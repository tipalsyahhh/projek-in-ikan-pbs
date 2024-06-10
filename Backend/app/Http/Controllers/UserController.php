<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class UserController extends BaseController
{
    public function loginByGoogle(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $uid = $request->input('uid');
        $password = $request->input('password');
        $remember_token = Str::random(60);

        $user = User::where('name', $name)->first();

        if (!$user) {

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'uid' => $uid,
                'password' => bcrypt($password),
                'remember_token' => $remember_token,
            ]);
            Auth::login($user);

            return response()->json([
                'status' => 'success',
                'redirect' => URL::to('/frontend/login.html')
            ])->header('Access-Control-Allow-Origin', '*');
        } else {

            $user->uid = $uid;
            $user->password = bcrypt($uid);
            $user->save();
        }

        Auth::login($user);

        if ($user->role === 'admin') {
            return response()->json([
                'status' => 'success',
                'redirect' => 'http://localhost/frontend/admin/admin.html'
            ])->header('Access-Control-Allow-Origin', '*');
        }

        return response()->json([
            'status' => 'success',
            'redirect' => URL::to('http://localhost/frontend/home.html'),
            'user' => [
                'name' => $user->name
            ]
        ])->header('Access-Control-Allow-Origin', '*');
    }

    public function loginfrom(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        if (!$name || !$password) {
            return response()->json([
                'status' => 'error',
                'message' => 'Nama dan kata sandi harus diisi.'
            ]);
        }

        $user = User::where('name', $name)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Nama pengguna tidak ditemukan.'
            ]);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kata sandi salah.'
            ]);
        }

        Auth::login($user);

        $redirectPath = '/frontend/home.html';
        if ($user->role === 'admin') {
            $redirectPath = '/frontend/admin/admin.html';
        }

        return response()->json([
            'status' => 'success',
            'redirect' => 'http://localhost' . $redirectPath,
            'user' => [
                'name' => $user->name
            ]
        ]);
    }

    public function userChart()
    {
        $monthlyUsers = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total_users')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        return response()->json($monthlyUsers);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return response()->json([
            'status' => 'success',
            'redirect' => URL::to('http://localhost/frontend/login.html')
        ])->header('Access-Control-Allow-Origin', '*');
    }
    
}
