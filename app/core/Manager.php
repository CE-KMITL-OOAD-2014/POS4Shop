<?php
    namespace ceddd;
	class Manager extends User{

        function __construct(ManagerRepository $managerrepository){
            $this->self['username']=NULL;
            $this->self['password']=NULL;
            $this->self['repository']=$managerrepository;
            parent::__construct();
        }
        
        public function setPassword($oldPw,$newPw,$confPw){
            if($newPw == $confPw){
                if(Hash::check($oldPw,$this->self['password'])){
                    $this->self['password'] = $newPw;
                }else{
                    throw new \Exception("Current password incorrect", 1);
                }
            }else{
                throw new \Exception("Confirm password incorrect", 1);                
            }
        }

        public function set($key,$value){
            //if($key=='id')
            //    throw new \Exception("Wrong method", 1);                
            parent::set($key,$value);
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

        public function findByName($name){
            return $this->self['repository']->findByName($name);
        }
    }