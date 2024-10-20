<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tour extends Model
{
    //


    protected $fillable=[
'travel_id',
'name',
'price',
'start_date',
'end_date',


        
    ];
    public function price(): Attribute
    {
return Attribute::make(
    get: fn ($value) =>$value/100,
    set: fn ($value) =>$value*100
);

        
    }
}