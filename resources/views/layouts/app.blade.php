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
    <header>
        <nav class="container">
            <a href="/" class="logo">🐱 ねこの予約システム</a>
            <ul class="nav-links">
                <li><a href="/">ホーム</a></li>
                <li><a href="{{ route('front.reservation.index') }}">予約</a></li>
            </ul>
        </nav>
    </header>

    <!-- メインコンテンツ -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- フッター -->
    <footer>
        <div class="container">
            <p>&copy; 2025 ねこの予約システム. All rights reserved.</p>
            <p style="margin-top: 10px; font-size: 14px; opacity: 0.8;">
                〒165-0033 東京都中野区 | 営業時間: 8:00～20:00（金土休）
            </p>
        </div>
    </footer>

    <!-- ページ固有のJavaScript -->
    @stack('scripts')
</body>
</html>