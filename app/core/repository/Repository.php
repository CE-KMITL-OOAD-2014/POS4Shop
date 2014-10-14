<?php 
    interface Repository{
        public function save();
        public function edit();
        public function getAll();
        public function find();
    }