<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IAdoptionsRepository;
use App\Repositories\Interfaces\IAnimalsRepository;
use App\Repositories\Interfaces\IPeopleRepository;
use App\Adoption;
use App\Animal;

class AdoptionsController extends Controller
{

    public function __construct(IAdoptionsRepository $adoptionsRepo,
                                IAnimalsRepository $animalsRepo,
                                IPeopleRepository $peopleRepo)
    {
        $this->adoptionsRepo = $adoptionsRepo;
        $this->animalsRepo = $animalsRepo;
        $this->peopleRepo = $peopleRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adoptions/index')->with('adoptions', $this->adoptionsRepo->allPaginated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adoptions/create')->with([
            'animals' => $this->animalsRepo->all(),
            'people' => $this->peopleRepo->all()
        ]);
    }

    /**
     * Show the form for creating a new adoption for animal.
     *
     * @param Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function createWithAnimalID(Animal $animal)
    {
        return view('adoptions/create')->with([
            'animal' => $this->animalsRepo->formatFieldsForPresentation($animal),
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
        $formFields = $this->validate($request, [
            'animal' => 'required|numeric',
            'adoption-date' => 'required|date',
            'person' => 'required|numeric',
            'notes' => 'string|nullable'
        ]);

        $result = $this->adoptionsRepo->addFromInput($formFields);
        if ($result)
            return redirect('/adoptions/')->with('success', 'Adoption was added');
        else
            return redirect('/adoptions/')->with('error', 'Error creating new adoption');
    }

    /**
     * Display the specified resource.
     *
     * @param  Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function show(Adoption $adoption)
    {
        return view('adoptions/show')->with([
            'adoption' => $adoption,
            'animal' => $this->animalsRepo->formatFieldsForPresentation($adoption->animal)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function edit(Adoption $adoption)
    {
        return view('adoptions/edit')->with([
            'adoption' => $adoption,
            'animal' => $this->animalsRepo->formatFieldsForPresentation($adoption->animal)
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adoption $adoption)
    {
        $formFields = $this->validate($request, [
            'notes' => 'string|nullable',
            'return-date' => 'date|nullable'
        ]);

        $this->adoptionsRepo->updateFromInput($adoption, $formFields);

        return redirect('/adoptions/')->with('success', 'Adoption was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adoption $adoption)
    {
        $this->adoptionsRepo->delete($adoption);
        return redirect('/adoptions')->with('success', 'Adoption deleted successfully');
    }
}
