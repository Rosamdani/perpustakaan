$(document).ready(function () {
  $("#submitLogin").click(function (e) {
    var email = $("#email").val();
    var password = $("#password").val();
    var remainder = $("#remainder").val();
    valid = true;

    // Validasi Email
    if (email === "") {
      $("#emailValidationMessage").html(
        '<p class="text-red-400">Email tidak boleh kosong</p>'
      );
      valid = false;
    }

    if (password === "") {
      $("#passwordValidationMessage").html(
        '<p class="text-red-400">Password tidak boleh kosong</p>'
      );
      valid = false;
    }

    if (valid) {
      $.ajax({
        type: "POST",
        url: "action/action_login.php",
        data: {
          email: email,
          password: password,
        },
        success: function (response) {
          // Tanggapan dari server, Anda dapat menangani respons sesuai kebutuhan
          if (response.status === "Failed") {
            $("#errorLoginMessage").html(
              '<p class="w-full md:w-[80%] rounded flex justify-center py-2 bg-red-400 text-white">' +
                response.message +
                "</p>"
            );
          } else if (response.status == "success") {
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
