<?php 
    namespace ceddd;
    class Product {
        private $self;

        function __construct(ProductRepository $productRepo){
            $this->self['productRepository']=$productRepo;
            $this->self['id']=NULL;
            $this->self['barcode']=NULL;
            $this->self['name']=NULL;
            $this->self['file']=NULL;
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

        public function save(){
            $this->self['productRepository']->save($this);
        }

        public function getById($id){
            return $this->self['productRepository']->getById($id);
        }

        public function getAll(){
            return $this->self['productRepository']->getAll();
        }

        public function findByName(){
            return $this->self['productRepository']->findByName($name);
        }
    }