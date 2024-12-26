<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ฟังก์ชันนี้ใช้ในการลงทะเบียนบริการต่าง ๆ ที่ต้องการใช้ในแอป
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ฟังก์ชันนี้ใช้ในการตั้งค่าหรือเตรียมบริการต่าง ๆ ก่อนที่จะใช้งาน
        // ตรวจสอบว่า Vite::prefetch รองรับในโปรเจกต์นี้หรือไม่
        if (method_exists(Vite::class, 'prefetch')) {
            Vite::prefetch(['concurrency' => 3]); // ใช้ Vite เพื่อพรีโหลดไฟล์ JavaScript หรือ CSS
        }
    }
}
