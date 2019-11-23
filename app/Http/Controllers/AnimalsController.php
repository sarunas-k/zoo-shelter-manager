<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IAnimalsRepository;
use App\Repositories\Interfaces\ISpeciesRepository;
use App\Repositories\Interfaces\IColorsRepository;
use App\Repositories\Interfaces\IStaffRepository;
use App\Repositories\Interfaces\ILivingAreasRepository;
use App\Repositories\Interfaces\IIntakeTypesRepository;
use App\Repositories\Interfaces\ICallsRepository;
use App\Repositories\Interfaces\IPeopleRepository;
use App\Animal;

class AnimalsController extends Controller
{

    public function __construct(IAnimalsRepository $animalsRepo,
                                ISpeciesRepository $speciesRepo,
                                IColorsRepository $colorsRepo,
                                IStaffRepository $staffRepo,
                                ILivingAreasRepository $areasRepo,
                                IIntakeTypesRepository $intakeTypesRepo,
                                ICallsRepository $callsRepo,
                                IPeopleRepository $peopleRepo
                                )
    {
        $this->animalsRepo = $animalsRepo;
        $this->speciesRepo = $speciesRepo;
        $this->colorsRepo = $colorsRepo;
        $this->staffRepo = $staffRepo;
        $this->areasRepo = $areasRepo;
        $this->intakeTypesRepo = $intakeTypesRepo;
        $this->callsRepo = $callsRepo;
        $this->peopleRepo = $peopleRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * AJAX request
         * @return Array of animals and pagination links
         *        Optional parameters: 
         *                  appendFilters - if true, append lists of all available species, colors, sizes and genders
         *                                  to initialize ListFilter component.
         *                  nonShelter    - if true, only get animals which are already adopted or reclaimed.
        */
         if ($request->ajax()) {
            $appendFilters = $request->appendFilters;
            unset($request['appendFilters']);
            
            if ($request->nonShelter)
                $response = $this->animalsRepo->allFilteredAndPaginated($request, false, 10, true)->toArray();
            else
                $response = $this->animalsRepo->allFilteredAndPaginated($request)->toArray();

            if ($appendFilters) {
                $speciesNames = $this->speciesRepo->getSpeciesNames();
                $colorsNames = $this->colorsRepo->getColorsNames();
                sort($speciesNames);
                sort($colorsNames);

                $response['filters'] = [
                    'species' => $speciesNames,
                    'gender' => $this->animalsRepo->getGenderNames(),
                    'size' => $this->animalsRepo->getSizeNames(),
                    'color' => $colorsNames ];
            }

            return response()->json($response);

        } else {
        /**
         * WEB request
         * @return View of animals index page
        */
            return view('animals/index')->with('title', $request->only_adopted_reclaimed ? 'Animals off shelter' : 'Animals');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('animals/create')->with([
            'species' => $this->speciesRepo->allWithBreeds(),
            'colors' => $this->colorsRepo->all(),
            'staff' => $this->staffRepo->all(),
            'livingAreas' => $this->areasRepo->all(),
            'sizes' => $this->animalsRepo->getSizeNames(),
            'genders' => $this->animalsRepo->getGenderNames(),
            'intakeTypes' => $this->intakeTypesRepo->all(),
            'calls' => $this->callsRepo->all(),
            'people' => $this->peopleRepo->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['is-neutered'] == 'on')
            $request['is-neutered'] = '1';

        $formFields = $this->validate($request, [
            'animal-number' => 'required',
            'species' => 'required',
            'gender' => 'required',
            'name' => 'required',
            'birthdate' => 'date|nullable',
            'microchip' => 'required',
            'size' => 'required',
            'intake-date' => 'required',
            'color' => 'required',
            'living-area' => 'required',
            'animal-image' => 'max:1999|array',
            'animal-image.*' => 'mimes:jpeg,jpg,bmp,png',
            'breed' => 'required',
            'staff' => 'required',
            'is-neutered' => 'required|boolean',
            'intake-type' => 'required',
            'call' => '',
            'bring-in-person' => '',
            'age-digit' => 'digits_between:1,100|nullable',
            'age-unit' => ''
        ]);

        $animalId = $this->animalsRepo->addFromInput($formFields);

        return redirect('/animals/' . $animalId)->with('success', 'Animal was added');
    }

    /**
     * Display the specified resource.
     *
     * @param  Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        return view('animals/show')->with('animal', $this->animalsRepo->formatFieldsForPresentation($animal));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        return view('animals/edit')->with([
            'animal' => $this->animalsRepo->formatFieldsForPresentation($animal),
            'species' => $this->speciesRepo->all(),
            'colors' => $this->colorsRepo->all(),
            'staff' => $this->staffRepo->all(),
            'livingAreas' => $this->areasRepo->all(),
            'intakeTypes' => $this->intakeTypesRepo->all(),
            'calls' => $this->callsRepo->all(),
            'people' => $this->peopleRepo->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        if ($request['is-neutered'] == 'on')
            $request['is-neutered'] = '1';

        $formFields = $this->validate($request, [
            'animal-number' => 'required',
            'species' => 'required',
            'gender' => 'required',
            'name' => 'required',
            'birthdate' => 'date|nullable',
            'microchip' => 'required',
            'size' => 'required',
            'intake-date' => 'required',
            'color' => 'required',
            'living-area' => 'required',
            'staff' => 'required',
            'breed' => 'required',
            'is-neutered' => 'required|boolean',
            'animal-images-list' => '',
            'intake-type' => 'required',
            'call' => '',
            'bring-in-person' => '',
            'animal-image' => 'max:1999|array',
            'animal-image.*' => 'mimes:jpeg,jpg,bmp,png',
            'age-digit' => 'digits_between:1,100|nullable',
            'age-unit' => ''
        ]);

        $this->animalsRepo->updateFromInput($animal, $formFields);
        return redirect('/animals/' . $animal->id)->with('success', 'Animal edit successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $this->animalsRepo->delete($animal);
        return redirect('/animals')->with('success', 'Animal delete successful');
    }
}
