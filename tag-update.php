<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:tag.php');
    exit;
}

require_once("classes/CRUD.php");
$crud = new CRUD();
$update = $crud->update('Tag', $_POST);

if($update){
    header('location:Tag.php');
}
else{
    echo 'error';
}
