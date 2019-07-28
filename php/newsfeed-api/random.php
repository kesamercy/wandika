<?php

require 'database.php';
    require 'validity.php';
   
    // the response will be a JSON object
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if(isset($_POST['action']) && !empty($_POST['action'])) {
            $action = $_POST['action'];
        }
     if ($action == "blog-post"){

      

}

?>