<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IAnimalsRepository;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IAnimalsRepository $animalsRepo)
    {
        $this->middleware('auth');
        $this->animalsRepo = $animalsRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index')->with('latest_animals', $this->animalsRepo->getLatest(5));
    }
}
