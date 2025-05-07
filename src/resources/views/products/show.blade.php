@extends('layouts.app')

@section('content')
<div class="admin">
    <h2>商品詳細</h2>

    <div>
        <p><strong>商品名:</strong>{{ $product->name }}</p>
        <p><strong>価格：</strong>{{ number_format($product->price)}}円</p>
        <p><strong>説明：</strong>{{$product->description}}</p>
        <p><strong>季節：</strong>
            @foreach($product->seasons as $season)
            {{ $season->name }}{{ !$loop->last ? '、' : '' }}
            @endforeach
        </p>
        <p><strong>画像：</strong></p>
        @if ($product->image_path)
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="商品画像" style="max-width: 300px;">
        @else
        <p>画像なし</p>
        @endif
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('products.edit',$product->id) }}">
            <button>編集する</button>
        </a>
        <a href="{{ route('products.index') }}">
            <button>戻る</button>
        </a>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('本当に削除しますか？')" title="削除" style="background: none; border: none; cursor: pointer;">
                🗑️
            </button>
        </form>
    </div>
</div>

@endsection

<!-- 詳細ページ -->