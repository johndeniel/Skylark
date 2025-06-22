<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThoughtController extends Controller
{
    /**
     * Display all thoughts
     */
    public function index()
    {

        $user = Auth::user();

        $thoughts = Thought::with('user') 
            ->orderBy('created_at', 'desc')
            ->get();

        return view('thought', compact('thoughts'),  compact('user'));
    }

    /**
     * Store a new thought
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        Thought::create([
            'userid' => Auth::user()->userid,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Thought posted successfully!');
    }
}