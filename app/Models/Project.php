<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use InvalidArgumentException;

class Project extends Model
{
    use HasFactory;

    /**
     * List of available statuses.
     */
    protected const AVAILABLE_STATUSES = [
        'Pending'   => 'pending',
        'Active'    => 'active',
        'Completed' => 'completed'
    ];

    /**
     * Fillable attributes.
     */
    protected $fillable = [
        'name', 'host_url', 'description', 'customer_id', 'status'
    ];         
    
    /**
     * Attributes fefault values.
     * 
     * @var array
     */
    protected $attributes = [
        'description' => '',
        'status'      => self::AVAILABLE_STATUSES['Active']
    ];

    /**
     * Get task status by key
     * 
     * @param string $key Task status key.
     * @return string Task status.
     */
    public static function getStatus(string $key)
    {
        if (!array_key_exists($key, self::AVAILABLE_STATUSES)) {
            throw new InvalidArgumentException(
                sprintf('status for key[%s] does not exist.', $key)
            );
        }

        return self::AVAILABLE_STATUSES[$key];
    }

    /**
     * Get all available statuses.
     * Keys or values.
     * 
     * @param boolean $key If true return statuses keys, otherwise values.
     * @return array available statuses keys or values.
     */
    public static function getAvailablesStatuses(bool $keys = false)
    {
        return ($keys) ? array_keys(self::AVAILABLE_STATUSES) : array_values(self::AVAILABLE_STATUSES);
    }
    /**
     * Set model slug attribute.
     * Before setting check for similar lugs and set unique value.
     * 
     * @param string $slug Task slug.
     * @return void
     */
/*    public function setSlugAttribute(string $slug)
    {
      //  $this->attributes['slug'] = $this->slug;
      //  $this->attributes['slug'] = $slug;
        $this->attributes['slug'] = Str::slug($slug);
    } */

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
        * Customer::class  model tabeli
        * 'owner_id'       kucz obcy ( w tabeli 'customers' )
        * 'id'             klucz lokalny-podstawowy ( w tabeli 'projects' ), który odpowiada kluczowi obcemu      
        **/ 
          return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

}
