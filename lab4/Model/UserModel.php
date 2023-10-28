<?php
    require("Model.php");
    define('USER_ID', 'user_id');
    define('USER_EMAIL', 'email');
    define('USER_USERNAME', 'name');
    define('USER_PASSWORD', 'password');
    define('USER_REG_DATE', 'registration_date');

    class User implements ModelData
    {
        private $id;
        private $email;
        private $name;
        private $password;
        private $timestamp;

        function __construct($name, $email, $password) {
            $this->setName( $name );
            $this->setEmail( $email );
            $this->setPassword( $password );
        }
        
        public function getId() {
            return $this->id;
        }

        public function getTimestamp() {   
            return $this->timestamp;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function getEmail() {    
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getPassword() {
            return $this->password;
        }
        public function getHashPassword() {
            return md5($this->password);
        }
        public function hashPassword($password) {
            return md5($password);
        }

        public function setPassword($password) {

            $this->password = ($password);
        }
        public function print()
        {
            echo"ID: ". $this->getId() ."/Email: ". $this->getEmail() ."/Name: ". $this->getName() ."/Password: ". $this->getPassword() . "/Time: ". $this->getTimestamp() ."";
            echo"<br/>";
        }

        public static function row_to_model($row)
        {
            if ($row == null)
            {
                return null;
            }

            $model = new User($row[USER_USERNAME],$row[USER_EMAIL], $row[USER_PASSWORD]);
            $model->id = $row[USER_ID];
            $model->timestamp = $row[USER_REG_DATE];
            return $model;
        }
        
        public static function rows_to_model($rows)
        {  
            if ($rows == null)
            {
                return [];
            }

            $models = array_fill(0, count($rows), null);
            $i = 0;

            foreach ($rows as $row) {
                $models[$i] = User::row_to_model($row);
                $i++;
            }

            return $models;
        }
    }

    class UserModel implements ModelDB {

        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }
        
        public function getRows()
        {
            try {
                $query = "SELECT * FROM user";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $models = User::rows_to_model($rows);
                return $models;
            } catch (PDOException $e) {
                return null;
            }
        }

        public function getRowById($model_id)
        {
            try {
                $query = "SELECT * FROM `user` WHERE :user_id_column=:user_id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":user_id_column", USER_ID, PDO::PARAM_INT);
                $stmt->bindParam(":user_id", $model_id, PDO::PARAM_INT);
                $stmt->execute();
                $rows = $stmt->fetchAll();
                $models = User::rows_to_model($rows);
                return $models;
            } catch (PDOException $e) {
                return null;
            }
        }

        public function getRowsByColumnValue($columnName, $value)
        {
            try {
                $query = "SELECT * FROM `user` WHERE $columnName=:columnValue;";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":columnValue", $value, PDO::PARAM_STR);
                $stmt->execute();
                $rows = $stmt->fetchAll();
                $models = User::rows_to_model($rows);
                return $models;
            } catch (PDOException $e) {
                return null;
            }
        }

        public function insertRow($model)
        {
            $name = $model->getName();
            $email = $model->getEmail();
            $password = $model->getPassword();
            try {
                $query = "INSERT INTO `user`(`email`, `name`, `password`) VALUES (:emailParm,:nameParm,:passwordParm)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":emailParm", $email, PDO::PARAM_STR);
                $stmt->bindParam(":nameParm", $name, PDO::PARAM_STR);
                $stmt->bindParam(":passwordParm", $password, PDO::PARAM_STR);
                $stmt->execute();  
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function updateRowById($model_id, $new_model)
        {

        }

        public function deleteRowById($model_id)
        {

        }
    }
?>