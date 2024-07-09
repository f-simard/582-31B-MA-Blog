<?php

require_once("classes/CRUD.php");

$crud = new CRUD();
$insert = $crud->insert('user', $_POST);

header('location:compte.php?idUser='.$insert);
