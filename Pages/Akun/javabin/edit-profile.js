document
  .getElementById("Bar-User-Open")
  .addEventListener("click", function (event) {
    event.stopPropagation(); // Menghentikan event dari mempropagasi ke parent elements

    // Menampilkan
    document.querySelector(".Bar-Edit-Username").style.display = "flex";
    // Menyembunyikan
  });

document
  .getElementById("Bar-Bio-Open")
  .addEventListener("click", function (event) {
    event.stopPropagation(); // Menghentikan event dari mempropagasi ke parent elements

    // Menampilkan
    document.querySelector(".Bar-Edit-Bio").style.display = "flex";
    // Menyembunyikan
  });

document
  .getElementById("Bar-ProfileImage-Open")
  .addEventListener("click", function (event) {
    event.stopPropagation(); // Menghentikan event dari mempropagasi ke parent elements

    // Menampilkan
    document.querySelector(".Bar-Edit-ProfileImage").style.display = "flex";
    // Menyembunyikan
  });

// Mendapatkan elemen tombol penutup
const closeButton = document.getElementById("Nav-Username-Back");

// Menambahkan event listener untuk tombol penutup
closeButton.addEventListener("click", function () {
  // Menyembunyikan saat tombol penutup diklik
  document.querySelector(".Bar-Edit-Username").style.display = "none";
});

// Mendapatkan elemen tombol penutup
const closeButtonBio = document.getElementById("Nav-Bio-Back");

// Menambahkan event listener untuk tombol penutup
closeButtonBio.addEventListener("click", function () {
  // Menyembunyikan saat tombol penutup diklik
  document.querySelector(".Bar-Edit-Bio").style.display = "none";
});

// Mendapatkan elemen tombol penutup
const closeButtonProfileImage = document.getElementById(
  "Nav-ProfileImage-Back"
);

// Menambahkan event listener untuk tombol penutup
closeButtonProfileImage.addEventListener("click", function () {
  // Menyembunyikan saat tombol penutup diklik
  document.querySelector(".Bar-Edit-ProfileImage").style.display = "none";
});

// Ambil elemen textarea dan span yang diperlukan
var textarea = document.getElementById("bio");
var charCountSpan = document.getElementById("charCount");

// Tambahkan event listener untuk menghitung jumlah karakter setiap kali pengguna mengetik
textarea.addEventListener("input", function () {
  // Hitung jumlah karakter
  var charCount = this.value.length;

  // Batasi jumlah karakter yang diizinkan
  if (charCount > 150) {
    // Jika jumlah karakter melebihi batas, potong teks dan buat jumlah karakter menjadi 200
    this.value = this.value.substring(0, 150);
    charCount = 150;
  }

  // Tampilkan jumlah karakter dalam span
  charCountSpan.textContent = charCount + "/150";
});

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
  var charCountName = sanitizedInput.length;

  // Batasi jumlah karakter yang diizinkan
  if (charCountName > 16) {
    // Jika jumlah karakter melebihi batas, potong teks
    this.value = this.value.substring(0, 16);
    charCountName = 16;
  }

  // Tampilkan jumlah karakter dalam span
  charCountNameSpan.textContent = charCountName + "/16";
});

var saveButton = document.getElementById("saveButton");

// Tambahkan event listener untuk menangkap klik tombol
saveButton.addEventListener("click", function () {
  // Redirect ke halaman myaccount.php setelah tombol diklik
  window.location.href = "user";
});
