<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:tags.php');
    exit;
}

require_once("classes/CRUD.php");
$crud = new CRUD();
$update = $crud->update('Tag', $_POST, 'idTag');

if($update){
    header('location:tags.php');
}
else{
    echo 'error';
}
