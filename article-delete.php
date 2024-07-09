<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:article-admin.php');
    exit;
}

$idArticle = $_POST['idArticle'];

require_once("classes/CRUD.php");
$crud = new CRUD();
$delete = $crud->delete('Article', $idArticle, 'idArticle');
$deleteRelationCategory = $crud->delete('Article_has_Category', $idArticle, 'idArticle');
$deleteRelationTag = $crud->delete('Article_has_Tag', $idArticle, 'idArticle');


if ($delete && $deleteRelationCategory && $deleteRelationTag)
{
    header('location:article-admin.php');
}
else {
    print('error');
}
?>