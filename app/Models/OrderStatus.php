<?php

namespace App\Models;

use App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_statuses';

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
     * Get the orders associated with this status
     *
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'status_id');
    }
}
