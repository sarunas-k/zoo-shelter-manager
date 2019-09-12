<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    // Table name
    protected $table = 'animals';
    // Primary key
    public $primaryKey = 'id';
    protected $guarded = [];

    public function species() {
        return $this->belongsTo(Species::class);
    }

    public function living_area() {
        return $this->belongsTo(LivingArea::class);
    }

    public function color() {
        return $this->belongsTo(Color::class);
    }

    public function call() {
        return $this->belongsTo(Call::class);
    }

    public function images() {
        return $this->belongsToMany(Image::class);
    }

    public function breeds() {
        return $this->belongsToMany(Breed::class);
    }

    public function staff() {
        return $this->belongsTo(Staff::class);
    }

    public function procedures() {
        return $this->hasMany(Procedure::class);
    }

    public function adopters() {
        return $this->belongsToMany(Person::class, 'animal_adoptions')->withPivot('adoption_date', 'return_date', 'notes');
    }

    public function adoptions() {
        return $this->hasMany(Adoption::class);
    }

    public function fosterers() {
        return $this->belongsToMany(Person::class, 'animal_fosters')->withPivot('foster_start_date', 'foster_end_date', 'notes');
    }

    public function fosters() {
        return $this->hasMany(Foster::class);
    }

    public function reclaimers() {
        return $this->belongsToMany(Person::class, 'animal_reclaims')->withPivot('date');
    }

    public function reclaims() {
        return $this->hasMany(Reclaim::class);
    }
}