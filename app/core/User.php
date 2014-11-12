<?php
namespace ceddd;
class User{
  protected $self;

  function __construct(){
    $this->self['id']=NULL;
    $this->self['name']=NULL;
    $this->self['created_at']=NULL;
    $this->self['updated_at']=NULL;
  }

  public function get($key){
    return $this->self[$key];
  }

  public function set($key,$value){
    $this->self[$key]=$value;            
  }		
}
