<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'email'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function UserEvent()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }



    
}
