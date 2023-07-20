<?php

$koneksi = mysqli_connect("localhost", "root", "", "detiklib");

if(!$koneksi){
    echo "Error";
}