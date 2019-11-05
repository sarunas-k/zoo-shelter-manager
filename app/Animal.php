<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    // Table name
    protected $table = 'animals';
    // Primary key
    public $primaryKey = 'id';
    protected $guarded = [];
    protected $appends = ['age'];

    public function species() {
        return $this->belongsTo(Species::class);
    }

    public function living_area() {
        return $this->belongsTo(LivingArea::class);
    }

    public function color() {
        return $this->belongsTo(Color::class);
    }

    public function call() {
        return $this->belongsTo(Call::class);
    }

    public function images() {
        return $this->belongsToMany(Image::class);
    }

    public function breeds() {
        return $this->belongsToMany(Breed::class);
    }

    public function staff() {
        return $this->belongsTo(Staff::class);
    }

    public function procedures() {
        return $this->hasMany(Procedure::class);
    }

    public function adopters() {
        return $this->belongsToMany(Person::class, 'animal_adoptions')->withPivot('adoption_date', 'return_date', 'notes');
    }

    public function adoptions() {
        return $this->hasMany(Adoption::class);
    }

    public function activeAdoptions() {
        return $this->adoptions()->whereNull('return_date');
    }

    public function activeFosters() {
        return $this->fosters()->whereNull('foster_end_date');
    }

    public function activeReclaims() {
        return $this->reclaims()->whereNull('return_date');
    }

    public function notInShelter() {
        return $this->activeAdoptions()->count() > 0 ||
                $this->activeFosters()->count() > 0 ||
                $this->activeReclaims()->count() > 0;
    }

    public function fosterers() {
        return $this->belongsToMany(Person::class, 'animal_fosters')->withPivot('foster_start_date', 'foster_end_date', 'notes');
    }

    public function fosters() {
        return $this->hasMany(Foster::class);
    }

    public function reclaimers() {
        return $this->belongsToMany(Person::class, 'animal_reclaims')->withPivot('date', 'return_date', 'notes');
    }

    public function reclaims() {
        return $this->hasMany(Reclaim::class);
    }

    public function intakeType() {
        return $this->belongsTo(IntakeType::class);
    }

    public function bringInPerson() {
        return $this->belongsTo(Person::class);
    }

    public function getAgeAttribute() {
        $dateDiff = date_diff(date_create($this->birthdate), date_create(date("Y-m-d")));
        $ageMonths =  $dateDiff->m + ($dateDiff->y * 12);
        $age = '';
        // if($ageMonths < 1) {
        //     $age = $dateDiff->format('%a day(-s)');
        // } elseif($ageMonths >= 1 && $ageMonths < 3) {
        //     $age = $dateDiff->format('%m month(-s) and %d day(-s)');
        // } elseif($ageMonths > 3 && $ageMonths < 12) {
        //     $age = $dateDiff->format('%m month(-s)');
        // } else {
        //     $age = $dateDiff->format('%y year(-s) and %m month(-s)');
        // }
        if ($dateDiff->y == 1) {
            $age = '1 year';
        } else if ($dateDiff->y > 1) {
            $age = $dateDiff->format('%y years');
        } else if ($dateDiff->y == 0) {
            if ($dateDiff->m < 1) {
                if ($dateDiff->d == 1)
                    $age = '1 day';
                else
                    $age = $dateDiff->format('%a days');
            } else if ($dateDiff->m == 1) {
                $age = '1 month';
            } else {
                $age = $dateDiff->format('%m months');
            }  
        }

        return $age;
    }
}
