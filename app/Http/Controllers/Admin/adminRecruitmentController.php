<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // <--- TAMBAHKAN BARIS INI
use Illuminate\Http\Request;
use App\Models\Member; // Pastikan Model Member juga di-import jika dipakai

class adminRecruitmentController extends Controller
{
    public function index()
    {
        // Pastikan model Member sudah ada
        $members = Member::latest()->paginate(10); 
        
        // Sesuaikan path view-nya dengan folder view Anda
        return view('admin/laporan/adminrecruitment', compact('members'));
    }
}