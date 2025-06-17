@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('page_title', '商品一覧')

@section('content')

<div class="right-contents">
    <p class="message">{{session('message')}}</p>
    <a href="/products/create" class="add-button"><span>+</span>商品を追加</a>
</div>

@if($user)
<div class="user-profile">
    <p><strong>名前:</strong> {{ $user->name }}</p>
    <p><strong>性別:</strong> {{ $user->profile->gender ?? '未登録' }}</p>
    <p><strong>誕生日:</strong> {{ $user->profile->birthday ?? '未登録' }}</p>
</div>
@endif

<div class="product-sidebar">
    <h2 class="product-list__title">商品一覧</h2>

    <form method="GET" action="{{ route('products.index') }}" style="margin-bottom: 10px;">
        <input type="text" name="keyword" placeholder="商品名を入力"
            value="{{ request('keyword') }}"
            style="border-radius: 25px; padding: 10px 20px; width: 300px; border: 1px solid #ccc; margin-bottom: 10px; display: block;">

        <button type="submit">検索</button>

        <select name="price_order" onchange="this.form.submit()" style="margin-top: 10px;">
            <option value="">並び替え</option>
            <option value="asc" {{ request('price_order') == 'asc' ? 'selected' : '' }}>価格が安い順</option>
            <option value="desc" {{ request('price_order') == 'desc' ? 'selected' : '' }}>価格が高い順</option>
        </select>
    </form>
</div>

<div class="product-main">
    <div class="product-list__items">
        @forelse ($products as $product)
        <div class="product-card" style="width: 200px; border: 1px solid #ccc; border-radius: 10px; padding: 10px;">
            <a href="/products/{{ $product->id }}">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <p style="font-weight: bold;">{{ $product->name }}</p>
                <p>¥{{ number_format($product->price) }}</p>
            </a>
        </div>
        @empty
        <p>該当する商品は見つかりませんでした。</p>
        @endforelse
    </div>


    <div class="pagination" style="margin-top: 20px;">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>

    @if(request('price_order'))
    <div style="margin-bottom: 15px;">
        <span style="display: inline-block; background: #eee; padding: 5px 10px; border-radius: 15px;">
            {{ request('price_order') == 'asc' ? '価格が安い順' : '価格が高い順' }}
            <a href="{{ route('products.index', ['keyword' => request('keyword')]) }}" style="margin-left: 10px; color: red;">×</a>
        </span>
    </div>
    @endif
</div>
@endsection
</div>