<?php
    require("Model.php");
    class User
    {
        private $id;
        private $name;
        private $email;
        private $password;

        function __construct($name, $email, $password) {
            $this->setName( $name );
            $this->setEmail( $email );
            $this->setPassword( $password );
        }
        
        public function getId() {
            return $this->id;
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

        public function setPassword($password) {

            $this->password = md5($password);
        }
    }

    class UserModel implements Model {

        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }
        
        public function getRows()
        {
            $query = "SELECT * FROM user";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll();
        }

        public function getById($model_id): Model
        {
            return $this;
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