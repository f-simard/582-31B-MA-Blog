<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:categories.php');
    exit;
}

require_once("classes/CRUD.php");
$crud = new CRUD();
$update = $crud->update('Article', $_POST, 'idArticle');

if($update){
    header('location:article.php?idArticle='.$update);
}
else{
    echo 'error';
}
