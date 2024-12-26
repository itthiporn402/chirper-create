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

        Schema::create('jobs', function (Blueprint $table) {
            // สร้างตาราง 'jobs' สำหรับเก็บข้อมูลของงานที่ถูกเพิ่มเข้า Queue
            $table->id(); // คอลัมน์ 'id' เป็น Primary Key ของตาราง
            $table->string('queue')->index(); // คอลัมน์ 'queue' สำหรับเก็บชื่อของคิว และทำการ index เพื่อเพิ่มประสิทธิภาพในการค้นหา
            $table->longText('payload'); // คอลัมน์ 'payload' สำหรับเก็บข้อมูลงาน (รายละเอียดที่ต้องการทำงาน)
            $table->unsignedTinyInteger('attempts'); // คอลัมน์ 'attempts' สำหรับเก็บจำนวนครั้งที่งานนี้พยายามจะทำใหม่
            $table->unsignedInteger('reserved_at')->nullable(); // คอลัมน์ 'reserved_at' สำหรับเก็บเวลาเมื่อมีการจองงาน
            $table->unsignedInteger('available_at'); // คอลัมน์ 'available_at' สำหรับเก็บเวลาเมื่อการทำงานเริ่มต้น
            $table->unsignedInteger('created_at'); // คอลัมน์ 'created_at' สำหรับเก็บเวลาที่งานนี้ถูกสร้างขึ้น
        });

        Schema::create('job_batches', function (Blueprint $table) {
            // สร้างตาราง 'job_batches' สำหรับเก็บข้อมูลของกลุ่มงานที่ทำผ่าน Queue
            $table->string('id')->primary(); // คอลัมน์ 'id' เป็น Primary Key ของกลุ่มงาน
            $table->string('name'); // คอลัมน์ 'name' สำหรับเก็บชื่อของกลุ่มงาน
            $table->integer('total_jobs'); // คอลัมน์ 'total_jobs' สำหรับเก็บจำนวนงานทั้งหมดในกลุ่ม
            $table->integer('pending_jobs'); // คอลัมน์ 'pending_jobs' สำหรับเก็บจำนวนงานที่ยังไม่เสร็จ
            $table->integer('failed_jobs'); // คอลัมน์ 'failed_jobs' สำหรับเก็บจำนวนงานที่ล้มเหลว
            $table->longText('failed_job_ids'); // คอลัมน์ 'failed_job_ids' สำหรับเก็บ IDs ของงานที่ล้มเหลว
            $table->mediumText('options')->nullable(); // คอลัมน์ 'options' สำหรับเก็บตัวเลือกเสริมต่าง ๆ ของกลุ่มงาน
            $table->integer('cancelled_at')->nullable(); // คอลัมน์ 'cancelled_at' สำหรับเก็บเวลาที่กลุ่มงานถูกยกเลิก
            $table->integer('created_at'); // คอลัมน์ 'created_at' สำหรับเก็บเวลาที่กลุ่มงานถูกสร้าง
            $table->integer('finished_at')->nullable(); // คอลัมน์ 'finished_at' สำหรับเก็บเวลาที่กลุ่มงานเสร็จสมบูรณ์
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            // สร้างตาราง 'failed_jobs' สำหรับเก็บข้อมูลงานที่ล้มเหลว
            $table->id(); // คอลัมน์ 'id' เป็น Primary Key ของตาราง
            $table->string('uuid')->unique(); // คอลัมน์ 'uuid' สำหรับเก็บรหัสที่ไม่ซ้ำกันของงาน
            $table->text('connection'); // คอลัมน์ 'connection' สำหรับเก็บข้อมูลการเชื่อมต่อที่ใช้ในการทำงาน
            $table->text('queue'); // คอลัมน์ 'queue' สำหรับเก็บชื่อของคิวที่งานถูกเพิ่ม
            $table->longText('payload'); // คอลัมน์ 'payload' สำหรับเก็บข้อมูลงาน
            $table->longText('exception'); // คอลัมน์ 'exception' สำหรับเก็บข้อมูลข้อผิดพลาดที่ทำให้งานล้มเหลว
            $table->timestamp('failed_at')->useCurrent(); // คอลัมน์ 'failed_at' สำหรับเก็บเวลาที่งานล้มเหลว
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ฟังก์ชันนี้จะทำการลบตารางที่สร้างขึ้นเมื่อทำการย้อนกลับการ migration
        Schema::dropIfExists('jobs'); // ลบตาราง 'jobs'
        Schema::dropIfExists('job_batches'); // ลบตาราง 'job_batches'
        Schema::dropIfExists('failed_jobs'); // ลบตาราง 'failed_jobs'
    }
};
