@extends('layouts.app')

@section('page_title', '商品詳細画面')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/list.css') }}" />
</head>

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
</div>
@endsection