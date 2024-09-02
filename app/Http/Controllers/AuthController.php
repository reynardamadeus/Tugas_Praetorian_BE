<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getRegisterPage()
    {
        return view('register');
    }

    public function getLoginPage()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'max:12', 'string'],
            'phone_number' => ['required', 'starts_with:08']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);

        return redirect(route('login'))->with(['session' => 'Register Successfull']);
    }

    public function login(Request $request)
    {
        try{

        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            if(Auth::user()->role == 'Admin')
            {
                return redirect()->route('admin.dashboard');
            }else
            {
                $userCart = Cart::where('user_id', Auth::user()->id)->first();
                if ($userCart) {
                    session()->put('cart', $userCart->cart_items);
                }
                return redirect()->route('user.dashboard');
            }
        }else
        {
            return redirect()->route('login')->with(['error', 'The provided credentials doesnt match our records']);
        }

        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }
}
