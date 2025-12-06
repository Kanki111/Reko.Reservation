<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ねこの予約システム')</title>

    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    <!-- ページ固有のCSS -->
    @stack('styles')
</head>
<body>
    <!-- ヘッダー -->
    @include('layouts.header')

    <!-- メインコンテンツ -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('layouts.footer')

    <!-- ページ固有のJavaScript -->
    @stack('scripts')

</body>
</html>
