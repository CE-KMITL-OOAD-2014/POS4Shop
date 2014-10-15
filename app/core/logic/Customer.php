<?php 
    namespace ceddd;
    class Customer extends User{

        function __construct(CustomerRepository $customerRepo){
            $this->self['historyRepository']=$customerRepo;

        }

        public function getById($id){
            return $this->self['historyRepository']->getById($id);
        }

        public function getAll(){
            return $this->self['historyRepository']->getAll();
        }

        public function find($name){
            return $this->self['historyRepository']->find($name);
        }
    }