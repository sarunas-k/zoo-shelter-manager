<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // Table name
    protected $table = 'staff';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
    // Append these accessors to query results
    protected $appends = ['name'];

    
    public function calls() {
        return $this->hasMany(Call::class);
    }

    public function animals() {
        return $this->hasMany(Animal::class);
    }

    public function procedures() {
        return $this->hasMany(Procedure::class, 'vet_id');
    }

    public function getNameAttribute() {
        return $this->first_name . ' ' . $this->last_name;
    }
}
