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
            <a href="article.php">Partager une pensée</a>
            <a href="admin.php">Administration</a>
        </nav>
    </header>
    <main>
        <section>
        <h1>Titre</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae quidem alias cumque dolor earum quo voluptatum ut nostrum eius veniam. Sint voluptatem fugiat exercitationem sed? Qui ipsam natus omnis illum?</p>
        </section>
        <section class="article-list">
            <article class="article">
                <h2>{{Titre}}</h2>
                <div data-category><span>{{Cat1}}</span><span>{{Cat2}}</span></div>
                <div data-tags><span>{{Tag2}}</span><span>{{Tag1}}</span><span>{{Tag3}}</span</div>
            </article>
            <article class="article">
                <h2>{{Titre}}</h2>
                <div data-category><span>{{Cat1}}</span><span>{{Cat2}}</span></div>
                <div data-tags><span>{{Tag2}}</span><span>{{Tag1}}</span><span>{{Tag3}}</span</div>
            </article>
            <article class="article">
                <h2>{{Titre}}</h2>
                <div data-category><span>{{Cat1}}</span><span>{{Cat2}}</span></div>
                <div data-tags><span>{{Tag2}}</span><span>{{Tag1}}</span><span>{{Tag3}}</span</div>
            </article>
        </section>
    </main>
    <footer>
        <h2>582-31B-MA</h2>
        <p>TP 1 - Système web PHP orienté objet avec une base de données MySQL</p>
        <p>&copy; Filippa Simard</p>
    </footer>
</body>
</html>