@extends('layouts.app')

@section('content')
<div class="admin">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image">画像</label>
            <input type="file" name="image" id="image">
            @error('image')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">説明</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>季節</label><br>
            @foreach($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                    {{ in_array($season->id,old('seasons',[]))? 'checked' : ''}}>
                    {{ $season->name }}
                </label>
            @endforeach
            @error('seasons')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit">登録する</button>
        </div>
    </form>
</div>
@endsection

<!-- 商品登録ページ -->