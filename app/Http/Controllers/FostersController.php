<?php

namespace App\Http\Controllers;

use App\Foster;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IFostersRepository;
use App\Repositories\Interfaces\IAnimalsRepository;
use App\Repositories\Interfaces\IPeopleRepository;

class FostersController extends Controller
{

    public function __construct(IFostersRepository $fostersRepo, IAnimalsRepository $animalsRepo, IPeopleRepository $peopleRepo)
    {
        $this->fostersRepo = $fostersRepo;
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
        return view('fosters/index')->with('fosters', $this->fostersRepo->allPaginated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->animal_id) {
            $animal = $this->animalsRepo->get($request->animal_id);
            if ($animal == null)
                return redirect()->action('FostersController@create');
            
            return view('fosters/create')->with([
                'animal' => $animal,
                'people' => $this->peopleRepo->all()
            ]);
        }
        return view('fosters/create')->with([
            'animals' => $this->animalsRepo->all(),
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
        // Validate new animal_fosters form fields
        $this->validate($request, [
            'animal' => 'required|numeric',
            'start-date' => 'required|date',
            'person' => 'required|numeric',
        ]);

        $result = $this->fostersRepo->addFromInput($request);
        if ($result)
            return redirect('/fosters/')->with('success', 'Foster was added');
        else
            return redirect('/fosters/')->with('error', 'Error creating new foster');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Foster $foster)
    {
        return view('fosters/show')->with([
            'foster' => $foster,
            'animal' => $this->animalsRepo->formatFieldsForPresentation($foster->animal)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Foster $foster)
    {
        return view('fosters/edit')->with([
            'foster' => $foster,
            'animal' => $this->animalsRepo->formatFieldsForPresentation($foster->animal)
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foster $foster)
    {
        $formFields = $this->validate($request, [
            'notes' => 'string|nullable',
            'end-date' => 'date|nullable'
        ]);

        $this->fostersRepo->updateFromInput($foster, $formFields);

        return redirect('/fosters/')->with('success', 'Foster was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
