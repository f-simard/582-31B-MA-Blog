<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:categories.php');
    exit;
}

$idCategory = $_POST['idCategory'];

require_once("classes/CRUD.php");
$crud = new CRUD();
$delete = $crud->delete('Category', $idCategory, 'idCategory');
$deleteRelation = $crud->delete('Article_has_Category', $idCategory,'idCategory');



if ($delete && $deleteRelation)
{
    header('location:categories.php');
}
else {
    print('error');
}
?>