<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function bookmark(): View 
    {
        $user = Auth::user();
       return view('bookmark', compact('user'));
    }
}
