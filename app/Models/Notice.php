<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the order_request that owns the Notice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_request()
    {
        return $this->belongsTo(OrderRequest::class, 'order_request_id', 'id');
    }
}
