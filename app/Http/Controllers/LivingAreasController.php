<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ILivingAreasRepository;

class LivingAreasController extends Controller
{

    public function __construct(ILivingAreasRepository $areasRepo)
    {
        $this->areasRepo = $areasRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('living-areas/index')->with('living_areas', $this->areasRepo->allPaginated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('living-areas/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate new living area form
        $this->validate($request, [
            'area-name' => 'required',
        ]);

        $this->areasRepo->addFromInput($request);
        
        // Redirect to living areas list
        return redirect('/living-areas/')->with('success', 'Living area was added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('living-areas/show')->with('livingArea', $this->areasRepo->get($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('living-areas/edit')->with('livingArea', $this->areasRepo->get($id));
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
        $formFields = $this->validate($request, [
            'area-name' => 'required',
        ]);

        $this->areasRepo->updateFromInput($id, $formFields);

        return redirect('/living-areas')->with('success', 'Living area was edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->areasRepo->delete($id);
        return redirect('/living-areas')->with('success', 'Living area deleted successfully');
    }
}
