<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('seasons')->get();
        return view('products.index',compact('products'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(Request $request)
    {
        $request->validate(Product::$rules);

        $product = Product::create($request->only([
            'name',
            'price',
            'image',
            'description'
        ]));

        $product->seasons()->sync($request->seasons);

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        return view('products.show',compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $seasons = Season::all();
        $selectedSeasons = $product->seasons->pluck('id')->toArray();

        return view('products.edit',compact(
            'product',
            'seasons',
            'selectedSeasons'
        ));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $request->validate(Product::$rules);

        $product = Product::findOrFail($product);
        $product->update($request->only([
            'name',
            'price',
            'image',
            'description'
        ]));
        $product->seasons()->sync($request->seasons);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->seasons()->detach();
        $product->delete();

        return redirect()->route('products.index');
    }
}
