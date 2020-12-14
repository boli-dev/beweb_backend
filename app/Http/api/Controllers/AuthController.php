<?php

namespace App\Http\Api\Controllers;

use App\Models\User;

class AuthController {

    public function login() {
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Access-Control-Allow-Header");
        $data = json_decode(file_get_contents("php://input"));
        $user = User::findByUsernameAndPassword($data->username, $data->password);
        if(!$user) {
            echo json_encode(array(
                'message' => "user not found"
            ));
        } else {
            echo json_encode($user);
        }
    }

}