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
        <h1>Options</h1>
        </section>
		<section class="option-admin">
			<a href="{{base}}/admin/article" class="bouton">Articles</a>
			<a href="compte-admin.php" class="bouton">Comptes</a>
			<a href="{{base}}/admin/category" class="bouton">Catégories</a>
			<a href="{{base}}/admin/tag" class="bouton">Tags</a>
		</section>
    </main>
    <footer>
        <h2>582-31B-MA</h2>
        <p>TP 1 - Système web PHP orienté objet avec une base de données MySQL</p>
        <p>&copy; Filippa Simard</p>
    </footer>
</body>
</html>