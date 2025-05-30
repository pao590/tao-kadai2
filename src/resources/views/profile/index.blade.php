@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>プロフィール登録</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('profile.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="gender">性別</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="">選択してください</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="birthday">誕生日</label>
            <input type="date" name="birthday" id="birthday" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">登録する</button>
    </form>
</div>
@endsection