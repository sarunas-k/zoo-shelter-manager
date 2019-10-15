<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IAnimalsRepository;
use App\Repositories\Interfaces\ISpeciesRepository;
use App\Repositories\Interfaces\IColorsRepository;
use App\Repositories\Interfaces\IStaffRepository;
use App\Repositories\Interfaces\ILivingAreasRepository;
use App\Animal;

class AnimalsController extends Controller
{

    public function __construct(IAnimalsRepository $animalsRepo,
                                ISpeciesRepository $speciesRepo,
                                IColorsRepository $colorsRepo,
                                IStaffRepository $staffRepo,
                                ILivingAreasRepository $areasRepo)
    {
        $this->animalsRepo = $animalsRepo;
        $this->speciesRepo = $speciesRepo;
        $this->colorsRepo = $colorsRepo;
        $this->staffRepo = $staffRepo;
        $this->areasRepo = $areasRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('animals/index')->with('animals', $this->animalsRepo->allFilteredAndPaginated($request));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('animals/create')->with([
            'species' => $this->speciesRepo->all()->sortBy('id'),
            'colors' => $this->colorsRepo->all(),
            'staff' => $this->staffRepo->all(),
            'livingAreas' => $this->areasRepo->all()
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
            'birthdate' => 'required|date',
            'microchip' => 'required',
            'size' => 'required',
            'intake-date' => 'required',
            'color' => 'required',
            'living-area' => 'required',
            'animal-image' => 'max:1999|array',
            'animal-image.*' => 'mimes:jpeg,jpg,bmp,png',
            'breed' => 'required',
            'staff' => 'required',
            'is-neutered' => 'required|boolean'
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
            'livingAreas' => $this->areasRepo->all()
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
            'birthdate' => 'required|date',
            'microchip' => 'required',
            'size' => 'required',
            'intake-date' => 'required',
            'color' => 'required',
            'living-area' => 'required',
            'staff' => 'required',
            'breed' => 'required',
            'is-neutered' => 'required|boolean',
            'animal-images-list' => ''
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

    public function getAnimalsJSON(Request $request) {
        $appendFilters = $request->appendFilters;
        // appendFilters parameter is only used in first request to get data to initialize ListFilter component
        // Unset appendFilters so that Paginator doesnt use this parameter in pagination links
        unset($request['appendFilters']);
        $response = $this->animalsRepo->allFilteredAndPaginated($request)->toArray();
        if ($appendFilters)
            $response['filters'] = $this->getAnimalsFilters();
        return response()->json($response);
    }
    
    public function getAnimalsFilters() {
        return [
            'species' => $this->speciesRepo->getSpeciesNames(),
            'gender' => ['Male', 'Female'],
            'size' => ['Small', 'Medium', 'Large', 'Very large'],
            'color' => $this->colorsRepo->getColorsNames()
        ];
    }
}
