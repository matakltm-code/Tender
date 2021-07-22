<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }

    public function order_request()
    {
        return $this->belongsTo(OrderRequest::class, 'order_request_id', 'id');
    }

    /**
     * Get the user that owns the Notice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function proposal()
    // {
    //     return $this->belongsTo(BidProposal::class, 'id', 'notice_id');
    // }

    public function proposals()
    {
        return $this->hasMany(BidProposal::class, 'notice_id', 'id');
    }
}
