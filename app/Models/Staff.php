<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Staff extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'staff';

    /**
     * Current guard staff before login.
     *
     * @var string
     */
    protected $guard = 'staff';

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
    public function tasks()
    {
       /**
        * relacja jeden do wielu
        * Task::class  model tabeli, która ma wiele elementów użytkownika,
        * 'owner_id'   kucz obcy ( w tabeli 'tasks' )  -/ staff_id /
        * 'id'         klucz lokalny-podstawowy ( w tabeli 'users' ), który odpowiada kluczowi obcemu      
        **/       
        return $this->hasMany(Task::class, 'owner_id', 'id')
                ->orderBy('created_at', 'DESC');
    }
    /**
     * getTasksByStatus.
     *
     * @param	string $statusKey  Status key name.	
     * @return	Illuminate\Support\Collection
     */
    public function tasksByStatus(string $statusKey)
    {
        return $this->tasks()->where('status', Task::getStatus($statusKey));
    }
 
    /**
     * isCurrentlyAthorized  Is currently authorized user.
     *
     * @return	boolean
     */
    public function isCurrentlyAuthorized()
    {
        return ($this->id === Auth::id());
    }
}
