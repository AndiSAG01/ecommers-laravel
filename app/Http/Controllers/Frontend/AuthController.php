<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (auth()->guard('customer')->check()) return redirect(route('front.index'));
        return view('frontend.pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $customer = \App\Models\Customer::where('email', $request->email)->first();

        if ($customer && $customer->status == 1 && password_verify($request->password, $customer->password)) {
            auth()->guard('customer')->login($customer);
            return redirect()->intended(route('front.index'));
        } elseif ($customer && $customer->status == 0) {
            Alert::toast('Account is inactive. Please contact support.', 'error');
        } else {
            Alert::toast('Email or Password is Incorrect', 'error');
        }

        return redirect()->back();
    }

    public function registerForm()
    {
        if (auth()->guard('customer')->check()) return redirect(route('front.index'));
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        return view('frontend.pages.auth.register', compact('provinces'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:customers,email,id',
            'password' => 'required|string|min:8',
        ]);

        if (!auth()->guard('customer')->check()) {
            Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => 1
            ]);
        }

        $credentials = $request->only('first_name', 'last_name', 'email', 'password') + ['status' => 1];

        if (auth()->guard('customer')->attempt($credentials)) {
            return redirect()->intended(route('front.index'));
        }

        return redirect()->back();
    }

    public function logout()
    {
        auth()->guard('customer')->logout();
        return redirect(route('front.index'));
    }
}
