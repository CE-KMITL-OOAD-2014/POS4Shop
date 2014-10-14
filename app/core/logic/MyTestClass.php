<?php
	namespace ceddd;

	class MyTestClass {
		protected $self = array();
		public function __construct() {
	        $args = func_get_args();
	        for( $i=0, $n=count($args); $i<$n; $i++ )
            	$this->add($args[$i]);
	    }

	    public function __get( /*string*/ $name = null ) {
	        return $this->self[$name];
	    }

	    public function add($a,$b){
	    	return  $a+$b;
	    }
	}