<?php

if (isset($_GET['idArticle']) && $_GET['idArticle'] != null){
	$idArticle = $_GET['idArticle'];

	
	require_once("classes/CRUD.php");
	$crud = new CRUD;
	$select = $crud->selectByField('article', $idArticle , 'idArticle');

	$auteur = $crud->getArticleAuthor($idArticle);

	if ($select){
		foreach($select as $key=>$value){
			$$key = $value;
		}
	} else {
		header('location:index.php');
		exit;
	}

} else {
	header('location:index.php');
	exit;
}

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
    <title>Accueil</title>
</head>
<body>
    <header>
        <picture>
            <img src="assets/img/316271_clouds_icon.svg" alt="icone de nuage">
        </picture>
        <nav class="navigation">
            <a href="index.php" class="selected">Accueil</a>
			<a href="article-soumettre.php">Partager une pensée</a>
            <a href="admin.php">Administration</a>
        </nav>
    </header>
    <main>
        <section class="article">
        <h1><?= $title; ?> </h1>
		<h3>By <?= $auteur[0]['firstName'];?> <?= $auteur[0]['lastName']; ?></h3>
		<p><small>Catégorie: </small></p>
		<p><small>Tags: </small></p>
        <p><?= $content; ?></p>
        </section>
    </main>
    <footer>
        <h2>582-31B-MA</h2>
        <p>TP 1 - Système web PHP orienté objet avec une base de données MySQL</p>
        <p>&copy; Filippa Simard</p>
    </footer>
</body>
</html>