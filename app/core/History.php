<?php 
    namespace ceddd;
    class History{
        private $self;

        function __construct($sth = null,HistoryRepository $historyRepo){
            $this->self['repository']=$historyRepo;
            $this->self['id']=NULL;
            $this->self['hid']=NULL;
            $this->self['item']=NULL;
            $this->self['customer_Id']=NULL;
            $this->self['created_at']=NULL;
            $this->self['updated_at']=NULL;
        }

        public function get($key){
            return $this->self[$key];
        }

        public function set($key,$value){
            $this->self[$key]=$value;
        }

        public function delete(){
            return $this->self['repository']->delete($this);
        }

        public function save(){
            return $this->self['repository']->save($this);
        }

        public function edit(){
            return $this->self['repository']->edit($this);
        }

        public function getById($id){
            return $this->self['repository']->getById($id);
        }

        public function getAll(){
            return $this->self['repository']->getAll();
        }

        public function find($name){
            return $this->self['repository']->find($name);
        }

        public function where($key,$value){
            return $this->self['repository']->where($key,$value);
        }
    }