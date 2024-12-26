<?php //ใช้สำหรับกำหนดนโยบายการเข้าถึง ของโมเดล Chirp

namespace App\Policies; // ระบุว่าไฟล์นี้อยู่ใน Namespace "App\Policies" ซึ่งใช้สำหรับกำหนดนโยบายการเข้าถึงใน Laravel

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChirpPolicy // ประกาศคลาส ChirpPolicy ซึ่งจะกำหนดการเข้าถึงสำหรับโมเดล Chirp
{
    /**
     * กำหนดว่า User สามารถดูโมเดลทั้งหมดได้หรือไม่
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * กำหนดว่า User สามารถดูโมเดลที่ระบุได้หรือไม่
     */
    public function view(User $user, Chirp $chirp): bool
    {
        return false; // ปฏิเสธไม่ให้ผู้ใช้ดู Chirp ที่ระบุ
    }

    /**
     * กำหนดว่า User สามารถสร้างโมเดลใหม่ได้หรือไม่
     */
    public function create(User $user): bool
    {
        return false; // ปฏิเสธไม่ให้ผู้ใช้สร้าง Chirp ใหม่
    }

    /**
     * กำหนดว่า User สามารถอัพเดตโมเดลที่ระบุได้หรือไม่
     */
    public function update(User $user, Chirp $chirp): bool
    {

        return $chirp->user()->is($user); // อนุญาตให้แก้ไขเฉพาะ Chirp ของตัวเอง
    }

    /**
     * กำหนดว่า User สามารถลบโมเดลที่ระบุได้หรือไม่
     */
    public function delete(User $user, Chirp $chirp): bool
    {
        // อนุญาตให้ลบได้เฉพาะ Chirp ของตัวเอง
        return $this->update($user, $chirp); // ใช้ฟังก์ชัน update ในการตรวจสอบ
    }

    /**
     * กำหนดว่า User สามารถกู้คืนโมเดลที่ถูกลบได้หรือไม่
     */
    public function restore(User $user, Chirp $chirp): bool
    {
        return false; // ปฏิเสธไม่ให้ผู้ใช้กู้คืน Chirp ที่ถูกลบ
    }

    /**
     * กำหนดว่า User สามารถลบโมเดลถาวรได้หรือไม่
     */
    public function forceDelete(User $user, Chirp $chirp): bool
    {
        return false; // ปฏิเสธไม่ให้ผู้ใช้ลบ Chirp ถาวร
    }
}
