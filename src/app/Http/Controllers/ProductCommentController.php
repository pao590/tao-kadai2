<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class ProductCommentController extends Controller
{
    public function create(Product $product)
    {
        return view('products.comment_create',compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'content' => $request->comment,
        ]);

        return redirect()->route('products.show',$product->id)->with('success','コメントを投稿しました！');
    }
    
}
