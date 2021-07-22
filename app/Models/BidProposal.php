<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidProposal extends Model
{
    use HasFactory;
    // Table
    protected $table = 'bid_proposals';
    // Primary Key
    protected $primaryKey = 'id';
    // created_at and updated_at
    public $timestamps = true;

    protected $guarded = [];





    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notice()
    {
        return $this->belongsTo(Notice::class, 'notice_id', 'id');
    }
}
