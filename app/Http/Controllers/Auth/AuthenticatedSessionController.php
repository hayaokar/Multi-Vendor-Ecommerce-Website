<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

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
        try {
            $request->authenticate();

            $request->session()->regenerate();

            $url = '';

            if ($request->user()->role == 'admin')
                $url = '/admin/dashboard';
            else if ($request->user()->role == 'vendor')
                $url = '/vendor/dashboard';
            else if ($request->user()->role == 'user')
                $url = '/dashboard';

            $notification = array(
                'message' => 'Logged in Successfully',
                'alert-type' => 'success'
            );

            return redirect()->intended($url)->with($notification);

        } catch (ValidationException $e){
            $notification = array(
                'message' => 'Wrong Credentials',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

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
