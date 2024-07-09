<?php

require_once("classes/CRUD.php");

$crud = new CRUD;
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
		<h1>Créer un compte</h1>
		</section>
		<form class="soumettre" action="compte-create.php" method="post">
			<label for="firstName">Prénom</label>
			<input type="text" name="firstName" id ="firstName">
			<label for="lastName">Nom de famille</label>
			<input type="text" name="lastName" id ="lastName">
			<label required for="username">Nom d'utilisateur	</label>
			<input type="text" name="username" id ="username">
			<label for="email">Courriel</label> <input type="email" name="email" id ="email">
			<label for="password">Mot de passe</label>
			<input type="text" name="password" id ="password">
			<div>
				<input type="checkbox" name="isAdmin" id ="isAdmin">
				<label for="isAdmin">Admin</label>
			</div>
			<input type="submit" value="Sauvegarder" class="bouton">
		</form>
	</main>
	<footer>
		<h2>582-31B-MA</h2>
		<p>TP 1 - Système web PHP orienté objet avec une base de données MySQL</p>
		<p>&copy; Filippa Simard</p>
	</footer>
</body>
</html>