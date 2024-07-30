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
			<a href="{{base}}">Accueil</a>
			<a href="{{base}}/article/create">Partager une pensée</a>	
			<a href="compte-soumettre.php">Créer un compte</a>			
			<a href="{{base}}/admin">Administration</a>
        </nav>
    </header>
    <main>
        <section class="article">
        <h1>{{article.title}}</h1>
		<h3>By {{auteur}}</h3>
		<p><small>Catégorie: {{categoriesString}}</small></p>
		<p><small>Tags: {{tagsString}}</small></p>
        <p>{{article.content}}</p>
        </section>
		<form action="{{base}}/article/edit" method="get">
				<input type="hidden" name="idArticle" value="{{article.idArticle}}">
				<button class="bouton">Modifier</button>
			</form>
    </main>
    <footer>
        <h2>582-31B-MA</h2>
        <p>TP2 - Architecture MVC</p>
        <p>&copy; Filippa Simard</p>
    </footer>
</body>
</html>