<?php
	include_once(__DIR__."/../../../autoloader.php");
	define("DEFAULT_MAX_SIZE", 1000);
	
	class PageArray{
		public $pages;
		public $size;
		public $max_size;
		
		public function __construct(){
			if(func_num_args() <= 1){
				$this->size = 0;
				$this->max_size = DEFAULT_MAX_SIZE;
				if(func_num_args() == 1){
					$this->max_size = func_get_arg(0);
				}
			}
			else{
				throw new InvalidArgumentException("Too much parameters");
			}
		}
		
		public function add($page){
			if($this->size + 1 <= $this->max_size){
				$this->pages[$this->size++] = $page;
			}
			else{
				throw new OutOfBoundsException("Array size is limited to ".$this->max_size);	
			}
		}
		
		public function get(){
			$pages = PageManager::get();
			foreach($pages as $page){
				$this->add(new Page($page["title"], $page["content"], $page["date"], $page["id"], $page["author"], $page['is_event']));
			}
		}
		
		public function get_events(){
			$pages = PageManager::get();
			foreach($pages as $page){
				if($page['is_event'] == TRUE){
					$this->add(new Page($page["title"], $page["content"], $page["date"], $page["id"], $page["author"], $page['is_event']));
				}
			}
		}
		
		public function display_list(){
			if($this->size>0){
				echo "<ul class='page_list'>";
					foreach($this->pages as $page){
						$page->display_as_item();
					}
				echo "</ul>";
			}
			else{
				echo "Pas de pages &agrave; afficher";
			}
		}	
	}
?>