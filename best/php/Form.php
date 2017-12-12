<?php
	class Form{
		public $inputs; //Array containing all of the inputs
		public $size;
		public $submit; //Boolean to know whether or not it is possible to submit the form
		
		public function __construct(){
			$this->size = 0;
			$this->submit = TRUE;
			
			$number_of_parameters = func_num_args();
			if($number_of_parameters <= 1){
				if($number_of_parameters == 1){
					$submittable = func_get_arg(0);
					if(is_bool($submittable)){
						$this->submit = $submittable;
					}
					else{
						throw new InvalidArgumentException("The parameter must be a boolean");
					}
				}
			}
			else{
				throw new InvalidArgumentException("Too much parameters");
			}
		}
		
		public function add_text($name, $placeholder){
			$name = htmlspecialchars($name);
			$placeholder = htmlspecialchars($placeholder);
			
			$number_of_parameters = func_num_args();
		  	$value = $number_of_parameters==3 ? htmlspecialchars(func_get_arg(2), ENT_NOQUOTES):'';
			$this->inputs[$this->size++] = sprintf("<input type='text' name='%s' placeholder='%s' value='%s'/>", $name, $placeholder, $value);
			return $this;
		}
		
		public function add_date($name, $placeholder){
			$name = htmlspecialchars($name);
			$placeholder = htmlspecialchars($placeholder);
			
			$number_of_parameters = func_num_args();
		  	$value = $number_of_parameters==3 ? htmlspecialchars(func_get_arg(2), ENT_NOQUOTES):'';
			$this->inputs[$this->size++] = sprintf("<input type='date' name='%s' placeholder='%s' value='%s'/>", $name, $placeholder, $value);
			return $this;
		}
		
		public function add_password($name, $placeholder){
			$name = htmlspecialchars($name);
			$placeholder = htmlspecialchars($placeholder);
			$this->inputs[$this->size++] = sprintf("<input type='password' placeholder='%s' name='%s'/>", $placeholder, $name);
			return $this;
		}
		
		public function add_textarea($name, $placeholder){
			$name = htmlspecialchars($name);
			$placeholder = htmlspecialchars($placeholder);
			
			$number_of_parameters = func_num_args();
		  	$value = $number_of_parameters==3 ? htmlspecialchars(func_get_arg(2), ENT_NOQUOTES):'';
			$this->inputs[$this->size++] = sprintf("<textarea name='%s' class='ckeditor' id='editor1' placeholder='%s'>%s</textarea>", $name, $placeholder, $value);
			return $this;
		}
		
		public function add_hidden($name, $value){
			$name = htmlspecialchars($name);
			$value = htmlspecialchars($value);

			$this->inputs[$this->size++] = sprintf("<input type='hidden' name='%s' value='%s'>", $name, $value);
			return $this;
		}
		
		public function add_checkbox($name, $value, $description){
			$name = htmlspecialchars($name);	
			$value = htmlspecialchars($value);
			if(func_num_args() == 4 && func_get_arg(3) == TRUE){
				$is_checked = func_get_arg(3); 
				$this->inputs[$this->size++] = sprintf("<input type='checkbox' name='%s' value='%s' checked/> %s", $name, $value, $description);
			}
			else{
				$this->inputs[$this->size++] = sprintf("<input type='checkbox' name='%s' value='%s'/> %s", $name, $value, $description);
			}
			return $this;
		}
		
		public function display($destination, $method){
			if($this->size > 0){
				$format = "
					<form action='%s' method='%s' enctype='multipart/form-data'>
				";
				echo sprintf($format, $destination, $method);
				foreach($this->inputs as $input){
					echo $input;
					echo "</br>";
				}
				if($this->submit){
					echo "<input type='submit' value='Envoyer'/>";
				}
				echo "</form>";
			}
		}
	}
?>