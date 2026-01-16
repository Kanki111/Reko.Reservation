<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineUser extends Model
{
    protected $table = 'line_user';

    // 複合主キーのためidは使わない
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'line_user_id',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * 顧客ユーザーとのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * LINE IDからuser_idを取得
     */
    public static function getUserIdByLineId(string $lineUserId): ?int
    {
        $lineUser = self::where('line_user_id', $lineUserId)
            ->where('active', 1)
            ->first();

        return $lineUser?->user_id;
    }
}
