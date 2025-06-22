<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThoughtController extends Controller
{
    /**
     * Display all thoughts with bookmark status
     */
    public function index()
    {
        // Get all thoughts with user and bookmark information
        $thoughts = Thought::with(['user', 'bookmarks'])->latest()->get();
        
        // Add bookmark status for each thought if user is authenticated
        if (auth()->check()) {
            $userBookmarks = auth()->user()->bookmarks()->pluck('thought_id')->toArray();
            
            $thoughts->each(function ($thought) use ($userBookmarks) {
                $thought->is_bookmarked_by_user = in_array($thought->_id, $userBookmarks);
                $thought->bookmark_count = $thought->bookmarks->count();
            });
        } else {
            $thoughts->each(function ($thought) {
                $thought->is_bookmarked_by_user = false;
                $thought->bookmark_count = $thought->bookmarks->count();
            });
        }
        
        $user = Auth::user();

        return view('thought', compact('user', 'thoughts'));
    }

    /**
     * Store a new thought
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:280'
        ]);

        Thought::create([
            'userid' => auth()->user()->userid,
            'content' => $request->content
        ]);

        return redirect()->route('thoughts.index')->with('success', 'Thought posted successfully!');
    }
}