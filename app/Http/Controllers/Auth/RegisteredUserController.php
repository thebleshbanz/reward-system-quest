<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use App\Http\Traits\UserTrait;

use App\Models\User;

class RegisteredUserController extends Controller
{

    use UserTrait;


    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'referral_code' => [
                'required',
                Rule::exists('users')->where(function ($query) use ($data) {
                    return $query->where('referral_code', $data['referral_code']);
                }),
            ],
        ]);

        $res = User::where('referral_code', $data['referral_code'])->first();

        if(!empty($res)){
            $referred_by = $res->id;
            // update discount balance to referred_by user account
            $res->discount_balance = 5 + $res->discount_balance;
            $res->save();
        }else{
            $referred_by = 0;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => Str::random(8),
            'referred_by' => $referred_by,
        ]);

        return redirect(route('login'))->with('status', 'Thanks for registering!, Please Login');
    }

}
