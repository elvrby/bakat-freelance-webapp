<?php
ob_start();
require "Pages/Login/connection.php";
require_once "Pages/Login/controllerUserData.php";

    $username = "";
    $email = "";
    $telephone = "";
    $bio = "";
    $errors = array();
    error_reporting(0);

    // Periksa apakah pengguna sudah masuk
    if(isset($_SESSION['email'])) {
        // Jika sudah masuk, dapatkan nama pengguna dari basis data
        $email = $_SESSION['email'];
        $query = "SELECT username FROM users WHERE email='$email'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];

        // Ubah link menuju myaccount.php agar mencakup nama pengguna
        $account_link = "Pages/Akun/user?=$username";
    } else {
        // Jika belum masuk, link menuju login page
        $account_link = "Pages/Login/masuk.php";
    }

    $email = $_SESSION['email'];
    $get_profile_image_query = "SELECT profileimage FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $get_profile_image_query);
    $row = mysqli_fetch_assoc($result);
    $profile_image_path = $row['profileimage'];

    ob_end_flush();  

    $con->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="style.css">
    <title>Bakat</title>
</head>
<body>
    <header>
        <div class="NavigasiMenuHeadAtas">
            <div class="NavigasiMenu">
                <div class="LogoNavigasiMenuAtas">
                    <h1>Logo</h1>
                </div>
                <div class="SearchNavigasiAtas">
                    <table class="element-search">
                        <tr>
                            <td>
                                <input type="text" placeholder="Cari Kebutuhanmu" class="search">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="NavNotifPesan">
                    <a href=""><img src="Icon/bell.svg" alt=""></a>
                    <a href=""><img src="Icon/mail.svg" alt=""></a>
                </div>
                <div class="Profile">
                    <!-- Di menu atau tombol yang mengarah ke halaman profil -->
                <a href="<?php echo $account_link; ?>">
                <?php if (!empty($profile_image_path)) : ?>
                <img src="Pages/Akun/<?php echo $profile_image_path ?>" alt="Profile Image">
                <?php else: ?>
                    <img src="Image/user.jpg" alt="Profile Image">
                <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="badan">
        <div class="DisplayLayananPopuler">
            <div class="LayananPopulerText">
                <div class="TextLayananPopuler">
                    <h1>Pelayanan Populer</h1>
                </div>
                <div class="TextLayananPopulerSemua">
                    <li><a href="">Semua</a></li>
                </div>
            </div>
            <div class="LayananPopulerProduk">
                <div class="LayananProduk">
                    <a href="">
                    <div class="LayananProdukImage">
                        <img src="Image/illustrator.svg" alt="">
                    </div>
                    <div class="LayananProdukText">
                        <h1>Art & illustrator</h1>
                    </div>
                    </a>
                </div>
                <div class="LayananProduk">
                    <a href="">
                    <div class="LayananProdukImage">
                        <img src="Image/copywriting.svg" alt="">
                    </div>
                    <div class="LayananProdukText">
                        <h1>Copywriting</h1>
                    </div>
                    </a>
                </div>
                <div class="LayananProduk">
                    <a href="">
                    <div class="LayananProdukImage">
                        <img src="Image/web.svg" alt="">
                    </div>
                    <div class="LayananProdukText">
                        <h1>Website Development</h1>
                    </div>
                    </a>
                </div>
                <div class="LayananProduk">
                    <a href="">
                    <div class="LayananProdukImage">
                        <img src="Image/Tampilan.jpeg" alt="">
                    </div>
                    <div class="LayananProdukText">
                        <h1>Digital Art</h1>
                    </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="AdsDisplay">
            <div class="AdsDisplayBox">
                <div class="AdsDisplayText">
                    <h1>Buat pekerjaanmu menjadi lebih mudah</h1>
                    <p>Kamu dapat memilih jasa yang di tawarkan oleh freelancer
                        dari seluruh indonesia untuk membantu pekerjaanmu semakin lebih mudah</p>
                </div>
                <div class="AdsDisplayImage">
                    <img src="Image/WorkAds.png" alt="">
                </div>
            </div>
        </div>

        <div class="ProdukDisplay">

            <div class="ProdukFrame">

                <div class="ProdukRekomendasi">
                    <div class="ProdukRekomendasiText">
                        <h1>Rekomendasi</h1>
                    </div>
                    <div class="ProdukRekomendasiTextAll">
                        <a href="">Semua</a>
                    </div>
                </div>

                
                <div class="ProdukSeller">
                    
                    <div class="ProdukSellerBox">
                        <div class="ProdukSellerBoxImage">
                            <img src="Image/Produk1.png" alt="">
                        </div>
                        <div class="ProdukSellerBoxInfo">

                            <div class="ProdukSellerBoxRatePesan">
                                <div class="ProdukSellerBoxRate">
                                    <img src="Icon/Bintang.svg" alt="">
                                    <div class="ProdukSellerBoxRateText">
                                        <h2>4.8</h2>
                                        <h2>(1k)</h2>
                                    </div>
                                </div>
                                <div class="ProdukSellerBoxPesan">
                                    <a href="Pesan"><img src="Icon/mail.svg" alt=""></a>
                                    <a href="Suka"><img src="Icon/Heart.svg" alt=""></a>
                                </div>
                            </div>

                            <div class="ProdukSellerBoxJudulProduk">
                                <a href=""><h1>Membuat Website Professional Untukmu</h1></a>
                            </div>

                            <div class="ProdukSellerBoxHarga">
                                <h3>Mulai Dari  Rp90.000</h3>
                            </div>
                        </div>
                    </div>

                    <div class="ProdukSellerBox">
                        <div class="ProdukSellerBoxImage">
                            <img src="Image/Produk2.png" alt="">
                        </div>
                        <div class="ProdukSellerBoxInfo">

                            <div class="ProdukSellerBoxRatePesan">
                                <div class="ProdukSellerBoxRate">
                                    <img src="Icon/Bintang.svg" alt="">
                                    <div class="ProdukSellerBoxRateText">
                                        <h2>4.9</h2>
                                        <h2>(1k)</h2>
                                    </div>
                                </div>
                                <div class="ProdukSellerBoxPesan">
                                    <a href="Pesan"><img src="Icon/mail.svg" alt=""></a>
                                    <a href="Suka"><img src="Icon/Heart.svg" alt=""></a>
                                </div>
                            </div>

                            <div class="ProdukSellerBoxJudulProduk">
                                <a href=""><h1>Aku Akan Membuat Design Banner Untukmu</h1></a>
                            </div>

                            <div class="ProdukSellerBoxHarga">
                                <h3>Mulai Dari  Rp80.000</h3>
                            </div>
                        </div>
                    </div>

                    <div class="ProdukSellerBox">
                        <div class="ProdukSellerBoxImage">
                            <img src="Image/produk3.jpg" alt="">
                        </div>
                        <div class="ProdukSellerBoxInfo">

                            <div class="ProdukSellerBoxRatePesan">
                                <div class="ProdukSellerBoxRate">
                                    <img src="Icon/Bintang.svg" alt="">
                                    <div class="ProdukSellerBoxRateText">
                                        <h2>4.8</h2>
                                        <h2>(1k)</h2>
                                    </div>
                                </div>
                                <div class="ProdukSellerBoxPesan">
                                    <a href="Pesan"><img src="Icon/mail.svg" alt=""></a>
                                    <a href="Suka"><img src="Icon/Heart.svg" alt=""></a>
                                </div>
                            </div>

                            <div class="ProdukSellerBoxJudulProduk">
                                <a href=""><h1>Aku Akan Design Professional Poster Untukmu</h1></a>
                            </div>

                            <div class="ProdukSellerBoxHarga">
                                <h3>Mulai Dari  Rp30.000</h3>
                            </div>
                        </div>
                    </div>

                    <div class="ProdukSellerBox">
                        <div class="ProdukSellerBoxImage">
                            <img src="Image/Produk4.jpg" alt="">
                        </div>
                        <div class="ProdukSellerBoxInfo">

                            <div class="ProdukSellerBoxRatePesan">
                                <div class="ProdukSellerBoxRate">
                                    <img src="Icon/Bintang.svg" alt="">
                                    <div class="ProdukSellerBoxRateText">
                                        <h2>4.8</h2>
                                        <h2>(1k)</h2>
                                    </div>
                                </div>
                                <div class="ProdukSellerBoxPesan">
                                    <a href="Pesan"><img src="Icon/mail.svg" alt=""></a>
                                    <a href="Suka"><img src="Icon/Heart.svg" alt=""></a>
                                </div>
                            </div>

                            <div class="ProdukSellerBoxJudulProduk">
                                <a href=""><h1>Aku Akan Design Di Powerpoint Untuk Presentasimu</h1></a>
                            </div>

                            <div class="ProdukSellerBoxHarga">
                                <h3>Mulai Dari  Rp90.000</h3>
                            </div>
                        </div>
                    </div>

                    <div class="ProdukSellerBox">
                        <div class="ProdukSellerBoxImage">
                            <img src="Image/Produk5.jpg" alt="">
                        </div>
                        <div class="ProdukSellerBoxInfo">

                            <div class="ProdukSellerBoxRatePesan">
                                <div class="ProdukSellerBoxRate">
                                    <img src="Icon/Bintang.svg" alt="">
                                    <div class="ProdukSellerBoxRateText">
                                        <h2>4.5</h2>
                                        <h2>(800)</h2>
                                    </div>
                                </div>
                                <div class="ProdukSellerBoxPesan">
                                    <a href="Pesan"><img src="Icon/mail.svg" alt=""></a>
                                    <a href="Suka"><img src="Icon/Heart.svg" alt=""></a>
                                </div>
                            </div>

                            <div class="ProdukSellerBoxJudulProduk">
                                <a href=""><h1>Aku Akan Lakukan Copywriting Untukmu</h1></a>
                            </div>

                            <div class="ProdukSellerBoxHarga">
                                <h3>Mulai Dari  Rp10.000</h3>
                            </div>
                        </div>
                    </div>

                    <div class="ProdukSellerBox">
                        <div class="ProdukSellerBoxImage">
                            <img src="Image/Produk6.jpg" alt="">
                        </div>
                        <div class="ProdukSellerBoxInfo">

                            <div class="ProdukSellerBoxRatePesan">
                                <div class="ProdukSellerBoxRate">
                                    <img src="Icon/Bintang.svg" alt="">
                                    <div class="ProdukSellerBoxRateText">
                                        <h2>4.6</h2>
                                        <h2>(200)</h2>
                                    </div>
                                </div>
                                <div class="ProdukSellerBoxPesan">
                                    <a href="Pesan"><img src="Icon/mail.svg" alt=""></a>
                                    <a href="Suka"><img src="Icon/Heart.svg" alt=""></a>
                                </div>
                            </div>

                            <div class="ProdukSellerBoxJudulProduk">
                                <a href=""><h1>Aku Akan Membuat 3D Illustrator Untukmu</h1></a>
                            </div>

                            <div class="ProdukSellerBoxHarga">
                                <h3>Mulai Dari  Rp50.000</h3>
                            </div>
                        </div>
                    </div>

                    <div class="ProdukSellerBox">
                        <div class="ProdukSellerBoxImage">
                            <img src="Image/Produk7.jpg" alt="">
                        </div>
                        <div class="ProdukSellerBoxInfo">

                            <div class="ProdukSellerBoxRatePesan">
                                <div class="ProdukSellerBoxRate">
                                    <img src="Icon/Bintang.svg" alt="">
                                    <div class="ProdukSellerBoxRateText">
                                        <h2>4.8</h2>
                                        <h2>(1k)</h2>
                                    </div>
                                </div>
                                <div class="ProdukSellerBoxPesan">
                                    <a href="Pesan"><img src="Icon/mail.svg" alt=""></a>
                                    <a href="Suka"><img src="Icon/Heart.svg" alt=""></a>
                                </div>
                            </div>

                            <div class="ProdukSellerBoxJudulProduk">
                                <a href=""><h1>Aku Akan Membuat Digital Art Anime</h1></a>
                            </div>

                            <div class="ProdukSellerBoxHarga">
                                <h3>Mulai Dari  Rp90.000</h3>
                            </div>
                        </div>
                    </div>

                    <div class="ProdukSellerBox">
                        <div class="ProdukSellerBoxImage">
                            <img src="Image/Produk8.png" alt="">
                        </div>
                        <div class="ProdukSellerBoxInfo">

                            <div class="ProdukSellerBoxRatePesan">
                                <div class="ProdukSellerBoxRate">
                                    <img src="Icon/Bintang.svg" alt="">
                                    <div class="ProdukSellerBoxRateText">
                                        <h2>5.0</h2>
                                        <h2>(10k)</h2>
                                    </div>
                                </div>
                                <div class="ProdukSellerBoxPesan">
                                    <a href="Pesan"><img src="Icon/mail.svg" alt=""></a>
                                    <a href="Suka"><img src="Icon/Heart.svg" alt=""></a>
                                </div>
                            </div>

                            <div class="ProdukSellerBoxJudulProduk">
                                <a href="Pages/Produk/produkmu"><h1>Aku Akan Membuat Design Produk Untuk E-Commercemu</h1></a>
                            </div>

                            <div class="ProdukSellerBoxHarga">
                                <h3>Mulai Dari  Rp25.000</h3>
                            </div>
                        </div>
                    </div>

                    <div class="bottom-corner">

                    </div>

                </div>

            </div>

        </div>
        
    </div>

    <!--        Mobile Fitur        -->
    <div class="MobileNavigasi">
        <div class="MobileNavigasiBox">
            <div class="MobileNavigasiBoxIcon">
                <div>
                    <a href="">
                        <img src="Icon/Home.svg" alt="">
                    </a>
                    
                </div>

                <div>
                    <a href="Pages/Search/Search.html">
                        <img src="Icon/Search.svg" alt="">
                    </a>
                    
                </div>

                <div>
                    <a href="Pages/Post/Post.html">
                        <img src="Icon/Plus.svg" alt="">
                    </a>
                    
                </div>

                <div>
                    <a href="Pages/Shorts/Shorts.html">
                        <img src="Icon/Reels.svg" alt="">
                    </a>
                    
                </div>

                <div>
                    <a href="<?php echo $account_link; ?>">
                        <img src="Icon/Akun.svg" alt="">
                    </a>                    
                </div>

                
                
                
                
                
            </div>
        </div>
    </div>





</body>
</html>