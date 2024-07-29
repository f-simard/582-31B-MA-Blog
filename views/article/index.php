<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Filippa Simard">
	<meta name="description" content="Projet Blog - Programmation avancée">
	<link rel="stylesheet" href="{{asset}}/css/style.css">
	<title>Accueil</title>
</head>
<body>
	<header>
		<picture>
			<img src="{{asset}}/img/316271_clouds_icon.svg" alt="icone de nuage">
		</picture>
		<nav class="navigation">
			<a href="{{base}}" class="selected">Accueil</a>
			<a href="{{base}}/article/create">Partager une pensée</a>			
			<a href="TP/compte-soumettre.php">Créer un compte</a>			
			<a href="{{base}}/admin">Administration</a>
		</nav>
	</header>
	<main>
		<section>
		<h1>Titre</h1>
		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae quidem alias cumque dolor earum quo voluptatum ut nostrum eius veniam. Sint voluptatem fugiat exercitationem sed? Qui ipsam natus omnis illum?</p>
		</section>
		<section class="article-liste">

		{% for article in articles %}
			<article class="article">
			<h2>{{article.title}} <a href="{{base}}/article/show?idArticle={{article.idArticle}}" class="lire">&#10097;</a></h2>
					<div data-category>
					{# //source:https://twig.symfony.com/doc/3.x/tags/if.html #}
					{% if article.categories %}
						{% for category in article.categories %}
							<span>{{ category }}</span>
						{% endfor %}
					{% else %}
						<span><i>Sans catégorie</i></span>
					{% endif %}
				</div>
				<div data-tags>
				{% if article.tags %}
					{% for tag in article.tags %}
						<span>{{tag}}</span>
					{% endfor %}
				{% else %}
					<span><i>Sans Tag</i></span>
				{% endif %}
				</div>

			</article>
		{% endfor %}

		</section>
	</main>
	<footer>
		<h2>582-31B-MA</h2>
		<p>TP 2 - Architecture MVC</p>
		<p>&copy; Filippa Simard</p>
	</footer>
</body>
</html>