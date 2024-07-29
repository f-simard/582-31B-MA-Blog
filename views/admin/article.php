<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Filippa Simard">
	<meta name="description" content="Projet Blog - Programmation avancée">
	<link rel="stylesheet" href="{{asset}}/css/style.css">
	<title>Admin</title>
</head>
<body>
	<header>
		<picture>
			<img src="{{asset}}/img/316271_clouds_icon.svg" alt="icone de nuage">
		</picture>
		<nav class="navigation">
		<a href="{{base}}">Accueil</a>
			<a href="{{base}}/article/create">Partager une pensée</a>	
			<a href="compte-soumettre.php">Créer un compte</a>			
			<a href="{{base}}/admin" class="selected">Administration</a>
		</nav>
	</header>
	<main>
		<section>
		<h1>Articles</h1>
		</section>
		<section class="label-list">
		{% for article in articles %}
			<div class="doubleForm">
				<form action="{{base}}/article/edit" method="get">
					<input type="hidden" name="idArticle" value="{{article.idArticle}}">
					<p>{{article.title}}</p>
					<button class="bouton end">Modifier</button>
				</form>
				<form action="{{base}}/article/" method="post">
					<div class="auto">
						<input type="hidden" name="idArticle" value="{{article.idArticle}}">
						<button class="bouton rouge">Supprimer</button>
					</div>
				</form>
			</div>
		{% endfor %}
		</section>
	</main>
	<footer>
		<h2>582-31B-MA</h2>
		<p>TP2 - Architecture MVC</p>
		<p>&copy; Filippa Simard</p>
	</footer>
</body>
</html>