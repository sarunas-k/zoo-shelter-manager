<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IStaffRepository;
use App\Staff;

class StaffController extends Controller
{
    public function __construct(IStaffRepository $staffRepo) {
        $this->staffRepo = $staffRepo;
    }

    public function create() {
        return view('staff/create')->with('title', 'New Staff');
    }

    public function store(Request $request) {
        $formFields = $this->validate($request, [
            'first-name' => 'required|string',
            'last-name' => 'required|string',
            'phone' => '',
            'is-vet' => 'required'
        ]);

        $this->staffRepo->addFromInput($formFields);

        return redirect('/settings')->with('success', 'Staff member was created');
    }

    public function update(Request $request, $id) {
        /**
         * AJAX Request
         */
        if ($request->ajax()) {
            $formFields = $this->validate($request, [
                'phone' => '',
                'is_vet' => ''
            ]);
            $this->staffRepo->updateFromInput($id, $formFields);
            return response()->json(['status' => 'success']);
        }
    }

    public function destroy(Request $request, $id) {
        $this->staffRepo->delete($id);
        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        } else {
            return redirect('/settings')->with('success', 'Staff member was deleted');
        }
        
    }
}
