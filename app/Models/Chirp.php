<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // ใช้สำหรับการตั้งความสัมพันธ์ "BelongsTo" กับโมเดลอื่น (ในกรณีนี้คือ User)

class Chirp extends Model
{
     // กำหนดฟิลด์ที่สามารถกรอกข้อมูลได้ในฐานข้อมูล
    protected $fillable = [
        'message',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
