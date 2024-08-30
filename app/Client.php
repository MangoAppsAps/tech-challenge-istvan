<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'postcode',
    ];

    protected $appends = [
        'url',
    ];

    public function bookings()
    {
        // The challenge asked me to order the bookings in "chronological order (newest first)",
        // that's why I used the `latest()` method.
        // Maybe it was meant to be ordered by `start` column, that would be `orderBy('start')`.
        return $this->hasMany(Booking::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBookingsCountAttribute()
    {
        return $this->bookings->count();
    }

    public function getUrlAttribute()
    {
        return "/clients/" . $this->id;
    }
}
