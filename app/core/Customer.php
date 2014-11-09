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
            return $this->self['repository']->edit($this);
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

        public function getHistory(){
            $history = \App::make('ceddd\History');
            //$customerHistory = 
            return $history->getByCustomerId($this->self['id']);
            //return $customerHistory;
        }
    }