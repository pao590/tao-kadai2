@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('page_title', '商品詳細画面')

@section('content')
<div class="product-detail">
    <h2>{{ $product->name }}</h2>

    <div class="product-detail__image" style="margin-bottom: 20px;">
        @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

        @else
        <p>画像が登録されていません。</p>
        @endif
    </div>

    <p><strong>価格:</strong> ¥{{ number_format($product->price) }}</p>

    <p><strong>季節:</strong>
        @foreach ($product->seasons as $season)
        {{ $season->name }}@if (!$loop->last)、@endif
        @endforeach
    </p>

    <p><strong>商品説明:</strong></p>
    <p>{{ $product->description }}</p>

    <div class="form-buttons" style="margin-top: 30px;">
        <a href="{{ route('products.edit', $product->id) }}" class="btn-edit">編集する</a>
        <a href="{{ route('products.index') }}" class="btn-back">一覧へ戻る</a>
    </div>

    <h1>{{ $product->name }}</h1>

    <a href="{{ route('products.comment.create' , $product->id) }}">
        コメントを投稿する
    </a>

    <h2>コメント一覧</h2>
    @foreach ($product->comments as $comment)
    <div>
        <strong>{{ $comment->user->name }}</strong><br>
        {{ $comment->content }}
    </div>
    @endforeach
</div>
@endsection