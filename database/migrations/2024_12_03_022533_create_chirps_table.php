<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // สร้างตาราง 'chirps'
        Schema::create('chirps', function (Blueprint $table) {
            $table->id(); // สร้างคอลัมน์ 'id' เป็น primary key อัตโนมัติ
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // สร้างคอลัมน์ 'user_id' ที่เชื่อมโยงกับ 'users' table และลบข้อมูลใน 'chirps' เมื่อผู้ใช้ถูกลบ
            $table->string('message'); // สร้างคอลัมน์ 'message' สำหรับเก็บข้อความที่ผู้ใช้โพสต์
            $table->timestamps(); // สร้างคอลัมน์ 'created_at' และ 'updated_at' อัตโนมัติ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ลบตาราง 'chirps' หากมีอยู่
        Schema::dropIfExists('chirps');
    }
};
