@extends('layouts.app')

@section('content')
<div class="admin">
    <h2>商品編集</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name',$product->name) }}">
            @error('name')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image">画像</label>
            <input type="file" name="image" id="image">
            @if($product->image)
            <div class="image-preview">
                <img src="{{ asset('storage/' . $product->image) }}" alt="現在の画像" style="max-width: 200px;">
            </div>
            @endif
            @error('image')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">説明</label>
            <textarea name="description" id="description">{{ old('description',$product->description) }}</textarea>
            @error('description')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>季節</label><br>
            @foreach($seasons as $season)
            <label>
                <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                    {{ in_array($season->id, old('seasons',$selectedSeasons)) ? 'checked' : '' }}>
                {{ $season->name }}
            </label>
            @endforeach
            @error('seasons')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection