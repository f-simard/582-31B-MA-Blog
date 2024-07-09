<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:index.php');
    exit;
}

if($_POST['isAdmin']){
    $_POST['isAdmin'] = 1;
} else {
    $_POST['isAdmin'] = 0;
}

require_once("classes/CRUD.php");
$crud = new CRUD();
$update = $crud->update('User', $_POST, 'idUser');

if($update){
    header('location:compte-admin.php');
}
else{
    echo 'error';
}
