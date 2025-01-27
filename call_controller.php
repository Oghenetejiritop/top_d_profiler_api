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
 

 $method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


?>