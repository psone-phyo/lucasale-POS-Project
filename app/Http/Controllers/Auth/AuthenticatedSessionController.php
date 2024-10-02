<?php

namespace App\Http\Controllers\Auth;

use App\Models\Order;
use App\Models\ActionLog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('customAuth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        if (Auth::user()->role=='admin' || Auth::user()->role=='superadmin'){
            $data = Order::select('order_code', 'status')
                ->where('status','!=',1)
                ->groupby('order_code')
                ->orderby('created_at')
                ->get();
            Session::put('pendingData', count($data));
            return to_route('dashboard');
        }elseif (Auth::user()->role=='user'){
            ActionLog::create([
                'user_id' => Auth::user()->id,
                'product_id' => 0,
                'action' => 'Login',
            ]);
            return to_route('home');
        }
        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
