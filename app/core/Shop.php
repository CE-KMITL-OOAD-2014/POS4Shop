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
	}