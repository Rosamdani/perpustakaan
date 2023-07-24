<?php

include '../koneksi.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);


    //Mengecek ketersediaan akun pada database
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1");

    $response = array();
    if ( $query->num_rows > 0) {

        // Mendapatkan data pengguna dari hasil query
        $user = $query->fetch_assoc();

        // Menyimpan data pengguna ke dalam session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['nama_pengguna'] = $user['nama'];
        $_SESSION['email_pengguna'] = $user['email'];
        
        $response['status'] = 'success';
    } else {
        $response['status'] = "Failed";
        $response['message'] = "Email atau password salah!";
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
