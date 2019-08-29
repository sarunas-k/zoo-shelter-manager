<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    // Table name
    protected $table = 'procedures';
    // Primary key
    public $primaryKey = 'id';
    public $timestamps = false;

    
    public function animal() {
        return $this->belongsTo(Animal::class);
    }

    public function vet() {
        return $this->belongsTo(Staff::class);
    }

    public function type() {
        return $this->belongsTo(ProcedureType::class, 'procedure_type_id');
    }
}
