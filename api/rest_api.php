<?php
header('Content-Type: application/json');
include_once('../config/koneksi.php');
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $last_uri_segment = end($request_uri);
        if ($request_uri[0] === 'api' && $request_uri[1] === 'students') {
            if (isset($request_uri[2]) && !empty($request_uri[2])) {
                $nim = intval($request_uri[2]);
                get_students($nim);
            } else {
                get_students();
            }
        }else{
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode(array("status" => 0, "status_message" => "Metode yang diminta tidak dikenali oleh API."));
            break;
        }
        break;
    case "POST":
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        if($request_uri[0] === 'api' && $request_uri[1] === 'students'){
            insert_student();
        }else{
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode(array("status" => 0, "status_message" => "Metode yang diminta tidak dikenali oleh API."));
            break;
        }
        break;

    case "PUT":
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $last_uri_segment = end($request_uri);
        if ($request_uri[0] === 'api' && $request_uri[1] && is_numeric($last_uri_segment)) {
            $nim = intval($last_uri_segment);
            update_student($nim);
        } else {
            header('Content-Type: application/json');
            $response = array('status' => 0, 'status_message' => 'Invalid Request');
            echo json_encode($response);
        }
        break;
    case "DELETE":
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $last_uri_segment = end($request_uri);
        if ($request_uri[0] === 'api' && $request_uri[1] && is_numeric($last_uri_segment)) {
            $nim = intval($last_uri_segment);
            delete_student($nim);
        } else {
            header('Content-Type: application/json');
            $response = array('status' => 0, 'status_message' => 'Invalid Request');
            echo json_encode($response);
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode(array("status" => 0, "status_message" => "Metode yang diminta tidak dikenali oleh API."));
        break;
}
function get_students($nim = null)
{
    global $connection;
    $query = "SELECT * FROM mahasiswa";
    if ($nim != null) {
        $query .= " WHERE nim = " . $nim . " LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
function insert_student()
{
    global $connection;
    $nim = $_POST["nim"];
    $name = $_POST["nama"];
    $angkatan = $_POST["angkatan"];
    $semester = $_POST['semester'];
    $ipk = $_POST['ipk'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $query = "INSERT INTO mahasiswa VALUES ('$nim', '$name', '$angkatan', '$semester','$ipk', '$email', '$telepon')";
    if (mysqli_query($connection, $query)) {
        $response = array('status' => 1, 'status_message' => "Data Mahasiswa Berhasil ditambahkan");
    } else {
        $response = array('status' => 0, 'status_message' => 'Data Mahasiswa Gagal ditambahkan');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
function update_student($nim)
{
    global $connection;
    parse_str(file_get_contents("php://input"), $post_vars);
    $nama = $post_vars["nama"];
    $angkatan = $post_vars['angkatan'];
    $semester = $post_vars['semester'];
    $ipk = $post_vars['IPK'];
    $email = $post_vars['email'];
    $telepon = $post_vars['telepon'];
    $query = "UPDATE mahasiswa SET nama=?, angkatan=?, semester=?, ipk=?, email=?, telepon=? WHERE nim=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "siiisss", $nama, $angkatan, $semester, $ipk, $email, $telepon, $nim);
    if (mysqli_stmt_execute($stmt)) {
        $response = array('status' => 1, 'status_message' => "Data Mahasiswa Berhasil diupdate");
    } else {
        $response = array('status' => 0, 'status_message' => 'Data Mahasiswa Gagal diupdate');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
function delete_student($nim)
{
    global $connection;
    $query = "DELETE FROM mahasiswa WHERE nim =" . $nim;
    if (mysqli_query($connection, $query)) {
        $response = array('status' => 1, 'status_message' => 'Data Mahasiswa berhasil dihapus');
    } else {
        $response = array('status' => 0, 'status_message' => 'Data Mahasiswa gagal dihapus');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}