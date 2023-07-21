<?php
// include koneksi database
include '../koneksi.php';

$query = "SELECT * FROM book_access";
// Query untuk mendapatkan daftar data buku
$result = mysqli_query($koneksi, $query);

// Array untuk menampung data buku
$dataAuthor = array();

// Memasukkan data buku ke dalam array
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dataAuthor[] = $row;
    }
}

// Mengembalikan data buku dalam format JSON
header('Content-Type: application/json');
echo json_encode($dataAuthor);
