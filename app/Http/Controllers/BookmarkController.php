<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Thought;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Display all bookmarked thoughts for the current user
     */
    public function index()
    {
        // Get only the thoughts that are bookmarked by the current user
        $userBookmarkIds = auth()->user()->bookmarks()->pluck('thought_id')->toArray();
        
        $thoughts = Thought::with(['user', 'bookmarks'])
            ->whereIn('_id', $userBookmarkIds)
            ->latest()
            ->get();

        // Add bookmark status (all will be true since we're only showing bookmarked thoughts)
        $thoughts->each(function ($thought) {
            $thought->is_bookmarked_by_user = true;
            $thought->bookmark_count = $thought->bookmarks->count();
        });
        
        $user = Auth::user();

        return view('bookmark', compact('user', 'thoughts'));
    }


    /**
     * Toggle bookmark for a thought (add if not bookmarked, remove if bookmarked)
     */
    public function toggle(Request $request, $thoughtId)
    {
        $user = auth()->user();
        
        // Validate that the thought exists
        $thought = Thought::findOrFail($thoughtId);
        
        // Check if bookmark already exists
        $bookmark = Bookmark::where('userid', $user->userid)
                           ->where('thought_id', $thoughtId)
                           ->first();
        
        if ($bookmark) {
            // Remove bookmark if it exists
            $bookmark->delete();
            $bookmarked = false;
            $message = 'Bookmark removed successfully';
        } else {
            // Add bookmark if it doesn't exist
            Bookmark::create([
                'userid' => $user->userid,
                'thought_id' => $thoughtId
            ]);
            $bookmarked = true;
            $message = 'Thought bookmarked successfully';
        }
        
        // Get updated bookmark count
        $bookmarkCount = Bookmark::where('thought_id', $thoughtId)->count();
        
        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'bookmarked' => $bookmarked,
                'message' => $message,
                'bookmark_count' => $bookmarkCount
            ]);
        }
        
        // Redirect back with success message for regular requests
        return back()->with('success', $message);
    }
}