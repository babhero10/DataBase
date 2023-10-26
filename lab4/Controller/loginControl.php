<?php
    require('../Model/RegistrationDB.php');
    require('../Model/UserModel.php');

    // Make sure there is post request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Data collection and validation
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Or to make your own RegEx with preg_match()
        // Which will be a lot harder and not fully correct
        if (!isset($email) || trim($email) == "" || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !isset($password) || trim($password) == "") 
        {
            http_response_code(400);
            echo json_encode(array("message" => "Missing Data"));
            exit();
        }

        $db = getDatabaseConnection();
        $userModel = new UserModel($db);
        $user = $userModel->getRowByColumnValue(USER_EMAIL, $email);

        if (!$user || $user[USER_PASSWORD] != $password)
        {
            http_response_code(401);
            echo json_encode(array("message"=> "Wrong email or password"));
            $db = null;
            die();
        }

        http_response_code(200);
        echo json_encode(array("message"=> "Login successful"));
        $db = null;
        die();
    }
?>