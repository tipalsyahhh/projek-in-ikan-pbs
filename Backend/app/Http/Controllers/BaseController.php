<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;

class BaseController extends Controller
{
    public function __construct()
    {
        $user = Auth::user();

        if ($user) {
            $token = $user->reset_token;
        } else {
            $token = 'contoh_nilai_token';
        }

        view()->share('token', $token);
    }
}
