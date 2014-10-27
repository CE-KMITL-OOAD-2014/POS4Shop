<?php 
    namespace ceddd;
    class Product {
        private $self;

        function __construct(ProductRepository $productRepo){
            $this->self['repository']=$productRepo;
            $this->self['id']=NULL;
            $this->self['barcode']=NULL;
            $this->self['name']=NULL;
            $this->self['file']=NULL;
            $this->self['detail']=NULL;
            $this->self['cost']=NULL;
            $this->self['price']=NULL;
            $this->self['created_at']=NULL;
            $this->self['updated_at']=NULL;
        }

        public function get($key){
            return $this->self[$key];
        }

        public function set($key,$value){
            $this->self[$key]=$value;
        }

        public function save(){
            $this->self['repository']->save($this);
        }

        public function edit(){
            $this->self['repository']->edit($this);
        }

        public function getById($id){
            return $this->self['repository']->getById($id);
        }

        public function getAll(){
            return $this->self['repository']->getAll();
        }

        public function findByName(){
            return $this->self['repository']->findByName($name);
        }
    }