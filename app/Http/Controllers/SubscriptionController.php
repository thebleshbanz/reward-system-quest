<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Subscription;
use App\Models\User;


class SubscriptionController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $subscriptions = Subscription::all();
        $user = Auth::user();
        $active_subscribtion = $user->subscribtions()->first();
        return view('subscription', compact('subscriptions', 'user', 'active_subscribtion'));
    }

    public function userSubscription(Request $request){
        $user = Auth::user();
        
        $user->subscribtions()->attach($request->input('subscription_id'));

        return redirect(route('subscriptions'))->with('status', 'Thanks for subscriptions!, '.$user->name);
    }
}
