@extends('layouts.app')

@section('content')
<div class="admin">
    <h2>商品一覧</h2>

    <a href="{{ route('products.create') }}">
        新規商品を登録
    </a>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>季節</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ number_format($product->price) }}
                </td>
                <td>
                    @foreach ($product->seasons as $season)
                    {{ $season->name}}
                    @if(!$loop->last),@endif
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('products.show',$product->id) }}">
                        詳細
                    </a>
                    <a href="{{ route('products.edit',$product->id) }}">
                        編集
                    </a>
                    <form action="{{ route('products.destroy',$product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('削除しますか？')">
                            削除
                        </button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

<!-- 商品一覧ページ -->