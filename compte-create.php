<?php

require_once("classes/CRUD.php");


if($_POST['isAdmin']){
    $_POST['isAdmin'] = 1;
} else {
    $_POST['isAdmin'] = 0;
}

$crud = new CRUD();
$insert = $crud->insert('user', $_POST);

header('location:compte.php?idUser='.$insert);
