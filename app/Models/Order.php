<?php

namespace App\Models;

use App\Models\{Pet, OrderStatus};

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
    protected $fillable = ['pet_id', 'quantity', 'ship_date', 'complete', 'status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'integer',
        'complete' => 'boolean'
    ];

    /**
     * Get the pet associated with this order
     *
     * @return BelongsTo
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
