<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reclaim extends Model
{
    // Table name
    protected $table = 'animal_reclaims';
    // Primary key
    public $primaryKey = 'id';

    public function animal() {
        return $this->belongsTo(Animal::class);
    }

    public function person() {
        return $this->belongsTo(Person::class);
    }
}
