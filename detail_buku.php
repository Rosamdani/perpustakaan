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


$api_url = 'http://localhost/detikcom/action/daftar_kategori.php';
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$kategori = curl_exec($ch);
curl_close($ch);

$dataBuku = json_decode($response, true);
$dataKategori = json_decode($kategori, true);

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
<nav class="bg-white w-full border-gray-200 shadow-md fixed">
        <div class="container flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap ">Flowbite</span>
            </a>
            <div class="flex lg:order-2">

                <div class="relative hidden h-full lg:block">
                    <div class="absolute inset-y-0 left-0 flex items-center h-full pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search icon</span>
                    </div>
                    <form action="index.php" method="get">
                        <input type="text" id="search-navbar" name="Search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg  focus:ring-blue-500 placeholder-gray-400  " placeholder="Cari judul...">
                    </form>
                </div>
                <?php
                if (isset($_SESSION['nama_pengguna'])) {
                ?>
                    <button type="button" class="flex mx-3 text-sm lg:mr-0 items-center" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="font-bold">Hello</span>, <?= $_SESSION['nama_pengguna'] ?>
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                <?php
                } else {
                ?>
                    <a href="login.php" class="mx-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Login</a>
                <?php
                }
                ?>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow " id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 "><?= $_SESSION['nama_pengguna'] ?></span>
                        <span class="block text-sm  text-gray-500 truncate"><?= $_SESSION['email_pengguna'] ?></span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Earnings</a>
                        </li>
                        <li>
                            <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-search" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 hover" aria-controls="navbar-search" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="navbar-search">
                <div class="relative mt-3 lg:hidden">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <form action="index.php" method="get">
                        <input type="text" id="search-navbar" name="Search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg  focus:ring-blue-500  placeholder-gray-400" placeholder="Cari judul...">
                    </form>
                </div>
                <ul class="flex flex-col p-4 lg:p-0 mt-4 font-medium border border-gray-100 rounded-lg  lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 lg:bg-white ">
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4  bg-blue-700 rounded lg:bg-transparent hover:text-white lg:text-blue-700 lg:p-0 " aria-current="page">Home</a>
                    </li>
                    <li>
                        <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown" class="flex items-center justify-between py-2 pl-3 w-full pr-4 font-medium text-gray-900 lg:w-auto hover: lg:border-0 lg:hover:text-blue-600 lg:p-0  lg: hover">
                            Kategori <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="mega-menu-dropdown" class="absolute z-10 grid hidden w-auto grid-cols-2 text-sm bg-white border border-gray-100 rounded-lg shadow-md lg:grid-cols-3">
                            <div class="p-4 pb-0 text-gray-900 lg:pb-4 ">
                                <ul class="space-y-4" aria-labelledby="mega-menu-dropdown-button">
                                    <?php
                                    foreach ($dataKategori as $kategoriBuku) {
                                    ?>
                                        <li>
                                            <a href="index.php?kategori=<?= $kategoriBuku['id'] ?>" class="text-gray-500 hover:text-blue-600 ">
                                                <?= $kategoriBuku['nama_kategori'] ?>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 lg:border-0 lg:hover:text-blue-700 lg:p-0 lg:w-auto ">Data Buku <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            <li>
                                    <a href="tambah_buku.php" class="block px-4 py-2 hover:bg-gray-100">Upload Buku</a>
                                </li>
                                <li>
                                    <a href="buku.php" class="block px-4 py-2 hover:bg-gray-100">Data Buku</a>
                                </li>
                                <li>
                                    <a href="export_excel.php" class="block px-4 py-2 hover:bg-gray-100">Export Data Buku</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                    <a href="kategori.php" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 lg:border-0 lg:hover:text-blue-700 lg:p-0 lg:w-auto ">Data Kategori</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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