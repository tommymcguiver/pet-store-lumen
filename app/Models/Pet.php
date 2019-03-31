<?php

namespace App\Models;

use App\Models\{Tag, Order, PetCategory, PetStatus};

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Pet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the order that this pet is associated with
     *
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the category that this pet belongs to
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(PetCategory::class);
    }

    /**
     * Get the status that this pet belongs to
     *
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(PetStatus::class);
    }

    /**
     * The tags that belong to the pet
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
