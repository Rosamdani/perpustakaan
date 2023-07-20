$(document).ready(function () {
  $("#submitRegis").click(function (e) {
    e.preventDefault();

    var valid = true;

    // Validasi Nama
    var name = $("#name").val();
    if (name === "") {
      $("#nameValidationMessage").html(
        '<p class="text-red-400">Nama tidak boleh kosong</p>'
      );
      valid = false;
    } else {
      var nameRegex = /^[A-Za-z\s]+$/;
      if (!nameRegex.test(name)) {
        $("#nameValidationMessage").html(
          '<p class="text-red-400">Nama hanya boleh terdiri dari huruf</p>'
        );
        valid = false;
      } else {
        $("#nameValidationMessage").empty();
      }
    }

    // Validasi Email
    var email = $("#email").val();
    if (email === "") {
      $("#emailValidationMessage").html(
        '<p class="text-red-400">Email tidak boleh kosong</p>'
      );
      valid = false;
    } else {
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        $("#emailValidationMessage").html(
          '<p class="text-red-400">Email tidak valid</p>'
        );
        return;
      } else {
        $("#emailValidationMessage").empty();
      }
    }

    // Validasi Password
    var password = $("#password").val();
    var rePassword = $("#rePassword").val();
    if (password === "" || rePassword === "") {
      $("#passwordValidationMessage").html(
        '<p class="text-red-400">Password tidak boleh kosong</p>'
      );
      valid = false;
    } else {
      var minLengthRegex = /.{8,}/;
      var uppercaseRegex = /[A-Z]/;
      var digitRegex = /\d/;
      var specialCharRegex = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/;
      if (
        !minLengthRegex.test(password) ||
        !uppercaseRegex.test(password) ||
        !digitRegex.test(password) ||
        !specialCharRegex.test(password)
      ) {
        $("#passwordValidationMessage").html(
          '<p class="text-red-400">Password harus terdiri dari minimal 8 karakter, 1 huruf kapital, 1 angka, dan 1 karakter khusus</p>'
        );
        valid = false;
      } else {
        $("#passwordValidationMessage").empty();
      }
    }

    // Validasi Kesamaan Password
    if (password !== rePassword) {
      $("#matchValidationMessage").html(
        '<p class="text-red-400">Password tidak cocok</p>'
      );
      valid = false;
    } else {
      $("#matchValidationMessage").empty();
    }

    if(valid) {
      // Data Valid, Kirim Data menggunakan AJAX
      $.ajax({
        type: "POST",
        url: "action/action_regis.php",
        data: {
          name: name,
          email: email,
          password: password,
        },
        success: function (response) {
          // Tanggapan dari server, Anda dapat menangani respons sesuai kebutuhan
          if(response.status === 'Failed') {
            $("#errorRegisMessage").html(
              '<p class="w-[80%] rounded flex justify-center py-2 bg-red-400 text-white">'+response.message+'</p>'
            );
          }else if(response.status == "success"){
            window.location = "index.php";
          }
        },
        error: function (xhr, status, error) {
          // Tanggapan kesalahan dari server, Anda dapat menangani kesalahan sesuai kebutuhan
          console.error(error);
        },
      });
    }
  });
});
