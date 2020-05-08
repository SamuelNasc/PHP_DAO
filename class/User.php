<?php

    class User{
        private $userId;
        private $userLogin;
        private $userPassword;
        private $userRegister;


        public function __construct($login = "", $password = "")
        {
            $this->setUserLogin($login);
            $this->setUserPassword($password);
        }

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
                $this->setData($result[0]);
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
                $this->setData($result[0]);
            }
            else
                throw new Exception("Wrong login or password");
        }

        public function insert(){
            $sql = new Sql();
            $results = $sql->select("CALL sp_insert_users(:LOGIN, :PASSWORD)", array(
                ':LOGIN'=>$this->getUserLogin(),
                ':PASSWORD'=>$this->getUserPassword()
            ));

            if(count($results) > 0)
                $this->setData($results[0]);
        }

        public function update($login, $password){

            $this->setUserLogin($login);
            $this->setUserPassword($password);

            $sql = new SQL();
            $sql->query("UPDATE TB_USERS SET USER_LOGIN = :LOGIN, USER_PASSWORD = :PASSWORD WHERE USER_ID = :ID", ARRAY(
                ':LOGIN'=>$this->getUserLogin(),
                ':PASSWORD'=>$this->getUserPassword(),
                ':ID'=>$this->getUserId()
            ));
        }

        public function delete(){
            $sql = new Sql();
            $sql->query("DELETE FROM TB_USERS WHERE USER_ID = :ID", array(
                ':ID'=>$this->getUserId()
            ));

            $this->setUserId(0);
            $this->setUserLogin("");
            $this->setUserPassword("");
            $this->setUserRegister(new DateTime());
        }

        public function setData($data){
                $this->setUserId($data['USER_ID']);
                $this->setUserLogin($data['USER_LOGIN']);
                $this->setUserPassword($data['USER_PASSWORD']);
                $this->setUserRegister(new DateTime($data['USER_REGISTER']));
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