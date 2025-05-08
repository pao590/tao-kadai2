<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

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

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated
        ();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        $product = Product::create($validated);
        $product->seasons()->attach($request->seasons);

        return redirect()->route('products.index')->with('success', '登録完了しました');
    }


    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();
        return view('products.show', compact('product', 'seasons'));
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $seasons = Season::all();
        $selectedSeasons = $product->seasons->pluck('id')->toArray();

        return view('products.edit', compact(
            'product',
            'seasons',
            'selectedSeasons'
        ));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'seasons' => 'required|array',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);
        $product->seasons()->sync($request->seasons);

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
