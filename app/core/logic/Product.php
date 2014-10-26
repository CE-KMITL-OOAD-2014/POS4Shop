<?php 
    namespace ceddd;
    class Product {
        private $self;

        function __construct($sth = null){
            $this->self['id']=NULL;
            $this->self['barcode']=NULL;
            $this->self['name']=NULL;
            $this->self['detail']=NULL;
            $this->self['cost']=NULL;
            $this->self['price']=NULL;
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