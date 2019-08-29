<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IPeopleRepository;
use App\Repositories\Interfaces\IAdoptionsRepository;
use App\Repositories\Interfaces\IFostersRepository;
use App\Repositories\Interfaces\IReclaimsRepository;

class PeopleController extends Controller
{
    public function __construct(IPeopleRepository $peopleRepo,
                                IAdoptionsRepository $adoptionsRepo,
                                IFostersRepository $fostersRepo,
                                IReclaimsRepository $reclaimsRepo
                                )
    {
        $this->peopleRepo = $peopleRepo;
        $this->adoptionsRepo = $adoptionsRepo;
        $this->fostersRepo = $fostersRepo;
        $this->reclaimsRepo = $reclaimsRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('people/index')->with('people', $this->peopleRepo->allPaginated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('people/show')->with([
            'person' => $this->peopleRepo->get($id),
            'person_adoptions' => $this->adoptionsRepo->getByPerson($id),
            'person_fosters' => $this->fostersRepo->getByPerson($id),
            'person_reclaims' => $this->reclaimsRepo->getByPerson($id)
        ]);
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
        //
    }
}
