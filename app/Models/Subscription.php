<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Subscription extends Model
{
    use HasFactory;

    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscriptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'amount',
    ];


    public function users(){
        return $this->belongsToMany(User::class, 'subscription_user', 'user_id', 'subscription_id')->withTimestamps();
    }
}
