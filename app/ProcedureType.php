<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureType extends Model
{
    // Table name
    protected $table = 'procedure_types';
    // Primary key
    public $primaryKey = 'id';

    public function procedures() {
        return $this->hasMany(Procedure::class);
    }
}
