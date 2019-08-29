<?php

namespace App\Repositories;

use App\Animal;
use App\Image;
use App\Repositories\Interfaces\IAnimalsRepository;

class AnimalsRepository implements IAnimalsRepository {

    public function all() {
        return Animal::all();
    }

    public function allFilteredAndPaginated($request, $perPage = 10) {
        $animals = Animal::latest();
        $this->applyFilters($animals, $request);
        return $animals->paginate($perPage);
    }

    public function getLatest($number = null) {
        $latestAnimals = Animal::latest();
        if (isset($number) && is_numeric($number)) {
            return $latestAnimals->take($number)->get();
        } 
        return $latestAnimals->get();
    }

    public function addFromInput($formFields) {
        $animal = Animal::create([
            'list_number' => $formFields['animal-number'],
            'gender' => $formFields['gender'],
            'birthdate' => $formFields['birthdate'],
            'name' => $formFields['name'],
            'chip_number' => $formFields['microchip'],
            'size' => $formFields['size'],
            'intake_date' => $formFields['intake-date'],
            'species_id' => $formFields['species'],
            'living_area_id' => $formFields['living-area'],
            'color_id' => $formFields['color'],
            'staff_id' => $formFields['staff'],
            'is_neutered' => $formFields['is-neutered']
        ]);

        // Attach Animal breeds to the Animal through animal_breed table
        $animal->breeds()->sync($formFields['breed']);

        // Upload images to server and save animal images paths to database
        if (isset($formFields['animal-image'])) {
            foreach($formFields['animal-image'] as $imageFile) {
                $fileNameWithExt = $imageFile->getClientOriginalName();
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $imageFile->guessClientExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $imageFile->storeAs('public/images', $fileNameToStore);
                $animal->images()->attach(Image::create(['path' => $path]));
            }
        } else {
            $animal->images()->attach(Image::create(['path' => 'public/images/no_image.jpeg']));
        }

        return $animal->id;
    }

    public function updateFromInput($animal, $formFields) {
        $animal->update([
            'list_number' => $formFields['animal-number'],
            'gender' => $formFields['gender'],
            'birthdate' => $formFields['birthdate'],
            'name' => $formFields['name'],
            'chip_number' => $formFields['microchip'],
            'size' => $formFields['size'],
            'intake_date' => str_replace('T', ' ', $formFields['intake-date']),
            'species_id' => $formFields['species'],
            'living_area_id' => $formFields['living-area'],
            'color_id' => $formFields['color'],
            'staff_id' => $formFields['staff'],
            'is_neutered' => $formFields['is-neutered'] ? 1 : 0
        ]);
        
        // Save animal breeds to animal_breed table
        $animal->breeds()->sync($formFields['breed']);

        if (!is_null($formFields['animal-images-list'])) {
            $animal->images()->sync(explode(',', $formFields['animal-images-list']));
        }

        // // Upload images to server and save animal images paths to database
        // if ($request->hasFile('animal-image')) {
        //     foreach($request->file('animal-image') as $imageFile) {
        //         $fileNameWithExt = $imageFile->getClientOriginalName();
        //         $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //         $extension = $imageFile->guessClientExtension();
        //         $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        //         $path = $imageFile->storeAs('public/images', $fileNameToStore);
        //         $image = new Image;
        //         $image->path = $path;
        //         $image->save();
        //         $animal->images()->attach($image);
        //     }
        // } else {
        //     $image = new Image;
        //     $image->path = 'public/images/no_image.jpeg';
        //     $image->save();
        //     $animal->images()->attach($image);
        // }
    }

    public function get($id) {
        $animal = Animal::find($id);
        if($animal !== null)
            $this->formatFieldsForPresentation($animal);

        return $animal;
    }

    public function delete($animal) {
        $animal->images()->detach();
        $animal->breeds()->detach();
        $animal->procedures()->detach();
        $animal->adopters()->detach();
        $animal->fosterers()->detach();
        $animal->reclaimers()->detach();
        $animal->delete();
    }

    public function deleteById($id) {
        $animal = Animal::findOrFail($id);
        $this->delete($animal);
    }

    public function formatFieldsForPresentation($animal) {
        // Convert date of birth to age
        $dateDiff = date_diff(date_create($animal->birthdate), date_create(date("Y-m-d")));
        $ageMonths =  $dateDiff->m + ($dateDiff->y * 12);
        if($ageMonths < 1) {
            $animal->age = $dateDiff->format('%a day(-s)');
        } elseif($ageMonths > 1 && $ageMonths < 3) {
            $animal->age = $dateDiff->format('%m month(-s) and %d day(-s)');
        } elseif($ageMonths > 3 && $ageMonths < 12) {
            $animal->age = $dateDiff->format('%m month(-s)');
        } else {
            $animal->age = $dateDiff->format('%y year(-s) and %m month(-s)');
        }  

        // Check if animal quarantine period has passed
        $daysInShelter = date_diff(date_create($animal->intake_date), date_create(date("Y-m-d")))->format('%a');
        $animal->is_adoptable = $daysInShelter > 14; //TODO: store this value somewhere in configuration file

        // Check if animal is in foster care
        $animal->in_foster = $animal->fosters()->whereNull('foster_end_date')->count() > 0;

        $animal->breeds_concatenated = '';
        foreach($animal->breeds as $key => $breed) {
            $separator = $key == $animal->breeds->count()-1 ? '' : ' / ';
            $animal->breeds_concatenated .= $breed->name . $separator;
        } 

        return $animal;
    }

    private function applyFilters($animals, $request) {
        if (empty($request->gender) && empty($request->species) && empty($request->color))
            return;
            
        // Filter by gender
        if(!empty($request->gender))
            $animals->whereIn('gender', $request->gender);

        // Filter by species
        if(!empty($request->species)) {
            $animals->whereHas('Species', function($q) use($request){
                $q->whereIn('name', $request->species);
            });
        }

        // Filter by color
        if(!empty($request->color)) {
            $animals->whereHas('Color', function($q) use($request){
                $q->whereIn('name', $request->color);
            });
        }
    }
}
