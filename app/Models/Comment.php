<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['message','user_id','listing_id'];

    
    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Relationship To User
    public function listing() {
        return $this->belongsTo(Listing::class, 'listing_id');
    }


}
