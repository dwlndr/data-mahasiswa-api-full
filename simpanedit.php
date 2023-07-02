<?php 
    require_once 'model.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $angkatan = $_POST['angkatan'];
        $semester = $_POST['semester'];
        $ipk = $_POST['ipk'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];

        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'semester' => $semester,
            'IPK' => $ipk,
            'email' => $email,
            'telepon' => $telepon
        );
    }
    if(!empty($_POST['nim'])){
        $id = $_POST['nim'];
        // $data = array();
        // foreach($_POST as $key => $value){
        //     $data[$key] = $value;
        // }
        // print_r($data);
        $url = "localhost:8080/api/students/";
        model::editStudent($url, $data, $id);
        header("Location:index.php");
        // print_r ($data);
    }
?>