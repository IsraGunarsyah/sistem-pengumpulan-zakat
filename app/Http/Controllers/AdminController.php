<?php

namespace App\Http\Controllers;
use App\Models\upzs;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count(); 
        $totalUPZ = upzs::count();    
        $upzList = upzs::all();       
    
        return view('admin.index', compact('totalUsers', 'totalUPZ', 'upzList'));
    }
}
