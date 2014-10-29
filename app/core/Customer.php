<?php 
    namespace ceddd;
    class Customer extends User{

        function __construct(CustomerRepository $customerRepo){
            $this->self['repository']=$customerRepo;
            parent::__construct();
        }

        public function save(){
            return $this->self['repository']->save($this);
        }

        public function edit(){
            $this->self['repository']->edit($this);
        }

        public function delete(){
            return $this->self['repository']->delete($this);
        }

        public function find($name){
            return $this->self['repository']->find($name);
        }

        public function getById($id){
            return $this->self['repository']->getById($id);
        }

        public function getAll(){
            return $this->self['repository']->getAll();
        }
    }