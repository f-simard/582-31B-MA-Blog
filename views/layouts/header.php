<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Filippa Simard">
	<meta name="description" content="Projet Blog - Programmation avancée">
	<link rel="stylesheet" href="{{asset}}/css/style.css">
	<title>{{title}}</title>
</head>
<body>
	<header>
		<picture>
			<img src="{{asset}}/img/316271_clouds_icon.svg" alt="icone de nuage">
		</picture>
		<nav class="navigation">
			<a href="{{base}}" {% if navActive=="accueil" %} class="selected" {% endif %}">Accueil</a>
			<a href="{{base}}/article/create" {% if navActive=="newArticle" %} class="selected" {% endif %}>Partager une pensée</a>	
			<a href="{{base}}/user/create" {% if navActive=="newUser" %} class="selected" {% endif %}>Créer un compte</a>			
			<a href="{{base}}/admin" {% if navActive=="admin" %} class="selected" {% endif %}>Administration</a>
		</nav>
	</header>
	<main>