<?php

include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | DetikLib</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body>
    <div class="w-full h-screen flex items-center justify-center">
        <div class="w-full h-[80%] md:w-[70%] md:h-[70%] lg:w-[30%] lg:-translate-x-[80%]">
            <div class="w-[80%] mx-auto md:w-full h-full text-base space-y-6">
                <div class="w-full space-y-2">
                    <p class="text-xl md:text-2xl lg:text-4xl font-bold text-slate-600">Selamat Datang</p>
                    <p class="text-sm md:text-lg lg:text-2xl text-gray-500">Selamat datang, Silahkan buat akun anda</p>
                </div>
                <div class="w-full" id="errorRegisMessage"></div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <div id="nameValidationMessage"></div>
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-2 px-3" id="name" placeholder="Masukkan nama lengkapmu..">
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <div id="emailValidationMessage"></div>
                    <label for="email">Email</label>
                    <input type="email" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-2 px-3" id="email" placeholder="Masukkan email">
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <label for="pass">Password</label>
                    <input type="password" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-2 px-3" id="password" placeholder="Masukkan password">
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <label for="pass">Ulangi Password</label>
                    <input type="password" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-2 px-3" id="rePassword" placeholder="Masukkan password">
                    <div id="passwordValidationMessage"></div>
                    <div id="matchValidationMessage"></div>
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold flex justify-between">
                    <div class="text-slate-500 flex space-x-2">
                        <input type="checkbox" name="remindMe" id="checkRemind" class="bg-slate-600">
                        <label for="pass">Ingatkan Saya</label>
                    </div>
                    <a href="#" class="text-blue-500">Lupa Password?</a>
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <button type="submit" id="submitRegis" class="w-full rounded-md bg-blue-500 py-2 text-white hover:bg-blue-600">REGISTRASI</button>
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <p>Sudah punya akun? <a href="login.php" class="text-blue-500">Login disini</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="js/regis.js"></script>
</body>

</html>