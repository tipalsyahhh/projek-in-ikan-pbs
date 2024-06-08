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
                'redirect' => URL::to('/frontend/admin/admin.html')
            ])->header('Access-Control-Allow-Origin', '*');
        }
    
        return response()->json([
            'status' => 'success',
            'redirect' => URL::to('/frontend/home.html')
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
            ])->header('Access-Control-Allow-Origin', '*');
        }
    
        $user = User::where('name', $name)->first();
    
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Nama pengguna tidak ditemukan.'
            ])->header('Access-Control-Allow-Origin', '*');
        }
    
        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kata sandi salah.'
            ])->header('Access-Control-Allow-Origin', '*');
        }
        $user->save();
    
        Auth::login($user);
    
        $redirectUrl = '/frontend/home.html';
        if ($user->role === 'admin') {
            $redirectUrl = '/frontend/admin/admin.html';
        }
    
        return response()->json([
            'status' => 'success',
            'redirect' => URL::to($redirectUrl)
        ])->header('Access-Control-Allow-Origin', '*');
    }
    
    // public function userChart()
    // {
    //     $monthlySales = User::selectRaw('MONTH(created_at) as month, COUNT(DISTINCT user) as total_users')
    //         ->groupBy('month')
    //         ->orderBy('month')
    //         ->get();

    //     return response()->json($monthlySales);
    // }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
