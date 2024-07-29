<?php

require_once("classes/CRUD.php");

$crud = new CRUD();
$insert = $crud->insert('Category', $_POST);

header('location:categories.php');
