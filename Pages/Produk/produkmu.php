<?php
ob_start();
require "../Login/connection.php";
require_once "../Login/controllerUserData.php";

    $username = "";
    $email = "";
    $telephone = "";
    $bio = "";
    $errors = array();

    if (!isset($_SESSION['status']) || $_SESSION['status'] != 'verified') {
      // Jika belum masuk, arahkan ke halaman masuk
      header('Location: ../Login/masuk.php');
      exit(); // Pastikan untuk keluar dari skrip setelah mengarahkan
    }

    // Memeriksa apakah pengguna sudah masuk
    if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified') {
        // Jika sudah masuk, ambil username pengguna dari database berdasarkan email yang tersimpan di sesi
        $email = $_SESSION['email'];
        $query = "SELECT username FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];
        }
    }

    // Memeriksa apakah pengguna sudah masuk
    if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified') {
        // Jika sudah masuk, ambil username pengguna dari database berdasarkan email yang tersimpan di sesi
        $email = $_SESSION['email'];
        $query = "SELECT bio FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $bio = $row['bio'];
        }
    }

    

    $email = $_SESSION['email'];
    $get_profile_image_query = "SELECT profileimage FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $get_profile_image_query);
    $row = mysqli_fetch_assoc($result);
    $profile_image_path = $row['profileimage'];

    // Memeriksa apakah pengguna sudah masuk
    if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified') {
      // Jika sudah masuk, ambil username pengguna dari database berdasarkan email yang tersimpan di sesi
      $email = $_SESSION['email'];
      $query = "SELECT profileimage FROM users WHERE email = '$email'";
      $result = mysqli_query($con, $query);
      
      if(mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $profileimage = $row['profileimage'];
      }
      
    }

    $account_link = "../Akun/user?=$username";
    

    ob_end_flush();  

    $sql = "SELECT roles FROM users WHERE username='$username'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data dari setiap baris
        while($row = $result->fetch_assoc()) {
            $roles = $row["roles"]; // Ambil roles dari database
        }
    } else {
        echo "0 hasil";
    }
    $con->close();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="cssbin/produkmu.css" />
    <title>Produkmu</title>
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
                  <input
                    type="text"
                    placeholder="Cari Kebutuhanmu"
                    class="search"
                  />
                </td>
              </tr>
            </table>
          </div>
          <div class="NavNotifPesan">
            <a href=""><img src="Icon/bell.svg" alt="" /></a>
            <a href=""><img src="Icon/mail.svg" alt="" /></a>
          </div>
          <div class="Profile">
            <a href="">
            <img src="../Akun/<?php echo $profile_image_path ?>" alt="Profile Image">
            </a>
          </div>
          <div class="Logout">
            <a
              ><img
                src="../../Icon/Setting-Gear.svg"
                alt=""
                id="m-settings-nav-show"
            /></a>
          </div>
        </div>
      </div>

      <div class="m-navigasi-hide" style="display: none">
        <div class="m-navigasi-hide-box">
          <div class="m-navigasi-hide-box-setting">
            <div class="m-navigasi-hide-box-nav">
              <div class="m-navigasi-hide-box-nav-exit">
                <img
                  src="Icon/Arrow-Left.svg"
                  alt=""
                  id="m-settings-nav-hide"
                />
              </div>
              <div class="m-navigasi-hide-box-nav-judul">
                <h3>Pengaturan</h3>
              </div>
            </div>

            <div class="m-navigasi-hide-box-pilihan">
              <a href="edit-profile.php">
                <div class="m-navigasi-hide-box-pilihan-setting">
                  <div class="m-navigasi-hide-box-pilihan-setting-icon">
                    <svg
                      width="30"
                      height="30"
                      viewBox="0 0 30 30"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M5.25 21V21.232L5.38102 21.4235C7.4601 24.4622 10.984 26.55 15 26.55C19.016 26.55 22.5399 24.4622 24.619 21.4235L24.75 21.232V21C24.75 19.9774 24.2338 19.1279 23.5311 18.463C22.8321 17.8016 21.8989 17.2716 20.9154 16.8585C18.9515 16.0336 16.6029 15.6 15 15.6C13.3971 15.6 11.0485 16.0336 9.08458 16.8585C8.10113 17.2716 7.16793 17.8016 6.46892 18.463C5.76621 19.1279 5.25 19.9774 5.25 21ZM0.75 15C0.75 7.16421 7.16421 0.75 15 0.75C22.8358 0.75 29.25 7.16421 29.25 15C29.25 22.8358 22.8358 29.25 15 29.25C7.16421 29.25 0.75 22.8358 0.75 15ZM20.25 9C20.25 6.03579 17.9642 3.75 15 3.75C12.0358 3.75 9.75 6.03579 9.75 9C9.75 11.9642 12.0358 14.25 15 14.25C17.9642 14.25 20.25 11.9642 20.25 9Z"
                        stroke="black"
                        stroke-width="1.5"
                      />
                    </svg>
                  </div>
                  <div class="m-navigasi-hide-box-pilihan-setting-text-info">
                    <div class="m-navigasi-hide-box-pilihan-setting-text">
                      <h3>Profile Settings</h3>
                    </div>
                    <div class="m-navigasi-hide-box-pilihan-setting-icon-right">
                      <img src="arrow2-right.svg" alt="" />
                    </div>
                  </div>
                </div>
              </a>

              <a href="">
                <div class="m-navigasi-hide-box-pilihan-setting">
                  <div class="m-navigasi-hide-box-pilihan-setting-icon">
                    <svg
                      width="30"
                      height="36"
                      viewBox="0 0 30 36"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M28.9869 11.8835C29.0695 14.4285 28.7691 17.3136 27.862 20.1175C25.8042 26.4763 21.8236 31.3596 15.906 34.7397C15.2928 35.0897 14.6745 35.0897 14.0395 34.722C7.67234 31.0358 3.5728 25.7028 1.73578 18.7295C1.20734 16.724 1.00112 14.676 1.0004 12.6078C0.999669 11.3154 1.00003 10.0229 1.00076 8.73002C1.00149 7.61924 1.54885 7.06773 2.6752 6.95708C6.8093 6.55265 10.3509 4.92395 13.283 2.05614C13.4689 1.87443 13.6445 1.68317 13.8297 1.50075C14.513 0.828343 15.5092 0.826929 16.1868 1.53398C17.3702 2.76885 18.6788 3.84923 20.1768 4.70688C22.4077 5.98453 24.8143 6.73789 27.3929 6.96521C28.4061 7.05465 28.9793 7.64257 28.9858 8.63421C28.992 9.58944 28.9869 10.5443 28.9869 11.8835ZM22.7583 14.046C22.6328 13.8544 22.5474 13.6585 22.4041 13.5185C22.0495 13.1724 21.6702 12.85 21.2974 12.5212C20.7806 12.0652 20.5023 12.0737 20.0146 12.5569C18.1602 14.3935 16.3064 16.2308 14.4512 18.0667C13.9442 18.5683 13.6715 18.5761 13.1368 18.1214C12.2534 17.3702 11.3707 16.6179 10.4811 15.8734C10.1378 15.586 9.82213 15.6019 9.49699 15.9091C9.12748 16.258 8.76597 16.6147 8.40264 16.9697C7.95384 17.4077 7.94584 17.6824 8.38227 18.1285C10.0494 19.8332 11.7188 21.5362 13.3885 23.2384C13.8049 23.663 14.1399 23.6644 14.5389 23.2278C17.1807 20.3381 19.82 17.4466 22.455 14.5512C22.5757 14.4186 22.643 14.2411 22.7583 14.046Z"
                        stroke="black"
                        stroke-miterlimit="10"
                      />
                    </svg>
                  </div>
                  <div class="m-navigasi-hide-box-pilihan-setting-text-info">
                    <div class="m-navigasi-hide-box-pilihan-setting-text">
                      <h3>Security Settings</h3>
                    </div>
                    <div class="m-navigasi-hide-box-pilihan-setting-icon-right">
                      <img src="Icon/arrow2-right.svg" alt="" />
                    </div>
                  </div>
                </div>
              </a>

              <a href="">
                <div class="m-navigasi-hide-box-pilihan-setting">
                  <div class="m-navigasi-hide-box-pilihan-setting-icon">
                    <svg
                      class="icon-aktifitas"
                      width="30"
                      height="30"
                      viewBox="0 0 21 21"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M19.2682 9.21937V17.0741C19.2682 18.6936 17.9644 19.9974 16.3449 19.9974H3.92318C2.3037 19.9974 0.999924 18.6936 0.999924 17.0741V4.65286C0.999924 3.03338 2.3037 1.72961 3.92318 1.72961H11.7957"
                        stroke="black"
                        stroke-width="0.999999"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M4.41121 13.8413L6.41528 11.7537C7.33508 10.8339 8.50353 10.9303 9.17926 11.7433C9.88998 12.5155 10.9933 12.7224 12.0366 11.7208L13.9364 9.62408"
                        stroke="black"
                        stroke-width="0.999999"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M19.9978 3.49618C19.9978 4.15819 19.7348 4.79309 19.2667 5.26121C18.7986 5.72932 18.1636 5.9923 17.5016 5.9923C16.8396 5.9923 16.2047 5.72932 15.7366 5.26121C15.2685 4.79309 15.0055 4.15819 15.0055 3.49618C15.0055 2.83417 15.2685 2.19927 15.7366 1.73116C16.2047 1.26304 16.8396 1.00006 17.5016 1.00006C18.1636 1.00006 18.7986 1.26304 19.2667 1.73116C19.7348 2.19927 19.9978 2.83417 19.9978 3.49618Z"
                        stroke="black"
                        stroke-width="0.999999"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="m-navigasi-hide-box-pilihan-setting-text-info">
                    <div class="m-navigasi-hide-box-pilihan-setting-text">
                      <h3>Aktifitasmu</h3>
                    </div>
                    <div class="m-navigasi-hide-box-pilihan-setting-icon-right">
                      <img src="Icon/arrow2-right.svg" alt="" />
                    </div>
                  </div>
                </div>
              </a>

              <a href="">
                <div class="m-navigasi-hide-box-pilihan-setting">
                  <div class="m-navigasi-hide-box-pilihan-setting-icon">
                    <svg
                      fill="none"
                      height="30"
                      viewBox="0 0 118 155"
                      width="30"
                    >
                      <g clip-path="url(#clip0)">
                        <path
                          d="M56.0783 107.382C55.4041 108.47 54.645 109.505 53.8083 110.474C41.3062 122.797 28.7751 135.09 16.2149 147.353C14.0892 149.468 11.7634 151.374 9.27033 153.043C5.04205 155.798 1.705 154.135 1.00105 149.114C0.880203 147.788 0.852448 146.455 0.917897 145.124C0.964697 113.828 0.930928 82.5317 1.11293 51.2362C1.18378 38.9257 1.66869 26.6152 2.12109 14.3105C2.32537 11.6584 2.7779 9.03129 3.47299 6.46332C4.21009 3.25696 5.09796 2.39559 8.47798 2.1245C15.3478 1.57324 22.2313 0.939644 29.1155 0.846904C54.251 0.510311 79.3897 0.402671 104.527 0.150391C107.856 0.184034 111.148 0.847844 114.229 2.10645C114.975 2.3557 115.635 2.81229 116.13 3.42268C116.625 4.03307 116.935 4.77187 117.024 5.55211C117.262 7.08419 117.366 8.63381 117.335 10.1839C115.675 53.3361 114.86 96.4946 116.072 139.676C116.054 143.084 115.767 146.486 115.213 149.848C114.88 152.368 112.483 153.852 109.719 153.48C106.933 153.093 104.387 151.697 102.565 149.56C88.7036 134.096 71.7678 122.033 56.0783 107.382ZM108.629 7.75387L10.4976 8.46337C10.3676 9.60868 10.2481 10.2502 10.2331 10.8935C10.083 17.6564 9.79098 24.4206 9.83713 31.1822C10.0789 66.5829 10.3705 101.983 10.712 137.382C10.7185 138.076 10.8115 138.769 10.8999 139.936C12.092 138.828 12.9111 138.112 13.6788 137.347C25.9464 125.103 38.2079 112.855 50.4634 100.602C54.9348 96.123 57.7733 96.0063 62.4611 100.122C68.3898 105.326 74.414 110.423 80.3179 115.656C88.7133 123.096 97.0353 130.619 105.398 138.096C105.947 138.504 106.521 138.878 107.115 139.218C104.65 95.2053 107.356 51.7531 108.629 7.75387Z"
                          fill="black"
                        />
                      </g>
                      <defs>
                        <clipPath id="clip0">
                          <rect
                            fill="white"
                            height="155"
                            transform="translate(0.777344)"
                            width="117"
                          />
                        </clipPath>
                      </defs>
                    </svg>
                  </div>
                  <div class="m-navigasi-hide-box-pilihan-setting-text-info">
                    <div class="m-navigasi-hide-box-pilihan-setting-text">
                      <h3>Saved</h3>
                    </div>
                    <div class="m-navigasi-hide-box-pilihan-setting-icon-right">
                      <img src="Icon/arrow2-right.svg" alt="" />
                    </div>
                  </div>
                </div>
              </a>

              <div class=""></div>
              <div class="m-navigasi-hide-box-pilihan-setting-logout">
                <div class="m-navigasi-hide-box-pilihan-setting-text-logout">
                  <a href="logout.php"><button>Logout</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="badan">
      <div class="Desktop">
        <div class="Badan-Desktop">
          <div class="Des-Navigasi-Samping">
            <nav class="Nav-Navigasi-Samping">
              <a href="../../home">
                <div class="Navigasi-Samping-Pilihan">
                  <div class="Navigasi-Samping-Pilihan-icon">
                    <svg
                      width="26"
                      height="26"
                      viewBox="0 0 24 21"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M12 0C12 0 4.5768 6.23 0.4284 9.604C0.1848 9.81867 0 10.1313 0 10.5C0 11.1452 0.5364 11.6667 1.2 11.6667H3.6V19.8333C3.6 20.4785 4.1364 21 4.8 21H8.4C9.0636 21 9.6 20.4773 9.6 19.8333V15.1667H14.4V19.8333C14.4 20.4773 14.9364 21 15.6 21H19.2C19.8636 21 20.4 20.4785 20.4 19.8333V11.6667H22.8C23.4636 11.6667 24 11.1452 24 10.5C24 10.1313 23.8152 9.81867 23.5404 9.604C19.4208 6.23 12 0 12 0Z"
                        fill="black"
                      />
                    </svg>
                  </div>
                  <div class="Navigasi-Samping-Pilihan-Text">
                    <h1>Beranda</h1>
                  </div>
                </div>
              </a>

              <a href="">
                <div class="Navigasi-Samping-Pilihan">
                  <div class="Navigasi-Samping-Pilihan-icon">
                    <svg
                      width="26"
                      height="26"
                      viewBox="0 0 26 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M21 24H5C4.20435 24 3.44129 23.6839 2.87868 23.1213C2.31607 22.5587 2 21.7956 2 21V11C2 10.7348 2.10536 10.4804 2.29289 10.2929C2.48043 10.1054 2.73478 10 3 10C3.26522 10 3.51957 10.1054 3.70711 10.2929C3.89464 10.4804 4 10.7348 4 11V21C4 21.2652 4.10536 21.5196 4.29289 21.7071C4.48043 21.8946 4.73478 22 5 22H21C21.2652 22 21.5196 21.8946 21.7071 21.7071C21.8946 21.5196 22 21.2652 22 21V11C22 10.7348 22.1054 10.4804 22.2929 10.2929C22.4804 10.1054 22.7348 10 23 10C23.2652 10 23.5196 10.1054 23.7071 10.2929C23.8946 10.4804 24 10.7348 24 11V21C24 21.7956 23.6839 22.5587 23.1213 23.1213C22.5587 23.6839 21.7956 24 21 24Z"
                        fill="black"
                      />
                      <path
                        d="M12 24H7C6.73478 24 6.48043 23.8946 6.29289 23.7071C6.10536 23.5196 6 23.2652 6 23V17C6 16.2044 6.31607 15.4413 6.87868 14.8787C7.44129 14.3161 8.20435 14 9 14H10C10.7956 14 11.5587 14.3161 12.1213 14.8787C12.6839 15.4413 13 16.2044 13 17V23C13 23.2652 12.8946 23.5196 12.7071 23.7071C12.5196 23.8946 12.2652 24 12 24ZM8 22H11V17C11 16.7348 10.8946 16.4804 10.7071 16.2929C10.5196 16.1054 10.2652 16 10 16H9C8.73478 16 8.48043 16.1054 8.29289 16.2929C8.10536 16.4804 8 16.7348 8 17V22Z"
                        fill="black"
                      />
                      <path
                        d="M22 12C20.9391 12 19.9217 11.5786 19.1716 10.8284C18.4214 10.0783 18 9.06087 18 8C18 7.73478 18.1054 7.48043 18.2929 7.29289C18.4804 7.10536 18.7348 7 19 7C19.2652 7 19.5196 7.10536 19.7071 7.29289C19.8946 7.48043 20 7.73478 20 8C20 8.53043 20.2107 9.03914 20.5858 9.41421C20.9609 9.78929 21.4696 10 22 10C22.5304 10 23.0391 9.78929 23.4142 9.41421C23.7893 9.03914 24 8.53043 24 8V7.24L21.38 2H4.62L2 7.24V8C2 8.53043 2.21071 9.03914 2.58579 9.41421C2.96086 9.78929 3.46957 10 4 10C4.53043 10 5.03914 9.78929 5.41421 9.41421C5.78929 9.03914 6 8.53043 6 8C6 7.73478 6.10536 7.48043 6.29289 7.29289C6.48043 7.10536 6.73478 7 7 7C7.26522 7 7.51957 7.10536 7.70711 7.29289C7.89464 7.48043 8 7.73478 8 8C8 9.06087 7.57857 10.0783 6.82843 10.8284C6.07828 11.5786 5.06087 12 4 12C2.93913 12 1.92172 11.5786 1.17157 10.8284C0.421427 10.0783 0 9.06087 0 8V7C0.000938583 6.84346 0.038616 6.68932 0.11 6.55L3.11 0.55C3.1931 0.385086 3.32024 0.246402 3.47733 0.149323C3.63443 0.0522435 3.81533 0.000559705 4 0H22C22.1847 0.000559705 22.3656 0.0522435 22.5227 0.149323C22.6798 0.246402 22.8069 0.385086 22.89 0.55L25.89 6.55C25.9614 6.68932 25.9991 6.84346 26 7V8C26 9.06087 25.5786 10.0783 24.8284 10.8284C24.0783 11.5786 23.0609 12 22 12Z"
                        fill="black"
                      />
                      <path
                        d="M10 12C8.93913 12 7.92172 11.5786 7.17157 10.8284C6.42143 10.0783 6 9.06087 6 8C6 7.73478 6.10536 7.48043 6.29289 7.29289C6.48043 7.10536 6.73478 7 7 7C7.26522 7 7.51957 7.10536 7.70711 7.29289C7.89464 7.48043 8 7.73478 8 8C8 8.53043 8.21071 9.03914 8.58579 9.41421C8.96086 9.78929 9.46957 10 10 10C10.5304 10 11.0391 9.78929 11.4142 9.41421C11.7893 9.03914 12 8.53043 12 8C12 7.73478 12.1054 7.48043 12.2929 7.29289C12.4804 7.10536 12.7348 7 13 7C13.2652 7 13.5196 7.10536 13.7071 7.29289C13.8946 7.48043 14 7.73478 14 8C14 9.06087 13.5786 10.0783 12.8284 10.8284C12.0783 11.5786 11.0609 12 10 12Z"
                        fill="black"
                      />
                      <path
                        d="M16 12C14.9391 12 13.9217 11.5786 13.1716 10.8284C12.4214 10.0783 12 9.06087 12 8C12 7.73478 12.1054 7.48043 12.2929 7.29289C12.4804 7.10536 12.7348 7 13 7C13.2652 7 13.5196 7.10536 13.7071 7.29289C13.8946 7.48043 14 7.73478 14 8C14 8.53043 14.2107 9.03914 14.5858 9.41421C14.9609 9.78929 15.4696 10 16 10C16.5304 10 17.0391 9.78929 17.4142 9.41421C17.7893 9.03914 18 8.53043 18 8C18 7.73478 18.1054 7.48043 18.2929 7.29289C18.4804 7.10536 18.7348 7 19 7C19.2652 7 19.5196 7.10536 19.7071 7.29289C19.8946 7.48043 20 7.73478 20 8C20 9.06087 19.5786 10.0783 18.8284 10.8284C18.0783 11.5786 17.0609 12 16 12Z"
                        fill="black"
                      />
                      <path
                        d="M19 17H16C15.7348 17 15.4804 16.8946 15.2929 16.7071C15.1054 16.5196 15 16.2652 15 16C15 15.7348 15.1054 15.4804 15.2929 15.2929C15.4804 15.1054 15.7348 15 16 15H19C19.2652 15 19.5196 15.1054 19.7071 15.2929C19.8946 15.4804 20 15.7348 20 16C20 16.2652 19.8946 16.5196 19.7071 16.7071C19.5196 16.8946 19.2652 17 19 17Z"
                        fill="black"
                      />
                    </svg>
                  </div>
                  <div class="Navigasi-Samping-Pilihan-Text">
                    <h1>Seller Center</h1>
                  </div>
                </div>
              </a>

              <a href="">
                <div class="Navigasi-Samping-Pilihan">
                  <div class="Navigasi-Samping-Pilihan-icon">
                    <svg
                      width="26"
                      height="26"
                      viewBox="0 0 21 21"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M19.2682 9.21937V17.0741C19.2682 18.6936 17.9644 19.9974 16.3449 19.9974H3.92318C2.3037 19.9974 0.999924 18.6936 0.999924 17.0741V4.65286C0.999924 3.03338 2.3037 1.72961 3.92318 1.72961H11.7957"
                        stroke="black"
                        stroke-width="0.999999"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M4.41121 13.8413L6.41528 11.7537C7.33508 10.8339 8.50353 10.9303 9.17926 11.7433C9.88998 12.5155 10.9933 12.7224 12.0366 11.7208L13.9364 9.62408"
                        stroke="black"
                        stroke-width="0.999999"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M19.9978 3.49618C19.9978 4.15819 19.7348 4.79309 19.2667 5.26121C18.7986 5.72932 18.1636 5.9923 17.5016 5.9923C16.8396 5.9923 16.2047 5.72932 15.7366 5.26121C15.2685 4.79309 15.0055 4.15819 15.0055 3.49618C15.0055 2.83417 15.2685 2.19927 15.7366 1.73116C16.2047 1.26304 16.8396 1.00006 17.5016 1.00006C18.1636 1.00006 18.7986 1.26304 19.2667 1.73116C19.7348 2.19927 19.9978 2.83417 19.9978 3.49618Z"
                        stroke="black"
                        stroke-width="0.999999"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <div class="Navigasi-Samping-Pilihan-Text">
                    <h1>Aktifitasmu</h1>
                  </div>
                </div>
              </a>

              <a href="">
                <div class="Navigasi-Samping-Pilihan">
                  <div class="Navigasi-Samping-Pilihan-icon">
                    <svg
                      width="27"
                      height="27"
                      viewBox="0 0 28 35"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M27.9869 11.2037C28.0696 13.8233 27.7691 16.7939 26.8619 19.6796C24.8047 26.2258 20.8239 31.2521 14.9059 34.7319C14.2927 35.0923 13.6745 35.0923 13.0391 34.714C6.67181 30.9191 2.5724 25.4295 0.735821 18.2512C0.207491 16.1861 0.00119153 14.0786 0.000472714 11.9496C-0.000246103 10.6189 -0.000247595 9.28826 0.00119004 7.9576C0.00190886 6.81395 0.548929 6.24645 1.67532 6.1328C5.80923 5.71562 9.35084 4.03971 12.2829 1.08708C12.4684 0.900067 12.6445 0.702984 12.8299 0.515253C13.5135 -0.17669 14.5091 -0.178128 15.1869 0.549779C16.3701 1.82074 17.6791 2.93274 19.1771 3.81601C21.4083 5.13085 23.8142 5.90695 26.3933 6.14071C27.4068 6.23278 27.9797 6.83769 27.9862 7.85834C27.9919 8.84231 27.9869 9.82556 27.9869 11.2037ZM21.7583 13.4299C21.6326 13.2328 21.5477 13.0307 21.404 12.8868C21.0496 12.53 20.6701 12.1985 20.2977 11.8604C19.7809 11.3907 19.5027 11.4001 19.0146 11.8971C17.1601 13.7873 15.3062 15.679 13.451 17.5686C12.9442 18.085 12.6711 18.0929 12.137 17.6254C11.2536 16.8522 10.3708 16.0775 9.48167 15.3108C9.13807 15.0151 8.82251 15.0317 8.49761 15.3474C8.12814 15.7064 7.76657 16.0739 7.40285 16.4393C6.95431 16.8903 6.9464 17.173 7.38272 17.6326C9.04966 19.3876 10.7195 21.1405 12.3893 22.8927C12.8055 23.33 13.1404 23.3314 13.5394 22.8819C16.181 19.9069 18.8205 16.9306 21.455 13.9499C21.575 13.8139 21.6433 13.6313 21.7583 13.4299Z"
                        fill="black"
                      />
                    </svg>
                  </div>
                  <div class="Navigasi-Samping-Pilihan-Text">
                    <h1>Privacy Akun</h1>
                  </div>
                </div>
              </a>

              <a href="../../logout">
                <div class="Navigasi-Samping-Pilihan-Button">
                  <div class="Navigasi-Samping-Pilihan-Logout">
                    <button>Logout</button>
                  </div>
                </div>
              </a>
            </nav>
          </div>

          <div class="produk-gig">
            <div class="produk-gig-frame">
                <div class="produk-gig-main">
                    <div class="produk-gig-main-info">
                        <h1>Aku akan membuat design Produk untukmu</h1>
                    </div>
                    <div class="gig-user">
                        <div class="gig-user-profile">
                        <img src="../Akun/<?php echo $profile_image_path ?>" alt="Profile Image">
                        </div>
                        <div class="gig-user-username">
                            <a href="<?php echo $account_link; ?>"><span><?php echo $username ?></span></a>
                        </div>
                    </div>
                    <div class="produk-gig-container">
                        <div class="produk-gig-main-picture">
                            <!-- Gambar utama di sini -->
                            <img src="../../Image/Aki.jpg" alt="Gambar Utama" id="gambar-utama">
                        </div>
                        <div class="produk-gig-thumbnail">
                            <!-- Thumbnail gambar kecil -->
                            <img src="../../Image/Aki.jpg" alt="Gambar 2" class="thumbnail" onclick="tampilkanGambar(this)">
                            <img src="../../Image/copywriting.svg" alt="Gambar 3" class="thumbnail" onclick="tampilkanGambar(this)">
                            <img src="../../Image/post1.jpg" alt="Gambar 4" class="thumbnail" onclick="tampilkanGambar(this)">
                        </div>
                    </div>

                    <div class="produk-gig-main-info-deskripsi">
                        <div class="produk-gig-info-note">
                            <h3>Tentang Produk</h3>
                        </div>
                        <div class="produk-gig-main-info-deskripsi-user">
                            <span>If You're looking for Professional Packaging Design & Box Packaging for your products to amaze your customers in market, well you're in the right place !!!
                                Welcome to my Packaging Gig 
                                I will make an attractive and unique packaging design for you with 3D Mockup that will increase your product value in the market of e-commerce, Spotify, Amazon, Ebay and small and large business owners. I'll make any kind of custom style boxes in print ready format so your supplier (manufacturer) easily print your boxes using my provided design file.
                                We Provide Source Files in (AI + PDF + EPS + JPEG) and 3D Mockup
                                For get the best result we recommend use color format as CMYK
                                What we deliver to you?
                                Box Packaging Design related to any design theme ordered by you
                                All Files format are ready to print
                                3D Mockup
                                Why choose us?
                                Professional in our work
                                Fast Delivery
                                Unlimited Revision
                                Money Back Guarantee
                                Feel Free to ask if you have any questions about our gig for any assistance we will be more than happy to work with you. Inbox me before order</span>
                        </div>
                    </div>
                    
                </div>
                <div class="produk-gig-buy">
                    <div class="sticky-produk-gig-buy">
                        <div class="sticky-produk-gig-buy-kerangka">
                            <div class="produk-gig-buy-class">
                                <div class="product-gig-buy-class-user">
                                    <h2>Basic</h2>
                                </div>
                                <div class="product-gig-buy-class-user">
                                    <h2>Premium</h2>
                                </div>
                                <div class="product-gig-buy-class-user">
                                    <h2>Deluxe</h2>
                                </div>
                            </div>
                        </div>
                        <div class="sticky-produk-gig-buy-info">
                            <div class="sticky-produk-gig-buy-info-kerangka">
                                <div class="sticky-produk-gig-buy-info-price">
                                    <h3>Hanya Design</h3>
                                    <span>Rp. 90.000</span>
                                </div>
                                <div class="sticky-produk-gig-buy-info-note">
                                    <span>(Text me before order) Only Dieline of the box without Design + Source file + ready to print</span>
                                </div>
                                <div class="sticky-produk-gig-buy-info-delivery">
                                    <span>8-Jam Pengerjaan</span>
                                    <span>2x Revisi</span>
                                </div>
                                <div class="sticky-produk-gig-buy-info-itemlist">
                                    <div class="gig-produk-item">
                                        <div class="gig-item-logo">

                                        </div>
                                        <div class="gig-item">
                                            <span>1 Design Gambar</span>
                                        </div>
                                    </div>
                                    <div class="gig-produk-item">
                                        <div class="gig-item-logo">

                                        </div>
                                        <div class="gig-item">
                                            <span>Source File</span>
                                        </div>
                                    </div>
                                    <div class="gig-produk-item">
                                        <div class="gig-item-logo">

                                        </div>
                                        <div class="gig-item">
                                            <span>Printable File</span>
                                        </div>
                                    </div>
                                    <div class="gig-produk-item">
                                        <div class="gig-item-logo">

                                        </div>
                                        <div class="gig-item">
                                            <span>High Resolution</span>
                                        </div>
                                    </div>
                                    <div class="gig-produk-item">
                                        <div class="gig-item-logo">

                                        </div>
                                        <div class="gig-item">
                                            <span>3D Mockup</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="sticky-produk-gig-buy-info-button">
                                    <button>Beli Sekarang</button>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>

            </div>
          </div>


        </div>

        <div class="space">

        </div>





      <!--        Mobile Fitur        -->
      <div class="Mobile">
        <div class="MobileNavigasi">
          <div class="MobileNavigasiBox">
            <div class="MobileNavigasiBoxIcon">
              <div>
                <a href="../../home">
                  <img src="../../Icon/Home.svg" alt="" />
                </a>
              </div>

              <div>
                <a href="../Search/Search.html">
                  <img src="../../Icon/Search.svg" alt="" />
                </a>
              </div>

              <div>
                <a href="../Post/Post.html">
                  <img src="../../Icon/Plus.svg" alt="" />
                </a>
              </div>

              <div>
                <a href="../Shorts/Shorts.html">
                  <img src="../../Icon/Reels.svg" alt="" />
                </a>
              </div>

              <div>
                <a href="../Akun/user?<?php echo $username ?>">
                  <img src="../../Icon/Akun.svg" alt="" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<script src="javabin/produkmu.js"></script>
<script>
    function tampilkanGambar(thumbnail) {
  var gambarUtama = document.getElementById("gambar-utama");
  var gambarBaru = thumbnail.src;
  gambarUtama.src = gambarBaru;

  // Memperbarui class untuk gambar thumbnail yang sedang aktif
  var thumbnails = document.querySelectorAll(".thumbnail");
  thumbnails.forEach(function (thumb) {
    if (thumb.src === gambarBaru) {
      thumb.classList.add("active");
    } else {
      thumb.classList.remove("active");
    }
  });
}
</script>
