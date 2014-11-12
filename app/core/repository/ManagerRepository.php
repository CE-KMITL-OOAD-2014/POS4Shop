<?php 
namespace ceddd;
class ManagerRepository implements Repository{
  
  public static function getRules(){
    return array('name' => 'required|min:2|unique:users',
      'username' => 'required|min:4|unique:users',
      'password' => 'required|min:4');
  }

  public function save($manager){
    if($manager->get('id')!=NULL)
      return false;
    $m = new \ManagerEloquent();
    $m->name = $manager->get('name');
    $m->username = $manager->get('username');
    $m->password = $manager->get('password');
    if($m->save()){
      $manager->set('id',$m->id);
      return true;
    }
    return false;
  }

  public function edit($manager){
    if($manager->get('id')){
      $m = \ManagerEloquent::find($manager->get('id'));
      $m->name = $manager->get('name');
                // Not allow to change username
      $m->password = $manager->get('password');
      
      return $m->save();
    }
    return false;
  }

  public function delete($manager){
    if($manager->get('id')){
      $m = \ManagerEloquent::find($manager->get('id'));
      return $m->delete();
    }
    return false;
  }

  public static function getAll(){
    $all = \ManagerEloquent::all();
    if(count($all)==0)
      return NULL;
    foreach($all as $key => $val){
      $m = new Manager(new ManagerRepository);
      $m->set('id',$val->id);
      $m->set('name',$val->name);
      $m->set('username',$val->username);
      $m->set('password',$val->password);
      $m->set('created_at',$val->created_at);
      $m->set('updated_at',$val->updated_at);
      $result[$key]=$m;
    } 
    return $result;
  }

  public static function find($name){
    $all = \ManagerEloquent::where('name', 'like', '%'.$name.'%');;
    if(count($all)==0)
      return NULL;
    foreach($all as $key => $val){
      $m = new Manager(new ManagerRepository);
      $m->set('id',$val->id);
      $m->set('name',$val->name);
      $m->set('username',$val->username);
      $m->set('password',$val->password);
      $m->set('created_at',$val->created_at);
      $m->set('updated_at',$val->updated_at);
      $result[$key]=$m;
    } 
    return $result;
  }

  public static function getById($id){
    $m = \ManagerEloquent::find($id);
    if($m){
      $manager = \App::make('ceddd\Manager');
      $manager->set('id',$m->id);
      $manager->set('name',$m->name);
      $manager->set('username',$m->username);
      $manager->set('password',$m->password);
      $manager->set('created_at',$m->created_at);
      $manager->set('updated_at',$m->updated_at);
      return $manager;
    }
    return NULL;
  }
  
  public static function where($key,$value){
    $all = \ManagerEloquent::where($key, 'like', '%'.$value.'%');;
    if(count($all)==0)
      return NULL;
    foreach($all as $index => $val){
      $m = new Manager(new ManagerRepository);
      $m->set('id',$val->id);
      $m->set('name',$val->name);
      $m->set('username',$val->username);
      $m->set('password',$val->password);
      $m->set('created_at',$val->created_at);
      $m->set('updated_at',$val->updated_at);
      $result[$index]=$m;
    } 
    return $result;
  }
}