<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        // Check if the user has the 'admin' role
        if ($user->hasRole('admin')) {
            return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
        }

        // Check if the user has the 'user' role
        if ($user->hasRole('user')) {
            return redirect(RouteServiceProvider::HOME);
        }

        // Check if the user has the 'personnel' role
        if ($user->hasRole(['personnel', 'another_role'])) {
            return redirect()->route('personnel.index');
        }

        // If the user doesn't have any of the above roles, you can redirect them to a default page
        return redirect(RouteServiceProvider::HOME);
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
