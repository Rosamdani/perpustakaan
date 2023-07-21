<?php
session_start();

if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_role'])) {
    // Jika session tidak ada, atau data pengguna tidak tersedia, redirect ke halaman login
    header("Location: login.php");
    exit;
}
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
//Curl untuk mengakses daftar buku
$ch = curl_init();

$api_url = 'http://localhost/detikcom/action/daftar_buku.php?id=' . $id;
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$dataBuku = json_decode($response, true);

if ($dataBuku['status'] == 'Berhasil') {
    foreach ($dataBuku['data'] as $buku) {
        $judul = $buku['judul'];
        $kategori = $buku['kategori'];
        $deskripsi = $buku['kategori'];
        $deskripsi = $buku['deskripsi'];
        $jumlah = $buku['jumlah'];
        $cover_buku = $buku['cover_buku'];
        $file_buku = $buku['file_buku'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container mx-10 md:mx-auto pt-32">
        <div class="md:flex text-base text-slate-500 md:space-x-20">
            <div class="poster mx-auto md:mx-0 max-w-[300px]">
                <img src="assets/data_buku/<?= $cover_buku ?>" class="shadow-xl bg-white p-3 rounded hover:shadow-2xl" alt="">
            </div>
            <div class="detail mt-10 mx-5 md:mt-0 space-y-4">
                <p class="md:text-4xl font-bold"><?= $judul ?></p>
                <p class="md:text-2xl">Kategori : <?= $kategori ?></p>
                <p class="md:text-2xl">Jumlah : <?= $jumlah ?></p>
                <p class="md:text-2xl font-bold">Deskripsi Buku</p>
                <p class="md:text-xl max-h-[400px]"><?= $deskripsi ?></p>
            </div>
        </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>