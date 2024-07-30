
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Filippa Simard">
    <meta name="description" content="Projet Blog - Programmation avancée">
    <link rel="stylesheet" href="{{asset}}/css/style.css">
    <title>Tags</title>
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
        <h1>Tags</h1>
        </section>
        <section class="label-list">
			{% for tag in tags %}
			<div>
				<form action="{{base}}/tag/update" method="post">
					<input type="hidden" name="idTag" value="{{tag.idTag}}">
					<input type="text" name="label" id="label" value="{{tag.label}}">
					<button class="bouton">Sauvegarder</button>
				</form>
				<form action="{{base}}/tag/delete" method="post">
					<input type="hidden" name="idTag" value="{{tag.idTag}}">
					<button class="bouton rouge">Supprimer</button>
				</form>
			</div>
			{% endfor %}
			{% if errors.tag is defined %}
				<span class="error">{{errors.tag}}</span>
			{% endif %}
        </section>
    </main>
    <footer>
        <h2>582-31B-MA</h2>
        <p>TP 1 - Système web PHP orienté objet avec une base de données MySQL</p>
        <p>&copy; Filippa Simard</p>
    </footer>
</body>
</html>