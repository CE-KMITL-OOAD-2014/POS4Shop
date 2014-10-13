<?php 
    class History{
        private $self;

        function __construct($sth = null){
            $this->self['id']=NULL;
            $this->self['item']=NULL;
            $this->self['customerId']=NULL;
            $this->self['created']=NULL;
            $this->self['updated']=NULL;
        }

        public function get($key){
            return $this->self[$key];
        }

        public function set($key,$value){
            $this->self[$key]=$value;            
        }
    }