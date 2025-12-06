@extends('layouts.app')

@section('title', 'ページタイトル')

@push('styles')
<style>
    /* 予約ページ固有のCSS */
    .calendar-nav {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        background: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .current-month {
        font-size: 24px;
        font-weight: bold;
        color: #2c3e50;
        min-width: 200px;
        text-align: center;
    }

    /* カレンダーテーブル */
    .calendar-container {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    }

    .calendar-table {
        width: 100%;
        border-collapse: collapse;
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
        min-width: 120px;
        line-height: 1.3;
    }

    .calendar-body tr:nth-child(even) {
        background: #f8f9fa;
    }

    .time-cell {
        padding: 12px 8px;
        text-align: center;
        font-weight: bold;
        color: #2c3e50;
        background: #ecf0f1;
        border-right: 2px solid #bdc3c7;
        font-size: 14px;
        min-width: 80px;
        line-height: 1.2;
    }

    .availability-cell {
        padding: 8px;
        text-align: center;
        border: 1px solid #e0e0e0;
        position: relative;
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
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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

    @media (max-width: 768px) {
        .calendar-container {
            overflow-x: auto;
        }

        .calendar-table {
            min-width: 600px;
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
</style>
@endpush

@section('content')
    <!-- ページヘッダー -->
    <div class="page-header">
        <h1 class="page-title">🗓️ 予約カレンダー</h1>
        <p class="page-subtitle">ご希望の日時をお選びください（○：空きあり ×：満席）</p>

        <!-- LINE予約ボタン -->
        <div style="margin-top: 25px;">
            <a href="https://line.me/R/msg/text/?ねこサロンの予約を希望します。%0A%0A希望日時：%0A希望メニュー：%0A%0Aよろしくお願いします。"
               class="line-reservation-btn" target="_blank">
                💬 LINEで直接予約する
            </a>
            <p style="margin-top: 15px; color: #7f8c8d; font-size: 14px;">
                ※下記カレンダーで空き状況をご確認の上、LINEにて希望日時をお伝えください
            </p>
        </div>
    </div>

    <!-- デバッグ情報（一時的） -->
    <div style="background: #fff; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
        <h4>デバッグ情報:</h4>
        <p><strong>選択スタッフ:</strong> {{ $staff ?? '全スタッフ' }}</p>
        <p><strong>対象日:</strong> {{ $targetDate ?? '未設定' }}</p>
        <p><strong>スタッフ総数:</strong> {{ isset($staffList) ? $staffList->count() : '0' }}名</p>
    </div>
@endsection

@push('scripts')
<script>
    function selectSlot(staff, time, date) {
        const formattedDate = new Date(date).toLocaleDateString('ja-JP');
        const message = `ネコサロン予約希望\n\n日付: ${formattedDate}\n時間: ${time}\n担当者: ${staff}\n\nこちらの時間でご予約をお願いします。`;
        const lineUrl = `https://line.me/R/msg/text/?${encodeURIComponent(message)}`;
        window.open(lineUrl, '_blank');
    }

    function previousWeek() {
        alert('前の週のデータを読み込みます');
    }

    function nextWeek() {
        alert('次の週のデータを読み込みます');
    }

    function showUserSchedule(userName) {
        alert(`${userName}のスケジュールを表示します`);
    }
</script>
@endpush
