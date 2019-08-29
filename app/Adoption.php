<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    // Table name
    protected $table = 'animal_adoptions';
    // Primary key
    public $primaryKey = 'id';

    public function animal() {
        return $this->belongsTo(Animal::class);
    }

    public function person() {
        return $this->belongsTo(Person::class);
    }
}
