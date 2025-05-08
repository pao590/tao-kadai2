@extends('layouts.app')

@section('content')
<div class="product-list" style="padding: 20px;">
    <div style="margin-bottom: 20px; text-align: right;">
        <a href="{{ route('products.create') }}" class="btn btn-primary" style="padding: 10px 20px; background-color: #4CAF50; color: white; border-radius: 25px;">+ 商品を追加</a>
    </div>

    <h2 class="product-list__title" style="text-align: left;">商品一覧</h2>

    <form method="GET" action="{{ route('products.index') }}" style="margin-bottom: 10px;">
        <input type="text" name="keyword" placeholder="商品名を入力"
            value="{{ request('keyword') }}"
            style="border-radius: 25px; padding: 10px 20px; width: 300px; border: 1px solid #ccc; margin-bottom: 10px; display: block;">

        <button type="submit" style="padding: 5px 15px;">検索</button>

        <select name="price_order" onchange="this.form.submit()" style="margin-top: 10px;">
            <option value="">並び替え</option>
            <option value="asc" {{ request('price_order') == 'asc' ? 'selected' : '' }}>価格が安い順</option>
            <option value="desc" {{ request('price_order') == 'desc' ? 'selected' : '' }}>価格が高い順</option>
        </select>
    </form>

    @if(request('price_order'))
    <div style="margin-bottom: 15px;">
        <span style="display: inline-block; background: #eee; padding: 5px 10px; border-radius: 15px;">
            {{ request('price_order') == 'asc' ? '価格が安い順' : '価格が高い順' }}
            <a href="{{ route('products.index', ['keyword' => request('keyword')]) }}" style="margin-left: 10px; color: red;">×</a>
        </span>
    </div>
    @endif

    <div class="product-list__items" style="display: flex; flex-wrap: wrap; gap: 20px;">
        @forelse ($products as $product)
        <div class="product-card" style="width: 200px; border: 1px solid #ccc; border-radius: 10px; padding: 10px;">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

            <p style="font-weight: bold;">{{ $product->name }}</p>
            <p>¥{{ number_format($product->price) }}</p>
        </div>
        @empty
        <p>該当する商品は見つかりませんでした。</p>
        @endforelse
    </div>

    <div class="pagination" style="margin-top: 20px;">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection