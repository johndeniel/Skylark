<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Thought;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display all bookmarked thoughts for the current user
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get all bookmarked thoughts with user information
        $bookmarkedThoughts = Thought::whereIn('_id', 
            $user->bookmarks()->pluck('thought_id')
        )->with('user')->latest()->get();
        
        return view('bookmark', [
            'bookmarkedThoughts' => $bookmarkedThoughts,
            'user' => $user
        ]);
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