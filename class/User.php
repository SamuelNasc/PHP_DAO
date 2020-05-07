<?php

    class User{
        private $userId;
        private $userLogin;
        private $userPassword;
        private $userRegister;

        public function getUserId(){
            return $this->userId;
        }

        public function setUserId($value){
            $this->userId = $value;
        }

        public function getUserLogin(){
            return $this->userLogin;
        }

        public function setUserLogin($value){
            $this->userLogin = $value;
        }

        public function getUserPassword(){
            return $this->userPassword;
        }

        public function setUserPassword($value){
            $this->userPassword = $value;
        }

        public function getUserRegister(){
            return $this->userRegister;
        }

        public function setUserRegister($value){
            $this->userRegister = $value;
        }

        public function loadById($id){
            $sql = new Sql();
            $result = $sql->select("SELECT * FROM TB_USERS WHERE USER_ID = :ID", array(
                ":ID"=>$id
            ));

            if(count($result) > 0){
                $row = $result[0];
                $this->setUserId($row['USER_ID']);
                $this->setUserLogin($row['USER_LOGIN']);
                $this->setUserPassword($row['USER_PASSWORD']);
                $this->setUserRegister(new DateTime($row['USER_REGISTER']));
            }
        }

        public static function getList(){
            $sql = new Sql();
            return $sql->select("SELECT * FROM TB_USERS ORDER BY USER_LOGIN");
        }

        public static function search($login){
            $sql = new Sql();
            return $sql->select("SELECT * FROM TB_USERS WHERE USER_LOGIN LIKE :SEARCH ORDER BY USER_LOGIN", array(
                ":SEARCH"=>"%" . $login . "%"
            ));
        }

        public function login($login, $password){
            $sql = new Sql();
            $result = $sql->select("SELECT * FROM TB_USERS WHERE USER_LOGIN = :LOGIN AND USER_PASSWORD = :PASSWORD" , array(
                ":LOGIN"=>$login, 
                ":PASSWORD"=>$password
            ));
            if(count($result) > 0){
                $row = $result[0];
                $this->setUserId($row['USER_ID']);
                $this->setUserLogin($row['USER_LOGIN']);
                $this->setUserPassword($row['USER_PASSWORD']);
                $this->setUserRegister(new DateTime($row['USER_REGISTER']));
            }
            else
                throw new Exception("Wrong login or password");
        }

        public function __toString()
        {
            return json_encode(array(
                "userLogin"=>$this->getUserId(),
                "userLogin"=>$this->getUserLogin(),
                "userPassword"=>$this->getUserPassword(),
                "userRegister"=>$this->getUserRegister()->format("d:m:Y h:i:s")
            ));
        }
    }

?>