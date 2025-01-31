<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\ActionLog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('customAuth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if (asset($request->role) && $request->role == 'admin'){
            $data['role'] = 'admin';
            User::create($data);
            return back()->with('success', 'Admin is successfully created.');
        }

        $user = User::create($data);
        event(new Registered($user));

        Auth::login($user);
        ActionLog::create([
            'user_id' => Auth::user()->id,
            'product_id' => 0,
            'action' => 'user registered',
        ]);
        // return redirect(route('dashboard', absolute: false));
        return to_route('home');
    }
}
