<?php

include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | DetikLib</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body>
    <div class="w-full h-screen flex items-center justify-center">
        <div class="w-full h-[80%] md:w-[70%] md:h-[70%] lg:w-[30%] lg:-translate-x-[80%]">
            <div class="w-[80%] mx-auto md:w-full h-full text-base space-y-6">
                <div class="w-full space-y-2">
                    <p class="text-xl md:text-2xl lg:text-4xl font-bold text-slate-600">Selamat Datang</p>
                    <p class="text-sm md:text-lg lg:text-2xl text-gray-500">Selamat datang, Silahkan masukkan akun anda</p>
                </div>
                <div class="w-full space-y-2" id="errorLoginMessage"></div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <div id="emailValidationMessage"></div>
                    <label for="email">Email</label>
                    <input id="email" type="email" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-2 px-3" id="email" placeholder="Masukkan email">
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <div id="passwordValidationMessage"></div>
                    <label for="pass">Password</label>
                    <input id="password" type="password" class="w-full border-2 border-gray-300 rounded-md shadow-sm py-2 px-3" id="email" placeholder="Masukkan password">
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold flex justify-between">
                    <div class="text-slate-500 flex space-x-2">
                        <input id="remainder" type="checkbox" name="remindMe" id="checkRemind" class="bg-slate-600">
                        <label for="pass">Ingatkan Saya</label>
                    </div>
                    <a href="#" class="text-blue-500">Lupa Password?</a>
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <button id="submitLogin" class="w-full rounded-md bg-blue-500 py-2 text-white hover:bg-blue-600">LOGIN</button>
                </div>
                <div class="w-full md:w-[80%] text-slate-500 font-bold space-y-2">
                    <p>Tidak punya akun? <a href="regis.php" class="text-blue-500">Registrasi disini</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="js/login.js"></script>
</body>

</html>