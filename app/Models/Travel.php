<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travel extends Model
{
    use HasFactory;
    protected $table = 'travels';
    //
    protected $fillable = ['name', 'slug', 'description', 'number_of_days', 'is_public'];


public function tours(): HasMany
{
return $this->hasMany(Tour::class);
    
}

    
    protected function numberOfNights(): Attribute
    {
        return new Attribute(
            get: fn () => $this->number_of_days - 1
        );
    }
}