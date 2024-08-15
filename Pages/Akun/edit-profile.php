<?php
require "../Login/connection.php";
require_once "../Login/controllerUserData.php";
ob_start();

    $username = "";
    $email = "";
    $telephone = "";
    $bio = "";
    $profileimage = "";
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
    $email = $_SESSION['email'];
    $get_profile_image_query = "SELECT profileimage FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $get_profile_image_query);
    $row = mysqli_fetch_assoc($result);
    $profile_image_path = $row['profileimage'];
    
    
        
    
    
    

    

    ob_end_flush(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cssbin/edit-profile.css">
    
    <title>Edit Profile</title>
</head>
<body>

    <!--         Header Navigasi         -->
    <header>
        <div class="NavigasiMenuHeadAtas">
            <div class="NavigasiMenu">
                <div class="LogoNavigasiMenuAtas">
                    <a href="user?<?php echo $username ?>">
                        <svg height="24" viewBox="0 0 24 24" width="24"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"/></svg>
                        <h1>Edit Profile</h1>
                    </a>
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
            </div>
        </div>
    </header>

    <!--         Konten Body         -->
    <div class="badan">

        <div class="Desktop">

        
            
            <div class="Badan-Desktop">

                <!--        Navigasi Samping        -->
                <div class="Des-Navigasi-Samping">

                    <nav class="Nav-Navigasi-Samping">

                        <a href="../../home">
                            <div class="Navigasi-Samping-Pilihan">
                                <div class="Navigasi-Samping-Pilihan-icon">
                                    <svg width="26" height="26" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 0C12 0 4.5768 6.23 0.4284 9.604C0.1848 9.81867 0 10.1313 0 10.5C0 11.1452 0.5364 11.6667 1.2 11.6667H3.6V19.8333C3.6 20.4785 4.1364 21 4.8 21H8.4C9.0636 21 9.6 20.4773 9.6 19.8333V15.1667H14.4V19.8333C14.4 20.4773 14.9364 21 15.6 21H19.2C19.8636 21 20.4 20.4785 20.4 19.8333V11.6667H22.8C23.4636 11.6667 24 11.1452 24 10.5C24 10.1313 23.8152 9.81867 23.5404 9.604C19.4208 6.23 12 0 12 0Z" fill="black"/>
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
                                    <svg width="26" height="26" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 24H5C4.20435 24 3.44129 23.6839 2.87868 23.1213C2.31607 22.5587 2 21.7956 2 21V11C2 10.7348 2.10536 10.4804 2.29289 10.2929C2.48043 10.1054 2.73478 10 3 10C3.26522 10 3.51957 10.1054 3.70711 10.2929C3.89464 10.4804 4 10.7348 4 11V21C4 21.2652 4.10536 21.5196 4.29289 21.7071C4.48043 21.8946 4.73478 22 5 22H21C21.2652 22 21.5196 21.8946 21.7071 21.7071C21.8946 21.5196 22 21.2652 22 21V11C22 10.7348 22.1054 10.4804 22.2929 10.2929C22.4804 10.1054 22.7348 10 23 10C23.2652 10 23.5196 10.1054 23.7071 10.2929C23.8946 10.4804 24 10.7348 24 11V21C24 21.7956 23.6839 22.5587 23.1213 23.1213C22.5587 23.6839 21.7956 24 21 24Z" fill="black"/>
                                        <path d="M12 24H7C6.73478 24 6.48043 23.8946 6.29289 23.7071C6.10536 23.5196 6 23.2652 6 23V17C6 16.2044 6.31607 15.4413 6.87868 14.8787C7.44129 14.3161 8.20435 14 9 14H10C10.7956 14 11.5587 14.3161 12.1213 14.8787C12.6839 15.4413 13 16.2044 13 17V23C13 23.2652 12.8946 23.5196 12.7071 23.7071C12.5196 23.8946 12.2652 24 12 24ZM8 22H11V17C11 16.7348 10.8946 16.4804 10.7071 16.2929C10.5196 16.1054 10.2652 16 10 16H9C8.73478 16 8.48043 16.1054 8.29289 16.2929C8.10536 16.4804 8 16.7348 8 17V22Z" fill="black"/>
                                        <path d="M22 12C20.9391 12 19.9217 11.5786 19.1716 10.8284C18.4214 10.0783 18 9.06087 18 8C18 7.73478 18.1054 7.48043 18.2929 7.29289C18.4804 7.10536 18.7348 7 19 7C19.2652 7 19.5196 7.10536 19.7071 7.29289C19.8946 7.48043 20 7.73478 20 8C20 8.53043 20.2107 9.03914 20.5858 9.41421C20.9609 9.78929 21.4696 10 22 10C22.5304 10 23.0391 9.78929 23.4142 9.41421C23.7893 9.03914 24 8.53043 24 8V7.24L21.38 2H4.62L2 7.24V8C2 8.53043 2.21071 9.03914 2.58579 9.41421C2.96086 9.78929 3.46957 10 4 10C4.53043 10 5.03914 9.78929 5.41421 9.41421C5.78929 9.03914 6 8.53043 6 8C6 7.73478 6.10536 7.48043 6.29289 7.29289C6.48043 7.10536 6.73478 7 7 7C7.26522 7 7.51957 7.10536 7.70711 7.29289C7.89464 7.48043 8 7.73478 8 8C8 9.06087 7.57857 10.0783 6.82843 10.8284C6.07828 11.5786 5.06087 12 4 12C2.93913 12 1.92172 11.5786 1.17157 10.8284C0.421427 10.0783 0 9.06087 0 8V7C0.000938583 6.84346 0.038616 6.68932 0.11 6.55L3.11 0.55C3.1931 0.385086 3.32024 0.246402 3.47733 0.149323C3.63443 0.0522435 3.81533 0.000559705 4 0H22C22.1847 0.000559705 22.3656 0.0522435 22.5227 0.149323C22.6798 0.246402 22.8069 0.385086 22.89 0.55L25.89 6.55C25.9614 6.68932 25.9991 6.84346 26 7V8C26 9.06087 25.5786 10.0783 24.8284 10.8284C24.0783 11.5786 23.0609 12 22 12Z" fill="black"/>
                                        <path d="M10 12C8.93913 12 7.92172 11.5786 7.17157 10.8284C6.42143 10.0783 6 9.06087 6 8C6 7.73478 6.10536 7.48043 6.29289 7.29289C6.48043 7.10536 6.73478 7 7 7C7.26522 7 7.51957 7.10536 7.70711 7.29289C7.89464 7.48043 8 7.73478 8 8C8 8.53043 8.21071 9.03914 8.58579 9.41421C8.96086 9.78929 9.46957 10 10 10C10.5304 10 11.0391 9.78929 11.4142 9.41421C11.7893 9.03914 12 8.53043 12 8C12 7.73478 12.1054 7.48043 12.2929 7.29289C12.4804 7.10536 12.7348 7 13 7C13.2652 7 13.5196 7.10536 13.7071 7.29289C13.8946 7.48043 14 7.73478 14 8C14 9.06087 13.5786 10.0783 12.8284 10.8284C12.0783 11.5786 11.0609 12 10 12Z" fill="black"/>
                                        <path d="M16 12C14.9391 12 13.9217 11.5786 13.1716 10.8284C12.4214 10.0783 12 9.06087 12 8C12 7.73478 12.1054 7.48043 12.2929 7.29289C12.4804 7.10536 12.7348 7 13 7C13.2652 7 13.5196 7.10536 13.7071 7.29289C13.8946 7.48043 14 7.73478 14 8C14 8.53043 14.2107 9.03914 14.5858 9.41421C14.9609 9.78929 15.4696 10 16 10C16.5304 10 17.0391 9.78929 17.4142 9.41421C17.7893 9.03914 18 8.53043 18 8C18 7.73478 18.1054 7.48043 18.2929 7.29289C18.4804 7.10536 18.7348 7 19 7C19.2652 7 19.5196 7.10536 19.7071 7.29289C19.8946 7.48043 20 7.73478 20 8C20 9.06087 19.5786 10.0783 18.8284 10.8284C18.0783 11.5786 17.0609 12 16 12Z" fill="black"/>
                                        <path d="M19 17H16C15.7348 17 15.4804 16.8946 15.2929 16.7071C15.1054 16.5196 15 16.2652 15 16C15 15.7348 15.1054 15.4804 15.2929 15.2929C15.4804 15.1054 15.7348 15 16 15H19C19.2652 15 19.5196 15.1054 19.7071 15.2929C19.8946 15.4804 20 15.7348 20 16C20 16.2652 19.8946 16.5196 19.7071 16.7071C19.5196 16.8946 19.2652 17 19 17Z" fill="black"/>
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
                                    <svg width="26" height="26" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.2682 9.21937V17.0741C19.2682 18.6936 17.9644 19.9974 16.3449 19.9974H3.92318C2.3037 19.9974 0.999924 18.6936 0.999924 17.0741V4.65286C0.999924 3.03338 2.3037 1.72961 3.92318 1.72961H11.7957" stroke="black" stroke-width="0.999999" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M4.41121 13.8413L6.41528 11.7537C7.33508 10.8339 8.50353 10.9303 9.17926 11.7433C9.88998 12.5155 10.9933 12.7224 12.0366 11.7208L13.9364 9.62408" stroke="black" stroke-width="0.999999" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M19.9978 3.49618C19.9978 4.15819 19.7348 4.79309 19.2667 5.26121C18.7986 5.72932 18.1636 5.9923 17.5016 5.9923C16.8396 5.9923 16.2047 5.72932 15.7366 5.26121C15.2685 4.79309 15.0055 4.15819 15.0055 3.49618C15.0055 2.83417 15.2685 2.19927 15.7366 1.73116C16.2047 1.26304 16.8396 1.00006 17.5016 1.00006C18.1636 1.00006 18.7986 1.26304 19.2667 1.73116C19.7348 2.19927 19.9978 2.83417 19.9978 3.49618Z" stroke="black" stroke-width="0.999999" stroke-linecap="round" stroke-linejoin="round"/>
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
                                    <svg width="27" height="27" viewBox="0 0 28 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.9869 11.2037C28.0696 13.8233 27.7691 16.7939 26.8619 19.6796C24.8047 26.2258 20.8239 31.2521 14.9059 34.7319C14.2927 35.0923 13.6745 35.0923 13.0391 34.714C6.67181 30.9191 2.5724 25.4295 0.735821 18.2512C0.207491 16.1861 0.00119153 14.0786 0.000472714 11.9496C-0.000246103 10.6189 -0.000247595 9.28826 0.00119004 7.9576C0.00190886 6.81395 0.548929 6.24645 1.67532 6.1328C5.80923 5.71562 9.35084 4.03971 12.2829 1.08708C12.4684 0.900067 12.6445 0.702984 12.8299 0.515253C13.5135 -0.17669 14.5091 -0.178128 15.1869 0.549779C16.3701 1.82074 17.6791 2.93274 19.1771 3.81601C21.4083 5.13085 23.8142 5.90695 26.3933 6.14071C27.4068 6.23278 27.9797 6.83769 27.9862 7.85834C27.9919 8.84231 27.9869 9.82556 27.9869 11.2037ZM21.7583 13.4299C21.6326 13.2328 21.5477 13.0307 21.404 12.8868C21.0496 12.53 20.6701 12.1985 20.2977 11.8604C19.7809 11.3907 19.5027 11.4001 19.0146 11.8971C17.1601 13.7873 15.3062 15.679 13.451 17.5686C12.9442 18.085 12.6711 18.0929 12.137 17.6254C11.2536 16.8522 10.3708 16.0775 9.48167 15.3108C9.13807 15.0151 8.82251 15.0317 8.49761 15.3474C8.12814 15.7064 7.76657 16.0739 7.40285 16.4393C6.95431 16.8903 6.9464 17.173 7.38272 17.6326C9.04966 19.3876 10.7195 21.1405 12.3893 22.8927C12.8055 23.33 13.1404 23.3314 13.5394 22.8819C16.181 19.9069 18.8205 16.9306 21.455 13.9499C21.575 13.8139 21.6433 13.6313 21.7583 13.4299Z" fill="black"/>
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

                <!--        Edit Profile Main       -->
                <div class="Edit-Profile">
                
                    <!--        Alert       -->
                    <?php
                        if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
                    ?>
                        <div class="alert-gagal">
                        <?php
                            foreach($_SESSION['errors'] as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                    <?php
                        // Hapus pesan kesalahan setelah menampilkannya
                        unset($_SESSION['errors']);
                        }
                    ?>

                    <!--        Edit Profile Info       -->
                    <div class="Edit-Profile-Frame">

                        <div class="Edit-Profile-Framebox">

                            <!--        Edit Profile Image      -->
                            <div class="Edit-Profile-Image">
                                <div class="Profile-Image">
                                    <img src="<?php echo $profile_image_path; ?>" alt="Profile Image">
                                </div>
                                <div class="Username-User">
                                    <h3><?php echo $username ?></h3>
                                </div>
                                <div class="Bio-User">
                                    <p><?php echo $bio ?></p>
                                </div>
                                <div class="Ubah-Profile">
                                        <button id="Bar-ProfileImage-Open">Ubah Profile</button>
                                        <form action="edit-profile.php" method="POST">
                                            <button id="hapus-profile" type="submit" name="hapus-profile"  value="Save">Hapus Profile</button>
                                        </form>
                                </div>
                            </div>

                            <!--        Edit Profile Data       -->
                            <div class="Bio Profile-User">

                                <div class="Edit-Profile-User-Box" id="Bar-User-Open">
                                    <div class="Edit-Profile-User" >
                                        
                                        <div class="Judul-Username">
                                            <h3>Username</h3>
                                        </div>
                                        <div class="User-Profile">
                                            <span>Username</span>
                                            <svg width="25" height="25" viewBox="0 0 512 512"><title/><g data-name="1" id="_1"><path d="M202.1,450a15,15,0,0,1-10.6-25.61L365.79,250.1,191.5,75.81A15,15,0,0,1,212.71,54.6l184.9,184.9a15,15,0,0,1,0,21.21l-184.9,184.9A15,15,0,0,1,202.1,450Z"/></g></svg>
                                        </div>
                                    
                                    </div>
                                </div>
                                
                                <div class="Edit-Profile-User-Box" id="Bar-Bio-Open">
                                    <div class="Edit-Profile-User">
                                        
                                        <div class="Judul-User">
                                            <h3>Biography</h3>
                                        </div>
                                        <div class="User-Profile">
                                            <span>Add Biography</span>
                                            <svg width="25" height="25" viewBox="0 0 512 512"><title/><g data-name="1" id="_1"><path d="M202.1,450a15,15,0,0,1-10.6-25.61L365.79,250.1,191.5,75.81A15,15,0,0,1,212.71,54.6l184.9,184.9a15,15,0,0,1,0,21.21l-184.9,184.9A15,15,0,0,1,202.1,450Z"/></g></svg>
                                        </div>
                                        
                                    </div>
                                </div>
                                

                                <div class="Edit-Profile-User">
                                    <div class="User-Profile-Link">
                                        <a href="myaccount?$username"><span>@<?php echo $username ?></span></a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        
                    </div>

                    <!--        Edit ProfileImage       -->
                    <div class="Bar-Edit-ProfileImage" style="display:none";>
                        <div class="Bar-Edit-ProfileImage-Frame">
                            <div class="Bar-Edit-ProfileImage-FrameBox">
                            <form enctype="multipart/form-data" action="edit-profile.php" method="POST" >

                                <div class="Nav-Bar-Edit-ProfileImage">
                                    <div class="Nav-Bar-Edit-ProfileImage-Action" id="Nav-ProfileImage-Back">
                                        <svg height="24" viewBox="0 0 24 24" width="24"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"/></svg>
                                        <h3>Kembali</h3>
                                    </div>

                                    <div class="Nav-Bar-Edit-ProfileImage-Info">
                                        <h3>Profile</h3>
                                    </div>

                                    <div class="Nav-Bar-Edit-SaveProfileImage-Action">
                                        <input class="Save-Button" type="submit" name="change-profileimage" value="Save">
                                    </div>
                                </div>

                                <div class="User-Field-ProfileImage">
                                    <ul>
                                        <li>
                                            <label for="bio">Ubah Profile Image</label>
                                            <input type="file" name="uploaded_file" id="uploaded_file" accept="image/*" required>

                                        </li>
                                    </ul>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                    
                    <!--        Edit Username       -->
                     <div class="Bar-Edit-Username" style="display: none;">
                        <div class="Bar-Edit-Username-Frame">
                            <div class="Bar-Edit-Username-FrameBox">
                            <form action="edit-profile.php" method="POST">

                                <div class="Nav-Bar-Edit-Username">
                                    <div class="Nav-Bar-Edit-Username-Action" id="Nav-Username-Back">
                                        <svg height="24" viewBox="0 0 24 24" width="24"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"/></svg>
                                        <h3>Kembali</h3>
                                    </div>

                                    <div class="Nav-Bar-Edit-Username-Info">
                                        <h3>Username</h3>
                                    </div>

                                    <div class="Nav-Bar-Edit-Save-Action">
                                        <input class="Save-Button" type="submit" name="change-username" value="Save">
                                    </div>
                                </div>

                                <div class="User-Field">
                                    <ul>
                                        <li>
                                            <label for="username">Username Baru</label>
                                            <input type="text" class="kolum" name="username" id="username" required>
                                            <span id="charCountName">0/16</span>
                                        </li>
                                    </ul>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!--        Edit Biography       -->
                    <div class="Bar-Edit-Bio" style="display:none";>
                        <div class="Bar-Edit-Bio-Frame">
                            <div class="Bar-Edit-Bio-FrameBox">
                            <form action="edit-profile?<?php echo $username ?>" method="POST">

                                <div class="Nav-Bar-Edit-Bio">
                                    <div class="Nav-Bar-Edit-Bio-Action" id="Nav-Bio-Back">
                                        <svg height="24" viewBox="0 0 24 24" width="24"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"/></svg>
                                        <h3>Kembali</h3>
                                    </div>

                                    <div class="Nav-Bar-Edit-Bio-Info">
                                        <h3>Biography</h3>
                                    </div>

                                    <div class="Nav-Bar-Edit-SaveBio-Action">
                                        <input class="Save-Button" type="submit" name="change-bio" value="Save">
                                    </div>
                                </div>

                                <div class="User-Field-Bio">
                                    <ul>
                                        <li>
                                            <label for="bio">Add Biography</label>
                                            <textarea class="kolum-Bio" name="bio" id="bio" required></textarea>
                                            <span id="charCount">0/150</span>
                                        </li>
                                    </ul>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>

                
                
            </div>


            
        </div>
    
        
        
        
        <!--        Mobile Fitur        -->
        <div class="Mobile">
    
            <div class="MobileNavigasi">
                <div class="MobileNavigasiBox">
                    <div class="MobileNavigasiBoxIcon">
                        <div>
                            <a href="../../home">
                                <img src="../../Icon/Home.svg" alt="">
                            </a>
                            
                        </div>
        
                        <div>
                            <a href="../Search/Search.html">
                                <img src="../../Icon/Search.svg" alt="">
                            </a>
                            
                        </div>
        
                        <div>
                            <a href="../Post/Post.html">
                                <img src="../../Icon/Plus.svg" alt="">
                            </a>
                            
                        </div>
        
                        <div>
                            <a href="../Shorts/Shorts.html">
                                <img src="../../Icon/Reels.svg" alt="">
                            </a>
                            
                        </div>
        
                        <div>
                            <a href="user?<?php echo $username ?>">
                                <img src="../../Icon/Akun.svg" alt="">
                            </a>
                            
                        </div>
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>
    
        </div>

    </div>
    
</body>
</html>
<script src="javabin/edit-profile.js"></script>