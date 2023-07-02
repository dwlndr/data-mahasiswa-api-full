<?php 
require_once "model.php";
$id = $_GET['nim'];
$url = 'http://localhost:8080/api/students/';
model::deleteStudent($id, $url);
header('Location:index.php');
?>
