<?php

namespace App\Http\Controllers;

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
    public function create()
    {
        return view('reclaims/create')->with([
            'animals' => $this->animalsRepo->all(),
            'people' => $this->peopleRepo->all()
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
            return redirect()->action('ReclaimsController@create');
        
        return view('reclaims/create')->with([
            'animal' => $animal,
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
            'person' => 'required|numeric',
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
    public function show($id)
    {
        return view('reclaims/show')->with('reclaim', $this->reclaimsRepo->get($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('reclaims/edit')->with('reclaim', $this->reclaimsRepo->get($id));
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
        $this->reclaimsRepo->delete($id);
    }
}
