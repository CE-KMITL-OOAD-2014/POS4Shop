<?php 
    namespace ceddd;
    class History{
        private $self;

        function __construct($sth = null,HistoryRepository $historyRepo){
            $this->self['historyRepository']=$historyRepo;
            $this->self['id']=NULL;
            $this->self['item']=NULL;
            $this->self['customerId']=NULL;
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
            $this->self['historyRepository']->save($this);
        }

        public function getAll(){
            return $this->self['historyRepository']->getAll();
        }

        public function find($name){
            return $this->self['historyRepository']->find($name);
        }
    }