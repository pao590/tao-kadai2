@extends('layouts.app')

@section('content')
<h2>ログイン</h2>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <label>Email</label>
    <input type="email" name="email" required autofocus>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">ログイン</button>
</form>
@endsection