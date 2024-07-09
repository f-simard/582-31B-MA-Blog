<?php

require_once("classes/CRUD.php");

$crud = new CRUD();
$insert = $crud->insert('category', $_POST);

header('location:categories.php');
