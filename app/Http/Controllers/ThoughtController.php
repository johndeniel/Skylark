<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThoughtController extends Controller
{
    /**
     * Display all thoughts with bookmark status
     */
    public function index()
    {
        // Get all thoughts with user information
        $thoughts = Thought::with('user')->latest()->get();
        
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
        $validated = $request->validate([
            'content' => 'required|string|max:280'
        ]);

        try {
            $thought = Thought::create([
                'userid' => auth()->user()->userid,
                'content' => $validated['content']
            ]);

            $thought->load('user');

            // Return JSON response for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thought shared successfully!',
                    'thought' => [
                        'id' => $thought->_id,
                        'content' => $thought->content,
                        'user' => [
                            'name' => $thought->user->name,
                            'photo_url' => $thought->user->photo_url,
                        ],
                        'time_ago' => $thought->time_ago,
                        'is_bookmarked_by_user' => false,
                        'bookmark_count' => 0,
                    ]
                ]);
            }

            return redirect()->route('thoughts.index')->with('success', 'Thought posted successfully!');

        } catch (\Exception $e) {
            \Log::error('Thought creation error:', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to share thought. Please try again.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to share thought. Please try again.');
        }
    }

    /**
     * Update the specified thought
     */
    public function update(Request $request, $thoughtId)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:280',
        ]);

        try {
            $thought = Thought::findOrFail($thoughtId);
            
            // Check if the authenticated user owns this thought
            if ($thought->userid !== Auth::user()->userid) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized to edit this thought.'
                    ], 403);
                }
                
                return redirect()->back()->with('error', 'Unauthorized to edit this thought.');
            }

            $thought->update([
                'content' => $validated['content'],
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thought updated successfully!',
                    'thought' => [
                        'id' => $thought->_id,
                        'content' => $thought->content,
                    ]
                ]);
            }

            return redirect()->back()->with('success', 'Thought updated successfully!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Thought not found.'
                ], 404);
            }
            
            return redirect()->back()->with('error', 'Thought not found.');
            
        } catch (\Exception $e) {
            \Log::error('Thought update error:', [
                'thought_id' => $thoughtId,
                'user_id' => Auth::user()->userid,
                'error' => $e->getMessage()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update thought. Please try again.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to update thought. Please try again.');
        }
    }

    /**
     * Remove the specified thought
     */
    public function destroy(Request $request, $thoughtId)
    {
        try {
            $thought = Thought::findOrFail($thoughtId);
            
            // Check if the authenticated user owns this thought
            if ($thought->userid !== Auth::user()->userid) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized to delete this thought.'
                    ], 403);
                }
                
                return redirect()->back()->with('error', 'Unauthorized to delete this thought.');
            }

            // Delete associated bookmarks first to maintain data integrity
            Bookmark::where('thought_id', $thoughtId)->delete();
            
            // Delete the thought
            $thought->delete();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thought deleted successfully!'
                ]);
            }

            return redirect()->back()->with('success', 'Thought deleted successfully!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Thought not found.'
                ], 404);
            }
            
            return redirect()->back()->with('error', 'Thought not found.');
            
        } catch (\Exception $e) {
            \Log::error('Thought deletion error:', [
                'thought_id' => $thoughtId,
                'user_id' => Auth::user()->userid,
                'error' => $e->getMessage()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete thought. Please try again.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to delete thought. Please try again.');
        }
    }
}