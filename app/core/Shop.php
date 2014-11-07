<?php
namespace ceddd;
class Shop {
	private $self;

	function __construct($item = null){
		$this->self['name']="New Shop";
			//echo $this->self['name'];
	}

	function cal($item,Manager $manager,Customer $customer=NULL){
		$result=0;
		if($item==NULL)
			return $result;			

		foreach ($item as $key => $value) {
			$result+=$value->get('price')*$value->get('quantity');
		}

		return $result;
	}


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
