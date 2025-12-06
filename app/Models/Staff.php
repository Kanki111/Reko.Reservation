<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * active=1のスタッフのみ取得するスコープ
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * active=1のスタッフ一覧を取得
     */
    public static function getActiveStaff()
    {
        return self::active()->get();
    }
}
