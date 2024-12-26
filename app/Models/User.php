<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable; // ใช้ลักษณะ (trait) HasFactory สำหรับการสร้างข้อมูลและ Notifiable สำหรับการส่งการแจ้งเตือน

    /**
     * ฟิลด์ที่สามารถกรอกข้อมูลได้
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // ชื่อของผู้ใช้
        'email', // อีเมลของผู้ใช้
        'password', // รหัสผ่านของผู้ใช้
    ];

    /**
     * ฟิลด์ที่ไม่ควรถูกแสดงเมื่อทำการ Serialize ข้อมูล
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // ซ่อนรหัสผ่านจากการแสดงผล
        'remember_token', // ซ่อน token สำหรับการจดจำผู้ใช้
    ];

    /**
     * ฟังก์ชันสำหรับการแปลงค่า attributes
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // แปลงค่า 'email_verified_at' เป็นประเภท datetime
            'password' => 'hashed',
        ];
    }

    // ฟังก์ชันที่กำหนดความสัมพันธ์ระหว่าง User และ Chirp
    public function chirps(): HasMany
    {
        // ฟังก์ชันนี้แสดงถึงความสัมพันธ์ที่ว่า User สามารถมีหลาย Chirp
        return $this->hasMany(Chirp::class);
    }
}
