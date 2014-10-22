<?php 
    namespace ceddd;
    class Customer extends User{

        function __construct(CustomerRepository $customerRepo){
            return $this->self['CustomerRepository']=$customerRepo;
        }

        public function save(){
            return $this->self['CustomerRepository']->save($this);
        }

        public static function find($name){
            return $this->self['CustomerRepository']->find($name);
        }

        public static function getById($id){
            return CustomerRepository::getById($id);
        }

        public static function getAll(){
            return CustomerRepository::getAll();
        }
    }