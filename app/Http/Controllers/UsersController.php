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
    
    public function update(Request $request, $id) {
        $formFields = $this->validate($request, [
            'is_admin' => ''
        ]);
        $this->usersRepo->updateFromInput($id, $formFields);
        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $request, $id) {
        $this->usersRepo->delete($id);
        return response()->json(['status' => 'success']);
    }
}
