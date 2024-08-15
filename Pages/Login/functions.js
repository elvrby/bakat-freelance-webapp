function togglePasswordVisibility(inputId) {
    const passwordInput = document.getElementById(inputId);
    const passwordToggle = passwordInput.nextElementSibling;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
        passwordInput.type = 'password';
        passwordToggle.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
}
function register() {
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var region = document.getElementById('kota').value;
  
    // Kirim data ke server menggunakan AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "register.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var response = xhr.responseText;
        alert(response); // Tampilkan pesan respons dari server
        if (response === "Success") {
          // Redirect ke lokasi.php jika registrasi berhasil
          window.location.href = "lokasi.php";
        }
      }
    };
    var data = "username=" + encodeURIComponent(username) + "&email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password) + "&confirmPassword=" + encodeURIComponent(confirmPassword) + "&region=" + encodeURIComponent(region);
    xhr.send(data);
  }
  



