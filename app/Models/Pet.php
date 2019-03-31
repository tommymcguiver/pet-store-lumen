<?php

namespace App\Models;

use App\Models\{Tag, Image, Order, PetCategory};

use Illuminate\Support\Facades\DB;
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
    protected $fillable = ['name', 'status'];

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
     * The tags that belong to the pet
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the images that belong to this pet
     *
     * @return HasMAny
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Scope the pets by status
     *
     * @param Builder $query
     * @param array $status
     * @return Builder
     */
    public function scopeByStatus($query, array $status)
    {
        return $query->whereIn('status', $status);
    }

    /**
     * Count by status
     *
     */
    public function scopeInventory($query)
    {
        return $query->select(DB::raw('status, count(*) as quantity'))
                     ->groupBy('status');
    }
}
