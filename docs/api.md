# API・ルーティング仕様書

## 概要
Neko Reservation Server のルーティング・API仕様

## ルート一覧

### 🌐 フロントエンド (顧客向け)

#### 1. トップページ
```php
Route::get('/', function () {
    return view('neko-home');
});
```
- **URL**: `/`
- **メソッド**: GET
- **説明**: サイトのトップページ
- **テンプレート**: `neko-home.blade.php`
- **パラメータ**: なし

#### 2. 予約ページ
```php
Route::get('/reservation', [ReservationController::class, 'index'])
    ->name('reservation.index');
```
- **URL**: `/reservation`
- **メソッド**: GET
- **コントローラー**: `App\Http\Controllers\Front\ReservationController@index`
- **説明**: 予約カレンダー・メニュー表示
- **テンプレート**: `front/reservation/index.blade.php`
- **パラメータ**: 
  - `staff` (optional): スタッフフィルター
  - `targetDate` (optional): 対象日付
- **レスポンスデータ**:
  ```php
  [
      'staffList' => Collection, // アクティブスタッフ一覧
      'selectStaff' => 1,        // スタッフ選択フラグ
      'monday' => Carbon,        // 週の開始日
      'sunday' => Carbon,        // 週の終了日
      'weekDays' => array,       // 週間日付配列
      'targetDate' => string     // 対象日付文字列
  ]
  ```

#### 3. フローページ
```php
Route::get('/flow', [FlowController::class, 'index'])
    ->name('flow.index');
```
- **URL**: `/flow`
- **メソッド**: GET
- **コントローラー**: `App\Http\Controllers\Front\FlowController@index`
- **説明**: 予約からトリミングまでの流れ説明
- **テンプレート**: `front/flow/index.blade.php`
- **パラメータ**: なし

### 🔧 管理機能 (開発中)

#### 4. スタッフ管理
```php
Route::get('/staff', [StaffController::class, 'index'])
    ->name('staff.index');
```
- **URL**: `/staff`
- **メソッド**: GET
- **コントローラー**: `App\Http\Controllers\StaffController@index`
- **説明**: スタッフ一覧表示
- **ステータス**: 🚧 開発中

```php
Route::get('/staff/{id}', [StaffController::class, 'show'])
    ->name('staff.show');
```
- **URL**: `/staff/{id}`
- **メソッド**: GET
- **コントローラー**: `App\Http\Controllers\StaffController@show`
- **説明**: スタッフ詳細表示
- **パラメータ**: `id` (スタッフID)
- **ステータス**: 🚧 開発中

### 📡 API エンドポイント

#### 5. アクティブスタッフ取得
```php
Route::get('/api/staff/active', [StaffController::class, 'getActiveStaff']);
```
- **URL**: `/api/staff/active`
- **メソッド**: GET
- **コントローラー**: `App\Http\Controllers\StaffController@getActiveStaff`
- **説明**: アクティブなスタッフデータをJSON形式で取得
- **レスポンス形式**: JSON
- **ステータス**: 🚧 開発中

#### 6. 予約システム (別実装)
```php
Route::get('/front/reservation', [FrontReservationController::class, 'index'])
    ->name('front.reservation.index');
```
- **URL**: `/front/reservation`
- **メソッド**: GET
- **コントローラー**: `App\Http\Controllers\Front\FrontReservationController@index`
- **説明**: 予約システム (別バージョン)
- **ステータス**: 🚧 開発中

## コントローラー詳細

### ReservationController
**場所**: `app/Http/Controllers/Front/ReservationController.php`

```php
public function index(Request $request)
{
    $staff = $request->get('staff');
    $targetDate = $request->get('targetDate');
    
    // 固定日付 (開発中)
    $targetDate = "2025-11-29";
    
    // 週範囲計算
    $target = Carbon::parse($targetDate);
    $monday = $target->copy()->startOfWeek(Carbon::MONDAY);
    $sunday = $monday->copy()->addDays(6);
    
    // データ取得
    $staffList = Staff::active()->get();
    $weekDays = [];
    for ($i = 0; $i < 7; $i++) {
        $weekDays[] = $monday->copy()->addDays($i);
    }
    
    return view('front.reservation.index', compact(
        'staffList', 'selectStaff', 'monday', 
        'sunday', 'weekDays', 'targetDate'
    ));
}
```

### FlowController
**場所**: `app/Http/Controllers/Front/FlowController.php`

```php
public function index()
{
    return view('front.flow.index');
}
```

## ルート名とヘルパー

### 定義済みルート名
- `reservation.index` → `/reservation`
- `flow.index` → `/flow`  
- `staff.index` → `/staff`
- `staff.show` → `/staff/{id}`
- `front.reservation.index` → `/front/reservation`

### Bladeでの使用例
```php
// ヘッダーナビゲーション
<li><a href="/" class="header-menu">HOME</a></li>
<li><a href="{{ route('flow.index') }}" class="header-menu">ご予約からトリミングの流れ</a></li>
<li><a href="{{ route('reservation.index') }}">予約</a></li>
```

## パラメータ仕様

### 予約ページパラメータ
- **staff**: スタッフID またはスタッフ名
  - 例: `/reservation?staff=1`
  - 用途: 特定スタッフのスケジュール表示
- **targetDate**: 対象日付 (YYYY-MM-DD形式)
  - 例: `/reservation?targetDate=2025-11-29`
  - 用途: 指定日を含む週のカレンダー表示

## 今後の拡張予定

### 予約処理API
```php
// 予定
Route::post('/api/reservation', [ReservationController::class, 'store']);
Route::put('/api/reservation/{id}', [ReservationController::class, 'update']);
Route::delete('/api/reservation/{id}', [ReservationController::class, 'destroy']);
```

### 認証が必要な管理API
```php
// 予定 (要認証)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::resource('/admin/staff', StaffController::class);
    Route::resource('/admin/menu', MenuController::class);
});
```

### LINE Webhook
```php
// 予定
Route::post('/webhook/line', [LineController::class, 'webhook']);
```

## エラーハンドリング

### 現在の実装状況
- **404エラー**: Laravel標準
- **500エラー**: Laravel標準
- **バリデーションエラー**: 未実装 (フォーム処理未実装のため)

### 今後の実装予定
- カスタム404ページ
- APIエラーレスポンス統一
- バリデーションルール定義

---
**最終更新**: 2025年12月18日  
**関連ファイル**: `routes/web.php`