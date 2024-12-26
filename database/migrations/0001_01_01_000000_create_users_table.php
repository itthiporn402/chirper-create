<?php

use Illuminate\Database\Migrations\Migration; // นำเข้า Migration ของ Laravel ซึ่งใช้สำหรับจัดการการสร้างตารางในฐานข้อมูล
use Illuminate\Database\Schema\Blueprint; // นำเข้า Blueprint เพื่อกำหนดโครงสร้างของตาราง
use Illuminate\Support\Facades\Schema; // นำเข้า Schema ซึ่งใช้ในการดำเนินการเกี่ยวกับตารางในฐานข้อมูล

return new class extends Migration // สร้างคลาส Migration ใหม่ที่สืบทอดมาจาก Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ฟังก์ชันนี้จะทำการสร้างตารางในฐานข้อมูลเมื่อเรียกใช้ migration

        Schema::create('users', function (Blueprint $table) {
            // สร้างตาราง 'users' ซึ่งเก็บข้อมูลผู้ใช้
            $table->id(); // สร้างคอลัมน์ id เป็น Primary Key
            $table->string('name'); // สร้างคอลัมน์ 'name' สำหรับชื่อผู้ใช้
            $table->string('email')->unique(); // สร้างคอลัมน์ 'email' ที่ต้องไม่ซ้ำ
            $table->timestamp('email_verified_at')->nullable(); // สร้างคอลัมน์ 'email_verified_at' สำหรับเวลาที่ยืนยันอีเมล
            $table->string('password'); // สร้างคอลัมน์ 'password' สำหรับรหัสผ่าน
            $table->rememberToken(); // สร้างคอลัมน์ 'remember_token' สำหรับการจำรหัสผู้ใช้
            $table->timestamps(); // สร้างคอลัมน์ 'created_at' และ 'updated_at' สำหรับเวลาสร้างและอัพเดตข้อมูล
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            // สร้างตาราง 'password_reset_tokens' สำหรับจัดเก็บโทเค็นการรีเซ็ตรหัสผ่าน
            $table->string('email')->primary(); // คอลัมน์ 'email' เป็น Primary Key
            $table->string('token'); // คอลัมน์ 'token' สำหรับเก็บโทเค็น
            $table->timestamp('created_at')->nullable(); // คอลัมน์ 'created_at' สำหรับเวลาที่สร้างโทเค็น
        });

        Schema::create('sessions', function (Blueprint $table) {
            // สร้างตาราง 'sessions' สำหรับเก็บข้อมูลเซสชัน
            $table->string('id')->primary(); // คอลัมน์ 'id' เป็น Primary Key
            $table->foreignId('user_id')->nullable()->index(); // คอลัมน์ 'user_id' ที่เชื่อมโยงกับตาราง 'users'
            $table->string('ip_address', 45)->nullable(); // คอลัมน์ 'ip_address' สำหรับเก็บที่อยู่ IP
            $table->text('user_agent')->nullable(); // คอลัมน์ 'user_agent' สำหรับเก็บข้อมูลของเบราว์เซอร์ที่ใช้
            $table->longText('payload'); // คอลัมน์ 'payload' สำหรับเก็บข้อมูลอื่น ๆ ของเซสชัน
            $table->integer('last_activity')->index(); // คอลัมน์ 'last_activity' สำหรับเก็บเวลาในการทำกิจกรรมล่าสุด
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ฟังก์ชันนี้จะทำการลบตารางที่สร้างไว้เมื่อทำการย้อนกลับการ migration

        Schema::dropIfExists('users'); // ลบตาราง 'users'
        Schema::dropIfExists('password_reset_tokens'); // ลบตาราง 'password_reset_tokens'
        Schema::dropIfExists('sessions'); // ลบตาราง 'sessions'
    }
};
