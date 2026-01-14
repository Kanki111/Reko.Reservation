<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        'name',
        'price',
        'description',
        'duration_minutes',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'price' => 'integer',
        'duration_minutes' => 'integer',
    ];

    /**
     * active=1のメニューのみ取得するスコープ
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * 必要なスロット数を算出 (30分単位)
     */
    public function getSlotCount(): int
    {
        return (int) ceil($this->duration_minutes / 30);
    }
}
