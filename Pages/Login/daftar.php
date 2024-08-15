<?php require_once "controllerUserData.php"; ?>
<!-- require once artinya user cuma bisa ngeakses sekali -->
<!-- controllerUserData.php di gunain buat ngambil data disana -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="cssbin/daftar.css"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Registrasi</title>
    
</head>
<body>
    
    
<div class="penjelasan">
    <h1>Daftarkan Akunmu</h1>
    <p>Mulai cari dan dapatkan penawaran terbaik yang di tawarkan oleh
        user hanya untukmu, dan mulai karir anda dan tawarkan layanan yang anda akan berikan
    </p>
</div>
    </div>
    <form id="regiration_form" action="" method="post" onsubmit="return validateForm()">
    
    <fieldset class="form1" id="form1" >
        <!--      Fungsi ini buat tampilin kesalahan/benar          -->
    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert-salah">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger" id="phoneNumberError" style="display: none;">
                            <h1>error</h1>
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
        <div class="form-group">
        <div class="daftar-box">
        <h1 class="register-judul">Daftar Akun</h1>
    
        <div class="user-field">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" class="kolum" name="username" id="username" required>
                <span id="charCountName">0/16</span>
            </li>
            <li>
                <label for="email">Email</label>
                <input type="email" class="kolum" name="email" id="email" required>
            </li>
            
            <li>
                <label for="password">Password</label>
                <div class="password-input-container">
                    <input type="password" class="kolum" name="password" id="password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('password')">
                        <i class="bi bi-eye-slash"></i>
                    </span>
                </div>
            </li>
            <li>
                <label for="confirmPassword">Konfirmasi Password</label>
                <div class="password-input-container">
                    <input type="password" class="kolum" name="confirmPassword" id="confirmPassword" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility('confirmPassword')">
                        <i class="bi bi-eye-slash"></i>
                    </span>
                </div>
            </li>
            <div class="persetujuan">
                <input type="checkbox" name="persetujuan" id="persetujuan" required>
                <p>Dengan mengisi kotak di samping, anda setuju dengan privacy policy
                   yang kami berikan <a href="">baca persetujuan</a> 
                </p>
            </div> 
        </div>
        
            <div class="tombol">
            <button type="button" name="next" onclick="showForm2()" value="Next" >Daftar</button>

            </div>
            <div class="masuk">
                <p>Sudah mempunyai akun? <a href="masuk.php">masuk</a></p>
            </div>
        </ul>
        </div>
        
    </fieldset>
    <fieldset id="form2" style="display: none;">
        <div class="form-group">
        <div class="daftar-box">
        <h1 class="register-judul">Masukan Nomer</h1>
       
        <div class="user-field">
        <li>
            <label for="telephone">Nomor Telepon</label>
            <input type="tel" pattern="[6-2]+" class="kolum" name="telephone" id="telephone" required
                title="Harap masukkan hanya angka (6-2)">
        </li>
        <p>Pastikan kembali semua data yang anda masukkan sudah benar
            dan baca terlebih dahulu mengenai privacy policy <a href="">baca persetujuan</a> 
                </p>
        </div>
        <ul>
       

        <!-- <label for="region" class="lb-kota">Kota Asal:</label>
        <select id="kota" name="region" class="pilihan-kota">
            <option value="">Pilih Kotamu....</option>
            <option value="Jakarta">Jakarta</option>
            <option value="Bogor">Bogor</option>
            <option value="Depok">Depok</option>
            <option value="Tanggerang">Tanggerang</option>
            <option value="Bekasi">Bekasi</option>
            <option value="Jawa Barat">Jawa Barat</option>
            <option value="Jawa Tengah">Jawa Tengah</option>
            <option value="Jawa Timur">Jawa Timur</option>
            <option value="Sumatra Selatan">Sumatra Selatan</option>
            <option value="Sumatra Barat">Sumatra Barat</option>
            <option value="Sumatra Utara">Sumatra Utara</option>
            <option value="Kalimantan Barat">Kalimantan Barat</option>
            <option value="Kalimantan Tengah">Kalimantan Tengah</option>
            <option value="Kalimantan Timur">Kalimantan Timur</option>
            <option value="Sulawesi Barat">Sulawesi Barat</option>
            <option value="Sulawesi Tengah">Sulawesi Tengah</option>
            <option value="Sulawesi Selatan">Sulawesi Selatan</option>
            <option value="Sulawesi Utara">Sulawesi Utara</option>
            <option value="Papua">Papua</option>
            <option value="Papua Barat">Papua Barat</option>
            <option value="Maluku">Maluku</option>
            <option value="Maluku Utara">Maluku Utara</option>
            <option value="Bali">Bali</option>
            <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
            <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
        </select>
        <div class="skills">
            <div class="keahlian">
                <label for="keahlian">Keahlian</label>
                <select name="keahlian" id="keahlian">
                    <option value="">Keahlianmu...</option>
                    <option value="Grafik & Design">Grafik & Design</option>
                    <option value="Progamming & Tech">Progamming & Tech</option>
                    <option value="Multimedia">Multimedia</option>
                </select>
            </div>
            <div class="pendidikan">
                <label for="pendidikan">Pendidikan</label>
                <select name="pendidikan" id="pendidikan">
                    <option value="">Pendidikanmu Saat Ini...</option>
                    <option value="SMA/SMK">SMA/SMK</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Guru">Guru</option>
                </select>
            </div>
        </div> -->
        
        
            <div class="tombol2">
            <button type="button" name="previous" onclick="showForm1()" value="Previous"> Kembali</button>
            <button type="submit" onclick="validateForm()" name="daftar">Lanjutkan</button>
            </div>
            <div class="masuk">
                <p>Sudah mempunyai akun? <a href="masuk.php">masuk</a></p>
            </div>
        </ul>
        </div>
    </fieldset>

    </form>
</div>



</div>  
</body>
</html>
<script src="javabin/daftar.js"></script>
<script src="functions.js"></script>
