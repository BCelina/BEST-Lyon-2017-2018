<?php
	include_once(__DIR__."/../../autoloader.php");
	
	class ContentFactory{
		static public function build($object_family_name){
			switch($object_family_name){
				case "page": 
					if(func_num_args() == 2){
						return Page::get(func_get_arg(1));
					}
					else{
						return new Page("", "");
					}
			}
		}
		
		static public function buildArray($object_family_name){
			switch($object_family_name){
				case "page": 
					if(func_num_args() == 2){
						 $result = new PageArray(func_get_arg(1));
						 $result->get();
						 return $result;
					}
					else{
						$result = new PageArray();
						$result->get();
						return $result;
					}
			}
		}
	}
?>