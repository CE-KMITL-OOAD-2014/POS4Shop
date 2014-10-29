<?php 
    namespace ceddd;
    class CustomerHistory{
        private $self;

        function __construct($sth = null){
            $this->self['']=NULL;
        }

        public function get($key){
            return $this->self[$key];
        }

        public function set($key,$value){
            $this->self[$key]=$value;            
        }
    }