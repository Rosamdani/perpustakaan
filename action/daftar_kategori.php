<?php
// include koneksi database
include '../koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM book_categories WHERE id = '$id'";
}else{
    $query = "SELECT * FROM book_categories";
    // Query untuk mendapatkan daftar data buku
}
$result = mysqli_query($koneksi, $query);

// Array untuk menampung data buku
$dataKategori = array();

// Memasukkan data buku ke dalam array
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dataKategori[] = $row;
    }
}

// Mengembalikan data buku dalam format JSON
header('Content-Type: application/json');
echo json_encode($dataKategori);
?>
