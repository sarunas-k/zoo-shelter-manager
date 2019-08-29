<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IProceduresRepository;
use App\Repositories\Interfaces\IAnimalsRepository;
use App\Repositories\Interfaces\IStaffRepository;
use App\Repositories\Interfaces\IProcedureTypesRepository;

class ProceduresController extends Controller
{

    public function __construct(IProceduresRepository $proceduresRepo,
                                IAnimalsRepository $animalsRepo,
                                IStaffRepository $staffRepo,
                                IProcedureTypesRepository $procedureTypesRepo)
    {
        $this->proceduresRepo = $proceduresRepo;
        $this->animalsRepo = $animalsRepo;
        $this->staffRepo = $staffRepo;
        $this->procedureTypesRepo = $procedureTypesRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('procedures/create')->with([
            'animals' => $this->animalsRepo->all(),
            'vets' => $this->staffRepo->allVets(),
            'procedureTypes' => $this->procedureTypesRepo->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithAnimalID($id)
    {
        $animal = $this->animalsRepo->get($id);
        if ($animal == null)
            return redirect()->action('ProceduresController@create');

        return view('procedures/create')->with([
            'animal' => $animal,
            'vets' => $this->staffRepo->allVets(),
            'procedureTypes' => $this->procedureTypesRepo->all()
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
        // Validate new animal_procedure form fields
        $this->validate($request, [
            'animal' => 'required',
            'procedure-type' => 'required',
            'procedure-date' => 'required|date',
            'vet' => 'required',
            'notes' => 'required',
        ]);

        $result = $this->proceduresRepo->addFromInput($request);
        if ($result)
            return redirect('/animals/' . $this->animalsRepo->get($request->input('animal'))->id)->with('success', 'Procedure was added');
        else
            return redirect('/animals/')->with('error', 'Error adding new procedure');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->proceduresRepo->delete($id);
    }
}
