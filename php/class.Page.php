<?php
/**
 *  
 *  Copyright (C) 2013
 *
 *
 *  @who	   	PAJ
 *  @info   	paj@gaiterjones.com
 *  @license    -
 * 	
 *
 */


class Page {
	
	public $__;
	public $__config;
	
		public function __construct($_variables) {
		
			// load class variables
			foreach ($_variables as $key => $value)
			{
				$this->set($key,$value);
			}

			// load app variables
			$this->__config= new config();
			
	
		}
		
	    function __destruct() {
	       
	       unset($this->__config);
	       unset($this->__);
	       
	    }
	   
		public function set($key,$value)
		{
		    $this->__[$key] = $value;
		}
		
	  	public function get($variable)
		{
		    return $this->__[$variable];
		}
		
		
			   
	   // helpers
	   
	   
	   public function loadClassVariables($_variableArray)
	   {
			if(is_array($_variableArray)) {
			
				foreach ($_variableArray as $key => $value)
				{
					$this->set($key,$value);
				}
			} 
			   
	    }

}
?>