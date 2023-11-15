<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user_home(User $user){
        return view('users/user_home')->with(['posts' => $user->getUserHome()]);
    }
}
