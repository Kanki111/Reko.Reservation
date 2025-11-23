<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約システム - 猫専門サロン＆ホテル</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Hiragino Sans', 'Yu Gothic', 'Meiryo', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #fefefe;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ヘッダー */
        header {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 0;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #e67e22;
            padding: 10px 0;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 16px;
            padding: 12px 0;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #e67e22;
        }

        /* メインビジュアル */
        .hero {
            background: 
                linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)),
                url('/images/c658c0ef44c4bf2c172ef2d631917589_t.jpeg') center/cover;
            background-attachment: fixed;
            padding: 120px 0;
            text-align: center;
            position: relative;
        }
        
        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #ffffff;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.8);
            font-weight: 700;
        }

        .hero .subtitle {
            font-size: 20px;
            margin-bottom: 30px;
            color: #f8f9fa;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }

        .cta-button {
            display: inline-block;
            background-color: #e67e22;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 30px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .cta-button:hover {
            background-color: #d35400;
            transform: translateY(-2px);
        }

        /* サービスセクション */
        .services {
            padding: 80px 0;
            background-color: #fff;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            margin-bottom: 50px;
            color: #2c3e50;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 50px;
        }

        .service-card {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .service-card h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .service-card p {
            color: #7f8c8d;
            line-height: 1.6;
        }

        /* お知らせセクション */
        .news {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .news-item {
            background: #fff;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            border-left: 4px solid #e67e22;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .news-date {
            font-size: 14px;
            color: #95a5a6;
            margin-bottom: 5px;
        }

        .news-title {
            font-weight: bold;
            color: #2c3e50;
        }

        /* SNS セクション */
        .sns {
            padding: 80px 0;
            background-color: #fff;
        }

        .sns-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 30px;
        }

        .instagram-container {
            text-align: center;
            background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
            padding: 40px;
            border-radius: 20px;
            color: white;
        }

        .facebook-container {
            text-align: center;
            background: #1877f2;
            padding: 40px;
            border-radius: 20px;
            color: white;
        }

        .sns-icon {
            font-size: 64px;
            margin-bottom: 20px;
            display: block;
        }

        .sns-title {
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .sns-description {
            font-size: 14px;
            margin-bottom: 25px;
            opacity: 0.9;
            line-height: 1.5;
        }

        .sns-button {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            font-size: 14px;
            border: 2px solid rgba(255,255,255,0.3);
            transition: all 0.3s;
        }

        .sns-button:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        /* アクセスセクション */
        .access {
            padding: 80px 0;
            background-color: #fff;
        }

        .access-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-top: 30px;
        }

        .contact-info {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
        }

        .contact-info h4 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .contact-info p {
            margin-bottom: 10px;
            color: #555;
        }

        .phone-number {
            font-size: 24px;
            font-weight: bold;
            color: #e67e22;
            margin: 15px 0;
        }

        /* フッター */
        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 40px 0;
        }

        .social-links {
            margin-bottom: 20px;
        }

        .social-links a {
            color: #ecf0f1;
            font-size: 24px;
            margin: 0 15px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-links a:hover {
            transform: translateY(-3px);
            opacity: 0.8;
        }

        /* LINE連携ボタン */
        .line-contact {
            background: #00b900;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin: 10px;
            transition: all 0.3s;
        }

        .line-contact:hover {
            background: #009900;
            transform: translateY(-2px);
        }

        /* レスポンシブ */
        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                gap: 15px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero .subtitle {
                font-size: 16px;
            }

            .access-info {
                grid-template-columns: 1fr;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .sns-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .sns-title {
                font-size: 20px;
            }

            .sns-description {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <nav class="container">
            <div class="logo">🐱 予約システム</div>
            <ul class="nav-links">
                <li><a href="#home">トップ</a></li>
                <li><a href="#news">お知らせ</a></li>
                <li><a href="/reservation">予約</a></li>
            </ul>
        </nav>
    </header>

    <!-- メインビジュアル -->
    <section class="hero" id="home">
        <div class="container">
            <h1>東京の猫専門シャンプー・トリミングサロン</h1>
            <p class="subtitle">愛猫の美容と健康をプロがサポート</p>
            <a href="/reservation" class="cta-button">ご予約はこちら</a>
        </div>
    </section>

    <!-- 専門サービス紹介 -->
    <section style="padding: 60px 0; background-color: #fff;">
        <div class="container">
            <div style="max-width: 800px; margin: 0 auto; text-align: left; line-height: 1.8; color: #333; font-size: 16px;">
                <p>猫専門のシャンプーブロー・トリミング資格を持つ、プロのキャットグルーマーが、他店ではできないショーキャット仕上げの技術力で、猫の魅力を最大限に引き出します。</p>
                <p style="margin-top: 20px;">抜け毛・もつれや毛玉・猫ニキビや皮脂トラブルに悩んでいたお客さまに「数ヶ月ふわふわが続いて、毛玉ができなくなった」「抜け毛が気にならなくなった」「猫アレルギーが緩和された」「まるで別猫みたい」とご好評頂いております。</p>
                <p style="margin-top: 20px;">静かな完全個室で、施術はすべてマンツーマン。ご自宅では難しいお手入れを無麻酔で行います。</p>
            </div>
        </div>
    </section>

    <!-- サービスセクション -->
    <section class="services" id="services">
        <div class="container">
            <h2 class="section-title">サービス紹介</h2>
            <div class="service-grid">
                <div class="service-card">
                    <div class="service-icon">✂️</div>
                    <h3>トリミング・グルーミング</h3>
                    <p>猫専門のプロフェッショナルが、猫ちゃんのストレスを最小限に抑えながら、美しく仕上げます。</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🏨</div>
                    <h3>ペットホテル</h3>
                    <p>広々とした猫専用のお部屋で、愛猫が快適に過ごせる環境をご提供します。</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🩺</div>
                    <h3>健康チェック</h3>
                    <p>定期的な健康チェックで、猫ちゃんの体調管理をサポートします。</p>
                </div>
            </div>
        </div>
    </section>

    <!-- お知らせセクション -->
    <section class="news" id="news">
        <div class="container">
            <h2 class="section-title">お知らせ</h2>
            <div class="news-item">
                <div class="news-date">2025/11/20</div>
                <div class="news-title">年末年始の営業時間について</div>
            </div>
            <div class="news-item">
                <div class="news-date">2025/11/15</div>
                <div class="news-title">新サービス「猫ちゃんマッサージ」開始</div>
            </div>
            <div class="news-item">
                <div class="news-date">2025/11/10</div>
                <div class="news-title">オンライン予約システム導入のお知らせ</div>
            </div>
        </div>
    </section>

    <!-- SNS セクション -->
    <section class="sns" id="sns">
        <div class="container">
            <h2 class="section-title">SNSで最新情報をお届け</h2>
            <div class="sns-grid">
                <div class="instagram-container">
                    <span class="sns-icon">📷</span>
                    <h3 class="sns-title">Instagram</h3>
                    <p class="sns-description">
                        猫ちゃんたちの可愛い写真を毎日更新中！<br>
                        トリミング後のふわふわな猫ちゃんたちや、ホテルでくつろぐ様子をご覧ください
                    </p>
                    <a href="https://www.instagram.com/" target="_blank" class="sns-button">
                        Instagramをフォロー
                    </a>
                </div>
                <div class="facebook-container">
                    <span class="sns-icon">📘</span>
                    <h3 class="sns-title">Facebook</h3>
                    <p class="sns-description">
                        最新情報とお役立ち情報をお届け！<br>
                        営業時間の変更やキャンペーン情報、猫の健康に関する情報を発信中
                    </p>
                    <a href="https://www.facebook.com/" target="_blank" class="sns-button">
                        Facebookページへ
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- アクセス・お問い合わせ -->
    <section class="access" id="access">
        <div class="container">
            <h2 class="section-title">アクセス・お問い合わせ</h2>
            <div style="max-width: 600px; margin: 0 auto;">
                <div class="contact-info" style="text-align: center;">
                    <h4>💬 LINE１本でかんたん予約</h4>
                    <p>（年中無休／24時間受付中）</p>
                    <a href="#" class="line-contact" style="display: block; margin: 20px 0; text-align: center;">
                        💬 LINE予約はこちら
                    </a>
                    <a href="/reservation" class="cta-button" style="display: inline-block; margin-top: 15px;">
                        予約カレンダーへ
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- フッター -->
    <footer>
        <div class="container">
            <div class="social-links">
                <a href="https://www.instagram.com/" target="_blank" title="Instagram">📷</a>
                <a href="https://www.facebook.com/" target="_blank" title="Facebook">📘</a>
                <a href="#" target="_blank" title="LINE">💬</a>
            </div>
            <p>&copy; 2025 予約システム. All rights reserved.</p>
            <p style="margin-top: 10px; font-size: 14px; opacity: 0.8;">
                〒165-0033 東京都中野区 | 営業時間: 8:00～20:00（金土休）
            </p>
        </div>
    </footer>
</body>
</html>