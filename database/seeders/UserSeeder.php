<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ashish Banjare',
            'email' => 'aashish.banjare@gmail.com',
            'password' => Hash::make('123456'),
            'referral_code' => 'iSIRzSkq',
            'referred_by' => 0,
        ]);
    }
}
