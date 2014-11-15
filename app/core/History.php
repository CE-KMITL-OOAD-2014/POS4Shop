<?php 
namespace ceddd;
class History{
  private $self;

  public static function getRules(){
    return array('hid' => 'required|integer',
     'product_id'=>'required|exists:products,id',
     'quantity'=>'required|numeric',
     'price'=>'required|numeric',
     'customer_id'=>'exists:customers,id');
  }

  function __construct(HistoryRepository $historyRepo){
    $this->self['repository']=$historyRepo;
    $this->self['id']=NULL;
    $this->self['hid']=NULL;
    $this->self['item']=NULL;
    $this->self['manager_id']=NULL;
    $this->self['customer_id']=NULL;
    $this->self['created_at']=NULL;
    $this->self['updated_at']=NULL;
  }

  public function get($key){
    return $this->self[$key];
  }

  public function set($key,$value){
    $this->self[$key]=$value;
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

  public function delete(){
    return $this->self['repository']->deleteByID($this->get('hid'));
  }
  
  public function getByProductId($pid){
    return $this->self['repository']->getByProductId($pid);
  }

  public function getLast(){
    return $this->self['repository']->getLast();
  }

  public function deleteByHid(){
    return $this->self['repository']->deleteByHID($this);
  }


  public function getByCustomerId($cid){
    return $this->self['repository']->getByCustomerId($cid);
  }

  public function find($hid){
    return $this->self['repository']->find($hid);
  }

  public function where($pack, $query, $order=NULL){
    return $this->self['repository']->where($key,$value);
  }
}