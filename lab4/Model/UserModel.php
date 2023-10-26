<?php
    require("Model.php");
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

            $model = new User($row["name"],$row["email"], $row["password"]);
            $model->id = $row['user_id'];
            $model->timestamp = $row['registration_date'];
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
            $query = "SELECT * FROM user";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $models = User::rows_to_model($rows);
            return $models;
        }

        public function getById($model_id)
        {
            $query = "SELECT * FROM user WHERE user_id=:user_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":user_id", $model_id, PDO::PARAM_INT);
            $rows = $stmt->fetchAll();
            $models = User::rows_to_model($rows);
            return $models;
        }
        
        public function getRowById($model_id)
        {
            
        }

        public function updateRow($model_id)
        {

        }

        public function deleteRow($id)
        {

        }

        
    }
?>