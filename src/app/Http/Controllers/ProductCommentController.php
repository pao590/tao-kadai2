<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class ProductCommentController extends Controller
{
    public function create(Product $product)
    {
        return view('comments.create', compact('product'));
    }

    public function store(CommentRequest $request, Product $product)
    {
        $product->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->comment,
        ]);

        return redirect()->route('products.show', $product->id)->with('success', 'コメントを投稿しました！');
    }
}
