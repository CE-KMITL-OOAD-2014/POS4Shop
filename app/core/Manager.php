<?php
namespace ceddd;
class Manager extends User{
  
  public static function getRules(){
    return array('name' => 'required|min:2|unique:users',
      'username' => 'required|min:4|unique:users',
      'password' => 'required|min:4');
  }

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
      }
    }
    return false;
  }

  public function set($key,$value){         
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