<?php
// include koneksi database
include '../koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT nama, email FROM users WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    
    // Array untuk menampung data pengguna
    $dataPengguna = array();
    
    // Memasukkan data pengguna ke dalam array
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dataPengguna[] = $row;
        }
        // Jika data ditemukan, kirimkan respon dengan kunci 'data'
        $response['data'] = $dataPengguna;
    } else {
        // Jika data tidak ditemukan, kirimkan respon dengan kunci 'data' berisi array kosong
        $response['data'] = array();
    }
} else {
    // Jika parameter 'id' tidak ditemukan, kirimkan respon dengan kunci 'status' berisi 'Failed'
    $response['status'] = 'Failed';
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
