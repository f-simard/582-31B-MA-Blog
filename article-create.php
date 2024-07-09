<?php

require_once("classes/CRUD.php");

$data = [];

echo '<prep>';
print_r($_POST);
echo '</prep>';

$data['username'] = $_POST['username'];
$data['content'] = $_POST['content'];
$data['title'] = $_POST['title'];

$crud = new CRUD();
$insert = $crud->insert('article', $data);

//TODO: inserer relation Categorie

//TODO: inserer tags s'il n'existe pas deja
//TODO: inserer relation tags

header('location:article.php?id='.$insert);


