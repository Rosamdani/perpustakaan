<?php

include "koneksi.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $id_user = $_SESSION['user_id'];
    if (isset($_POST['submit'])) {
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $id_kategori = $_POST['id_kategori'];
        $jumlah = $_POST['jumlah'];

        $targetDir = "assets/file_buku/";
        $targetFile = $targetDir . basename($_FILES["fileBuku"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


        // Batasan ukuran file
        if ($_FILES["fileBuku"]["size"] > 1000000) {
            $message = "Maaf, ukuran file anda terlalu besar";
            $uploadOk = 0;
        }

        // Memeriksa tipe file yang diizinkan
        $allowedTypes = array('pdf');
        if (!in_array($imageFileType, $allowedTypes)) {
            $message = "Maaf, hanya bisa mengirim file format pdf";
            $uploadOk = 0;
        }

        $targetDir = "assets/data_buku/";
        $targetFile = $targetDir . basename($_FILES["fileCover"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


        // Batasan ukuran file
        if ($_FILES["fileCover"]["size"] > 500000) {
            $message = "Maaf, ukuran file anda terlalu besar";
            $uploadOk = 0;
        }

        // Memeriksa tipe file yang diizinkan
        $allowedTypes = array('jpg', 'jpeg');
        if (!in_array($imageFileType, $allowedTypes)) {
            $message = "Maaf, hanya bisa mengirim file format .jpg atau .jpeg";
            $uploadOk = 0;
        }

        // Memeriksa apakah $uploadOk bernilai 0 (terjadi kesalahan) atau 1 (berhasil)
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileBuku"]["tmp_name"], $targetFile)) {
                $message = "Berhasil";
                $file_buku =  basename($_FILES["fileBuku"]["name"]);
                $cover_buku =  basename($_FILES["fileCover"]["name"]);
                $sql = "INSERT INTO books (judul, deskripsi, id_kategori, jumlah, file_buku, cover_buku) VALUES ('$judul', '$deskripsi', '$id_kategori', '$jumlah', '$file_buku', '$cover_buku')";
                $query = mysqli_query($koneksi, $sql);
                if ($query) {
                    $id_buku = mysqli_insert_id($koneksi);
                    $query = mysqli_query($koneksi, "INSERT INTO book_access (id_pengguna,id_buku) VALUES ('$id_user', '$id_buku')");
                    if($query){
                        header("location:buku.php");
                    }else{
                        header("location:tambah_buku.php?pesan=Gagal Upload Ke Database");
                    }
                } else {
                    header("location:tambah_buku.php?pesan=Gagal Upload Ke Database");
                }
            }
        } else {
            header("location:tambah_buku.php?pesan=" . $message);
        }
    }

    $ch = curl_init();
    $api_url = 'http://localhost/detikcom/action/daftar_kategori.php';
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $kategori = curl_exec($ch);
    curl_close($ch);
    $dataKategori = json_decode($kategori, true);

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    </head>

    <body class="bg-gray-200">
        <nav class="w-full h-[50px] shadow-lg fixed z-10 bg-white">
        </nav>

        <section class="w-full py-36 h-[100vh] flex items-center">
            <div class="w-[85%] mx-auto max-h-fit py-10 flex flex-col bg-white items-center">
                <p>Tambah Buku</p>
                <?php if (isset($_GET['pesan'])) {
                ?>

                    <p class="px-32 py-4 bg-yellow-400"><?= ($_GET['pesan']) ?></p>

                <?php
                } ?>
                <form action="" method="post" class="w-[60%] mt-10 space-y-4" enctype="multipart/form-data">
                    <div class="w-full">
                        <input required type="text" placeholder="Judul" name="judul" class="w-full px-4 py-1 focus:outline-none bg-gray-200 placeholder:text-sm placeholder:text-gray-400 placeholder:before:contents['*'] before:text-red-600 rounded outline-none border-none">
                    </div>
                    <div class="w-full">
                        <textarea required name="deskripsi" class="w-full min-h-[200px] rounded bg-gray-200 border-none outline-none p-5" placeholder="Deskripsi buku" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="w-full">
                        <select required name="id_kategori" id="kategori" class="w-full px-4 py-1 focus:outline-none bg-gray-200 placeholder:text-sm placeholder:text-gray-400 placeholder:before:contents['*'] before:text-red-600 rounded outline-none border-none">
                            <option value="">--Pilih Kategori--</option>
                            <?php
                            foreach ($dataKategori as $category) {
                                echo "<option value='{$category['id']}'>{$category['nama_kategori']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="w-full">
                        <input required type="number" placeholder="Jumlah" name="jumlah" class="w-full px-4 py-1 focus:outline-none bg-gray-200 placeholder:text-sm placeholder:text-gray-400 placeholder:before:contents['*'] before:text-red-600 rounded outline-none border-none">
                    </div>
                    <div class="w-full space-y-2">
                        <p>Upload file buku</p>
                        <input required type="file" name="fileBuku" id="fileBuku" class="w-full border border-gray-600 px-3" placeholder="Periode Wisuda">
                    </div>
                    <div class="w-full space-y-2">
                        <p>Upload file cover</p>
                        <input required type="file" name="fileCover" id="fileCover" class="w-full border border-gray-600 px-3" placeholder="Periode Wisuda">
                    </div>
                    <input type="submit" value="Upload" name="submit" class="float-right border px-3 py-2 bg-slate-400 hover:bg-slate-500 text-white font-bold cursor-pointer">
                </form>
            </div>
        </section>


    </body>

    </html>


<?php
} else {
    echo "hello";
}

?>