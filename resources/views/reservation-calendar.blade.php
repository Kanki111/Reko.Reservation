<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約カレンダー - 予約システム</title>
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
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1400px;
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
            padding: 15px 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #e67e22;
            text-decoration: none;
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
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #e67e22;
        }

        /* メインコンテンツ */
        .main-content {
            padding: 40px 0;
            min-height: calc(100vh - 200px);
        }

        .page-header {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            text-align: center;
        }

        .page-title {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #7f8c8d;
            font-size: 16px;
        }

        /* カレンダーナビゲーション */
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

        .nav-btn {
            background: #e67e22;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
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

        .staff-header {
            min-width: 120px;
            line-height: 1.3;
        }

        .staff-subheader {
            padding: 10px 5px;
            background: rgba(255, 255, 255, 0.1);
        }

        .staff-buttons {
            display: flex;
            flex-direction: column;
            gap: 3px;
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



        /* スタッフ情報 */
        .staff-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
        }

        .staff-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e67e22, #d35400);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .staff-details h4 {
            color: #2c3e50;
            margin-bottom: 2px;
        }

        .staff-details p {
            color: #7f8c8d;
            font-size: 12px;
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
        }

        /* フッター */
        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 40px 0;
            margin-top: 40px;
        }

        /* モーダル（予約フォーム用） */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1000;
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            border-radius: 15px;
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            cursor: pointer;
            color: #aaa;
        }

        .close-modal:hover {
            color: #000;
        }

        /* LINE予約ボタン（ヘッダー用） */
        .line-reservation-btn {
            background: linear-gradient(135deg, #00b900, #00a000);
            color: white;
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

        .line-reservation-btn:active {
            transform: translateY(-1px);
        }

        /* ユーザースケジュールモーダル */
        .user-schedule-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1000;
        }

        .user-schedule-content {
            background: white;
            margin: 5% auto;
            padding: 30px;
            width: 90%;
            max-width: 600px;
            border-radius: 15px;
            position: relative;
            max-height: 80vh;
            overflow-y: auto;
        }

        .schedule-item {
            background: #f8f9fa;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            border-left: 4px solid #2ecc71;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .schedule-time {
            font-weight: bold;
            color: #2c3e50;
        }

        .schedule-status {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-available {
            background: #2ecc71;
            color: white;
        }

        .status-unavailable {
            background: #e74c3c;
            color: white;
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

        .user-icon {
            font-size: 20px;
        }

        .user-name {
            font-size: 16px;
        }

        .user-selection-desc {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 10px;
        }

        /* レスポンシブ対応 */
        @media (max-width: 768px) {
            .user-buttons {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .user-btn {
                padding: 15px 20px;
                font-size: 14px;
            }

            .user-icon {
                font-size: 18px;
            }

            .user-name {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <nav class="container">
            <a href="/" class="logo">🐱 予約システム</a>
            <ul class="nav-links">
                <li><a href="/">ホーム</a></li>
                <li><a href="/reservation">予約</a></li>
            </ul>
        </nav>
    </header>

    <!-- メインコンテンツ -->
    <main class="main-content">
        <div class="container">
            <!-- ページヘッダー -->
            <div class="page-header">
                <h1 class="page-title">🗓️ 予約カレンダー</h1>
                <p class="page-subtitle">ご希望の日時をお選びください（○：空きあり ×：満席）</p>
                
                <!-- LINE予約ボタン -->
                <div style="margin-top: 25px;">
                    <button class="line-reservation-btn">
                        💬 LINEで直接予約する
                    </button>
                </div>
                <p style="margin-top: 15px; color: #7f8c8d; font-size: 14px;">
                    ※下記カレンダーで空き状況をご確認の上、LINEにて希望日時をお伝えください
                </p>
            </div>

            <!-- カレンダーナビゲーション -->
            <div class="calendar-nav">
                <button class="nav-btn" onclick="previousWeek()">← 前の週</button>
                <div class="current-month" id="currentMonth">2025年11月 第3週</div>
                <button class="nav-btn" onclick="nextWeek()">次の週 →</button>
            </div>

            <!-- ユーザー選択ボタン -->
            <div class="user-selection">
                <h3>👥 スタッフ別スケジュール確認</h3>
                <div class="user-buttons">
                    <button class="user-btn" onclick="showUserSchedule('スタッフ1')">
                        <span class="user-name">スタッフ1</span>
                    </button>
                    <button class="user-btn" onclick="showUserSchedule('スタッフ2')">
                        <span class="user-name">スタッフ2</span>
                    </button>
                    <button class="user-btn" onclick="showUserSchedule('スタッフ3')">
                        <span class="user-name">スタッフ3</span>
                    </button>
                    <button class="user-btn" onclick="showUserSchedule('スタッフ4')">
                        <span class="user-name">スタッフ4</span>
                    </button>
                </div>
                <p class="user-selection-desc">↑ スタッフ名をクリックして個別の空き時間をチェック</p>
            </div>

            <!-- カレンダーテーブル -->
            <div class="calendar-container">
                <table class="calendar-table">
                    <thead class="calendar-header">
                        <tr>
                            <th class="time-header">時間</th>
                            <th class="date-header">11/18(月)</th>
                            <th class="date-header">11/19(火)</th>
                            <th class="date-header">11/20(水)</th>
                            <th class="date-header">11/21(木)</th>
                            <th class="date-header">11/22(金)</th>
                        </tr>

                    </thead>
                    <tbody class="calendar-body" id="calendarBody">
                        <!-- 10:00-12:00 -->
                        <tr>
                            <td class="time-cell">10:00<br>～<br>12:00</td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '10:00-12:00', '2025-11-18')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '10:00-12:00', '2025-11-19')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn unavailable">×</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '10:00-12:00', '2025-11-21')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '10:00-12:00', '2025-11-22')">○</button></td>
                        </tr>
                        <!-- 12:00-14:00 -->
                        <tr>
                            <td class="time-cell">12:00<br>～<br>14:00</td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '12:00-14:00', '2025-11-18')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn unavailable">×</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '12:00-14:00', '2025-11-20')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '12:00-14:00', '2025-11-21')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '12:00-14:00', '2025-11-22')">○</button></td>
                        </tr>
                        <!-- 14:00-16:00 -->
                        <tr>
                            <td class="time-cell">14:00<br>～<br>16:00</td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '14:00-16:00', '2025-11-18')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '14:00-16:00', '2025-11-19')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '14:00-16:00', '2025-11-20')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn unavailable">×</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '14:00-16:00', '2025-11-22')">○</button></td>
                        </tr>
                        <!-- 16:00-18:00 -->
                        <tr>
                            <td class="time-cell">16:00<br>～<br>18:00</td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '16:00-18:00', '2025-11-18')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '16:00-18:00', '2025-11-19')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '16:00-18:00', '2025-11-20')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn available" onclick="selectSlot('全員対応', '16:00-18:00', '2025-11-21')">○</button></td>
                            <td class="availability-cell"><button class="availability-btn unavailable">×</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 凡例 -->
            <div class="legend">
                <div class="legend-items">
                    <span>○ 空きあり</span>
                    <span>× 満席</span>
                </div>
            </div>
        </div>
    </main>

    <!-- 予約確認モーダル -->
    <div class="modal" id="reservationModal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2 style="margin-bottom: 20px; color: #2c3e50;">予約確認</h2>
            <div id="reservationDetails">
                <!-- 選択された予約詳細がここに表示されます -->
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <button onclick="openLineReservation()" style="background: #00b900; color: white; padding: 12px 30px; border: none; border-radius: 25px; font-weight: bold; cursor: pointer; margin-right: 10px;">💬 LINEで予約する</button>
                <button onclick="closeModal()" style="background: #95a5a6; color: white; padding: 12px 30px; border: none; border-radius: 25px; font-weight: bold; cursor: pointer;">キャンセル</button>
            </div>
        </div>
    </div>

    <!-- ユーザースケジュールモーダル -->
    <div class="user-schedule-modal" id="userScheduleModal">
        <div class="user-schedule-content">
            <span class="close-modal" onclick="closeUserScheduleModal()">&times;</span>
            <h2 style="margin-bottom: 20px; color: #2c3e50;" id="userScheduleTitle">スタッフ1の空き時間</h2>
            <div id="userScheduleList">
                <!-- ユーザーのスケジュールがここに表示されます -->
            </div>
        </div>
    </div>

    <!-- フッター -->
    <footer>
        <div class="container">
            <p>&copy; 2025 予約システム. All rights reserved.</p>
            <p style="margin-top: 10px; font-size: 14px; opacity: 0.8;">
                〒165-0033 東京都中野区 | 営業時間: 8:00～20:00（金土休）
            </p>
        </div>
    </footer>

    <script>
        // スタッフ別スケジュール表示データ
        const staffSchedules = {
            '2025-11-18': {
                'スタッフ1': { '10:00-12:00': '○', '12:00-14:00': '×', '14:00-16:00': '○', '16:00-18:00': '○' },
                'スタッフ2': { '10:00-12:00': '○', '12:00-14:00': '○', '14:00-16:00': '×', '16:00-18:00': '○' },
                'スタッフ3': { '10:00-12:00': '×', '12:00-14:00': '○', '14:00-16:00': '○', '16:00-18:00': '×' }
            },
            '2025-11-19': {
                'スタッフ1': { '10:00-12:00': '○', '12:00-14:00': '○', '14:00-16:00': '○', '16:00-18:00': '×' },
                'スタッフ2': { '10:00-12:00': '×', '12:00-14:00': '×', '14:00-16:00': '○', '16:00-18:00': '○' },
                'スタッフ3': { '10:00-12:00': '○', '12:00-14:00': '○', '14:00-16:00': '×', '16:00-18:00': '○' }
            },
            '2025-11-20': {
                'スタッフ1': { '10:00-12:00': '×', '12:00-14:00': '○', '14:00-16:00': '○', '16:00-18:00': '○' },
                'スタッフ2': { '10:00-12:00': '○', '12:00-14:00': '×', '14:00-16:00': '○', '16:00-18:00': '×' },
                'スタッフ3': { '10:00-12:00': '○', '12:00-14:00': '○', '14:00-16:00': '×', '16:00-18:00': '○' }
            },
            '2025-11-21': {
                'スタッフ1': { '10:00-12:00': '○', '12:00-14:00': '○', '14:00-16:00': '×', '16:00-18:00': '○' },
                'スタッフ2': { '10:00-12:00': '×', '12:00-14:00': '○', '14:00-16:00': '○', '16:00-18:00': '×' },
                'スタッフ3': { '10:00-12:00': '○', '12:00-14:00': '×', '14:00-16:00': '○', '16:00-18:00': '○' }
            },
            '2025-11-22': {
                'スタッフ1': { '10:00-12:00': '○', '12:00-14:00': '○', '14:00-16:00': '○', '16:00-18:00': '×' },
                'スタッフ2': { '10:00-12:00': '×', '12:00-14:00': '○', '14:00-16:00': '×', '16:00-18:00': '○' },
                'スタッフ3': { '10:00-12:00': '○', '12:00-14:00': '×', '14:00-16:00': '○', '16:00-18:00': '○' }
            }
        };

        // 日付選択でスタッフ別スケジュール表示
        function showUserSchedule(date, dateLabel) {
            const schedule = staffSchedules[date];
            if (!schedule) return;

            let modalContent = `
                <div style="text-align: center; margin-bottom: 20px;">
                    <h3>${dateLabel} のスタッフ別空き状況</h3>
                </div>
                <div style="display: grid; gap: 15px;">
            `;

            Object.keys(schedule).forEach(staff => {
                modalContent += `
                    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: #f9f9f9;">
                        <h4 style="margin: 0 0 10px 0; color: #333;">${staff}</h4>
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;">
                `;
                
                Object.keys(schedule[staff]).forEach(time => {
                    const status = schedule[staff][time];
                    const isAvailable = status === '○';
                    const btnClass = isAvailable ? 'available' : 'unavailable';
                    const onclick = isAvailable ? `onclick="selectSlot('${staff}', '${time}', '${date}'); closeModal();"` : '';
                    
                    modalContent += `
                        <button class="availability-btn ${btnClass}" ${onclick} style="width: 100%; height: 45px; margin: 2px;">
                            ${time}<br>${status}
                        </button>
                    `;
                });
                
                modalContent += `
                        </div>
                    </div>
                `;
            });

            modalContent += `</div>`;
            showModal('スタッフ選択', modalContent);
        }

        function selectSlot(staff, time, date) {
            const message = `ネコサロン予約希望\n日付: ${date}\n時間: ${time}\n担当者: ${staff}\n\nこちらの時間でご予約をお願いします。`;
            const lineUrl = `https://line.me/R/msg/text/?${encodeURIComponent(message)}`;
            window.open(lineUrl, '_blank');
        }

        function showModal(title, content) {
            const modal = document.getElementById('reservationModal');
            const modalTitle = modal.querySelector('.modal-header h2');
            const modalContent = document.getElementById('reservationDetails');
            
            modalTitle.textContent = title;
            modalContent.innerHTML = content;
            modal.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('reservationModal').style.display = 'none';
        }

        function openLineReservation() {
            // LINE予約用のメッセージを作成
            const message = `予約希望\n\n📅 日付: ${selectedDate}\n⏰ 時間: ${selectedTime}\n👨‍⚕️ 担当: ${selectedStaff}\n\n上記の時間で予約をお願いします。`;
            const encodedMessage = encodeURIComponent(message);
            
            // LINEアプリを開く（実際のLINE IDに変更してください）
            const lineUrl = `https://line.me/R/oaMessage/@vfy5062v/?${encodedMessage}`;
            
            // 新しいタブでLINEを開く
            window.open(lineUrl, '_blank');
            
            // モーダルを閉じる
            closeModal();
        }

        function previousWeek() {
            // 前の週の処理（実際のアプリではAjaxでデータを取得）
            alert('前の週のデータを読み込みます');
        }

        function nextWeek() {
            // 次の週の処理（実際のアプリではAjaxでデータを取得）
            alert('次の週のデータを読み込みます');
        }

        // ユーザースケジュール表示
        function showUserSchedule(userName) {
            const modal = document.getElementById('userScheduleModal');
            const title = document.getElementById('userScheduleTitle');
            const scheduleList = document.getElementById('userScheduleList');
            
            title.textContent = `${userName}の空き時間`;
            
            // サンプルデータ（実際はサーバーから取得）
            const schedules = getUserScheduleData(userName);
            
            let scheduleHTML = '';
            schedules.forEach(schedule => {
                const statusClass = schedule.available ? 'status-available' : 'status-unavailable';
                const statusText = schedule.available ? '空きあり' : '満席';
                scheduleHTML += `
                    <div class="schedule-item">
                        <div>
                            <div class="schedule-time">${schedule.date} ${schedule.time}</div>
                        </div>
                        <div class="schedule-status ${statusClass}">${statusText}</div>
                    </div>
                `;
            });
            
            scheduleList.innerHTML = scheduleHTML;
            modal.style.display = 'block';
        }

        function closeUserScheduleModal() {
            document.getElementById('userScheduleModal').style.display = 'none';
        }

        // サンプルスケジュールデータ（実際はAPIから取得）
        function getUserScheduleData(userName) {
            const allSchedules = {
                'スタッフ1': [
                    { date: '11/18', time: '09:00-11:00', available: true },
                    { date: '11/18', time: '11:00-13:00', available: false },
                    { date: '11/18', time: '13:00-15:00', available: true },
                    { date: '11/18', time: '15:00-17:00', available: true },
                    { date: '11/18', time: '17:00-19:00', available: false }
                ],
                'スタッフ2': [
                    { date: '11/19', time: '09:00-11:00', available: true },
                    { date: '11/19', time: '11:00-13:00', available: true },
                    { date: '11/19', time: '13:00-15:00', available: false },
                    { date: '11/19', time: '15:00-17:00', available: true },
                    { date: '11/19', time: '17:00-19:00', available: true }
                ],
                'スタッフ3': [
                    { date: '11/20', time: '09:00-11:00', available: false },
                    { date: '11/20', time: '11:00-13:00', available: true },
                    { date: '11/20', time: '13:00-15:00', available: true },
                    { date: '11/20', time: '15:00-17:00', available: false },
                    { date: '11/20', time: '17:00-19:00', available: true }
                ],
                'スタッフ4': [
                    { date: '11/21', time: '09:00-11:00', available: true },
                    { date: '11/21', time: '11:00-13:00', available: false },
                    { date: '11/21', time: '13:00-15:00', available: true },
                    { date: '11/21', time: '15:00-17:00', available: true },
                    { date: '11/21', time: '17:00-19:00', available: false }
                ]
            };
            
            return allSchedules[userName] || [];
        }

        // モーダル外クリックで閉じる
        window.onclick = function(event) {
            const reservationModal = document.getElementById('reservationModal');
            const userScheduleModal = document.getElementById('userScheduleModal');
            if (event.target == reservationModal) {
                reservationModal.style.display = 'none';
            }
            if (event.target == userScheduleModal) {
                userScheduleModal.style.display = 'none';
            }
        }
    </script>
</body>
</html>