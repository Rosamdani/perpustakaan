<?php

session_start();
$api_url = 'http://localhost/detikcom/action/daftar_buku.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$bukuku = json_decode($response, true);
$dataBuku = $bukuku['data'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container my-20 mx-auto text-lg space-y-10">
    <a href="tambah_buku.php" class="px-3 py-2 rounded bg-green-500 hover:bg-green-600 text-white font-bold">Tambah buku</a>
<?php

if ($_SESSION['user_id']){
    $id_user = $_SESSION['user_id'];
    if(isset($bukuku['status']) && $bukuku['status'] == "Berhasil"){
        echo '<table border="1" class="w-full text-sm text-left text-gray-500 ">';
        echo '<thead class="text-gray-700 text-center uppercase bg-gray-50">';
        echo '<tr><th scope="col" class="px-6 py-3">Judul Buku</th><th scope="col" class="px-6 py-3">Deskripsi</th><th scope="col" class="px-6 py-3">Kategori</th><th scope="col" class="px-6 py-3">Jumlah</th><th scope="col" class="px-6 py-3">Aksi</th></tr>';
        echo '</thead>';
        $foundUserBooks = false; // Inisialisasi variabel boolean
        foreach($dataBuku as $buku){
            if ($_SESSION['user_role'] == "user"){
                if($buku['id_author'] == $_SESSION['user_id']){
                    echo '<tr class="bg-white border-b text-lg">';
                    echo '<td>' . $buku['judul'] . '</td>';
                    echo '<td>' . $buku['deskripsi'] . '</td>';
                    echo '<td>' . $buku['kategori'] . '</td>';
                    echo '<td>' . $buku['jumlah'] . '</td>';
                    echo '<td><a href="editBuku.php?id='.$buku['id'].'" class="text-blue-600">Edit</a></td>';
                    echo '</tr>';
                    $foundUserBooks = true; // Set variabel boolean menjadi true
                }
            } else if($_SESSION['user_role'] == "admin"){
                echo '<tr class="bg-white border-b text-lg">';
                echo '<td>' . $buku['judul'] . '</td>';
                echo '<td>' . $buku['deskripsi'] . '</td>';
                echo '<td>' . $buku['kategori'] . '</td>';
                echo '<td>' . $buku['jumlah'] . '</td>';
                echo '<td><a href="editBuku.php?id='.$buku['id'].'" class="text-blue-600">Edit</a></td>';
                echo '</tr>';
            }
        }
        echo '</table>';
        
        // Tampilkan pesan khusus jika tidak ada buku yang sesuai dengan user_id
        if ($_SESSION['user_role'] == "user" && !$foundUserBooks) {
            echo "Tidak ada buku yang bisa anda akses.";
        }
    }
}else{
    exit;
}
?>
       
       </div>
</body>
</html>