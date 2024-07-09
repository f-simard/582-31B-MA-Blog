<?php

require_once("classes/CRUD.php");
$crud = new CRUD;
$select = $crud->select('User', "idUser");

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
            <a href="index.php">Accueil</a>
			<a href="article-soumettre.php">Partager une pensée</a>
			<a href="compte-soumettre.php">Créer un compte</a>			
            <a href="admin.php"  class="selected">Administration</a>
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
		<div class="compte">
			<form action="compte-modifier.php" method="get">
				<input type="hidden" name="idUser" value="<?= $row['idUser'] ?>">
				<p><?= $row['firstName'];?> <?= $row['lastName'];?> (<?= $row['username'];?>)</p>
				<button class="bouton end">Modifier</button>
			</form>
			<form action="compte-delete.php" method="post">
				<input type="hidden" name="idUser" value="<?= $row['idUser'] ?>">
				<button class="bouton rouge">Supprimer</button>
			</form>
			</div>
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