<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:index.php');
    exit;
}

require_once("classes/CRUD.php");
$crud = new CRUD();
$update = $crud->update('User', $_POST, 'idUser');

if($update){
    header('location:compte.php?idUser='.$update);
}
else{
    echo 'error';
}
