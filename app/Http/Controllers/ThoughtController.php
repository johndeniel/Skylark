<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThoughtController extends Controller
{
    public function index()
    { 
        $user = Auth::user();
        return view('thought', compact('user'));
    }
}