<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ICallsRepository;
use App\Repositories\Interfaces\IStaffRepository;
use App\Call;

class CallsController extends Controller
{

    public function __construct(ICallsRepository $callsRepo, IStaffRepository $staffRepo)
    {
        $this->callsRepo = $callsRepo;
        $this->staffRepo = $staffRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calls/index')->with('calls', $this->callsRepo->allPaginated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calls/create')->with(['staff' => $this->staffRepo->all()]);
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
            'call-date' => 'required',
            'caller-name' => 'required',
            'caller-phone' => 'required',
            'address' => 'required',
            'details' => 'required',
            'staff' => 'required',
        ]);
        $this->callsRepo->addFromInput($formFields);

        return redirect('/calls')->with('success', 'Call was added');
    }

    /**
     * Display the specified resource.
     *
     * @param  Call  $call
     * @return \Illuminate\Http\Response
     */

    public function show(Call $call)
    {
        return view('calls/show')->with([
            'call' => $this->callsRepo->formatFieldsForPresentation($call),
            'staff' => $this->staffRepo->all()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Call  $call
     * @return \Illuminate\Http\Response
     */
    public function edit(Call $call)
    {
        return view('calls/edit')->with([
            'call' => $this->callsRepo->formatFieldsForPresentation($call),
            'staff' => $this->staffRepo->all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Call  $call
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Call $call)
    {
        $formFields = $this->validate($request, [
            'call-date' => 'required',
            'caller-name' => 'required',
            'caller-phone' => 'required',
            'address' => 'required',
            'details' => 'required',
            'staff' => 'required',
            'status' => 'required',
        ]);

        $this->callsRepo->updateFromInput($call, $formFields);

        return redirect('/calls')->with('success', 'Call was edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Call  $call
     * @return \Illuminate\Http\Response
     */
    public function destroy(Call $call)
    {
        $this->callsRepo->delete($call);
        return redirect('/calls')->with('success', 'Call delete successful');
    }
}
