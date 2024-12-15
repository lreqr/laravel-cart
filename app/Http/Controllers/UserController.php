<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = User::find($request->user_id);
        $locale = app()->getLocale();
        if ($user){
            Auth::login($user);
            return response()->json(['message' => __('messages.welcome'), 'redirect_url' => route('cart.index', ['locale' => $locale])]);
        }

        return response()->json(['message' => 'Пользователь не найден'], 404);
    }

    public function logout(Request $request)
    {
        $locale = app()->getLocale();
        Auth::logout();
        return response()->json(['message' => __('messages.bye_user'), 'redirect_url' => route('cart.index', ['locale' => $locale])]);
    }
}
