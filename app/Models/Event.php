<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'date', 'location'];

    // Relationship with invitations
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function donate()
    {
        return $this->hasOne(Donate::class);
    }
}
