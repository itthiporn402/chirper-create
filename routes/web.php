<?php

//กำหนดเส้นทาง (Route) สำหรับแอปพลิเคชัน โดยแยกหน้าหลัก, Dashboard, โปรไฟล์, และฟังก์ชันจัดการโพสต์ Chirp พร้อมกับตั้งค่าให้บางเส้นทางต้องใช้ middleware เพื่อยืนยันว่าผู้ใช้ได้เข้าสู่ระบบแล้ว.

use App\Http\Controllers\ChirpController; // นำเข้า ChirpController ซึ่งใช้จัดการการทำงานของโมเดล Chirp
use App\Http\Controllers\ProfileController; // นำเข้า ProfileController ซึ่งใช้จัดการการทำงานเกี่ยวกับโปรไฟล์ของผู้ใช้
use Illuminate\Foundation\Application; // ใช้สำหรับดึงข้อมูลเกี่ยวกับแอปพลิเคชัน เช่น เวอร์ชัน Laravel
use Illuminate\Support\Facades\Route; // ใช้สำหรับการกำหนดเส้นทาง (Route) ใน Laravel
use Inertia\Inertia; // ใช้สำหรับเรนเดอร์หน้าเว็บผ่าน Inertia.js
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

// เส้นทางหน้าแรกของเว็บ
Route::get('/', function () {
    return Inertia::render('Welcome', [ // เรนเดอร์หน้า "Welcome" ด้วย Inertia
        'canLogin' => Route::has('login'), // ตรวจสอบว่ามีเส้นทางเข้าสู่ระบบ (login) หรือไม่
        'canRegister' => Route::has('register'), // ตรวจสอบว่ามีเส้นทางลงทะเบียน (register) หรือไม่
        'laravelVersion' => Application::VERSION, // ส่งข้อมูลเวอร์ชันของ Laravel ไปยังหน้าเว็บ
        'phpVersion' => PHP_VERSION, // ส่งข้อมูลเวอร์ชันของ PHP ไปยังหน้าเว็บ
    ]);
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/user/{id}', function (string $id) { return 'User '.$id;
});


// กำหนด Route สร้าง middleware ให้ products เพื่อไปเช็คว่าเข้าสู่ระบบยัง
Route::middleware(['auth'])->group(function () {
    Route::get('/products/{id}', [ProductController::class, 'show']);
});

// เส้นทางสำหรับดูรายการสินค้า
Route::get('/products', [ProductController::class, 'index'])->name('products');


Route::get('/user', [UserController::class, 'index']);



Route::get('/users/{user}', [UserController::class, 'show']);


// เส้นทางหน้าหลัก (Dashboard) สำหรับผู้ใช้ที่เข้าสู่ระบบ
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard'); // เรนเดอร์หน้า "Dashboard" ด้วย Inertia
})->middleware(['auth', 'verified'])->name('dashboard'); // ใช้ middleware เพื่อตรวจสอบว่าผู้ใช้เข้าสู่ระบบและยืนยันอีเมลแล้ว

// กลุ่มเส้นทางที่ต้องการให้ผู้ใช้เข้าสู่ระบบก่อนถึงจะเข้าถึงได้
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // เส้นทางแก้ไขโปรไฟล์
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // เส้นทางอัปเดตข้อมูลโปรไฟล์
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // เส้นทางลบโปรไฟล์
});

// เส้นทางสำหรับการจัดการ Chirp (โพสต์)
Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'update', 'destroy']) // กำหนดให้ใช้แค่ 4 action: ดูรายการ (index), สร้าง (store), แก้ไข (update), และลบ (destroy)
    ->middleware(['auth', 'verified']); // ใช้ middleware เพื่อให้เข้าถึงได้เฉพาะผู้ใช้ที่เข้าสู่ระบบและยืนยันอีเมลแล้ว

// โหลดไฟล์ auth.php เพื่อเพิ่มเส้นทางที่เกี่ยวข้องกับการตรวจสอบสิทธิ์ (authentication)
require __DIR__.'/auth.php';
