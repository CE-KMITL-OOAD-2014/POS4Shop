<?php 
namespace ceddd;
class CustomerRepository implements Repository{

  

  public function save($customer){
    if($customer->get('id')!=NULL)
      return false;
    $customerElo = new \CustomerEloquent;
    $customerElo->name = $customer->get('name');
    if($customerElo->save()){
      $customer->set('id',$customerElo->id);
      return true;
    }
    return false;
  }

  public function edit($customer){
    if($customer->get('id')){
      $customerElo = \CustomerEloquent::find($customer->get('id'));
      $customerElo->name = $customer->get('name');
      return $customerElo->save();
    }
    return false;
  }

  public function delete($customer){
    if($customer->get('id')){
      $customerElo = \CustomerEloquent::find($customer->get('id'));
      $customerElo->isDelete=true;
      return $customerElo->save();
    }
    return false;
  }

  public function getById($id){
    $customerElo =\CustomerEloquent::find($id);
    if($customerElo){
      return $this->toObj($customerElo);
    }
    return NULL;
  }

  public function getAll(){
    $arrOfCustomerElo = \CustomerEloquent::where('isDelete', '=', 0)->get();
    if(count($arrOfCustomerElo)==0)
      return NULL;
    $result=array();
    foreach($arrOfCustomerElo as $key => $customerElo){
      $result[$key]=$this->toObj($customerElo);
    }
    return $result;
  }

  public function find($name){
    return $this->where('name',$name);
  }

  public function where($col,$value){
    $arrOfCustomerElo = \CustomerEloquent::where($col, 'like', '%'.$name.'%');
    $arrOfCustomerElo = $arrOfCustomerElo->where('isDelete', '=', 0)->get();
    if(!$arrOfCustomerElo)
      return NULL;
    $result=array();
    foreach($arrOfCustomerElo as $key => $customerElo){
      $result[$key]=$this->toObj($customerElo);
    }
    return $result;
  }

  /**
  * Map ManagerEloquent to Manager
  */
  private function toObj($customerElo){
    $customer=\App::make('ceddd\Customer');
    $customer->set('id',$customerElo->id);
    $customer->set('name',$customerElo->name);
    $customer->set('created_at',$customerElo->created_at);
    $customer->set('updated_at',$customerElo->updated_at);
    return $customer;
  }
}