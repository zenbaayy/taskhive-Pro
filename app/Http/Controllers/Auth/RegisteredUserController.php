<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view for guests.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Display the registration view specifically for Admin without guest restriction.
     */
    public function createAdminMember(): View
    {
        // Yeh aapka wahi purana signup page kholega jo phele aa raha tha
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Strict Email aur Form Validation
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                'unique:users,email' // Email validation: unique check karega
            ],
            'role' => ['nullable', 'string', 'in:admin,member'], 
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Handle avatar file upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // Data database mein save ho raha hai yahan
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role ?? 'member', // Default member role fallback
            'avatar' => $avatarPath,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // CRITICAL CHECK: Agar pehle se Admin logged in hai, toh naye user ko auto-login MAT karo
        if (Auth::check() && strtolower(Auth::user()->role) === 'admin') {
            return redirect()->route('dashboard')->with('success', 'New member registered successfully inside database!');
        }

        // Agar guest user fresh signup kar raha hai tabhi login hoga
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}