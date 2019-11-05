<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    // Table name
    protected $table = 'people';
    // Primary key
    public $primaryKey = 'id';
    // Append these accessors to query results
    protected $appends = ['full_name', 'full_name_with_address'];
    
    public $guarded = [];
    public $timestamps = false;
    
    public function adoptedAnimals() {
        return $this->belongsToMany(Animal::class, 'animal_adoptions');
    }

    public function fosteredAnimals() {
        return $this->belongsToMany(Animal::class, 'animal_fosters');
    }

    public function reclaimedAnimals() {
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

    public function broughtInAnimals() {
        return $this->hasMany(Animal::class, 'bring_in_person_id');
    }

    public function getFullNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullNameWithAddressAttribute() {
        return $this->first_name . ' ' . $this->last_name . ' | ' . $this->address;
    }
}
