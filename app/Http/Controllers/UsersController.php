<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\Interfaces\IUsersRepository;

class UsersController extends Controller
{
    public function __construct(IUsersRepository $usersRepo) {
        $this->usersRepo = $usersRepo;
    }

    public function create() {
        return view('users/create')->with('title', 'New User');
    }

    public function store(Request $request) {
        $formFields = $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'is-admin' => 'required'
        ]);

        $this->usersRepo->addFromInput($formFields);

        return redirect('/settings')->with('success', 'User was created');
    }
    
    public function update(Request $request, $id) {
        /**
         * AJAX Request
         */
        if ($request->ajax()) {
            $formFields = $this->validate($request, [
                'is_admin' => ''
            ]);
            $this->usersRepo->updateFromInput($id, $formFields);
            return response()->json(['status' => 'success']);
        }
    }

    public function destroy(Request $request, $id) {
        $this->usersRepo->delete($id);
        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        } else {
            return redirect('/settings')->with('success', 'User was deleted');
        }
        
    }
}
