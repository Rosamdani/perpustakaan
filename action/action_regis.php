<?php

include '../koneksi.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    //Mengecek ketersediaan akun pada database
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");

    //Array response untuk mengembalikan respon ke klien
    $response = array();

    //Jika email sudah tersedia
    if ($query->num_rows > 0) {
        $response['status'] = "Failed";
        $response['message'] = "Email yang anda gunakan sudah tersedia, silahkan login";
    } else {
        //Memasukkan data user ke database tabel users
        $query = mysqli_query($koneksi, "INSERT INTO users (nama, email, `password`, `role`) VALUES ('$nama', '$email', '$password', 'user')");
        if ($query) {

            // Mendapatkan data pengguna dari hasil query
            $user = $query->fetch_assoc();

            // Menyimpan data pengguna ke dalam session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            // Menambahkan data pengguna ke dalam respons
            $response['status'] = 'success';
        } else {
            $response['status'] = "Failed";
            $response['message'] = "Data tidak tersimpan";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
