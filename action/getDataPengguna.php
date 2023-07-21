<?php
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Query untuk mendapatkan daftar data pengguna
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    // Array untuk menampung data buku
    $dataPengguna = array();

    if(mysqli_num_rows($result) > 0){

    }else{
        session_destroy();
        header("Location:index.php");
        exit;
    }

}else{
    header("Location:index.php");
    exit;
}
