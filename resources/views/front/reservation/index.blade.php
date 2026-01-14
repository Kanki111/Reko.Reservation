@extends('layouts.app')

@section('title', '予約カレンダー - ねこの予約システム')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
@endpush

@section('content')
    <div class="wrapper">
        <!-- 予約ヘッダー -->
        <section class="reservation-header">
            <h2 class="reservation-title">ご予約</h2>
            <p class="reservation-description">下記カレンダーで空き状況をご確認の上、<br>LINEまたはメールからご予約ください</p>
        </section>

        <!-- 予約カード -->
        <section class="reservation-cards-section">
            <div class="reservation-cards-grid">
                <!-- LINEで予約 -->
                <div class="reservation-card">
                    <div class="reservation-card-header">
                        <div class="reservation-card-icon reservation-card-icon-line">💬</div>
                        <div>
                            <h3 class="reservation-card-title">LINEで予約</h3>
                            <span class="reservation-card-badge">おすすめ</span>
                        </div>
                    </div>
                    <ul class="reservation-card-list">
                        <li>24時間いつでも予約OK</li>
                        <li>予約確認・リマインド通知が届く</li>
                        <li>トーク画面で気軽に相談できる</li>
                        <li>予約変更・キャンセルもLINEで完結</li>
                    </ul>
                    <button class="reservation-card-btn reservation-card-btn-line">
                        <span>📱</span>LINEで予約する
                    </button>
                </div>

                <!-- メールで予約 -->
                <div class="reservation-card">
                    <div class="reservation-card-header">
                        <div class="reservation-card-icon reservation-card-icon-mail">✉️</div>
                        <div>
                            <h3 class="reservation-card-title">メールで予約</h3>
                        </div>
                    </div>
                    <ul class="reservation-card-list">
                        <li>詳細な要望を文章で伝えられる</li>
                        <li>予約内容を記録として残せる</li>
                        <li>LINEをお持ちでない方に</li>
                        <li>営業時間内に返信いたします</li>
                    </ul>
                    <button class="reservation-card-btn reservation-card-btn-mail">
                        <span>📧</span>メールで予約する
                    </button>
                </div>
            </div>

            <!-- 予約の流れ -->
            <div class="reservation-flow">
                <h4 class="reservation-flow-title">📋 ご予約の流れ</h4>
                <div class="reservation-flow-steps">
                    <div class="reservation-flow-step">
                        <div class="reservation-flow-number">1</div>
                        <span class="reservation-flow-text">📅 空き状況を確認</span>
                        <span class="reservation-flow-arrow">→</span>
                    </div>
                    <div class="reservation-flow-step">
                        <div class="reservation-flow-number">2</div>
                        <span class="reservation-flow-text">📱 LINE/メールで連絡</span>
                        <span class="reservation-flow-arrow">→</span>
                    </div>
                    <div class="reservation-flow-step">
                        <div class="reservation-flow-number">3</div>
                        <span class="reservation-flow-text">✅ 予約確定の連絡</span>
                        <span class="reservation-flow-arrow">→</span>
                    </div>
                    <div class="reservation-flow-step">
                        <div class="reservation-flow-number">4</div>
                        <span class="reservation-flow-text">🐕 当日ご来店</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- メニューセクション -->
        <section class="menu-section">
            <div class="menu-header">
                <h2 class="menu-title">メニュー</h2>
                <p class="menu-subtitle">（税込表記）</p>
            </div>

            <!-- コースメニュー -->
            <div class="menu-category">
                <h3 class="category-title">コースメニュー</h3>
                <div class="course-cards">
                    <div class="course-card">
                        <div class="course-card-header">
                            <h4 class="course-name">テストコース</h4>
                        </div>
                        <div class="course-card-body">
                            <div class="price-list">
                                <div class="price-item">
                                    <span class="price-label">★ シャンプー</span>
                                    <span class="price-value">¥16,500</span>
                                </div>
                                <div class="price-item">
                                    <span class="price-label">★ シャンプーカット</span>
                                    <span class="price-value">¥22,000</span>
                                </div>
                            </div>
                            <p class="course-description">内容：爪切り、耳掃除、ブラッシング、シャンプー、ブロー、ウルトラファインバブルシャワー、肛門腺絞り、写真動画サービス無し</p>
                            <p class="course-note">※シャンプーカットは上記内容＋全身カット</p>
                        </div>
                    </div>
                    <div class="course-card">
                        <div class="course-card-header">
                            <h4 class="course-name">テストコース2</h4>
                        </div>
                        <div class="course-card-body">
                            <div class="price-list">
                                <div class="price-item">
                                    <span class="price-label">★ シャンプー</span>
                                    <span class="price-value">¥16,500</span>
                                </div>
                                <div class="price-item">
                                    <span class="price-label">★ シャンプーカット</span>
                                    <span class="price-value">¥22,000</span>
                                </div>
                            </div>
                            <p class="course-description">内容：爪切り、耳掃除、ブラッシング、シャンプー、ブロー、ウルトラファインバブルシャワー、肛門腺絞り、写真動画サービス無し</p>
                            <p class="course-note">※シャンプーカットは上記内容＋全身カット</p>
                        </div>
                    </div>
                    <div class="course-card">
                        <div class="course-card-header">
                            <h4 class="course-name">テストコース3</h4>
                        </div>
                        <div class="course-card-body">
                            <div class="price-list">
                                <div class="price-item">
                                    <span class="price-label">★ シャンプー</span>
                                    <span class="price-value">¥16,500</span>
                                </div>
                                <div class="price-item">
                                    <span class="price-label">★ シャンプーカット</span>
                                    <span class="price-value">¥22,000</span>
                                </div>
                            </div>
                            <p class="course-description">内容：爪切り、耳掃除、ブラッシング、シャンプー、ブロー、ウルトラファインバブルシャワー、肛門腺絞り、写真動画サービス無し</p>
                            <p class="course-note">※シャンプーカットは上記内容＋全身カット</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 追加料金 -->
            <div class="price-info-section">
                <div class="price-info-card">
                    <h4 class="price-info-title">📷 撮影オプション</h4>
                    <ul class="price-info-list">
                        <li>バースデープラン <span class="highlight-price">¥1,100</span> 誕生日の衣装で記念撮影</li>
                    </ul>
                </div>
                <div class="price-info-card">
                    <h4 class="price-info-title">⚖️ 体重別追加料金</h4>
                    <ul class="price-info-list">
                        <li>4キロ以下 <span class="highlight-price">定価</span></li>
                        <li>4～7キロ <span class="highlight-price">¥1,100</span></li>
                        <li>7～10キロ <span class="highlight-price">¥2,200</span></li>
                        <li>10キロ～ <span class="highlight-price">¥3,300</span></li>
                        <li>トリマー2人料金 <span class="highlight-price">¥5,500</span></li>
                    </ul>
                </div>
                <div class="price-info-card">
                    <h4 class="price-info-title">🧶 毛玉料金</h4>
                    <p class="price-info-desc">動いたら危ないので、皮膚に張り付く毛玉がある場合は毛玉が1つでもトリマー2人料金¥5,500 + 毛玉料金をいただきます。</p>
                    <ul class="price-info-list">
                        <li>10分以内 <span class="highlight-price">¥3,300</span> + トリマー2人料金 + コース料金</li>
                        <li>30分以内 <span class="highlight-price">¥8,800</span> + トリマー2人料金 + コース料金</li>
                        <li>1時間以内 <span class="highlight-price">¥11,000</span> + トリマー2人料金 + コース料金</li>
                    </ul>
                </div>
            </div>
            <div class="menu-notes">
                <p>※毛玉やもつれ具合によってプラス料金をいただく場合がございます。</p>
                <p>※途中中断した場合は途中までの金額をいただきます。</p>
            </div>

            <!-- オプションメニュー -->
            <div class="menu-category">
                <h3 class="category-title">オプションメニュー</h3>
                <div class="option-cards">
                    <div class="option-card">
                        <div class="option-image">
                            <a href="https://catsalonmewty.com/image/price-op2b.webp" data-lightbox="img03" data-title="クレンジング">
                                <img src="https://catsalonmewty.com/image/price-op2.png" alt="クレンジング">
                            </a>
                        </div>
                        <h4 class="option-name">クレンジング</h4>
                        <p class="option-price">¥1,100〜</p>
                        <p class="option-description">ねこ専用クレンジングクリームを使ってスタットテイルやあごニキビなどの皮脂を落とします。皮脂を落とすだけでなく、保湿もしてくれる高級クリームなので使う度に皮脂が改善されていきます。</p>
                    </div>
                    <div class="option-card">
                        <div class="option-image">
                            <a href="https://catsalonmewty.com/image/price-op3b.webp" data-lightbox="img03" data-title="部分カット">
                                <img src="https://catsalonmewty.com/image/price-op3.png" alt="部分カット">
                            </a>
                        </div>
                        <h4 class="option-name">部分カット</h4>
                        <p class="option-price">1箇所につき ¥1,100〜</p>
                        <p class="option-description">足裏足まわり、おしりなど部分的なカットをします。4箇所以上はシャンプーカットコースになります。</p>
                    </div>
                    <div class="option-card">
                        <div class="option-image">
                            <a href="https://catsalonmewty.com/image/price-op13b.webp" data-lightbox="img03" data-title="デザインカット">
                                <img src="https://catsalonmewty.com/image/price-op13.png" alt="デザインカット">
                            </a>
                        </div>
                        <h4 class="option-name">デザインカット</h4>
                        <div class="option-price-list">
                            <span>足ブーツ ¥2,200</span>
                            <span>背中モヒカン ¥2,200</span>
                            <span>恐竜カット ¥4,400</span>
                            <span>ハートなど ¥5,500～</span>
                        </div>
                        <p class="option-description">恐竜カット、背中にハート、星などデザインカットでオシャレを楽しみましょう</p>
                    </div>
                    <div class="option-card">
                        <div class="option-image">
                            <a href="https://catsalonmewty.com/image/price-op1b.webp" data-lightbox="img03" data-title="ハミガキ">
                                <img src="https://catsalonmewty.com/image/price-op1.png" alt="ハミガキ">
                            </a>
                        </div>
                        <h4 class="option-name">ハミガキ</h4>
                        <p class="option-price">¥1,100</p>
                        <p class="option-description">ねこちゃんだって歯が命。健康寿命を伸ばすためにハミガキを推奨してます。ハミガキしながら歯を一本一本見るので歯の健康チェックにもなります。</p>
                    </div>
                    <div class="option-card">
                        <div class="option-image">
                            <img src="https://catsalonmewty.com/image/price-op13.webp" alt="スペシャルオーラルケア">
                        </div>
                        <h4 class="option-name">スペシャルオーラルケア</h4>
                        <p class="option-price">¥3,300</p>
                    </div>
                    <div class="option-card">
                        <div class="option-image">
                            <a href="https://catsalonmewty.com/image/price-op10b.webp" data-lightbox="img03" data-title="レーキング">
                                <img src="https://catsalonmewty.com/image/price-op10.png" alt="レーキング">
                            </a>
                        </div>
                        <h4 class="option-name">レーキング</h4>
                        <p class="option-price">30分 ¥3,300〜 <span class="option-price-sub">（+10分ごと¥1,100）</span></p>
                        <p class="option-description">トリミングナイフを使って抜け毛を処理します。換毛期の抜け毛でお困りの方にオススメです。全く痛くないので気持ち良さそうにしてくれるねこちゃんが多いです。</p>
                    </div>
                </div>
            </div>
        </section>
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

        <!-- スタッフ選択セクション -->
        <div id="calendar" class="user-selection">
            <h3>👥 スタッフ別スケジュール確認</h3>
            <div style="display: flex; gap: 1rem; margin-bottom: 2rem; justify-content: center; flex-wrap: wrap;">
                @if(isset($staffList))
                    @foreach($staffList as $staffMember)
                        @php
                            $isSelected = $selectStaff == $staffMember->id;
                        @endphp
                        <button
                            style="background: {{ $isSelected ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : 'white' }}; color: {{ $isSelected ? 'white' : 'rgb(107, 114, 128)' }}; border: 2px solid {{ $isSelected ? 'transparent' : 'rgb(229, 231, 235)' }}; padding: 1rem 2rem; border-radius: 100px; cursor: pointer; font-size: 1rem; font-weight: 600; display: flex; align-items: center; gap: 0.75rem; transition: 0.3s; box-shadow: {{ $isSelected ? 'rgba(102, 126, 234, 0.4) 0px 4px 15px' : 'rgba(0, 0, 0, 0.05) 0px 2px 8px' }};"
                            onclick="location.href='{{ route('reservation.index', ['staff' => $staffMember->id, 'targetDate' => $targetDate]) }}#calendar'">
                            <span class="user-name">{{ $staffMember->name }}</span>
                        </button>
                    @endforeach
                @endif
            </div>
            <p class="user-selection-desc">↑ スタッフ名をクリックして個別の空き時間をチェック</p>
        </div>
        <div class="calendar-legend">
            <div class="legend-item">
                <div class="legend-badge available-badge">○</div>
                <span>予約可能</span>
            </div>
            <div class="legend-item">
                <div class="legend-badge unavailable-badge">×</div>
                <span>満席</span>
            </div>
            <div class="legend-item">
                <div class="legend-badge selected-badge">○</div>
                <span>選択中</span>
            </div>
        </div>
        <div class="calendar-table-container">
            <table class="calendar-table-new">
                <thead>
                    <tr>
                        <th class="time-header-new">時間</th>
                        @for($i = 0; $i < 7; $i++)
                            @php
                                $date = $monday->copy()->addDays($i);
                                $dayOfWeek = $date->dayOfWeek;
                                $isWeekend = ($dayOfWeek == 0 || $dayOfWeek == 6);
                            @endphp
                            <th class="date-header-new{{ $isWeekend ? ' weekend' : '' }}">{{ $date->format('n/j') }}({{ ['日','月','火','水','木','金','土'][$dayOfWeek] }})</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
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
                        <tr class="{{ $loop->even ? 'row-even' : '' }}">
                            <td class="time-cell-new {{ $loop->even ? 'row-even' : '' }}">{{ $timeDisplay }}</td>
                            @for($i = 0; $i < 7; $i++)
                                @php
                                    $date = $monday->copy()->addDays($i);
                                    $dateKey = $date->format('Y-m-d');
                                    // bookedSlotsに該当日時があれば予約済み（×）
                                    $isBooked = isset($bookedSlots[$dateKey]) && in_array($timeDisplay, $bookedSlots[$dateKey]);
                                @endphp
                                <td class="slot-cell">
                                    @if(!$isBooked)
                                        <div class="slot-badge available-badge" onclick="selectSlot('{{ $selectStaff }}', '{{ $timeDisplay }}', '{{ $dateKey }}')">○</div>
                                    @else
                                        <div class="slot-badge unavailable-badge">×</div>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
