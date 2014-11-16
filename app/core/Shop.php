<?php
namespace ceddd;
class Shop {
	private $self;


  /**
  * Default shop name
  */
  function __construct(){
    $this->self['name']="New Shop";
  }

  /**
  * Get shop name
  */
  public function getName(){
    $shop=\ShopEloquent::All();
    if(count($shop)>0){
      $shop=$shop[0];
      $shop = $shop->name;
    }else{
      $shop=new \ShopEloquent;
      $shop->name=$this->self['name'];
      $shop->save();
      \Session::put('shop', $this->self['name']);
      //$name = $shop->name;
    }
    $this->self['name']=$shop;
    return $this->self['name'];
  }


  /**
  * Change Shop name
  */
  public function setName($name){
    $shop=\ShopEloquent::All();
    if(count($shop)>0){
      $shop=$shop[0];
      $shop->name=$name;
    }else{
      $shop=new \ShopEloquent;      
    }
    $shop->name=$name;
    $shop->save();
    \Session::put('shop', $name);
    $this->self['name']=$shop->name;
    return $this->self['name'];
  }

  /**
  * Calculate value of buying product
  * return value of product in list
  */
	function cal($item){
		$result=0;
		if($item==NULL)
			return $result;			

		foreach ($item as $value) {
			$result+=$value->get('price')*$value->get('quantity');
		}

		return $result;
	}

  /**
  * Buy product and save it to History database
  * return true if can save
  * return false if can not save
  */
	function buy($item,Manager $manager,Customer $customer=NULL){
		$i=0;
		$arr = array();
		foreach ($item as $value) {
		  $arr[$i]=$value;
		  $i++;
		}

		$h = \App::make('ceddd\History');
    $lastID= $h->getLast()+1;
    $history = \App::make('ceddd\History');
    $history->set('hid',$lastID);
    $history->set('item',$arr);
    if($customer!=NULL)
    	$history->set('customer_id',$customer->get('id'));
    $history->set('manager_id',$manager->get('id'));
    return $history->save();
	}
}
