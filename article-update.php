<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:index.php');
    exit;
}

require_once("classes/CRUD.php");
$crud = new CRUD();
$update = $crud->update('Article', $_POST, 'idArticle');

if($update){
    header('location:index.php');
}
else{
    echo 'error';
}
