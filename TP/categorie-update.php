<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:categories.php');
    exit;
}

require_once("classes/CRUD.php");
$crud = new CRUD();
$update = $crud->update('Category', $_POST, 'idCategory');

if($update){
    header('location:categories.php');
}
else{
    echo 'error';
}
