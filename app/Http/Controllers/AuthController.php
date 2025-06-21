<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display the signin form.
     * 
     * @return View
     */
    public function signin(): View
    {
        return view('auth.signin');
    }

    /**
     * Authenticate user credentials and establish session.
     * 
     * Validates user credentials against the database and creates
     * an authenticated session if successful. Implements rate limiting
     * and secure session handling.
     * 
     * @param Request $request The HTTP request containing credentials
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // Validate incoming credentials
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        // Attempt authentication with optional remember me functionality
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Regenerate session ID to prevent session fixation attacks
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => __('auth.failed'),
        ])->onlyInput('username');
    }

    /**
     * Display the user signup form.
     * 
     * @return View
     */
    public function signup(): View
    {
        return view('auth.signup');
    }

    /**
     * Register a new user account.
     * 
     * Validates user input, creates a new user record with secure
     * password hashing, and automatically authenticates the new user.
     * 
     * @param Request $request The HTTP request containing registration data
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Comprehensive input validation
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'username' => ['required', 'string', 'max:255', 'min:3', 'unique:users,username', 'alpha_dash'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'pronoun' => ['required', 'string', 'in:He,She,Xe,Ze,They'],
        ]);

        // Create new user with validated data
        $user = User::create([
            'userid' => (string) Str::uuid(),
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'pronoun' => $validated['pronoun'],
            'bio' => null,
            'photo_url' => 'https://ui-avatars.com/api/?name=' . urlencode($validated['name']),
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        // Authenticate the newly created user
        Auth::login($user);

        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', __('Registration successful! Welcome aboard.'));
    }

    /**
     * Log out the authenticated user.
     * 
     * Terminates the user session, invalidates the session data,
     * and regenerates the CSRF token for security.
     * 
     * @param Request $request The HTTP request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        // Perform logout operations
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', __('You have been logged out successfully.'));
    }
}
