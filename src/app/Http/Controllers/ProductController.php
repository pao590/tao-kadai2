<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('price_order')) {
            $query->orderBy('price', $request->price_order);
        }

        $products = $query->with('seasons')->paginate(6);

        $user = Auth::user();

        return view('products.index', compact('products', 'user'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->only(['name', 'price', 'description', 'seasons']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store(
                'images',
                'public'
            );
        }

        $product = Product::create($data);
        $product->seasons()->attach($request->seasons);

        $product->comments()->create([
            'user_id' => Auth::id(),
            'content' => 'おいしそう',
        ]);

        return redirect()->route('products.index')->with('success', '登録完了しました');
    }


    public function show($id)
    {
        $product = Product::with('seasons','comments.user')->findOrFail($id);
        $seasons = Season::all();
        $profile = \App\Models\Profile::where('user_id', auth()->id())->first();
        $comments = $product->comments()->with('user')->get();


        return view('products.show', compact('product', 'seasons', 'profile', 'comments'));
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $seasons = Season::all();

        return view('products.edit', compact(
            'product',
            'seasons'
        ));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->only(['name', 'price', 'description', 'seasons']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store(
                'images',
                'public'
            );
        }

        $product->update($data);

        $product->seasons()->sync($data['seasons']);

        return redirect()->route('products.show', $product)->with('success', '更新完了しました');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // 画像削除
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->seasons()->detach();
        $product->delete();

        return redirect()->route('products.index');
    }
}
