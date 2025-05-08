@extends('layouts.app')

@section('page_title', '商品詳細画面')

@section('content')
<div class="product-detail">
    <h2>{{ $product->name }}</h2>

    <div class="product-detail__image">
        @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 300px;">
        @else
        <img src="{{ asset('images/no-image.png') }}" alt="No Image">
        @endif
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>商品名</label>
            <input type="text" name="name" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label>価格</label>
            <input type="number" name="price" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label>季節</label>
            @foreach ($seasons as $season)
            <label><input type="radio" name="seasons[]" value="{{ $season->id }}" {{ $product->seasons->contains($season->id) ? 'checked' : '' }}> {{ $season->name }}</label>
            @endforeach
        </div>

        <div class="form-group">
            <label>商品説明</label>
            <textarea name="description">{{ $product->description }}</textarea>
        </div>

        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">変更を保存</button>
        </div>
    </form>
</div>
@endsection