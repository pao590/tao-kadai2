<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>商品名</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}">
        @error('name') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>価格</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}">
        @error('price') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>季節</label><br>
        @foreach ($seasons as $season)
        <label>
            <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
            {{ $season->name }}
        </label>
        @endforeach
        @error('seasons') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>商品説明</label>
        <textarea name="description">{{ old('description', $product->description) }}</textarea>
        @error('description') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label>現在の画像</label><br>
        @if($product->image)
        <img id="current-image" src="{{ asset('storage/' . $product->image) }}" alt="現在の画像" style="max-width: 200px; border: 1px solid #ccc;">
        @else
        <p>画像が登録されていません</p>
        @endif
    </div>

    <div class="form-group">
        <label>新しい画像に変更（任意）</label>
        <input type="file" name="image" id="image">
        <br>
        <img id="preview" src="" style="max-width: 200px; margin-top: 10px; display: none; border: 1px solid #ccc;">
        @error('image') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            const current = document.getElementById('current-image');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                    if (current) current.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
                if (current) current.style.display = 'block';
            }
        });
    </script>

    <div class="form-buttons">
        <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
        <button type="submit" class="btn-submit">変更を保存</button>
    </div>
</form>

<form action="{{ route('products.destroy', $product->id) }}" method="POST" style="margin-top: 20px;">
    @csrf
    @method('DELETE')
    <button type="submit" style="color: red;">🗑 削除</button>
</form>