<?php

use Config\Autoloader;
use App\Http\Api\Controllers\UserController;
use App\Http\Api\Controllers\AuthController;

include_once 'config/Autoloader.php';
Autoloader::register();

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

if(isset($_GET['r'])) {
    $r = $_GET['r'];
} else {
    $r = "fetch_users";
}

if($r == "fetch_users") {
    UserController::index();
} elseif ($r == "fetch_one_user" && isset($_GET['id'])) {
    UserController::show($_GET['id']);
} elseif ($r == "create_one_user") {
    UserController::store();
} elseif ($r == "update_one_user" && $_GET['id']) {
    UserController::update();
} elseif ($r == "delete_one_user" && $_GET['id']) {
    UserController::delete();
} elseif ($r == "login") {
    AuthController::login();
}