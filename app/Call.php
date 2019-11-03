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
    protected $appends = ['name'];

    
    public function animals() {
        return $this->hasMany(Animal::class);
    }

    public function staff() {
        return $this->belongsTo(Staff::class);
    }

    public function getNameAttribute() {
        return substr($this->date_time, 0, 16) . ' | ' . substr($this->address, 0, 20); 
    }
}
