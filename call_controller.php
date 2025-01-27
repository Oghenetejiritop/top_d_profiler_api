<?php

header('Content-Type: application/json');

/**
 * call_controller.php
 *  Script that handles the API call base on the type of request
 * @author Oghenetejiri Peace Onosajerhe
 * @version 1.0
 * @package top_d_profiler_api
 */

 include 'model.php';
 

/**determine  the url request */
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


switch($method) {
    case 'GET':    //validate and extract the user from the get request
        $user = ["response" => "false"];
        if(preg_match("/^\/top_d_profiler_api/", $uri)) {
            $user =access_account(substr($uri, strpos($uri, "s") + 4));
        }
        else
        $user = ["response" => "false $uri"];
        echo json_encode($user);
                break;
        case 'POST':
            break;
            default:
            break;
}

?>