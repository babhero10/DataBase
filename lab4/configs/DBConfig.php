<?php
    // Ensures that users do not directly access the controller class.
    if (!defined('BASEPATH')) 
    {
        header('Location: ../View/index.php',true);
        exit();         
    } 

    // Database configuration
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '123456');
?>