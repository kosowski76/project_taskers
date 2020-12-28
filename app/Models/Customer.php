<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\Project;

class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * Current guard admins before login.
     *
     * @var string
     */
    protected $guard = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login'        => 'datetime',
    ];

    /**
     * Get user related tasks
     * 
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function projects()
    {
       /**
        * relacja jeden do wielu
        * Task::class  model tabeli, która ma wiele elementów użytkownika,
        * 'owner_id'   kucz obcy ( w tabeli 'tasks' )
        * 'id'         klucz lokalny-podstawowy ( w tabeli 'users' ), który odpowiada kluczowi obcemu      
        **/   
        return $this->hasMany( Project::class, 'customer_id', 'id')
               ->orderBy('created_at', 'DESC' );
    }

}
