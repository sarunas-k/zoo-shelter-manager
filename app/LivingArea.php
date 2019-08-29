<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LivingArea extends Model
{
    // Table name
    protected $table = 'living_areas';
    // Primary key
    public $primaryKey = 'id';
    
    public $timestamps = false;

    
    public function animals() {
        return $this->hasMany(Animal::class);
    }
}
