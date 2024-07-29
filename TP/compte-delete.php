<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:compte-admin.php');
    exit;
}

$idUser= $_POST['idUser'];

require_once("classes/CRUD.php");
$crud = new CRUD();
$delete = $crud->delete('User', $idUser, 'idUser');



if ($delete)
{
    header('location:compte-admin.php');
}
else {
    print('error');
}
?>