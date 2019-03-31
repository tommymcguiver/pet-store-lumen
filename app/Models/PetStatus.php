<?php

namespace App\Models;

use App\Models\Pet;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pet_statuses';

    /**
     * Disable eloquent's default database timestamps
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the pets associated with this status
     *
     * @return HasMany
     */
    public function pets()
    {
        return $this->hasMany(Pet::class, 'status_id');
    }
}
