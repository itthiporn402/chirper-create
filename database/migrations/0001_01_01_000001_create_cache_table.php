<?php

use Illuminate\Database\Migrations\Migration; // นำเข้า Migration ของ Laravel ซึ่งใช้สำหรับการจัดการการสร้างตารางในฐานข้อมูล
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

        Schema::create('cache', function (Blueprint $table) {
            // สร้างตาราง 'cache' ซึ่งใช้เก็บข้อมูลแคช
            $table->string('key')->primary(); // สร้างคอลัมน์ 'key' เป็น Primary Key
            $table->mediumText('value'); // สร้างคอลัมน์ 'value' สำหรับเก็บข้อมูลที่แคช
            $table->integer('expiration'); // สร้างคอลัมน์ 'expiration' สำหรับเก็บระยะเวลาแคชหมดอายุ (เป็นจำนวนวินาที)
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            // สร้างตาราง 'cache_locks' สำหรับจัดการล็อกของแคช
            $table->string('key')->primary(); // สร้างคอลัมน์ 'key' เป็น Primary Key
            $table->string('owner'); // สร้างคอลัมน์ 'owner' สำหรับเก็บเจ้าของของล็อก
            $table->integer('expiration'); // สร้างคอลัมน์ 'expiration' สำหรับเก็บระยะเวลาแคชล็อกหมดอายุ (เป็นจำนวนวินาที)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ฟังก์ชันนี้จะทำการลบตารางที่สร้างไว้เมื่อทำการย้อนกลับการ migration
        Schema::dropIfExists('cache'); // ลบตาราง 'cache'
        Schema::dropIfExists('cache_locks'); // ลบตาราง 'cache_locks'
    }
};
