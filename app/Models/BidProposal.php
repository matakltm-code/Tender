<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidProposal extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user that owns the BidProposal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the notice that owns the BidProposal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function notice()
    {
        return $this->belongsTo(User::class);
    }
}
