<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約カレンダー - ねこの予約システム</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Sawarabi Gothic,sans-serif;
            line-height: 1.6;
            color: #3c4c80;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ヘッダー */
        header {
            background-color: #797a7e;
            height: 80px;
            padding: 16px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            font-family: 'Zen Maru Gothic', sans-serif;
            color: #fff;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            font-weight: 700;
        }
        .line-reservation {
            margin: 0 6px 0 0;
            background-color: #fff;
        }
        .line-reservation-section{
            color: #797a7e;
            padding: 8px 16px;
            border-radius: 24px;
            display: flex;
        }
        .mail-reservation {
            background-color: #fff;
        }
        .line-reserve a{
            color: #797a7e;
            text-decoration: none;
        }
        .header-menu {
            text-decoration: none;
            color: #fff;
        }
        .nav-links li {
            padding-top: 8px;
        }

        .nav-links a {
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            opacity: 0.6;
        }
        .line-reserve:hover,
        .line-reserve:hover a {
            transition: all 0.3s ease;
            background-color: #797a7e;
            color: #fff;
            opacity: 1;
        }

        /* メインコンテンツ */
        .main-content {
            min-height: calc(100vh - 200px);
        }

        .section-reservation {
            padding: 24px;
        }

        .page-title {
            font-size: 32px;
            color: #797a7e;
            margin-bottom: 10px;
        }
        .title-border {
            width: 8rem;
            height: 2px;
            background: #212121;
            display: flex;
        }

        .page-subtitle {
            color: #7f8c8d;
            font-size: 16px;
        }

        .calendar-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 30px;
        }
        .calendar-before-button {
            background-color: #97b7d6;
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1.25rem;
            transition: 0.3s;"
        }
        .calendar-after-button {
            background-color: #97b7d6;
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1.25rem;
            transition: 0.3s;"
        }

        .nav-btn:hover {
            background: #d35400;
            transform: translateY(-2px);
        }

        .current-month {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            min-width: 200px;
            text-align: center;
        }
        .calendar-target-month {
            background-color: #97b7d6;
            padding: 1rem 2.5rem;
            border-radius: 100px;
            font-weight: 700;
            color: #fff;
            font-size: 1.25rem;"
        }

        /* カレンダーテーブル */
        .calendar-container {
            background: #fff;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, rgb(249, 250, 251), rgb(243, 244, 246));
            border-radius: 16px;
            padding: 1.5rem;
            overflow-x: auto;
        }
        .calender-container {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid rgb(226, 232, 240);
        }

        .calendar-table {
            width: 100%;
            border-spacing: 8px;
            border-collapse: collapse;
            min-width: 800px;
        }

        .calendar-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .calendar-header th {
            padding: 20px 10px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .time-header {
            width: 100px;
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        }

        .date-header {
            padding: 1rem 0.75rem;
            background: rgb(151, 183, 214);
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            position: sticky;
            left: 0px;
            z-index: 2;
            width: 80px;
        }
        .date-header-date {
            padding: 1rem 0.5rem;
            background: rgb(151, 183, 214);
            color: white;
            font-weight: 600;
            font-size: 0.8rem;
            white-space: nowrap;
        }

        .calendar-body tr:nth-child(even) {
            background: #f8f9fa;
        }

        .time-cell {
            font-weight: bold;
            padding: 1rem;
            background: white;
            border-radius: 12px;
            text-align: center;
            color: rgb(75, 85, 99);
        }

        .availability-cell {
            border: 1px solid #e0e0e0;
            position: relative;
            padding: 1rem;
            background: linear-gradient(135deg, rgb(209, 250, 229), rgb(167, 243, 208));
            border-radius: 12px;
            text-align: center;
            font-weight: 700;
            color: rgb(5, 150, 105);
            cursor: pointer;
            transition: 0.3s;"
        }

        .availability-btn {
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-weight: bold;
            font-size: 24px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            margin: 2px auto;
            display: block;
        }

        .available {
            background: transparent;
            color: #2ecc71;
            border: none;
        }

        .available:hover {
            color: #27ae60;
            transform: scale(1.05);
        }

        .unavailable {
            background: transparent;
            color: #e74c3c;
            border: none;
            cursor: not-allowed;
        }

        /* ユーザー選択セクション */
        .user-selection {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }

        .user-selection h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .user-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .user-btn {
            background: white;
            color: #333;
            border: 1px solid #ddd;
            padding: 18px 25px;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: bold;
            font-size: 16px;
        }

        .user-btn:hover {
            background: #f5f5f5;
        }

        .user-name {
            font-size: 16px;
        }

        .user-selection-desc {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 10px;
        }

        /* 凡例 */
        .legend {
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        .legend-items {
            display: flex;
            gap: 30px;
            justify-content: center;
        }

        .legend-items span {
            font-size: 16px;
            color: #2c3e50;
        }
        .line-icon {
            width: 32px;
            vertical-align: middle;
        }

        /* LINE予約ボタン（ヘッダー用） */
        .line-reservation-btn {
            background: linear-gradient(135deg, #00b900, #00a000);
            color: white;
            display: ruby-text;
            padding: 18px 40px;
            border-radius: 30px;
            border: 2px solid transparent;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 185, 0, 0.3);
        }

        .line-reservation-btn:hover {
            background: linear-gradient(135deg, #009900, #008800);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 185, 0, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .footer-info {
            clear: both;
            float: left;
            width: 40%;
            height: auto;
            margin: 0;
            padding: 0 2% 0 0;
            text-align: left;
        }

        .footer-map {
            float: right;
            width: 50%;
            margin: 0;
            padding: 5px;
            background: #fff;
        }
        .footer-map img {
            max-width: 100%;
        }
        .entry-title {
            clear: both;
            width: 100%;
            height: auto;
            margin: 0 0 30px;
            padding: 10px 0 10px 8%;
            text-align: left;
            font-size: 40px;
            color: #81a1c0;
            line-height: 120%;
            font-weight: normal;
            border-bottom: 1px solid #81a1c0;
        }
        .wrapper {
            width: 80%;
            margin: 0 auto;
            padding-top: 40px;
            background-color: #fff;
        }

        /* レスポンシブ */
        @media (max-width: 768px) {
            .calendar-container {
                overflow-x: auto;
            }

            .calendar-table {
                min-width: 600px;
            }

            .nav-links {
                flex-direction: column;
                gap: 15px;
            }

            .calendar-nav {
                flex-direction: column;
                gap: 15px;
            }

            .legend-items {
                flex-direction: column;
                gap: 15px;
            }

            .user-buttons {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .user-btn {
                padding: 15px 20px;
                font-size: 14px;
            }
        }

        /* フッター */
        footer {
            background-color: #797a7e;
            color: #ecf0f1;
            text-align: center;
            padding: 50px 3% 30px;
            margin-top: 40px;
            height: 400px;
        }
        .include-tax {
            color: #232323;
        }
        .course-title {
            clear: both;
            width: 100%;
            height: auto;
            margin: 30px 0 30px;
            padding: 10px 2%;
            text-align: left;
            font-weight: normal;
            font-size: 25px;
            line-height: 100%;
            background: #97b7d6;
            color: #fff;
        }
        .course-menu {
            margin: 0 auto;
            border-bottom: 1px dashed #81a1c0;
        }
        .course-menu img {
            display: block;
            margin: 0 auto;
        }
        .course-menu-title {
            text-align: center;
            color: #232323;
            font-size: 24px;
        }
        #price-taiju {
            clear: both;
            float: left;
            width: 100%;
            height: auto;
            margin: 0 0 30px;
            padding: 20px 5%;
            border: 1px solid #81a1c0;
        }
        #price-taiju ul {
            clear: both;
            float: left;
            width: 100%;
            height: auto;
            margin: 0;
            padding: 0;
        }
        #price-taiju ul li {
            float: left;
            width: auto;
            text-align: left;
            margin: 0 3% 15px 0;
            padding: 0;
            line-height: 100%;
            list-style-type: disc;
            list-style-position: inside;
        }
        :marker {
            unicode-bidi: isolate;
            font-variant-numeric: tabular-nums;
            text-transform: none;
            text-indent: 0px !important;
            text-align: start !important;
            text-align-last: auto !important;
        }
        .line-note {
            display: block;
        }
        #option-wrapper {
            clear: both;
            float: left;
            width: 100%;
            height: auto;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .option img {
            max-width: 100%;
            margin: 0 0 25px;
            z-index: 1;
        }
        .option {
            width: 31.3%;
            height: auto;
            margin: 0 2% 50px 0;
            padding: 25px 3% 5px;
            border: 1px solid #97b7d6;
            position: relative;
        }
        .option img.op-ribon {
            float: left;
            max-width: 35%;
            top: 0;
            left: 0;
            margin: 0;
            z-index: 888;
            position: absolute;
        }
        .reservation-wrapper {
            display: flex;
        }
        p {
          display: inline;
        }
    </style>
</head>
<body>
    @include('layouts.header')
    <main class="main-content">
        <div class="wrapper">
            <section class="section-reservation">
                <h1 class="page-title">予約</h1>
                <span class="title-border"></span>
                <p class="page-subtitle">ご希望の日時をお選びください（○：空きあり ×：満席）</p>

                <!-- LINE予約方法説明 -->

                <!-- LINE予約ボタン -->
                <div class="line-reservation-section">
                    <div class="reservation-wrapper">
                        <div class="line-reservation">
                            <a href="https://line.me/R/msg/text/?ねこサロンの予約を希望します。%0A%0A希望日時：%0A希望メニュー：%0A%0Aよろしくお願いします。" class="line-reservation-btn" target="_blank">
                                💬 LINEで直接予約する
                            </a>
                            <p class="line-note">
                                ※下記カレンダーで空き状況をご確認の上、LINEにて希望日時をお伝えください
                            </p>
                            <div class="line-guide">
                                <h3>LINE予約の流れ</h3>
                                <div class="line-guide-steps">
                                    <div class="line-guide-step">
                                        <p class="step-number">1</p>
                                        <p class="step-text">上の「LINEで直接予約する」ボタンをタップ</p>
                                    </div>
                                    <div class="line-guide-step">
                                        <p class="step-number">2</p>
                                        <p class="step-text">希望日時・メニューを入力して送信</p>
                                    </div>
                                    <div class="line-guide-step">
                                        <p class="step-number">3</p>
                                        <p class="step-text">スタッフから予約確認のご返信をお待ちください</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mail-reservation">
                            <a href="https://line.me/R/msg/text/?ねこサロンの予約を希望します。%0A%0A希望日時：%0A希望メニュー：%0A%0Aよろしくお願いします。" class="line-reservation-btn" target="_blank">
                                💬 LINEで直接予約する
                            </a>
                            <p class="line-note">
                                ※下記カレンダーで空き状況をご確認の上、LINEにて希望日時をお伝えください
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <h1 class="entry-title">メニュー</h1>
            <p class="include-tax">（税込表記）</p>
            <h2 class="course-title">
                コースメニュー
            </h2>
            <div class="course-menu">
                <img src="/images/heading-decoration-v2.png" alt="">
                <p class="course-menu-title">テストコース</p>
                <img src="/images/heading-decoration-bottom-v2.png" alt="">
                <p>★シャンプー ¥16,500</p>
                <p>★シャンプーカット ¥22,000</p>
                <p>内容爪切り、耳掃除、ブラッシング、シャンプー、ブロー、
                    ウルトラファインバブルシャワー、肛門腺絞り、写真動画サービス無し</p>
                <p>シャンプーカット上記内容＋全身カット</p>
            </div>
            <div class="course-menu">
                <img src="/images/heading-decoration-v2.png" alt="">
                <p class="course-menu-title">テストコース2</p>
                <img src="/images/heading-decoration-bottom-v2.png" alt="">
                <p>★シャンプー ¥16,500</p>
                <p>★シャンプーカット ¥22,000</p>
                <p>内容爪切り、耳掃除、ブラッシング、シャンプー、ブロー、
                    ウルトラファインバブルシャワー、肛門腺絞り、写真動画サービス無し</p>
                <p>シャンプーカット上記内容＋全身カット</p>
            </div>
            <div class="course-menu">
                <img src="/images/heading-decoration-v2.png" alt="">
                <p class="course-menu-title">テストコース3</p>
                <img src="/images/heading-decoration-bottom-v2.png" alt="">
                <p>★シャンプー ¥16,500</p>
                <p>★シャンプーカット ¥22,000</p>
                <p>内容爪切り、耳掃除、ブラッシング、シャンプー、ブロー、
                    ウルトラファインバブルシャワー、肛門腺絞り、写真動画サービス無し</p>
                <p>シャンプーカット上記内容＋全身カット</p>
            </div>
            <div id="price-taiju">
                <p><strong>撮影オプション</strong></p>
                <ul>
                    <li>バースデープラン　1100円　誕生日の衣装で記念撮影</li>
                </ul>
                <p><strong>体重別追加料金</strong></p>
                <ul>
                    <li>4キロ以下  定価</li>
                    <li>4～7 キロ 1,100円</li>
                    <li>7～10 キロ 2,200円</li>
                    <li>10キロ～ 3,300円</li>
                    <li>トリマー2人料金 5,500円</li>
                </ul>
            </div>
            <div id="price-taiju">
                <p><strong>毛玉料金</strong></p>
                <p>動いたら危ないので、皮膚に張り付く毛玉がある場合は毛玉が1つでもトリマー2人料金5,500円 + 毛玉料金をいただきます。<br>
                    麻酔無しでの毛玉取りは怪我や事故の危険性が高い施術の為、オーナーの吉見が行います。ご予約時に毛玉取りがある旨をお伝えいただけなかった場合、予約状況によってはお受け出来かねます。</p>
                <ul>
                    <li>10分以内　3,300円 + トリマー2人料金 + コース料金 </li>
                    <li>30分以内　8,800円 + トリマー2人料金 + コース料金 </li>
                    <li>1時間以内　11,000円 + トリマー2人料金 + コース料金</li>
                </ul>
            </div>
            <p>※毛玉やもつれ具合によってプラス料金をいただく場合がございます。</p>
            <p>※途中中断した場合は途中までの金額をいただきます。</p>
            <h2 class="course-title">
                【オプションメニュー】
            </h2>
            <div id="option-wrapper">
                <div class="option">
                    <a href="https://catsalonmewty.com/image/price-op2b.webp" data-lightbox="img03" data-title="クレンジング"><img decoding="async" src="https://catsalonmewty.com/image/price-op2.png" alt=""></a>
                    <img decoding="async" src="https://catsalonmewty.com/image/op-back.png" alt="" class="op-ribon">
                    <h4>クレンジング</h4>
                    <p class="f20blue">¥1,100〜</p>
                    <p>ねこ専用クレンジングクリームを使ってスタットテイルやあごニキビなどの皮脂を落とします。<br>
                        皮脂を落とすだけでなく、保湿もしてくれる高級クリームなので使う度に皮脂が改善されていきます。</p>
                </div>
                <div class="option">
                    <a href="https://catsalonmewty.com/image/price-op3b.webp" data-lightbox="img03" data-title="部分カット"><img decoding="async" src="https://catsalonmewty.com/image/price-op3.png" alt=""></a>
                    <img decoding="async" src="https://catsalonmewty.com/image/op-back.png" alt="" class="op-ribon">
                    <h4>部分カット</h4>
                    <p>1箇所につき <span class="f20blue">¥1,100〜</span></p>
                    <p>足裏足まわり、おしりなど部分的なカットをします。<br>4箇所以上はシャンプーカットコースになります。</p>
                    <a href="https://catsalonmewty.com/image/price-op12b.webp" data-lightbox="img03" data-title="部分カット Before＆After"><img decoding="async" src="https://catsalonmewty.com/image/price-op12.png" alt=""></a>
                </div>
                <div class="option">
                    <a href="https://catsalonmewty.com/image/price-op13b.webp" data-lightbox="img03" data-title="デザインカット"><img decoding="async" src="https://catsalonmewty.com/image/price-op13.png" alt=""></a>
                    <img decoding="async" src="https://catsalonmewty.com/image/op-back.png" alt="" class="op-ribon">
                    <h4>デザインカット</h4>
                    <p class="f20blue"><span>足ブーツ</span>¥2,200円<br>
                        <span>背中モヒカン</span>¥2,200円 <br>
                        <span>恐竜カット</span>¥4,400円 <br>
                        <span>ハートなど</span>¥5,500円～</p>
                    <p>恐竜カット、背中にハート、星などデザインカットでオシャレを楽しみましょう</p>
                </div>
            </div>
            <div id="option-wrapper">
                <div class="option">
                    <a href="https://catsalonmewty.com/image/price-op1b.webp" data-lightbox="img03" data-title="ハミガキ"><img decoding="async" src="https://catsalonmewty.com/image/price-op1.png" alt=""></a>
                    <img decoding="async" src="https://catsalonmewty.com/image/op-back.png" alt="" class="op-ribon">
                    <h4>ハミガキ</h4>
                    <p class="f20blue">¥1,100</p>
                    <p>ねこちゃんだって歯が命。健康寿命を伸ばすためにハミガキを推奨してます。ハミガキしながら歯を一本一本見るので歯の健康チェックにもなります。</p>
                    <!-- end div.op--></div>
                <div class="option">
                    <img decoding="async" src="https://catsalonmewty.com/image/price-op13.webp" alt="">
                    <img decoding="async" src="https://catsalonmewty.com/image/op-back.png" alt="" class="op-ribon">
                    <h4>スペシャルオーラルケア</h4>
                    <p class="f20blue">¥3,300</p>
                    <!-- end div.op--></div>
                <div class="option">
                    <a href="https://catsalonmewty.com/image/price-op10b.webp" data-lightbox="img03" data-title="レーキング"><img decoding="async" src="https://catsalonmewty.com/image/price-op10.png" alt=""></a>
                    <img decoding="async" src="https://catsalonmewty.com/image/op-back.png" alt="" class="op-ribon">
                    <h4>レーキング</h4>
                    <p>30分 <span class="f20blue">¥3,300〜</span><br>（＋10分ごと¥1,100）</p>
                    <p>トリミングナイフを使って抜け毛を処理します。<br>
                        換毛期の抜け毛でお困りの方にオススメです。全く痛くないので気持ち良さそうにしてくれるねこちゃんが多いです。</p>
                </div>
            </div>
            <!-- カレンダーナビゲーション -->
            <button></button>
            <div class="calendar-wrapper">
                <button class="calendar-before-button">
                    ←
                </button>
                <div class="calendar-target-month">
                    {{ now()->format('Y年m月') }}
                </div>
                <button class="calendar-after-button">
                    →
                </button>
            </div>

            <!-- ユーザー選択セクション -->
            <div class="user-selection">
                <h3>👥 スタッフ別スケジュール確認</h3>
                <div style="display: flex; gap: 1rem; margin-bottom: 2rem; justify-content: center; flex-wrap: wrap;">
                    @if(isset($staffList))
                        @foreach($staffList as $staffMember)
                            <button style="background: white; color: rgb(107, 114, 128); border: 2px solid rgb(229, 231, 235); padding: 1rem 2rem; border-radius: 100px; cursor: pointer; font-size: 1rem; font-weight: 600; display: flex; align-items: center; gap: 0.75rem; transition: 0.3s; box-shadow: rgba(0, 0, 0, 0.05) 0px 2px 8px;" onclick="showUserSchedule('{{ $staffMember->name }}')">
                                <span class="user-name">{{ $staffMember->name }}</span>
                            </button>
                        @endforeach
                    @endif
                </div>
                <p class="user-selection-desc">↑ スタッフ名をクリックして個別の空き時間をチェック</p>
            </div>
            <div class="calender-container">
                <table class="calendar-table">
                    <thead>
                    <tr>
                        <th class="date-header">
                            時間
                        </th>
                        @for($i = 0; $i < 7; $i++)
                            @php
                                $date = $monday->copy()->addDays($i);
                            @endphp
                            <th class="date-header-date">{{ $date->format('n/j') }}({{ ['日','月','火','水','木','金','土'][$date->dayOfWeek] }})</th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody class="calendar-body" id="calendarBody">
                    @php
                        $timeSlots = [
                            '10:00',
                            '10:30',
                            '11:00',
                            '11:30',
                            '12:00',
                            '12:30',
                            '13:00',
                            '13:30',
                            '14:00',
                            '14:30',
                            '15:00',
                            '15:30',
                            '16:00',
                            '16:30',
                            '17:00',
                            '17:30',
                            '18:00',
                            '18:30',
                        ];
                    @endphp
                    @foreach($timeSlots as $timeKey => $timeDisplay)
                        <tr>
                            <td class="time-cell">{!! $timeDisplay !!}</td>
                            @for($i = 0; $i < 7; $i++)
                                @php
                                    $date = $monday->copy()->addDays($i);
                                    $isAvailable = rand(0, 10) > 3; // ランダムで空き状況を決定（実際は予約データベースから取得）
                                @endphp
                                <td class="availability-cell">
                                    @if($isAvailable)
                                        <p class="availability-btn available" onclick="selectSlot('全員対応', '{{ $timeKey }}', '{{ $date->format('Y-m-d') }}')">○</p>
                                    @else
                                        <p class="availability-btn unavailable">×</p>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                    </tbody>
                </table><div style="display: flex; justify-content: center; gap: 2rem; margin-top: 1.5rem;"><div style="display: flex; align-items: center; gap: 0.5rem;"><div style="width: 24px; height: 24px; border-radius: 6px; background: linear-gradient(135deg, rgb(209, 250, 229), rgb(167, 243, 208));"></div><span style="color: rgb(107, 114, 128); font-weight: 500;">空きあり</span></div><div style="display: flex; align-items: center; gap: 0.5rem;"><div style="width: 24px; height: 24px; border-radius: 6px; background: linear-gradient(135deg, rgb(254, 226, 226), rgb(254, 202, 202));"></div><span style="color: rgb(107, 114, 128); font-weight: 500;">満席</span></div></div></div>
        </div>
    @include('layouts.footer')
</body>
</html>
