<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IAdoptionsRepository;
use App\Repositories\Interfaces\IAnimalsRepository;
use App\Repositories\Interfaces\IPeopleRepository;

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
     * Show the form for creating a new resource from animal id.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithAnimalID($id)
    {
        return view('adoptions/create')->with([
            'animal' => $this->animalsRepo->get($id),
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
        $this->validate($request, [
            'animal' => 'required|numeric',
            'adoption-date' => 'required|date',
            'person' => 'required|numeric',
        ]);

        $result = $this->adoptionsRepo->addFromInput($request);
        if ($result)
            return redirect('/adoptions/')->with('success', 'Adoption was added');
        else
            return redirect('/adoptions/')->with('error', 'Error creating new adoption');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('adoptions/show')->with('adoption', $this->adoptionsRepo->get($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('adoptions/edit')->with('adoption', $this->adoptionsRepo->get($id));
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
        //
    }
}
