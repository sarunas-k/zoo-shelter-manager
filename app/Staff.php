<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // Table name
    protected $table = 'staff';
    // Primary key
    public $primaryKey = 'id';

    
    public function calls() {
        return $this->hasMany(Call::class);
    }

    public function animals() {
        return $this->hasMany(Animal::class);
    }

    public function procedures() {
        return $this->hasMany(Procedure::class);
    }
}
