<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use InvalidArgumentException;

class Task extends Model
{
    use HasFactory;

    /**
     * title   - string, max 100 znaków
     * slug    - string, max 255 znaków, unique na całą bazę
     * content - string, max 255 znaków,
     * status  - <active, completed> string, wartość z dostępnej listy
     */
    protected const AVAILABLE_STATUSES = [
        'Active'     => 'active',
        'Completed'  => 'completed'
    ];

    /**
     * Fillable attributes.
     */
    protected $fillable = [
        'title', 'slug', 'content', 'status'
    ];

    /**
     * Attributes fefault values.
     * 
     * @var array
     */
    protected $attributes = [
        'content' => '',
        'status'  => self::AVAILABLE_STATUSES['Active']
    ];
    
    public static function getStatus(string $key)
    {
        if(!array_key_exists($key, self::AVAILABLE_STATUSES))
        {
            throw new InvalidArgumentException(
                sprintf('status for key [%s] does not exist.', $key)
            );
        }

        return self::AVAILABLE_STATUSES[$key];
    }

    public static function getAvailablesStatuses(bool $keys = false)
    {
        return ($keys) ? array_keys(self::AVAILABLE_STATUSES) : array_values(self::AVAILABLE_STATUSES);
    }

    protected static function boot()
    {
        parent::boot();

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setSlugAttribute(string $slug)
    {
        $this->attributes['slug'] = Str::slug($slug);
    }

    /**
     * Check is task status.
     * 
     * @param string $key
     * @return boolean
     */
    public function hasStatus(string $key)
    {
        return ($this->status == self::getStatus($key));
    }

    public function owner()
    {
       /**
        * relacja jeden do wielu
        * User::class  model tabeli
        * 'id'         kucz obcy ( w tabeli 'staff' )
        * 'owner_id'   klucz lokalny-podstawowy ( w tabeli 'tasks' ), który odpowiada kluczowi obcemu      
        **/ 
          return $this->belongsTo(Staff::class, 'owner_id', 'id');
    }

}
