<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonatePool extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'amount',
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Event model
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
