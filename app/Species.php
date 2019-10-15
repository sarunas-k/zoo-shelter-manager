<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    // Table name
    protected $table = 'species';
    // Primary key
    public $primaryKey = 'id';
    public $guarded = [];

    
    public function animals() {
        return $this->hasMany(Animal::class);
    }

    public function breeds() {
        return $this->hasMany(Breed::class);
    }
}
