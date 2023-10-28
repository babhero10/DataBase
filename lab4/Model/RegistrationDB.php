<?php
    require("../configs/DBConfig.php");
    function getDatabaseConnection()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=registration";
   
        try {
            $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: ". $e->getMessage();
        }

        return null;
    }
    
?>