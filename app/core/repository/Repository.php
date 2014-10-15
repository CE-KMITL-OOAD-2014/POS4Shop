<?php 
    namespace ceddd;
    interface Repository{
        public function save($obj);
        public function edit($obj);
        public function getAll();
        public function find($obj);
    }