<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ISettingsRepository;
use App\Repositories\Interfaces\IUsersRepository;
use App\Repositories\Interfaces\IStaffRepository;

class SettingsController extends Controller
{
    public function __construct(ISettingsRepository $settingsRepo,
                                IUsersRepository $usersRepo,
                                IStaffRepository $staffRepo)
    {
        $this->settingsRepo = $settingsRepo;
        $this->usersRepo = $usersRepo;
        $this->staffRepo = $staffRepo;
    }

    public function index(Request $request) {
        return view('settings/index')->with([
                                            'settings' => $this->settingsRepo->all(),
                                            'users' => $this->usersRepo->all(),
                                            'staff' => $this->staffRepo->all(),
                                            ]);
    }

    public function update(Request $request, $id) {
        $formFields = $this->validate($request, [
            'value' => 'required|string'
        ]);
        $this->settingsRepo->updateFromInput($id, $formFields);        
        return response()->json(['status' => 'success']);
    }
}
