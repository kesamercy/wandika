<?php
    require 'database.php';
    date_default_timezone_set('America/New_York');
    // the response will be a JSON object
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    // pull the input, which should be in the form of a JSON object
    $json_params = file_get_contents('php://input');
    $decoded_params = json_decode($json_params, TRUE);
    $conn = null;
    $post_id = null;   
    $content = null;
    $num = null;
    if(array_key_exists('post_id', $decoded_params)){
        $post_id = $decoded_params['post_id'];
    }
    if(array_key_exists('content', $decoded_params)){
        $post_id = $decoded_params['content'];
    }

    if(isset($_POST['action']) && !empty($_POST['action'])) {

        $action = $_POST['action'];
            switch($action) {
                case 'change-password': change_password(); break;
                default: echo "No such function found";
            }

    }

    //Helper function for change_password
    function get_user_id(){
        $response = array();
        $user_email = $_POST['email'];
        $sql = "SELECT IFNULL( SELECT user_id FROM user WHERE email=$user_email), 0)";
        $found_user_id = $conn->query($sql);
        if ($found_user_id === 0){
            $response['Error'] = "Credentials Not Found";
        }else{
           $response['user_id'] = $found_user_id->fetch()[0];
        }
        echo json_encode($response);
        return $response;
    }

    //Requires valid email address from email field.
    function change_password(){
        $conn = connect();
        $found_id = get_user_id();
        $response = array();
        if(array_key_exists('user_id',$found_id)){
            $user_id = $found_id['user_id'];
            $sql = "UPDATE user SET password=:new_password WHERE user_id=$user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':new_password', $new_pass);
            $new_pass = $_POST['new-password'];
            $success = $stmt->execute();
            if($success){
                $response['Result'] = "Password successfully changed.";
            }else{
                $response['Error'] = "Password could not be changed.";
            }
        }else{
            $response['Error'] = "Credentials Not Found";
        }
        close_connection();
        echo json_encode($response);
    }