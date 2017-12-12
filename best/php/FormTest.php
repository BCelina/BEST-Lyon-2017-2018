<?php
	include_once(__DIR__."/../autoloader.php");
	
	$form = new Form();
	$form->add_text("nom", "Votre nom");
	$form->add_date("date", "Format JJMMYY");
	$form->add_password("passw","Votre mot de passe ici :");
	$form->add_textarea("bio","Je vis  a Tonneins");
	$form->add_checkbox("etudiant", "1", "Etudiant", TRUE);
	$form->add_checkbox("bob", "2", "Bob");
	$form->display("./../index.php", "get");
?>