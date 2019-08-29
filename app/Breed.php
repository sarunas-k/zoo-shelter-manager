<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    // Table name
    protected $table = 'breeds';
    // Primary key
    public $primaryKey = 'id';

    
    public function animals() {
        return $this->belongsToMany(Animal::class);
    }

    public function species() {
        return $this->belongsTo(Species::class);
    }
}
