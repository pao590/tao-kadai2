@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('page_title','コメント投稿')

@section('content')
    <h2>コメントを投稿</h2>
    <form action="{{ route('products.comment.store', $product->id) }}" method="POST">
    @csrf
    <textarea name="comment" rows="5" cols="40" required></textarea><br>
    <button type="submit">投稿する</button>
    </form>

@endsection