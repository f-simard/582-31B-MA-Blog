<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Filippa Simard">
	<meta name="description" content="Projet Blog - Programmation avancée">
	<link rel="stylesheet" href="assets/css/style.css">
	<title>Soumission d'article</title>
</head>
<body>
	<header>
		<picture>
			<img src="assets/img/316271_clouds_icon.svg" alt="icone de nuage">
		</picture>
		<nav class="navigation">
			<a href="index.php">Accueil</a>
			<a href="article-soumettre.php" class="selected">Partager une pensée</a>
			<a href="admin.php">Administration</a>
		</nav>
	</header>
	<main>
		<section>
		<h1>Partagez votre pensée</h1>
		</section>
		<form id="soumettre-article" action="" method="post">
			<label for="title">Titre de l'article</label>
			<input required type="text" name="title" id="title">
			<label for="content">Votre pensée</label>
			<textarea required type="content" id="content" rows="6" col="75"></textarea>
			<label for="username">Nom d'utilisateur</label>
			<input required type="text" for="username" id="username">
			<fieldset>
				<legend>Catégories</legend>
				<div class="paire">
					<input type="checkbox" name="cat1" id="cat1">
					<label id="cat1">Categorie 1</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="cat2" id="cat2">
					<label id="cat2">Categorie 2</label>
				</div>
				<div class="paire">
					<input type="checkbox" name="cat3" id="cat3">
					<label id="cat1">Categorie 3</label>
				</div>
			</fieldset>
			<label for="tag">Libelés (séparés par des point-virgules)</label>
			<input type="text" name="tag" id="tag" placeholder="Séparer les libelés par des point-virgules">
			<input type="submit" name="submit" value="Soumettre" class="bouton">
		</form>
	</main>
	<footer>
		<h2>582-31B-MA</h2>
		<p>TP 1 - Système web PHP orienté objet avec une base de données MySQL</p>
		<p>&copy; Filippa Simard</p>
	</footer>
</body>
</html>