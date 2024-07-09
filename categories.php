<?php

require_once("classes/CRUD.php");
$crud = new CRUD;
$select = $crud->select('Category', "idCategory");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Filippa Simard">
    <meta name="description" content="Projet Blog - Programmation avancée">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Catégorie</title>
</head>
<body>
    <header>
        <picture>
            <img src="assets/img/316271_clouds_icon.svg" alt="icone de nuage">
        </picture>
        <nav class="navigation">
            <a href="index.php" class="selected">Accueil</a>
            <a href="soumettre-article.php">Partager une pensée</a>
            <a href="admin.php">Administration</a>
        </nav>
    </header>
    <main>
        <section>
        <h1>Catégorie</h1>
        </section>
        <section class="label-list">
        <?php
        foreach($select as $row){
        ?>
		<div>
			<form action="categorie-update.php" method="post">
				<input type="hidden" name="idCategory" value="<?= $row['idCategory'] ?>">
				<input type="text" name="label" id="label" value="<?= $row['label'] ?>">
				<button class="bouton">Sauvegarder</button>
			</form>
			<form action="categorie-delete.php" method="post">
				<input type="hidden" name="idCategory" value="<?= $row['idCategory'] ?>">
				<button class="bouton rouge">Supprimer</button>
			</form>
			</div>
				<?php
					}
					?>
			<form action="categorie-create.php" method="post">
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