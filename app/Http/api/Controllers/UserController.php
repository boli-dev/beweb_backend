<?php

namespace App\Http\Api\Controllers;

use App\Services\UserServices;

class UserController {

    public function index() {
        $array['users'] = array();
        foreach (UserServices::getAllUsers() as $user) {
            $item = array(
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'created_at' => $user->created_at,
            );
            array_push($array['users'], $item);
        }

        echo json_encode($array);
    }

    public function show($id) {
        echo json_encode(UserServices::findUserById($id));
    }

    public function store() {
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Access-Control-Allow-Header");
        $data = json_decode(file_get_contents("php://input"));
        $attr = [
            'name' => $data->name,
            'username' => $data->username,
            'email' => $data->email,
            'password' => $data->password,
            'created_at' => $data->created_at,
        ];
        echo json_encode(UserServices::createUser($attr));
    }

    public function update() {
        header("Access-Control-Allow-Methods: PUT");
        header("Access-Control-Allow-Headers: Access-Control-Allow-Header");
        $data = json_decode(file_get_contents("php://input"));
        $attr = [
            'id' => $_GET['id'],
            'name' => $data->name,
            'username' => $data->username,
            'email' => $data->email,
            'password' => $data->password,
            'created_at' => $data->created_at,
        ];
        echo json_encode(UserServices::updateUser($attr));
    }

    public function delete() {
        header("Access-Control-Allow-Methods: DELETE");
        header("Access-Control-Allow-Headers: Access-Control-Allow-Header");
        $data = json_decode(file_get_contents("php://input"));
        $attr = [
            'id' => $_GET['id']
        ];
        echo json_encode(UserServices::deleteUser($attr));
    }

}