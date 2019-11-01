<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntakeType extends Model
{
    // Table name
    protected $table = 'intake_types';
    // Primary key
    public $primaryKey = 'id';
    public $guarded = [];

    public function animals() {
        return $this->hasMany(Animal::class);
    }
}
