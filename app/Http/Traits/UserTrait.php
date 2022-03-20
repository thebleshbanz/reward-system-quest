<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Models\User;

trait UserTrait {
    
    protected $user_request;

    function __construct(Request $request)
    {
        $this->request = $request->all();
    }

    public function index() {
        
        // Fetch all the students from the 'student' table.
        
        $users = User::all();

        dd($users);
        
        // return view('welcome')->with(compact('student'));
    }

    public function checkReferralCode($user_request)
    {
        
        $res = User::where('referral_code', $user_request->referral_code)->first();

        dd($res);

        if(!empty($res)){
            return $res;
        }else{
            return 0;
        }
    }
}