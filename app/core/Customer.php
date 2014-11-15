<?php 
namespace ceddd;
class Customer extends User{

  public static function getRules(){
    return array('name' => 'required|min:3|unique:customers');
  }

  function __construct(CustomerRepository $customerRepo){
    parent::__construct();
    $this->self['repository']=$customerRepo;
    $this->self['history']=NULL;
  }

  public function save(){
    return $this->self['repository']->save($this);
  }

  public function edit(){
    return $this->self['repository']->edit($this);
  }

  public function delete(){
    return $this->self['repository']->delete($this);
  }

  public function find($name){
    return $this->self['repository']->find($name);
  }

  public function getById($id){
    return $this->self['repository']->getById($id);
  }

  public function getAll(){
    return $this->self['repository']->getAll();
  }

  public function getHistory(){
    $history = \App::make('ceddd\History');
    $this->self['history']=$history->getByCustomerId($this->self['id']);
    return $this->self['history'];
            //return $customerHistory;
  }

  // For restAPI
  public function toArray(){
    if($this->self['history']==NULL){
      $this->self['history']=$this->getHistory();
    }
    $result=array();
    foreach ($this->self['history'] as $hkey => $history) {
      foreach ($history->get('item') as $ikey => $item) {
        $result[$hkey][$ikey]['product']=$item->get('item')->get('name');
        $result[$hkey][$ikey]['quantity']=$item->get('quantity');
        $result[$hkey][$ikey]['price']=$item->get('price');
      }
    }

    return $result;
  }
}
