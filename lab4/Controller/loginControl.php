<?php
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Method: GET, POST');
    header("Access-Control-Allow-Headers: *");
    header('Content-Type: application/json; charset=UTF-8');

    // Make sure there is post request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require('../Model/RegistrationDB.php');
        require('../Model/UserModel.php');
        $postData = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($postData['email']) || !isset($postData['password'])) {
            http_response_code(400);
            die(json_encode(array("error" => "Missing Data")));
        } else {
            // Data collection and validation
            $email = $postData['email'];
            $password = $postData['password'];

            if (trim($email) == "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || trim($password) == "") 
            {
                http_response_code(400);
                die(json_encode(array("error" => "Invalid Data")));
            }

            $db = getDatabaseConnection();
            $userModel = new UserModel($db);
            $user = $userModel->getRowsByColumnValue(USER_EMAIL, $email);

            if (!$user || $user[0]->getPassword() != $user[0]->hashPassword($password))
            {
                http_response_code(401);
                $db = null;
                die(json_encode(array("error"=> "Wrong email or password")));
            }
            else 
            {
                http_response_code(200);
                $db = null;
                die(json_encode(array("name"=> $user[0]->getName())));
            }
        }
    } else {
        http_response_code(403);
        die(json_encode(array("error"=> "Couldn't be access!")));
    }
        
?>