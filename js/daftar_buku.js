$(document).ready(function () {
  // Mendapatkan referensi ke elemen tabel buku
  var tabelBuku = $("#tabelBuku");

  // Mengambil data buku dari server menggunakan AJAX
  $.ajax({
    url: "action/daftar_buku.php",
    method: "GET",
    success: function (response) {
      try {
        // Parsing JSON menjadi objek
        var data = JSON.parse(response);

        // Memeriksa apakah ada data buku yang ditemukan
        if (Array.isArray(data) && data.length > 0) {
          // Jika ada data buku, tampilkan di tabel
          data.forEach(function (buku) {
            var row = "<tr>";
            row += "<td>" + buku.judul + "</td>";
            row += "<td>" + buku.penulis + "</td>";
            row += "<td>" + buku.kategori + "</td>";
            row += "</tr>";
            tabelBuku.append(row);
          });
        } else {
          // Jika tidak ada data buku, tampilkan pesan data kosong
          var row =
            "<tr><td colspan='3'>Tidak ada data buku yang ditemukan</td></tr>";
          tabelBuku.append(row);
        }
      } catch (error) {
        console.error("Terjadi kesalahan dalam parsing JSON: " + error);
      }
    },

    error: function (xhr, status, error) {
      // Tangani kesalahan saat mengambil data buku
      console.error(error);
    },
  });
});
