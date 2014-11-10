<?php
    namespace ceddd;
	class Manager extends User{

        function __construct(ManagerRepository $managerrepository){
            $this->self['username']=NULL;
            $this->self['password']=NULL;
            $this->self['repository']=$managerrepository;
            parent::__construct();
        }
        
        public function setPassword($oldPwd,$newPwd,$conPwd){
            if($newPwd == $conPwd){
                if(\Hash::check($oldPwd,$this->self['password'])){
                    $this->self['password'] = \Hash::make($newPwd);
                    return true;
                }/*else{
                    //throw new \Exception("Current password incorrect", 1);
                }
            }else{
                //throw new \Exception("Confirm password incorrect", 1);*/
            }
            return false;
        }

        public function set($key,$value){
            //if($key=='id')
            //    throw new \Exception("Wrong method", 1);                
            parent::set($key,$value);
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

        public function findByName($name){
            return $this->self['repository']->findByName($name);
        }
    }