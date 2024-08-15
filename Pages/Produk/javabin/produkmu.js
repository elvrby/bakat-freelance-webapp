// Mendapatkan elemen-elemen yang diperlukan
const postinganMenu1 = document.querySelectorAll(".Postingan-Menu")[0];
const postinganMenu2 = document.querySelectorAll(".Postingan-Menu")[1];
const postinganMenu3 = document.querySelectorAll(".Postingan-Menu")[2];
const postinganMenu4 = document.querySelectorAll(".Postingan-Menu")[3];
const desUserPost = document.querySelector(".Des-User-Post");
const desUserKeranjang = document.querySelector(".Des-User-Keranjang");
const desUserProdukmu = document.querySelector(".Des-User-Produkmu");
const desUserReels = document.querySelector(".Des-User-Reels");

// Sembunyikan Des-User-Keranjang secara default menggunakan CSS
desUserKeranjang.style.display = "none";
desUserProdukmu.style.display = "none";
desUserReels.style.display = "none";

// Menambahkan event listener untuk postinganMenu1
postinganMenu1.addEventListener("click", function () {
  // Menampilkan Des-User-Post
  desUserPost.style.display = "flex";
  // Menyembunyikan Des-User-Keranjang
  desUserKeranjang.style.display = "none";
  desUserProdukmu.style.display = "none";
  desUserReels.style.display = "none";
});

// Menambahkan event listener untuk postinganMenu2
postinganMenu2.addEventListener("click", function () {
  // Menampilkan Des-User-Keranjang
  desUserKeranjang.style.display = "block";
  // Menyembunyikan Des-User-Post
  desUserPost.style.display = "none";
  desUserProdukmu.style.display = "none";
  desUserReels.style.display = "none";
});

postinganMenu3.addEventListener("click", function () {
  // Menampilkan Des-User-Keranjang
  desUserProdukmu.style.display = "block";
  // Menyembunyikan Des-User-Post
  desUserPost.style.display = "none";
  desUserKeranjang.style.display = "none";
  desUserReels.style.display = "none";
});

postinganMenu4.addEventListener("click", function () {
  // Menampilkan Des-User-Keranjang
  desUserReels.style.display = "flex";
  // Menyembunyikan Des-User-Post
  desUserPost.style.display = "none";
  desUserKeranjang.style.display = "none";
  desUserProdukmu.style.display = "none";
});

document
  .getElementById("kafka-image")
  .addEventListener("click", function (event) {
    event.stopPropagation(); // Menghentikan event dari mempropagasi ke parent elements

    // Menampilkan .display-post-feed
    document.querySelector(".display-post-feed").style.display = "block";
    // Menyembunyikan .Des-User-Post
  });

document.getElementById("reels1").addEventListener("click", function (event) {
  event.stopPropagation(); // Menghentikan event dari mempropagasi ke parent elements

  // Menampilkan .display-post-feed
  document.querySelector(".display-reels-feed").style.display = "block";
  // Menyembunyikan .Des-User-Post
  video.play();
});

document
  .getElementById("m-settings-nav-show")
  .addEventListener("click", function (event) {
    event.stopPropagation(); // Menghentikan event dari mempropagasi ke parent elements

    // Menampilkan .display-post-feed
    document.querySelector(".m-navigasi-hide").style.display = "block";
    // Menyembunyikan .Des-User-Post
  });

// Menambahkan event listener ke dokumen utama
document.addEventListener("click", function (event) {
  // Memeriksa apakah yang diklik bukan bagian dari .display-post-feed atau .Des-User-Post
  if (
    !event.target.closest(".display-post-feed") &&
    !event.target.closest(".Des-User-Post")
  ) {
    // Menyembunyikan .display-post-feed
    document.querySelector(".display-post-feed").style.display = "none";
    // Menampilkan .Des-User-Post
  }
});

// Menambahkan event listener ke dokumen utama
document.addEventListener("click", function (event) {
  if (
    !event.target.closest(".display-reels-feed") &&
    !event.target.closest(".Des-User-Reels")
  ) {
    document.querySelector(".display-reels-feed").style.display = "none";

    video.pause();
  }
});

// Mendapatkan elemen tombol penutup
const closeButton = document.getElementById("post-feed-mobile-close");

// Menambahkan event listener untuk tombol penutup
closeButton.addEventListener("click", function () {
  // Menyembunyikan display-post-feed saat tombol penutup diklik
  document.querySelector(".display-post-feed").style.display = "none";
});

// Mendapatkan elemen tombol penutup
const closeButtonReels = document.getElementById("reels-feed-mobile-close");

// Menambahkan event listener untuk tombol penutup
closeButtonReels.addEventListener("click", function () {
  // Menyembunyikan display-post-feed saat tombol penutup diklik
  document.querySelector(".display-reels-feed").style.display = "none";
});

// Mendapatkan elemen tombol penutup
const closeButtonMobileNav = document.getElementById("m-settings-nav-hide");

// Menambahkan event listener untuk tombol penutup
closeButtonMobileNav.addEventListener("click", function () {
  // Menyembunyikan display-post-feed saat tombol penutup diklik
  document.querySelector(".m-navigasi-hide").style.display = "none";
});

// Function to pause the video when display-reels-feed is hidden
function pauseVideo() {
  if (document.querySelector(".display-reels-feed").style.display === "none") {
    video.pause();
  }
}

// Call pauseVideo function whenever display-reels-feed is hidden
document
  .querySelector(".display-reels-feed")
  .addEventListener("transitionend", pauseVideo);

// Get the video element
var video = document.getElementById("reels-video");

// Function to toggle play/pause on video click
function togglePlayPause() {
  if (video.paused) {
    video.play();
  } else {
    video.pause();
  }
}

// Event listener to toggle play/pause when the video is clicked
video.addEventListener("click", function () {
  togglePlayPause();
});

// Function to pause the video when the reels-feed is closed
document
  .getElementById("reels-feed-mobile-close")
  .addEventListener("click", function () {
    video.pause();
  });

// Function to continuously play the video
video.addEventListener("ended", function () {
  this.currentTime = 0;
  this.play(); // Restart the video
});

// Set the video to loop
video.loop = true;
