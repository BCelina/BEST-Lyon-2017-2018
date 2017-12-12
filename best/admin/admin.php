<?php
	include_once("../autoloader.php");
	
	session_start();
	if(!isset($_SESSION["login"])){
		header("location: ../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Best Lyon : Administration</title>
		<script src="../ckeditor/ckeditor.js"></script>
		<link type="text/css" rel="stylesheet" href="../css/graphic_charter_admin.css"/>
		<link href='https://fonts.googleapis.com/css?family=Libre+Baskerville' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php include_once("navigation_admin.php"); ?>
		
		<section id="administration_panel">
			<?php
				//factory qui crée un tableau d'objets à administrer selon la valeur du paramètre $_GET['page']
				if(isset($_GET["page"])){
					if(isset($_GET["mode"]) && is_numeric($_GET["mode"])){
						if($_GET["mode"] == 1){
							$content = ContentFactory::build($_GET["page"]);
							echo "<h1>Contenu &agrave; ajouter : <h1>";
							$content->form_add->display("treatment.php?mode=1", "post");
						}
						else{
							$pdo_singleton = new PDOSingleton();
							if(isset($_GET['id']) && is_numeric($_GET['id'])){
								$content = ContentFactory::build($_GET["page"], $_GET["id"]);
								echo "<h1>Contenu &agrave; modifier : <h1>";
								$content->form_modify->display("treatment.php?mode=2", "post");
							}
							else{
								$array = ContentFactory::buildArray($_GET["page"]);
								echo "<h1>Contenu disponible : <h1>";
								$array->display_list();
							}
						}
					}
				}
				else{
					echo "<h1>Bienvenue sur l'espace d'administration</h1>";
				}
			?>
		</section>
		
		<?php include_once("footer_admin.php"); ?>
		<script>
			var roxyFileman = '../fileman/index.html'; 
			CKEDITOR.replace('editor1',{
			filebrowserBrowseUrl:roxyFileman,
			filebrowserImageBrowseUrl:roxyFileman+'?type=image'
			}); 
			//faire fonctionner fileman : modifier juste le path dans le conf.json
	    </script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	</body>
</html>