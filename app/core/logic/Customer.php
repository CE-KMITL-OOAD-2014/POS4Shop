<?php 
    namespace ceddd;
    class Customer extends User{

        public function getById(CustomerRepository $customerRepo,$id){
            return $customerRepo->getById($id);
        }

        public function getAll(CustomerRepository $customerRepo){
            return $customerRepo->getAll();
        }

        public function find(CustomerRepository $customerRepo,$name){
            return $customerRepo->find($name);
        }
    }