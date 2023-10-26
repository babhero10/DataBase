<?php
    require("../configs/DBConfigs.php");
    $dsn = "mysql:host=" . DB_HOST . ";dbname=registration";
    echo"$dsn";
    try {
        $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
    }

    
?>