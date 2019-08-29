<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    // Table name
    protected $table = 'colors';
    // Primary key
    public $primaryKey = 'id';

    
    public function animals() {
        return $this->hasMany(Animal::class);
    }
}
