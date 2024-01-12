<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'state_id',
        'country_id',
   
    ];

    public function country()
    {
        return $this->belongsTo(Country::class );
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
