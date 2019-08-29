<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // SEARCH ANIMALS BY:
        // * Registration Number
        // * Name
        // * Date of Birth - REMOVED: Database error using LIKE operation on data type DATETIME with lithuanian characters:
        //                            "Illegal mix of collations for operation 'like'"
        //                   TODO: fix it.
        // * Microchip Number

        // Get all animal records from database and sort by date
        $results = Animal::latest();
        if(!empty($request->q)){
            // Define animal table column names that will be searched
            $searchColumns = ['list_number', 'name', 'chip_number'];
            // Go through each record and select only those
            // where search text matched with data in columns.
            $results->where(function($query) use($request, $searchColumns){
                foreach($searchColumns as $column){
                  $query->orWhere($column, 'LIKE', '%' . $request->q . '%');
                }
              });
        }

        // Open search result page and attach results data
        return view('search/index')->with('animals_results', $results->paginate(10));
    }
}
