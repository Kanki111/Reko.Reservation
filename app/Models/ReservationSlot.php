<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationSlot extends Model
{
    protected $table = 'reservation_slot';

    // 複合主キーのためidは使わない
    public $incrementing = false;

    protected $fillable = [
        'reservation_id',
        'slot_time',
    ];

    /**
     * 予約とのリレーション
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
