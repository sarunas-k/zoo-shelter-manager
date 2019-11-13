<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ISettingsRepository;
use App\Repositories\Interfaces\IUsersRepository;

class SettingsController extends Controller
{
    public function __construct(ISettingsRepository $settingsRepo, IUsersRepository $usersRepo)
    {
        $this->settingsRepo = $settingsRepo;
        $this->usersRepo = $usersRepo;
    }

    public function index(Request $request) {
        return view('settings/index')->with([
                                            'settings' => $this->settingsRepo->all(),
                                            'users' => $this->usersRepo->all(),
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
