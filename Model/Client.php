<?php
    class Client {
        public $id;
        public $name;
        public $birthDate;
        public $CPF;
        public $RG;
        public $telephone;

        public function __set($atrib,$value){
            $this->$atrib = $value;
        }

        public function __get($atrib){
            return $this->$atrib;
        }
    }
?>