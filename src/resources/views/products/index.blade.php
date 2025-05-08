@extends('layouts.app')

@section('page_title', '商品一覧ページ')

@section('content')
<div class="product-list">
    <h2 class="product-list__title">商品一覧</h2>

    <div class="product-list__actions">
        <form class="product-list__search">
            <input type="text" name="keyword" placeholder="商品名を入力">
            <button type="submit">検索</button>
            <select name="price_order">
                <option value="">価格順で表示</option>
                <option value="asc">安い順</option>
                <option value="desc">高い順</option>
            </select>
        </form>
        <a href="{{ route('products.create') }}" class="btn-register">+ 商品を登録</a>
    </div>

    <div class="product-list__items">
        @foreach ($products as $product)
        <div class="product-card">
            @if($product->image)
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
            @else
            <img src="{{ asset('images/no-image.png') }}" alt="No Image">
            @endif
            <p class="product-card__name">{{ $product->name }}</p>
            <p class="product-card__price">¥{{ number_format($product->price) }}</p>
        </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection