<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';

    protected $fillable = [
        'user_id',
        'menu_id',
        'staff_id',
        'reservation_date',
        'reservation_time',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'reservation_date' => 'date',
    ];

    /**
     * 予約スロットとのリレーション
     */
    public function slots()
    {
        return $this->hasMany(ReservationSlot::class);
    }

    /**
     * スタッフとのリレーション
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    /**
     * active=1の予約のみ取得するスコープ
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
