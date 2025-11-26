<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class adminRecruitmentController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('admin.laporan.adminrecruitment', compact('pelamars'));
    }
    public function create()
    {
        return view('admin.laporan.adminrecruitment');
    }

}
