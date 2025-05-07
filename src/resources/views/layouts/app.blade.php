<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>

<body>
    <header class="header">
        <p class="header__page-title">
            @yield('page_title')
        </p>
        <h1 class="header__logo">
            mogitate
        </h1>
    </header>

    <main class="main">
        @yield('content')
    </main>
</body>

</html>