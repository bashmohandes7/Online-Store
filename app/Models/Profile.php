<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'locale',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    } // end of user
} // end of class
