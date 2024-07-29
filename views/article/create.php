<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Filippa Simard">
	<meta name="description" content="Projet Blog - Programmation avancée">
	<link rel="stylesheet" href="{{asset}}/css/style.css">
	<title>Soumission d'article</title>
</head>
<body>
	<header>
		<picture>
			<img src="{{asset}}/img/316271_clouds_icon.svg" alt="icone de nuage">
		</picture>
		<nav class="navigation">
			<a href="{{base}}">Accueil</a>
			<a href="{{base}}/article/create"class="selected" >Partager une pensée</a>	
			<a href="compte-soumettre.php">Créer un compte</a>			
			<a href="{{base}}/admin">Administration</a>
		</nav>
	</header>
	<main>
		<section>
		<h1>Partagez votre pensée</h1>
		</section>
		<form class="soumettre" id="soumettre-article" method="post">
			<label for="title">Titre de l'article</label>
			<input required type="text" name="title" id="title">
			<label for="content">Votre pensée</label>
			<textarea required type="content" name="content" id="content" rows="6" col="75"></textarea>
			<label for="username">Nom d'utilisateur</label>
			<input required type="text" name="username" id="username">
			<fieldset>
				<legend>Catégories</legend>
				{% if categories %}
					{% for category in categories %}
					<div class="paire">
						<input type="checkbox" name="cat{{category.idCategory}}" id="{{category.label}}">
						<label id="{{category.label}}">{{category.label}}</label>
					</div> 
					{% endfor %}
				{% else %}
					<p>Aucune catégorie disponible</p>
				{% endif %}
			</fieldset>
			<label for="tag">Libelés (séparés par des point-virgules)</label>
			<input type="text" name="tag" id="tag" placeholder="Séparer les libelés par des point-virgules">
			<input type="submit" name="submit" value="Soumettre" class="bouton">
		</form>
	</main>
	<footer>
		<h2>582-31B-MA</h2>
		<p>TP 2 - Architecture MVC</p>
		<p>&copy; Filippa Simard</p>
	</footer>
</body>
</html>