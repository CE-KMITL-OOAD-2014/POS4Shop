<?php 
	class SoldItem{
		private $self;
		
		function __construct(){
			$this->self['item']=NULL;
			$this->self['quantity']=NULL;
			$this->self['price']=NULL;
		}
		
		function get($name){
			return $this->self[$name];
		}

		function set($name, $value){
			$this->self[$name]=$value;
		}
	}