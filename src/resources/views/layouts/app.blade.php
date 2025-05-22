<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <h1 class="header__heading">mogitate
            </h1>
            @yield('page_title')
            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline; margin-left: 20px;">
                    @csrf
                    <button type="submit" style="background:none; border:none; cursor:pointer; color:#007bff; text-decoration:underline; padding:0; font-size: 1rem;">ログアウト
                    </button>
                </form>
            @endauth
        </header>

        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>