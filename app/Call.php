<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    // Table name
    protected $table = 'calls';
    // Primary key
    public $primaryKey = 'id';

    protected $guarded = [];

    
    public function animals() {
        return $this->hasMany(Animal::class);
    }

    public function staff() {
        return $this->belongsTo(Staff::class);
    }
}
