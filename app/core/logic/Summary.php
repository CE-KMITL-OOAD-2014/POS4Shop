<?php 
    class Summary{
        private $self;

        function __construct($sth = null){
            $this->self['topSellProduct']=NULL;
        }

        public function get($key){
            return $this->self[$key];
        }

        public function set($key,$value){
            $this->self[$key]=$value;            
        }
    }