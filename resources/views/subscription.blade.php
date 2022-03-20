<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Price components -->
                <div style="display: flex;">

                    @if(!empty($subscriptions))

                      @foreach($subscriptions as $subscription)
                      <!-- Subscription plan 1 -->
                      <div class="pricing-plan-wrap lg:w-1/3 my-4 md:my-6" style="width: 33.33%; border: 1px solid #000; margin: 10px;">

                          <div class="pricing-plan border-t-4 border-solid border-white bg-white text-center max-w-sm mx-auto hover:border-indigo-600 transition-colors duration-300">
                            <div class="p-6 md:py-8">
                              <h4 class="font-medium leading-tight text-2xl mb-2">{{ $subscription->title }}</h4>
                            </div>

                            <div class="pricing-amount bg-indigo-100 p-6 transition-colors duration-300">
                              @if($user->discount_balance != 0)
                                <div style="text-decoration: line-through;"><span class="text-4xl font-semibold">${{ $subscription->amount }}</span> /year</div>
                                @php
                                  $discount_amount = ($subscription->amount * $user->discount_balance) / 100;
                                  $final_subscription_amount = $subscription->amount - $discount_amount;
                                @endphp
                                <div><span class="text-4xl font-semibold">${{ $final_subscription_amount }}</span> /year</div>
                              @else
                                <div class=""><span class="text-4xl font-semibold">${{ $subscription->amount }}</span> /year</div>
                              @endif
                            </div>
                            <div class="p-6">
                              <!-- {{ $subscription->description }} -->
                              {{ Str::limit($subscription->description, 100) }}
                              <div class="mt-6 py-4">

                                @if(!empty($active_subscribtion))
                                  @if($subscription->id == $active_subscribtion->pivot->subscription_id)
                                    <button disabled style="background-color: green;" class="bg-indigo-600 text-xl text-white py-2 px-6 rounded hover:bg-indigo-700 transition-colors duration-300">Activated</button>
                                  @else
                                    <button disabled style="background-color: #000;" class="bg-indigo-600 text-xl text-white py-2 px-6 rounded hover:bg-indigo-700 transition-colors duration-300">Get Started</button>
                                  @endif
                                @else
                                  <form method="POST" action="{{ route('user_subscription') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <input type="hidden" name="subscription_id" value="{{$subscription->id}}">
                                    <button type="submit" style="background-color: #000;" class="bg-indigo-600 text-xl text-white py-2 px-6 rounded hover:bg-indigo-700 transition-colors duration-300">Get Started</button>
                                  </form>
                                @endif

                                  
                              </div>
                            </div>
                          </div>
                      </div>
                      @endforeach
                    
                    @else
                      <div class="p-6 bg-white border-b border-gray-200">
                        Subscriptions plans not found.
                      </div>
                    @endif
                </div>
            </div>
        </div>




    </div>


</x-app-layout>
