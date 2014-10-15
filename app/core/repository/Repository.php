<?php 
    interface Repository{
        public function save($value);
        public function edit($value);
        public function getAll();
        public function find($value);
    }