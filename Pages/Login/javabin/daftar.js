function validateForm() {
  var checkBox = document.getElementById("persetujuan");
  //          Kode yang di hijauin salah/gk di pake      //
  // var kotaElement = document.getElementById("kota");
  // var kotaValue = kotaElement.value;
  var usernameInput = document.getElementById("username");
  var usernameValue = usernameInput.value.trim();
  var emailInput = document.getElementById("email");
  var emailValue = emailInput.value.trim();
  var passwordInput = document.getElementById("password");
  var passwordValue = passwordInput.value.trim();
  var telephoneInput = document.getElementById("telephone");
  var telephoneValue = telephoneInput.value.trim();
  // var keahlianElement = document.getElementById("keahlian");
  // var keahlianValue = keahlianElement.value;
  // var pendidikanElement = document.getElementById("pendidikan");
  // var pendidikanValue = pendidikanElement.value;
  if (usernameValue === "") {
    alert("Username belum di isi, harap isi terlebih dahulu");
    return false; // Menghentikan pengiriman formulir jika validasi gagal
  }
  if (emailValue === "" || !emailValue.includes("@")) {
    alert("masukan email anda terlebih dahulu dan pastikan sudah benar");
    return false; // Menghentikan pengiriman formulir jika validasi gagal
  }
  if (passwordValue === "") {
    alert("harap masukan password anda dengan benar");
    return false; // Menghentikan pengiriman formulir jika validasi gagal
  }
  if (!checkBox.checked) {
    alert(
      "Anda harus menyetujui persyaratan privacy policy sebelum melanjutkan."
    );
    return false;
  }
  if (telephoneValue === "+62") {
    alert("Harap isikan nomer terlebih dahulu");
    return false; // Menghentikan pengiriman formulir jika validasi gagal
  }
  if (kotaValue === "") {
    alert("Harap pilih kota asal");
    return false; // Menghentikan pengiriman formulir jika validasi gagal
  }

  if (keahlianValue === "") {
    alert("Harap isikan keahlianmu terlebih dahulu");
    return false; // Menghentikan pengiriman formulir jika validasi gagal
  }
  if (pendidikanValue === "") {
    alert("Harap isikan pendidikanmu terlebih dahulu");
    return false; // Menghentikan pengiriman formulir jika validasi gagal
  }
}
// Mengambil referensi elemen input
var telephoneInput = document.getElementById("telephone");

// Mengatur nilai awal input
telephoneInput.value = "+62";

// Mendengarkan event input
telephoneInput.addEventListener("input", function () {
  // Menghapus karakter non-angka
  this.value = this.value.replace(/\D/g, "");
});
telephoneInput.addEventListener("input", function () {
  // Menghapus awalan hanya jika input masih berisi "+62"
  if (this.value === "+62") {
    this.value = "";
  }
});

// Mendengarkan event blur
telephoneInput.addEventListener("input", function () {
  // Mengatur kembali awalan jika input kosong
  if (this.value === "") {
    this.value = "+62";
  } else {
    // Memeriksa apakah angka setelah "+62" diawali dengan angka 8
    var phoneNumber = this.value.substr(2);
    if (!phoneNumber.startsWith("8")) {
      alert("Nomor telepon harus diawali dengan angka 8 setelah +62.");
      this.value = "+62";
    }
  }
});

document.getElementById("username").addEventListener("input", function (event) {
  // Mendapatkan nilai input
  var value = this.value;
  // Mengecek apakah terdapat spasi pada nilai input
  if (/\s/.test(value)) {
    // Menghapus spasi dari nilai input
    this.value = value.replace(/\s/g, "");
  }
});

function showForm1() {
  document.getElementById("form1").style.display = "block";
  document.getElementById("form2").style.display = "none";
}

function showForm2() {
  document.getElementById("form1").style.display = "none";
  document.getElementById("form2").style.display = "block";
}

// Ambil elemen textarea dan span yang diperlukan
// Ambil elemen textarea dan span yang diperlukan
var input = document.getElementById("username");
var charCountNameSpan = document.getElementById("charCountName");
var usernameInput = document.getElementById("username");

// Tambahkan event listener untuk menghitung jumlah karakter setiap kali pengguna mengetik
input.addEventListener("input", function () {
  // Mengambil nilai input
  var inputValue = this.value;

  // Membuat regular expression untuk memeriksa apakah input mengandung karakter selain huruf, angka, titik, dan underscore
  var regex = /^[a-zA-Z0-9._]+$/;

  // Membuat array untuk menyimpan karakter yang valid
  var validCharacters = [];

  // Iterasi melalui setiap karakter input
  for (var i = 0; i < inputValue.length; i++) {
    var char = inputValue[i];

    // Jika karakter sesuai dengan regular expression, tambahkan ke array karakter valid
    if (regex.test(char)) {
      validCharacters.push(char);
    }
  }

  // Menggabungkan karakter yang valid kembali menjadi string
  var sanitizedInput = validCharacters.join("");

  // Menetapkan nilai input ke string yang sudah disaring
  this.value = sanitizedInput;

  // Hitung jumlah karakter setelah penyaringan
  var charCount = sanitizedInput.length;

  // Batasi jumlah karakter yang diizinkan
  if (charCount > 16) {
    // Jika jumlah karakter melebihi batas, potong teks
    sanitizedInput = sanitizedInput.substring(0, 16);
    charCount = 16;
  }

  // Tampilkan jumlah karakter dalam span
  charCountNameSpan.textContent = charCount + "/16";
});
