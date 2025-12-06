@extends('layouts.app')

@section('title', 'ご予約からトリミングの流れ')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500&display=swap" rel="stylesheet">

<style>
        /* フローページ固有のスタイル */
        body {
            background: linear-gradient(180deg, #f0f8fc 0%, #e5f3fa 100%) !important;
            font-family: 'Noto Sans JP', sans-serif !important;
            color: #555 !important;
            font-size: 14px !important;
            line-height: 1.8 !important;
        }

        .container {
            max-width: 800px !important;
        }

        /* フロー専用のページタイトル */
        .page-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 20px;
            font-weight: 400;
            color: #7ab8d6;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .snowflake {
            color: #9ed0e8;
        }

        /* ステップ */
        .step {
            display: flex;
            gap: 30px;
            margin-bottom: 20px;
            position: relative;
        }

        .step-badge-container {
            width: 100px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .step-line {
            width: 1px;
            flex-grow: 1;
            border-left: 1px dashed #b5d9eb;
        }

        .step-badge {
            width: 90px;
            height: 60px;
            border: 2px solid #9ed0e8;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #fff;
            position: relative;
        }

        .step-badge::after {
            content: '';
            position: absolute;
            inset: 4px;
            border: 1px solid #c5e4f2;
            border-radius: 50%;
        }

        .step-number {
            font-size: 10px;
            color: #9ed0e8;
            letter-spacing: 0.05em;
        }

        .step-title {
            font-size: 14px;
            color: #7ab8d6;
            font-weight: 500;
        }

        .step-content {
            flex: 1;
            padding-top: 10px;
        }

        /* テキストスタイル */
        .text-blue {
            color: #7ab8d6;
        }

        .text-small {
            font-size: 12px;
            color: #888;
        }

        a {
            color: #7ab8d6;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* ボタン */
        .btn {
            display: inline-block;
            padding: 10px 24px;
            border-radius: 25px;
            font-size: 13px;
            text-decoration: none;
            margin-right: 10px;
            margin-top: 10px;
        }

        .btn-primary {
            background: #8dc9e5;
            color: #fff;
        }

        .btn-secondary {
            background: #fff;
            color: #7ab8d6;
            border: 1px solid #9ed0e8;
        }

        /* セクションタイトル */
        .section-title {
            text-align: center;
            margin: 30px 0 20px;
            padding: 15px;
            background: linear-gradient(90deg, transparent 0%, #e5f3fa 50%, transparent 100%);
        }

        .section-title h3 {
            font-size: 16px;
            font-weight: 400;
            color: #7ab8d6;
        }

        .section-title p {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }

        /* サブセクション */
        .sub-section {
            background: #f5fafc;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .sub-section-title {
            display: inline-block;
            background: #9ed0e8;
            color: #fff;
            padding: 4px 16px;
            border-radius: 15px;
            font-size: 12px;
            margin-bottom: 10px;
        }

        /* 画像グリッド */
        .image-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 15px;
        }

        .image-grid img {
            border-radius: 8px;
            object-fit: cover;
        }

        .image-grid.grid-6 img {
            width: 100px;
            height: 75px;
        }

        .image-grid.grid-2 img {
            width: 140px;
            height: 100px;
        }

        .image-grid.grid-3 img {
            width: 120px;
            height: 90px;
        }

        .image-grid.grid-8 img {
            width: 90px;
            height: 70px;
        }

        .image-grid.grid-4 img {
            width: 130px;
            height: 100px;
        }

        .image-grid.grid-1 img {
            width: 150px;
            height: 110px;
        }

        /* 下向き矢印 */
        .arrow-down {
            text-align: center;
            margin: 10px 0;
            color: #b5d9eb;
            font-size: 20px;
        }

        /* リンクセクション */
        .link-section {
            text-align: center;
            margin: 20px 0;
        }

        .link-section a {
            color: #7ab8d6;
            font-size: 13px;
        }

        /* 注意書き */
        .note {
            font-size: 12px;
            color: #888;
            margin-top: 10px;
        }

        .note-box {
            background: #f5fafc;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 13px;
            line-height: 2;
        }

        /* プレースホルダー画像 */
        .placeholder-img {
            background: linear-gradient(135deg, #e8f4f9 0%, #d4e9f2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ed0e8;
            font-size: 24px;
            border-radius: 8px;
        }
    </style>
@endpush

@include('layouts.header')
@section('content')
    <!-- タイトル -->
    <h1 class="page-title">
        <span class="snowflake">❄</span>
        ご予約からトリミングの流れ
    </h1>

    <!-- STEP1 ご予約 -->
    <div class="step">
        <div class="step-badge-container">
            <div class="step-line"></div>
            <div class="step-badge">
                <span class="step-number">STEP1</span>
                <span class="step-title">ご予約</span>
            </div>
            <div class="step-line"></div>
        </div>
        <div class="step-content">
            <p>混雑時等を回避する為、予約時にご利用規約の発信、新入情報をお願いしております。</p>
            <p class="text-small" style="margin-top: 10px;">
                <a href="#">※ご利用規約</a><br>
                <a href="#">※特定商法取引法に基づく表記</a><br>
                <a href="#">※プライバシーポリシー</a>
            </p>
            <div class="note-box">
                一年以内にワクチンの接種<br>
                1ヶ月以内にノミ・ダニの予防をお済みかご確認ください。<br>
                全てのねこちゃんが安心して来れるようご協力をお願いいたします。
            </div>
            <p style="margin-top: 15px;">ご予約は下記からどうぞ。</p>
            <div>
                <a href="#" class="btn btn-primary">LINEでのご予約はこちら</a>
                <a href="#" class="btn btn-secondary">Web予約はこちら</a>
            </div>
        </div>
    </div>

    <div class="arrow-down">▽</div>

    <!-- STEP2 ご来店 -->
    <div class="step">
        <div class="step-badge-container">
            <div class="step-line"></div>
            <div class="step-badge">
                <span class="step-number">STEP2</span>
                <span class="step-title">ご来店</span>
            </div>
            <div class="step-line"></div>
        </div>
        <div class="step-content">
            <p>当日、ご予約時間の5分前くらいを目安にご来店ください。</p>
            <p style="margin-top: 10px;">
                ・持ち物<br>
                ・一年以内のワクチン証明書<br>
                ・ちゅーるなどの好きなおやつ
            </p>
            <div class="sub-section">
                <span class="sub-section-title">問診</span>
                <p>ねこちゃんの健康チェックとオーナー様にご希望のメニュー内容を伺います。</p>
                <div class="image-grid grid-1">
                    <div class="placeholder-img" style="width: 150px; height: 110px;">🐱</div>
                </div>
            </div>
        </div>
    </div>

    <!-- セクション：ねこちゃんのお預かり -->
    <div class="section-title">
        <h3>ねこちゃんのお預かり</h3>
        <p>お預かり中は気がかねばすぐにご連絡いたします。</p>
    </div>

    <div class="arrow-down">▽</div>

    <!-- STEP3 下準備 -->
    <div class="step">
        <div class="step-badge-container">
            <div class="step-line"></div>
            <div class="step-badge">
                <span class="step-number">STEP3</span>
                <span class="step-title">下準備</span>
            </div>
            <div class="step-line"></div>
        </div>
        <div class="step-content">
            <p>爪切り、爪磨き、ブラッシングをします。<br>
                必要な場合はクレンジングをしたり、<br>
                （クレンジングはねこ専用クリームで皮脂を落とします）</p>
            <div class="image-grid grid-6">
                <div class="placeholder-img" style="width: 100px; height: 75px;">🐱</div>
                <div class="placeholder-img" style="width: 100px; height: 75px;">🐱</div>
                <div class="placeholder-img" style="width: 100px; height: 75px;">🐱</div>
                <div class="placeholder-img" style="width: 100px; height: 75px;">🐱</div>
                <div class="placeholder-img" style="width: 100px; height: 75px;">🐱</div>
                <div class="placeholder-img" style="width: 100px; height: 75px;">🐱</div>
            </div>
        </div>
    </div>

    <div class="arrow-down">▽</div>

    <!-- STEP4 シャンプー -->
    <div class="step">
        <div class="step-badge-container">
            <div class="step-line"></div>
            <div class="step-badge">
                <span class="step-number">STEP4</span>
                <span class="step-title">シャンプー</span>
            </div>
            <div class="step-line"></div>
        </div>
        <div class="step-content">
            <p>ねこ専用シャンプーで皮脂や汚れを落とします。</p>
            <div class="image-grid grid-2">
                <div class="placeholder-img" style="width: 140px; height: 100px;">🐱</div>
                <div class="placeholder-img" style="width: 140px; height: 100px;">🐱</div>
            </div>
        </div>
    </div>

    <div class="arrow-down">▽</div>

    <!-- STEP5 ブロー -->
    <div class="step">
        <div class="step-badge-container">
            <div class="step-line"></div>
            <div class="step-badge">
                <span class="step-number">STEP5</span>
                <span class="step-title">ブロー</span>
            </div>
            <div class="step-line"></div>
        </div>
        <div class="step-content">
            <p>音が静かなねこ専用ドライヤーで丁寧に全身を乾かします。</p>
            <div class="image-grid grid-3">
                <div class="placeholder-img" style="width: 120px; height: 90px;">🐱</div>
                <div class="placeholder-img" style="width: 120px; height: 90px;">🐱</div>
                <div class="placeholder-img" style="width: 120px; height: 90px;">🐱</div>
            </div>
        </div>
    </div>

    <div class="arrow-down">▽</div>

    <!-- STEP6 カット -->
    <div class="step">
        <div class="step-badge-container">
            <div class="step-line"></div>
            <div class="step-badge">
                <span class="step-number">STEP6</span>
                <span class="step-title">カット</span>
            </div>
            <div class="step-line"></div>
        </div>
        <div class="step-content">
            <p>ご希望のカット・スタイルに仕上げます。</p>
            <div class="image-grid grid-8">
                <div class="placeholder-img" style="width: 90px; height: 70px;">🐱</div>
                <div class="placeholder-img" style="width: 90px; height: 70px;">🐱</div>
                <div class="placeholder-img" style="width: 90px; height: 70px;">🐱</div>
                <div class="placeholder-img" style="width: 90px; height: 70px;">🐱</div>
                <div class="placeholder-img" style="width: 90px; height: 70px;">🐱</div>
                <div class="placeholder-img" style="width: 90px; height: 70px;">🐱</div>
                <div class="placeholder-img" style="width: 90px; height: 70px;">🐱</div>
                <div class="placeholder-img" style="width: 90px; height: 70px;">🐱</div>
            </div>
        </div>
    </div>

    <!-- リンク -->
    <div class="link-section">
        <a href="#">ねこちゃんのヘアカタログはこちら</a>
    </div>

    <div class="arrow-down">▽</div>

    <!-- STEP7 仕上がり -->
    <div class="step">
        <div class="step-badge-container">
            <div class="step-line"></div>
            <div class="step-badge">
                <span class="step-number">STEP7</span>
                <span class="step-title">仕上がり</span>
            </div>
            <div class="step-line"></div>
        </div>
        <div class="step-content">
            <p>季節に合わせたフォトスペースで撮影します。</p>
            <p class="note">（シングルコースは写真現物サービス（グッズはご相談ください））</p>
            <div class="image-grid grid-4">
                <div class="placeholder-img" style="width: 130px; height: 100px;">🐱</div>
                <div class="placeholder-img" style="width: 130px; height: 100px;">🐱</div>
                <div class="placeholder-img" style="width: 130px; height: 100px;">🐱</div>
                <div class="placeholder-img" style="width: 130px; height: 100px;">🐱</div>
            </div>
        </div>
    </div>

    <div class="arrow-down">▽</div>

    <!-- STEP8 お迎え -->
    <div class="step">
        <div class="step-badge-container">
            <div class="step-line"></div>
            <div class="step-badge">
                <span class="step-number">STEP8</span>
                <span class="step-title">お迎え</span>
            </div>
            <div class="step-line"></div>
        </div>
        <div class="step-content">
            <p>終了後にオーナー様に連絡をし、お迎えに来ていただきます。</p>
            <p>仕上がりの報告をしていただき、トリミングの様子を写真や動画を見ながら報告します。</p>
            <p class="note">（シングルコースは写真現物サービス（グッズはご相談ください））</p>
            <p style="margin-top: 15px;">最後に、お支払い頂きます。</p>
        </div>
    </div>
@endsection
