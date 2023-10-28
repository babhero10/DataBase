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
        
        if (!isset($postData['name']) || !isset($postData['email']) ||
            !isset($postData['password'])) {
            http_response_code(400);
            die(json_encode(array("message" => "Missing Data")));
        } else {
            // Data collection and validation
            $name = $postData['name'];
            $email = $postData['email'];
            $password = $postData['password'];
            $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"; 

            if (trim($name) == "" || trim($email) == "" || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
                trim($password) == "" || !preg_match($password_regex, trim($password)))
            {
                $name = trim($name);
                $email = trim($email);
                $password = trim($password);
                http_response_code(400);
                die(json_encode(array("error" => "Invalid Data")));
            }

            $db = getDatabaseConnection();
            $user = new User($name, $email, $password);
            $userModel = new UserModel($db);
            $checkUser = $userModel->getRowsByColumnValue(USER_EMAIL, $email);

            if ($checkUser && count($checkUser))
            {
                http_response_code(401);
                $db = null;
                die(json_encode(array("error"=> "This email already exist")));
            }

            $user->setPassword($user->getHashPassword());
            $message = $userModel->insertRow($user);
            if ($message == true)
            {
                http_response_code(200);
                die(json_encode(array("name"=> $name)));
            }
            else 
            {
                http_response_code(500);
                die(json_encode(array("error"=> $message)));
            }
        }
    } else {
        http_response_code(403);
        die(json_encode(array("error"=> "Couldn't be access!")));
    }
        
?>