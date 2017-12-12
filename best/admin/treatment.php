<?php
	include_once(__DIR__."/../autoloader.php");
	switch($_POST["type"]){
		case "Page": 
			$id = isset($_POST["id"]) ? $_POST["id"] : "";
			$is_event = isset($_POST["is_event"]) ? TRUE : FALSE;
			$title = isset($_POST["title"]) ? $_POST["title"] : "";
			$content = isset($_POST["content"]) ? $_POST["content"] : "";
			$date = isset($_POST["date"]) ? $_POST["date"] : "";
			$author = isset($_POST["author"]) ? $_POST["author"] : "";
			$page = new Page($title, $content, $date, "", $author, $is_event);
			
			//echo $title, $content, $author;
			$pdo_singleton = new PDOSingleton();
			if($_GET["mode"] == 1){
				$page->add();
				echo "Adding complete";
				header("location: admin.php?page=page&mode=2");
			}
			elseif($_GET["mode"] == 2){
				$page->modify($id);
				echo 'Modification complete';
				header("location: admin.php?page=page&mode=2");
			}
			else{
				echo "Error : no correct mode";
			}
			break;
	}
?>