@extends('layouts.app')

@section('title', 'ご予約からトリミングの流れ')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/flow.css') }}">
@endpush

@section('content')
    <div class="flow-wrapper">
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

    <!-- STEP7 仕上がり・お迎え -->
    <div class="step">
        <div class="step-badge-container">
            <div class="step-line"></div>
            <div class="step-badge">
                <span class="step-number">STEP7</span>
                <span class="step-title">仕上がり・お迎え</span>
            </div>
            <div class="step-line"></div>
        </div>
        <div class="step-content">
            <p>季節に合わせたフォトスペースで撮影します。</p>
            <div class="image-grid grid-4">
                <div class="placeholder-img" style="width: 130px; height: 100px;">🐱</div>
                <div class="placeholder-img" style="width: 130px; height: 100px;">🐱</div>
                <div class="placeholder-img" style="width: 130px; height: 100px;">🐱</div>
                <div class="placeholder-img" style="width: 130px; height: 100px;">🐱</div>
            </div>
            <p style="margin-top: 15px;">終了後にオーナー様に連絡をし、お迎えに来ていただきます。</p>
            <p>仕上がりの報告をしていただき、トリミングの様子を写真や動画を見ながら報告します。</p>
            <p class="note">（シングルコースは写真現物サービス（グッズはご相談ください））</p>
            <p style="margin-top: 15px;">最後に、お支払い頂きます。</p>
        </div>
    </div>
    </div>
@endsection
