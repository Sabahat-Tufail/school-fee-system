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
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $reservedAdminEmails = [
            '23pwcse2236@uetpeshawar.edu.pk',
            '23pwcse2259@uetpeshawar.edu.pk',
            '23pwcse2333@uetpeshawar.edu.pk',
        ];

        if (in_array($request->email, $reservedAdminEmails)) {
            return back()->withErrors(['email' => 'This email is reserved. Please log in instead.']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roll_number' => ['nullable', 'string', 'max:50'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->role = 'student';
        $user->roll_number = $request->roll_number;
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('student.dashboard');
    }
}

