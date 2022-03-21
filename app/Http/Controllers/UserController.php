<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function referrals(){
        $user = Auth::user();
        $children = $user->with('children')->get();
        dd($children[0]->name);
    }
}
