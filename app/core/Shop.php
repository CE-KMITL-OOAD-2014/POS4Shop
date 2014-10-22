<?php
	namespace ceddd;
	class Shop {
		private $self;

		function __construct($item = null){
			$this->self['name']="New Shop";
			//echo $this->self['name'];
		}
		
		function dump(){
			return "dump fn";
		}

		function cal($item,Customer $customer,Manager $manager){
			$result=0;

			foreach ($item as $key => $value) {
				$result+=$value->get('price')*$value->get('quantity');
			}

			return $result;
		}
	}