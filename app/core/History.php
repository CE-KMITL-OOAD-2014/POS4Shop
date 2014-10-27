<?php 
    namespace ceddd;
    class History{
        private $self;

        function __construct($sth = null,HistoryRepository $historyRepo){
            $this->self['repository']=$historyRepo;
            $this->self['id']=NULL;
            $this->self['item']=NULL;
            $this->self['customerId']=NULL;
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
            $this->self['repository']->save($this);
        }

        public function getAll(){
            return $this->self['repository']->getAll();
        }

        public function find($name){
            return $this->self['repository']->find($name);
        }
    }