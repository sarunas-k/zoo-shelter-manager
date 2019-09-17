<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IAnimalsRepository;
use App\Repositories\Interfaces\IAdoptionsRepository;
use App\Repositories\Interfaces\IReclaimsRepository;
use App\Repositories\Interfaces\IFostersRepository;

class ReportsController extends Controller
{

    public function __construct(IAnimalsRepository $animalsRepo,
                                IAdoptionsRepository $adoptionsRepo,
                                IReclaimsRepository $reclaimsRepo,
                                IFostersRepository $fostersRepo
                                )
    {
        $this->animalsRepo = $animalsRepo;
        $this->adoptionsRepo = $adoptionsRepo;
        $this->reclaimsRepo = $reclaimsRepo;
        $this->fostersRepo = $fostersRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports/index');
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
        return view('reports/show');
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

    public function getReportJSON(Request $request) {
        $reportId = $request->input('reportId');
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $resp = (object) [
            'reportId' => $reportId,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
        ];
        if ($reportId == '0') {
            $resp->animalsCount = $this->animalsRepo->all(true)->count();
            return response()->json($resp);
        } else if ($reportId == '1') {
            $resp->animalsCount = $this->animalsRepo->all()->where('intake_date', '>=', $dateFrom)->where('intake_date', '<', $dateTo)->count();
            return response()->json($resp);
        } else if ($reportId == '2') {
            $resp->adoptionsCount = $this->adoptionsRepo->all()->where('adoption_date', '>=', $dateFrom)->where('adoption_date', '<', $dateTo)->count();
            return response()->json($resp);
        } else if ($reportId == '3') {
            $resp->reclaimsCount = $this->reclaimsRepo->all()->where('date', '>=', $dateFrom)->where('date', '<', $dateTo)->count();
            return response()->json($resp);
        } else if ($reportId == '4') {
            $resp->fostersCount = $this->fostersRepo->all()->where('foster_start_date', '>=', $dateFrom)->where('foster_start_date', '<', $dateTo)->count();
            return response()->json($resp);
        } else if ($reportId == '5') {
            $resp->deceasedCount = $this->animalsRepo->all()->where('decease_date', '!=', null)->where('decease_date', '>=', $dateFrom)->where('decease_date', '<', $dateTo)->count();
            return response()->json($resp);
        }
        return response()->json($request->toArray());
    }
}
