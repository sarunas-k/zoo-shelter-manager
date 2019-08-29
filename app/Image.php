<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Table name
    protected $table = 'images';
    // Primary key
    public $primaryKey = 'id';
    public $timestamps = false;

    protected $guarded = [];

    
    public function animals() {
        return $this->belongsToMany(Animal::class);
    }
}
