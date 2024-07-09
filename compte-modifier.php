<?php

if (isset($_GET['idUser']) && $_GET['idUser'] != null){
	$idUser = $_GET['idUser'];

	
	require_once("classes/CRUD.php");
	$crud = new CRUD;
	$select = $crud->selectByField('User', $idUser , 'idUser');

	if ($select){
		foreach($select as $key=>$value){
			$$key = $value;
		}
	} else {
		header('location:index.php');
		exit;
	}


} else {
	header('location:index.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Filippa Simard">
	<meta name="description" content="Projet Blog - Programmation avancée">
	<link rel="stylesheet" href="assets/css/style.css">
	<title>Accueil</title>
</head>
<body>
	<header>
		<picture>
			<img src="assets/img/316271_clouds_icon.svg" alt="icone de nuage">
		</picture>
		<nav class="navigation">
			<a href="index.php">Accueil</a>
			<a href="article-soumettre.php">Partager une pensée</a>			
			<a href="compte-soumettre.php" class="selected" >Créer un compte</a>			
			<a href="admin.php">Administration</a>
		</nav>
	</header>
	<main>
		<section>
		<h1>Modifier</h1>
		</section>
		<form class="soumettre" action="compte-update.php" method="post">
			<input type="hidden" name="idUser" value="<?= $idUser; ?>">
			<label for="firstName">Prénom</label>
			<input type="text" name="firstName" id ="firstName" value="<?= $firstName; ?>">
			<label for="lastName">Nom de famille</label>
			<input type="text" name="lastName" id ="lastName" value="<?= $lastName; ?>">
			<label required for="username">Nom d'utilisateur	</label>
			<input type="text" name="username" id ="username" value="<?= $username; ?>">
			<label for="email">Courriel</label> <input type="email" name="email" id ="email" value="<?= $email; ?>">
			<label for="password">Mot de passe</label>
			<input type="text" name="password" id ="password" value="<?= $password; ?>">
			<input type="submit" class="bouton">
		</form>
	</main>
	<footer>
		<h2>582-31B-MA</h2>
		<p>TP 1 - Système web PHP orienté objet avec une base de données MySQL</p>
		<p>&copy; Filippa Simard</p>
	</footer>
</body>
</html>