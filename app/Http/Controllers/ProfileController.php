<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Thought;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page with their thoughts and bookmark status.
     */
    public function index()
    {
        $user = Auth::user();

        // Retrieve the user's thoughts with user and bookmark relationships
        $thoughts = Thought::with(['user', 'bookmarks'])
            ->where('userid', $user->userid)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get IDs of thoughts bookmarked by the user
        $userBookmarks = $user->bookmarks()->pluck('thought_id')->toArray();

        // Append bookmark status and count to each thought
        $thoughts->each(function ($thought) use ($userBookmarks) {
            $thought->is_bookmarked_by_user = in_array($thought->_id, $userBookmarks);
            $thought->bookmark_count = $thought->bookmarks->count();
        });

        return view('profile', compact('user', 'thoughts'));
    }

    /**
     * Update the user's profile with validation.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate incoming profile data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('users', 'username')->ignore($user->_id) // Ignore current user for uniqueness
            ],
            'pronoun' => ['required', 'string', 'in:He,She,Xe,Ze,They'],
            'bio' => ['nullable', 'string', 'max:60'],
        ]);

        try {
            // Update user record and refresh model
            $user->update($validated);
            $user->refresh();

            // Handle AJAX requests with JSON response
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

            // For form submissions, redirect back with success message
            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // Log error details for debugging
            \Log::error('Profile update error:', ['error' => $e->getMessage()]);

            // Respond with JSON or redirect based on request type
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update profile. Please try again.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
        }
    }

    /**
     * Upload a new profile photo to S3 and update user's photo URL.
     */
    public function uploadPhoto(Request $request)
    {
        try {
            // Validate uploaded file
            $request->validate([
                'photo' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg,gif,webp',
                    'max:5120' // Max 5MB
                ]
            ]);

            $user = Auth::user();
            $file = $request->file('photo');

            // Generate a unique file path
            $filename = 'profile-photos/' . $user->userid . '/' . time() . '.' . $file->getClientOriginalExtension();

            // Delete old profile photo from S3 if exists
            if ($user->photo_url) {
                $oldPath = $this->extractS3PathFromUrl($user->photo_url);
                if ($oldPath) {
                    Storage::disk('s3')->delete($oldPath);
                }
            }

            // Upload new photo to S3
            Storage::disk('s3')->put($filename, file_get_contents($file));

            // Get public URL to the uploaded photo
            $photoUrl = Storage::disk('s3')->url($filename);

            // Update user record with new photo URL
            $user->update([
                'photo_url' => $photoUrl
            ]);

            $user->refresh();

            return response()->json([
                'success' => true,
                'message' => 'Profile photo updated successfully!',
                'photo_url' => $photoUrl,
                'user' => [
                    'name' => $user->name,
                    'username' => $user->username,
                    'photo_url' => $user->photo_url
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation failure
            return response()->json([
                'success' => false,
                'message' => 'Invalid file uploaded.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // Log any unexpected error
            \Log::error('Photo upload error:', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to upload photo. Please try again.'
            ], 500);
        }
    }

    /**
     * Extract the relative S3 path from a full public URL for deletion purposes.
     */
    private function extractS3PathFromUrl($url)
    {
        if (!$url) return null;

        // Return directly if already a relative path
        if (!str_starts_with($url, 'http')) {
            return $url;
        }

        // Prepare expected S3 URL prefixes based on environment config
        $bucket = env('AWS_BUCKET');
        $region = env('AWS_DEFAULT_REGION');

        $patterns = [
            "https://{$bucket}.s3.{$region}.amazonaws.com/",
            "https://{$bucket}.s3.amazonaws.com/",
            "https://s3.{$region}.amazonaws.com/{$bucket}/",
            "https://s3.amazonaws.com/{$bucket}/"
        ];

        // Strip the matching prefix to get the relative file path
        foreach ($patterns as $pattern) {
            if (str_starts_with($url, $pattern)) {
                return str_replace($pattern, '', $url);
            }
        }

        return null;
    }
}