<?php
	include_once(__DIR__."/../../autoloader.php");
	
	class ContentObject{
		protected $id;
		public $title;
		public $content;
		protected $date;
		
		public $form_add; //Form object
		public $form_modify; //Form object
		
		protected function __construct($title, $content){
			$this->title = htmlspecialchars($title, ENT_NOQUOTES);
			$this->content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $content);
			
			$number_of_parameters = func_num_args();
			if($number_of_parameters > 2){
				$test_date = strtotime(func_get_arg(2));
				if ($test_date === false && !(func_get_arg(2) == '')) {
				    throw new InvalidArgumentException('bad date');
				}
				$this->date = date('Y-m-d G:i:s', $test_date);
				
				if($number_of_parameters == 4){
					if(is_numeric(func_get_arg(3)) || func_get_arg(3) === ''){
						$this->id = func_get_arg(3);
					}
					else{
						throw new InvalidArgumentException('id NaN');
					}
				}
			}
			
			$this->form_add = new Form();
			$this->form_modify = new Form();
		}
		
		//getter
		public function identifier(){
			return $this->id;
		}
		
		//getter
		public function when(){
			return "Le ".date("d/m/Y G\hi", strtotime($this->date));
		}
	}
?>