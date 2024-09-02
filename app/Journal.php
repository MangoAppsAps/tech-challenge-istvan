<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
        'date',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
