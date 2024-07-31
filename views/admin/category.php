<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Filippa Simard">
    <meta name="description" content="Projet Blog - Programmation avancée">
    <link rel="stylesheet" href="{{asset}}/css/style.css">
    <title>Catégorie</title>
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
        <h1>Catégorie</h1>
        </section>
        <section class="label-list">
		{% if success is defined %}
			<span class="success">{{success}}</span>
		{% endif %}
		{% if errors.category is defined %}
			<span class="error">{{errors.category}}</span>
		{% endif %}
		{% if errors.msg is defined %}
			<span class="error">{{errors.msg}}</span>
		{% endif %}
		{% for category in categories %}
		<div>
			<form action="{{base}}/admin/category/update" method="post">
				<input type="hidden" name="idCategory" value="{{category.idCategory}}">
				<input type="text" name="label" id="label" value="{{category.label}}">
				<button class="bouton">Sauvegarder</button>
			</form>
			<form action="{{base}}/admin/category/delete" method="post">
				<input type="hidden" name="idCategory" value="{{category.idCategory}}">
				<button class="bouton rouge">Supprimer</button>
			</form>
			</div>
			{% endfor %}
			<form action="{{base}}/admin/category/create" method="post">
				<input type="text" name="label" id="label">
				<button class="bouton">Créer</button>
			</form>
        </section>
    </main>
    <footer>
        <h2>582-31B-MA</h2>
        <p>TP 1 - Système web PHP orienté objet avec une base de données MySQL</p>
        <p>&copy; Filippa Simard</p>
    </footer>
</body>
</html>