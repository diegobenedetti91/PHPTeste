<?php
    class User{
        private $name;
        private $password;
        private $datecreate;

        public function __set($atrib,$value){
            $this->$atrib = $value;
        }

        public function __get($atribu){
            return $this->$atrib;
        }
    }
?>