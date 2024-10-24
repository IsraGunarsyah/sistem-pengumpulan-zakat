<?php

namespace App\Http\Controllers;
use App\Models\upzs;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    { 
        
        // Count total UPZ
        $totalUPZ = upzs::count();
        
        // Fetch all UPZs for the map
        $upzList = upzs::all();

        // Return the view with the data
        return view('user.index', compact('totalUPZ', 'upzList'));
        
    }

    public function map(){
        $upzMap = upzs::all();

        return view('user.map-upz', compact('upzMap'));
    }
}
