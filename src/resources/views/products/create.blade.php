@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('page_title', '商品登録')

@section('content')
<div class="product-form">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label" for="name">商品名</label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}">
            @error('name')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="price">価格</label>
            <input type="number" id="price" name="price" class="form-input" value="{{ old('price') }}">
            @error('price')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="image">商品画像</label>
            <input type="file" id="image" name="image" class="form-input">

            <img id="preview" src="" style="max-width: 300px; margin-top: 10px; display: none;">

            @error('image')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <script>
            document.getElementById('image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const preview = document.getElementById('preview');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            });
        </script>

        <div class="form-group">
            <label class="form-label">季節（複数選択可）</label>
            @foreach ($seasons as $season)
            <label><input type="checkbox" name="seasons[]" value="{{ $season->id }}"> {{ $season->name }}</label>
            @endforeach
            @error('seasons')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="description">商品説明</label>
            <textarea id="description" name="description" class="form-input">{{ old('description') }}</textarea>
            @error('description')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('products.index') }}" class="btn-submit">
                戻る
            </a>
        </div>
        <div class="form-buttons">
            <button type="submit" class="btn-submit">登録する</button>
        </div>
    </form>
</div>
@endsection