<?php
    interface InterfaceDAO{
        public function save();

        public function update();

        public function delete($id);

        public function getAll() : array;

        public function getForID($id);
    }
?>