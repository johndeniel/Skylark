<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Thought;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Fetch the user's thoughts for the creative wall
        $thoughts = Thought::with('user')
            ->where('userid', $user->userid)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('profile', compact('user', 'thoughts'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('users', 'username')->ignore($user->_id)
            ],
            'pronoun' => ['required', 'string', 'in:He,She,Xe,Ze,They'],
            'bio' => ['nullable', 'string', 'max:60'],
        ]);

        try {
            $user->update($validated);
            $user->refresh();

            // Check if it's an AJAX request
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile updated successfully!',
                    'user' => [
                        'name' => $user->name,
                        'username' => $user->username,
                        'pronoun' => $user->pronoun,
                        'bio' => $user->bio,
                    ]
                ]);
            }

            // For regular form submission, redirect back with success message
            return redirect()->back()->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Profile update error:', ['error' => $e->getMessage()]);
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update profile. Please try again.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
        }
    }
}