<?php 
namespace ceddd;
class Product {
  private $self;

  function __construct(ProductRepository $productRepo){
    $this->self['repository']=$productRepo;
    $this->self['id']=NULL;
    $this->self['barcode']=NULL;
    $this->self['name']=NULL;
    $this->self['file']=NULL;
    $this->self['detail']=NULL;
    $this->self['cost']=NULL;
    $this->self['price']=NULL;
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
  
  public function json(){
    $result = $this->self;
    unset($result['repository']);
    unset($result['created_at']);
    unset($result['updated_at']);
    return $result;
  }
}