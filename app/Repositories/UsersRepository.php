<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Interfaces\IUsersRepository;
use Illuminate\Support\Str;

class UsersRepository implements IUsersRepository {

    public function all() {
        return User::all();
    }

    public function get($id) {
        return User::find($id);
    }

    public function addFromInput($formFields) {
        $user = new User;
        $user->name = $formFields['name'];
        $user->email = $formFields['email'];
        $user->password = bcrypt($formFields['password']);
        $user->is_admin = $formFields['is-admin'] == 'on' ? '1' : '0';
        $user->api_token = Str::random(30);
        $user->save();
    }   

    public function updateFromInput($id, $formFields) {
        $user = $this->get($id);
        $user->is_admin = $formFields['is_admin'] === 'true' ? 1 : 0;
        $user->save();
    }

    public function delete($id) {
        $this->get($id)->delete();
    }
}