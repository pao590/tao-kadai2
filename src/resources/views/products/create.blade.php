@extends('layouts.app')

@section('page_title', '商品登録ページ')

@section('content')
<div class="product-form">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>商品名 <span class="required">必須</span></label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>価格 <span class="required">必須</span></label>
            <input type="number" name="price" value="{{ old('price') }}">
        </div>

        <div class="form-group">
            <label>商品画像 <span class="required">必須</span></label>
            <input type="file" name="image">
        </div>

        <div class="form-group">
            <label>季節 <span class="required">複数選択可</span></label>
            @foreach ($seasons as $season)
            <label><input type="checkbox" name="seasons[]" value="{{ $season->id }}"> {{ $season->name }}</label>
            @endforeach
        </div>

        <div class="form-group">
            <label>商品説明 <span class="required">必須</span></label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">登録</button>
        </div>
    </form>
</div>
@endsection