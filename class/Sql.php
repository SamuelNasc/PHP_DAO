<?php
    class Sql extends PDO{
        private $conn;

        public function __construct(){
            $this->conn = new PDO("mysql:host=localhost;dbname=db_test", "root", "");
        }
        
        private function setParameters($statement, $parameters = array()){
            foreach($parameters as $key => $value){
                $this->setParameter($statement,$key, $value);
            }
        }

        private  function setParameter($statement, $key, $value){
            $statement->bindParam($key,$value);
        }

        public function query($rawQuery, $parameters =  array()){
            $statement = $this->conn->prepare($rawQuery);
            
            $this->setParameters($statement,$parameters);

            $statement->execute();
            return $statement;
        }

        public function select($rawQuery, $parameters = array()){
            $statement = $this->query($rawQuery, $parameters);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
            
        
    }
?>