<?php

$ch = curl_init();
$api_url = 'http://localhost/detikcom/action/daftar_buku.php';
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$buku = curl_exec($ch);
curl_close($ch);

$dataBuku = json_decode($buku, true);

$dataBuku = $dataBuku['data'];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Buku</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Buku.xls");
    ?>

    <center>
        <h1>Export Data Buku</h1>
    </center>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            <th>Kategori</th>
            <th>Author</th>
            <th>Kontak</th>
        </tr>
        <?php
        $index = 1;
        foreach ($dataBuku as $buku) {
        ?>
            <tr>
                <td><?= $index++ ?></td>
                <td><?= $buku['judul'] ?></td>
                <td><?= $buku['deskripsi'] ?></td>
                <td><?= $buku['jumlah'] ?></td>
                <td><?= $buku['kategori'] ?></td>
                <?php
                foreach ($buku['author'] as $author) {
                ?>
                    <td><?= $author['nama'] ?></td>
                    <td><?= $author['email']?></td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>