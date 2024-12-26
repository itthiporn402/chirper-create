<?php
namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;

class ChirpController extends Controller
{
    /**
     * แสดงรายการ Chirp ทั้งหมด
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Chirps/Index', [
            // ดึงข้อมูล Chirp ทั้งหมด พร้อมข้อมูลผู้ใช้ที่เกี่ยวข้อง (user) โดยดึงเฉพาะ id และ name
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * แสดงฟอร์มสำหรับสร้าง Chirp ใหม่
     */
    public function create()
    {
        // ฟังก์ชันนี้จะใช้สำหรับการแสดงฟอร์มสร้าง Chirp แต่ไม่ได้ใช้งานในตอนนี้
    }

    /**
     * เก็บข้อมูล Chirp ที่สร้างขึ้นใหม่
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->chirps()->create($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * แสดง Chirp ที่ระบุ
     */
    public function show(Chirp $chirp)
    {
        // ฟังก์ชันนี้จะใช้สำหรับการแสดง Chirp ที่ระบุ
    }

    /**
     * แสดงฟอร์มสำหรับแก้ไข Chirp ที่ระบุ
     */
    public function edit(Chirp $chirp)
    {
        // ใช้สำหรับการแสดงฟอร์มแก้ไข Chirp ที่ระบุ
    }

    /**
     * อัพเดตข้อมูล Chirp ที่ระบุ
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        Gate::authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * ลบ Chirp ที่ระบุ
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        Gate::authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
