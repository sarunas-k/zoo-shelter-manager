<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    // Table name
    protected $table = 'people';
    // Primary key
    public $primaryKey = 'id';
    
    public $guarded = [];
    public $timestamps = false;

    
    public function adopted_animals() {
        return $this->belongsToMany(Animal::class, 'animal_adoptions');
    }

    public function fostered_animals() {
        return $this->belongsToMany(Animal::class, 'animal_fosters');
    }

    public function reclaimed_animals() {
        return $this->belongsToMany(Animal::class, 'animal_reclaims');
    }

    public function adoptions() {
        return $this->hasMany(Adoption::class);
    }

    public function fosters() {
        return $this->hasMany(Foster::class);
    }

    public function reclaims() {
        return $this->hasMany(Reclaim::class);
    }
}
