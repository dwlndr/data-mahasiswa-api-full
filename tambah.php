<?php
    require_once 'model.php';
    if(!empty($_POST['nim'])){
        $data = array();
        foreach($_POST as $key => $value){
            $data[$key] = $value;
        }
        $url = "localhost:8080/api/students/";
        model::createStudent($url, $data);
        header('Location:index.php');
        // print_r ($data);
    }
?>