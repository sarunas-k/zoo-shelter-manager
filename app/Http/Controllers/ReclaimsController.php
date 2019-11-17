<?php

namespace App\Http\Controllers;

use App\Reclaim;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IReclaimsRepository;
use App\Repositories\Interfaces\IAnimalsRepository;
use App\Repositories\Interfaces\IPeopleRepository;

class ReclaimsController extends Controller
{

    public function __construct(IReclaimsRepository $reclaimsRepo,
                                IAnimalsRepository $animalsRepo,
                                IPeopleRepository $peopleRepo)
    {
        $this->reclaimsRepo = $reclaimsRepo;
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
        return view('reclaims/index')->with('reclaims', $this->reclaimsRepo->allPaginated());
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
                return redirect()->action('ReclaimsController@create');
            
            return view('reclaims/create')->with([
                'animal' => $animal,
                'people' => $this->peopleRepo->all()
            ]);
        }
        return view('reclaims/create')->with([
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
        // Validate new animal_reclaims form fields
        $this->validate($request, [
            'animal' => 'required|numeric',
            'date' => 'required|date',
            'person' => 'required|numeric'
        ]);

        $result = $this->reclaimsRepo->addFromInput($request);
        if ($result)
            return redirect('/reclaims/')->with('success', 'Reclaim was added');
        else
            return redirect('/reclaims/')->with('error', 'Error creating new reclaim');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reclaim $reclaim)
    {
        return view('reclaims/show')->with([
            'reclaim' => $reclaim,
            'animal' => $this->animalsRepo->formatFieldsForPresentation($reclaim->animal)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reclaim $reclaim)
    {
        return view('reclaims/edit')->with([
            'reclaim' => $reclaim,
            'animal' => $this->animalsRepo->formatFieldsForPresentation($reclaim->animal)  
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reclaim $reclaim)
    {
        $formFields = $this->validate($request, [
            'notes' => 'string|nullable',
            'return-date' => 'date|nullable'
        ]);

        $this->reclaimsRepo->updateFromInput($reclaim, $formFields);

        return redirect('/reclaims/')->with('success', 'Reclaim was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->reclaimsRepo->delete($id);
        return redirect('/reclaims')->with('success', 'Reclaim deleted successfully');
    }
}
