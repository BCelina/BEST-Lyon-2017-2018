<?php
	include_once(__DIR__."/../../../autoloader.php");
	class PageManager{
		public function get(){
			global $pdo_singleton;
			$num_args = func_num_args();
			
			if($num_args <= 1){
				if($num_args == 1){
					$param = func_get_arg(0);
					if(is_numeric($param)){
						return $pdo_singleton->get_connexion()->query('SELECT * FROM Page WHERE id="'.$param.'"')->fetch();
					}
					else{
						return $pdo_singleton->get_connexion()->query('SELECT * FROM Page WHERE title="'.$param.'"')->fetch();
					}
				}
				else{
					return $pdo_singleton->get_connexion()->query('SELECT * FROM Page')->fetchAll();
				}
			}
			else{
				throw new InvalidArgumentException("Too much arguments");
			}
		}
		
		public function add($title, $content, $author, $is_event){
			global $pdo_singleton;
			echo "je vais ajouter ", $title, $content, $author;
			$request = $pdo_singleton->get_connexion()->prepare("INSERT INTO Page (title, content, author, is_event) VALUES(:title, :content, :author, :is_event)");
			$request->execute(array(
				"title"=>$title,
				"content"=>$content,
				"author"=>$author,
				"is_event"=>$is_event
			));
		}
		
		public function modify($id, $title, $content, $is_event){
			global $pdo_singleton;
			$request = $pdo_singleton->get_connexion()->prepare("UPDATE Page SET title=:title, content=:content, is_event=:is_event WHERE id=:id");
			$request->execute(array(
				"title"=>$title,
				"content"=>$content,
				"is_event"=>$is_event,
				"id"=>$id
			));
		}
		
		public function delete($param){
			global $pdo_singleton;
			if(is_numeric($param)){
				$requete = $pdo_singleton->get_connexion()->exec("DELETE FROM Page WHERE id='".$param."'");
			}
			else{
				$requete = $pdo_singleton->get_connexion()->exec("DELETE FROM Page WHERE title='".$param."'");	
			}
		}
	}
?>