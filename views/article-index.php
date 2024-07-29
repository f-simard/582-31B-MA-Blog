<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Filippa Simard">
    <meta name="description" content="Projet Blog - Programmation avancée">
    <link rel="stylesheet" href="<?= ASSET; ?>css/style.css">
    <title>Accueil</title>
</head>
<body>
    <header>
        <picture>
            <img src="<?= ASSET; ?>/img/316271_clouds_icon.svg" alt="icone de nuage">
        </picture>
        <nav class="navigation">
            <a href="index.php" class="selected">Accueil</a>
            <a href="article-soumettre.php">Partager une pensée</a>			
            <a href="compte-soumettre.php">Créer un compte</a>			
            <a href="admin.php">Administration</a>
        </nav>
    </header>
    <main>
        <section>
        <h1>Titre</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae quidem alias cumque dolor earum quo voluptatum ut nostrum eius veniam. Sint voluptatem fugiat exercitationem sed? Qui ipsam natus omnis illum?</p>
        </section>
        <section class="article-liste">
        <?php
        foreach($select as $row){

			$categories = $crud->getArticleCategory($row['idArticle']);
			$tags = $crud->getArticleTag($row['idArticle']);

        	?>
            <article class="article">
			<h2><?= $row['title']?> <a href="article.php?idArticle=<?= $row['idArticle']?>" class="lire">&#10097;</a></h2>
                <div data-category>
				<?php
				if($categories) {
					foreach($categories as $category){
						?><span><?= $category['label']; ?></span><?php
					}
				} else {
					?>
					<span><i>Sans catégorie</i></span>
					<?php
				} 
				?>
				</div>
                <div data-tags>
				<?php
				if($tags) {
					foreach($tags as $tag){
						?><span><?= $tag['label']; ?></span><?php
					}
				} else {
					?>
					<span><i>Sans Tag</i></span>
					<?php
				} 
				?>
				</div>

            </article>
			<?php
        }
        ?>
        </section>
    </main>
    <footer>
        <h2>582-31B-MA</h2>
        <p>TP 1 - Système web PHP orienté objet avec une base de données MySQL</p>
        <p>&copy; Filippa Simard</p>
    </footer>
</body>
</html>