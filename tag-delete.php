<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:tag.php');
    exit;
}

$idTag = $_POST['idTag'];

require_once("classes/CRUD.php");
$crud = new CRUD();
$delete = $crud->delete('Tag', $idTag, 'idTag');
$deleteRelation = $crud->delete('Article_has_tag', $idTag,'idTag');



if ($delete && $deleteRelation)
{
    header('location:tags.php');
}
else {
    print('error');
}
?>