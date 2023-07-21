<?php
// include koneksi database
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Query untuk mendapatkan daftar data buku
    $query = "SELECT * FROM books WHERE id = '$id'";
} else if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    // Query untuk mendapatkan daftar data buku
    $query = "SELECT * FROM books WHERE id_kategori = '$kategori'";
}else if (isset($_GET['key'])) {
    $key = $_GET['key'];
    // Query untuk mendapatkan daftar data buku
    $query = "SELECT * FROM books WHERE judul LIKE '%$key%'";
} else {
    // Query untuk mendapatkan daftar data buku
    $query = "SELECT * FROM books";
}
$result = mysqli_query($koneksi, $query);

// Array untuk menampung data buku
$dataBuku = array();

// Memasukkan data buku ke dalam array
$ch = curl_init();
$api_url = 'http://localhost/detikcom/action/daftar_kategori.php';
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$kategori = curl_exec($ch);
curl_close($ch);

$dataKategori = json_decode($kategori, true);


$ch = curl_init();
$api_url = 'http://localhost/detikcom/action/daftar_author.php';
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$author = curl_exec($ch);
curl_close($ch);

$dataAuthor = json_decode($author, true);

if (mysqli_num_rows($result) > 0) {
    $dataBuku["data"] = array();
    $dataBuku["status"] = "Berhasil";
    while ($x = mysqli_fetch_array($result)) {
        foreach ($dataKategori as $daftarKategori) {
            if ($daftarKategori['id'] === $x['id_kategori']) {
                $kategori = $daftarKategori['nama_kategori'];
            }
        }
        foreach ($dataAuthor as $daftarAuthor) {
            if ($daftarAuthor['id_pengguna'] === $x['id']) {
                $author = $daftarAuthor['id_pengguna'];
            }
        }
        $h['author'] = $author;
        $h['kategori'] = $kategori;
        $h['id'] = $x["id"];
        $h['judul'] = $x["judul"];
        $h['deskripsi'] = $x["deskripsi"];
        $h['jumlah'] = $x["jumlah"];
        $h['id_kategori'] = $x["id_kategori"];
        $h['file_buku'] = $x["file_buku"];
        $h['cover_buku'] = $x["cover_buku"];
        array_push($dataBuku["data"], $h);
    }
} else {
    $dataBuku['status'] = "Gagal";
    $dataBuku['message'] = "Ups..Tidak ada buku disini";
}

// Mengembalikan data buku dalam format JSON
header('Content-Type: application/json');
echo json_encode($dataBuku);
