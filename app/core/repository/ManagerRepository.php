<?php 
namespace ceddd;
class ManagerRepository implements Repository{

  public function save($manager){
    if($manager->get('id')!=NULL)
      return false;
    $managerElo = new \ManagerEloquent();
    $managerElo->name = $manager->get('name');
    $managerElo->username = $manager->get('username');
    $managerElo->password = $manager->get('password');
    if($managerElo->save()){
      $manager->set('id',$managerElo->id);
      return true;
    }
    return false;
  }

  public function edit($manager){
    if($manager->get('id')){
      $managerElo = \ManagerEloquent::find($manager->get('id'));
      $managerElo->name = $manager->get('name');
      //$managerElo->username : Not allow to change username
      $managerElo->password = $manager->get('password');
      
      return $managerElo->save();
    }
    return false;
  }

  public function delete($manager){
    if($manager->get('id')){
      $managerElo = \ManagerEloquent::find($manager->get('id'));
      $managerElo->isDelete = true;
      return $managerElo->save();
    }
    return false;
  }

  public function getById($id){
    $managerElo = \ManagerEloquent::find($id);
    if($managerElo){
      return $this->toObj($managerElo);
    }
    return NULL;
  }
  
  public function getAll(){
    $arrOfManagerEloquent = \ManagerEloquent::all();
    if(count($arrOfManagerEloquent)==0)
      return NULL;
    $result=array();
    foreach($arrOfManagerEloquent as $key => $managerElo){
      $result[$key]=$this->toObj($managerElo);
    } 
    return $result;
  }

  public function find($name){
    $arrOfManagerEloquent = \ManagerEloquent::where('name', 'like', '%'.$name.'%')->get();
    if(count($arrOfManagerEloquent)==0)
      return NULL;
    $result=array();
    foreach($arrOfManagerEloquent as $key => $managerElo){
      $result[$key]=$this->toObj($managerElo);
    } 
    return $result;
  }

  public function where($key,$value){
    $arrOfManagerEloquent = \ManagerEloquent::where($key, 'like', '%'.$value.'%')->get();
    if(count($arrOfManagerEloquent)==0)
      return NULL;
    $result=array();
    foreach($arrOfManagerEloquent as $key => $managerElo){
      $result[$key]=$this->toObj($managerElo);
    }
    return $result;
  }

  /**
  * Map ManagerEloquent to Manager
  */
  private function toObj($managerElo){
    $manager = \App::make('ceddd\Manager');
    $manager->set('id',$managerElo->id);
    $manager->set('name',$managerElo->name);
    $manager->set('username',$managerElo->username);
    $manager->set('password',$managerElo->password);
    $manager->set('created_at',$managerElo->created_at);
    $manager->set('updated_at',$managerElo->updated_at);
    return $manager;
  }
}