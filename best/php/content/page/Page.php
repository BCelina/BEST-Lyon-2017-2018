<?php
	include_once(__DIR__."/../../../autoloader.php");
	
	final class Page extends ContentObject{
		public $author;
		public $is_event;
		
		public function __construct($title, $content){			
			$number_of_parameters = func_num_args();
			if($number_of_parameters <= 6){
				$date = $number_of_parameters>=3 ? func_get_arg(2) : '';
				$id = $number_of_parameters>=4 ? func_get_arg(3) : '';
				$this->author = $number_of_parameters>=5 ? func_get_arg(4) : '';
				$this->is_event = $number_of_parameters==6 ? func_get_arg(5) : FALSE;
				parent::__construct($title, $content, $date, $id);
				
				$this->form_add
					->add_hidden("type", "Page")
					->add_text("title", "Page title")
					->add_checkbox("is_event", "TRUE", "&Eacute;v&egrave;nement")
					->add_textarea("content", "");
				$this->form_modify
					->add_hidden("type", "Page")
					->add_hidden("id", $this->id)
					->add_text("title", "", $this->title)
					->add_checkbox("is_event", "TRUE", "&Eacute;v&egrave;nement", $this->is_event)
					->add_textarea("content", "", $this->content);
			}
			else{
				throw new InvalidArgumentException("Too much parameters");
			}
		}
		
		//fetch a page that already exists using $param
		public function get($param){
			if(is_int($param) OR is_string($param)){
					$page = PageManager::get($param);
					if(is_null($page)){
						return null;
					}
					return new Page($page["title"], $page["content"], $page["date"], $page["id"], $page["author"], $page["is_event"]);
			}
			else{
				throw new InvalidArgumentException("Param must be string or integer");
			}
		}
		
		public function add(){
			PageManager::add($this->title, $this->content, $this->author, $this->is_event);
		}
		
		public function modify($id){
			PageManager::modify($id, $this->title, $this->content, $this->is_event);
		}
		
		public function delete(){
			PageManager::delete($this->id);
		}
		
		public function display_as_item(){
			$page_title = basename($_SERVER['PHP_SELF']); //page qui inclue notre fichier
			if($page_title == "admin.php"){
				$format = "
					<li>
						<a href='%s?page=page&mode=2&id=%s'>%s</a>
					</li>
				";
				echo sprintf($format, $page_title, $this->identifier(), $this->title);
			}
			else{
				$format = "
					<li>
						<a href='events.php?id=%s'>%s</a>
					</li>
				";
				echo sprintf($format, $this->identifier(), $this->title);
			}
		}
		
		public function display_full_page(){
			if(!is_null($this->content)){
				echo $this->content;
			}
			else{
				echo "No content";
			}
		}
	}
?>