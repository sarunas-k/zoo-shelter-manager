<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foster extends Model
{
    // Table name
    protected $table = 'animal_fosters';
    // Primary key
    public $primaryKey = 'id';

    public function animal() {
        return $this->belongsTo(Animal::class);
    }

    public function person() {
        return $this->belongsTo(Person::class);
    }
}
