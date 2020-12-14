<?php

namespace App\Services;

use App\Models\User;

class UserServices {

    public function getAllUsers() {
        return User::all();
    }

    public function findUserById($id) {
        return User::find($id);
    }

    public function createUser($attr) {
        return User::insertOrUpdate($attr, true);
    }

    public function updateUser($attr) {
        return User::insertOrUpdate($attr, false);
    }

    public function deleteUser($attr) {
        return User::delete($attr);
    }

}