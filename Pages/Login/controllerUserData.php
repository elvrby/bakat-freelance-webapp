<?php 
session_start();
ob_start();
require "connection.php";
require "PHPMailer/PHPMailerAutoload.php";

$email = "";
$username = "";
$bio = "Your Bio Will Goes Here";
$roles = "civil";
$profileimage = "../../Image/user.jpg";
$sender = "socialmediaku0102@gmail.com";
$errors = array();

if(isset($_POST['daftar'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telephone = ($_POST["telephone"]);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
    if($password !== $confirmPassword){
        $errors['password'] = "Konfirmasi password tidak cocok!";
    }
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email telah digunakan!";
    }
    $username_check = "SELECT * FROM users WHERE username = '$username'";
    $res_username = mysqli_query($con, $username_check);
    if(mysqli_num_rows($res_username) > 0){
        $errors['username'] = "Username telah digunakan, coba yang lain!";
    }

    

    if(count($errors) === 0){
        $unique_id = uniqid();
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO users (unique_id, username, telephone, email, password, bio, code, status, profileimage, member_date, roles)
                        VALUES ('$unique_id', '$username', '$telephone', '$email', '$encpass', '$bio', '$code', '$status', '$profileimage', NOW(), '$roles')";
        $data_check = mysqli_query($con, $insert_data);

        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'socialmediaku0102@gmail.com';
        $mail->Password = 'zijkunmioeclqjbn';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($sender, 'Social');
        $mail->addAddress($email, $username);

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification Code';
        $mail->Body    = "Dear $username, <br> Ini Kode Verifikasimu: $code";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if($data_check){ // Jika data berhasil dimasukkan ke dalam database
            if($mail->send()){
                $info = "Kami telah mengirimkan ke alamat emailmu - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Gagal ketika mengirimkan kode!";
            }
        } else {
            $errors['db-error'] = "Gagal ketika memasukan data!";
        }
    }
}


    //Jika user klik verifikasi code button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: masuk.php');
                exit();
            }else{
                $errors['otp-error'] = "Gagal ketika update kode!";
            }
        }else{
            $errors['otp-error'] = "Kode Verifikasi Salah!";
        }
    }
    

    //Jika user klik masuk
    if(isset($_POST['masuk'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: ../../home');
                }else{
                    $info = "Akunmu belum diverifikasi - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }
        }
    }
    // ...
    if(isset($_POST['masuk'])){
        // ...
        if(isset($fetch_pass)) {
            if(password_verify($password, $fetch_pass)){
                // ...
                if($status == 'verified'){
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['status'] = 'verified'; // Simpan status pengguna dalam variabel sesi
                    header('location: ../../home');
                } else {
                    $info = "Akunmu belum diverifikasi - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            } else {
                // Jika password salah
                $errors['password'] = "Password Salah!";
            }
        } else {
            // Jika email tidak ditemukan
            $errors['email'] = "Email Tidak Ditemukan!";
        }
    }
    
    
// ...

    

    //Jika user Lupa Password
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'socialmediaku0102@gmail.com';
                $mail->Password = 'zijkunmioeclqjbn';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom($sender, 'Social');
                $mail->addAddress($email, $username);

                $mail->isHTML(true);
                $mail->Subject = 'Reset-Password Verification Code';
                $mail->Body    = "Dear $username, <br> Ini Kode Reset Passwordmu: $code";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                
                // Ganti alamat emailnya
                if($mail->send()){
                    $info = "Kami telah mengirimkan kode reset verifikasimu - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Gagal ketika mengirimkan kode!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "Tidak ada email yang cocok!";
        }
    }

    //Jika user klik reset password
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Buat password baru.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "Kode verifikasi salah!";
        }
    }

    //Jika user klik change password
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Konfirmasi password tidak sama!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Passwordmu berhasil di ubah";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Gagal mengubah password!";
            }
        }
    }
    
    if(isset($_POST['change-username'])){
        // Kosongkan pesan info
        $_SESSION['info'] = "";
        
        // Ambil username baru dari form
        $new_username = mysqli_real_escape_string($con, $_POST['username']);
        
        // Ambil email dari session (atau identifier unik lainnya)
        $email = $_SESSION['email']; // atau sesuai dengan identifikasi unik yang kamu gunakan
        
        // Query untuk memeriksa apakah username baru sama dengan username saat ini
        $check_current_username_query = "SELECT username FROM users WHERE email = '$email'";
        $check_current_username_result = mysqli_query($con, $check_current_username_query);
        $current_username_row = mysqli_fetch_assoc($check_current_username_result);
        $current_username = $current_username_row['username'];
        
        // Jika username baru sama dengan username saat ini, kembalikan pesan kesalahan
        if($new_username == $current_username) {
            $errors['username'] = "Username baru tidak boleh sama dengan username saat ini.";
            // Simpan pesan kesalahan dalam sesi
            $_SESSION['errors'] = $errors;
            // Kembali ke halaman edit profil
            header('Location: ../Akun/edit-profile.php');
            exit(); // Pastikan agar skrip berhenti di sini
        }

        if(preg_match("/^\d+$/", $new_username)) {
            $errors['username'] = "Username tidak boleh hanya mengandung angka.";
            // Simpan pesan kesalahan dalam sesi
            $_SESSION['errors'] = $errors;
            // Kembali ke halaman edit profil
            header('Location: ../Akun/edit-profile.php');
            exit(); // Pastikan agar skrip berhenti di sini
        }

        if(strpos($new_username, ' ') !== false) {
            $errors['username'] = "Username tidak boleh mengandung spasi.";
            // Simpan pesan kesalahan dalam sesi
            $_SESSION['errors'] = $errors;
            // Kembali ke halaman edit profil
            header('Location: ../Akun/edit-profile.php');
            exit(); // Pastikan agar skrip berhenti di sini
        }
        
        // Query untuk memeriksa ketersediaan username
        $check_username_query = "SELECT * FROM users WHERE username = '$new_username' AND email != '$email'";
        
        // Eksekusi query untuk memeriksa ketersediaan username
        $check_username_result = mysqli_query($con, $check_username_query);
        
        // Hitung jumlah baris hasil query
        $num_rows = mysqli_num_rows($check_username_result);
        
        // Jika username sudah digunakan, kembalikan pesan kesalahan
        if($num_rows > 0) {
            $errors['username'] = "Username sudah digunakan, silakan pilih username lain.";
            // Simpan pesan kesalahan dalam sesi
            $_SESSION['errors'] = $errors;
            // Kembali ke halaman edit profil
            header('Location: ../Akun/edit-profile.php');
            exit(); // Pastikan agar skrip berhenti di sini
        } else {
            // Query untuk mengupdate username jika username tersedia
            $update_username_query = "UPDATE users SET username = '$new_username' WHERE email = '$email'";
            
            // Eksekusi query untuk mengupdate username
            $run_query = mysqli_query($con, $update_username_query);
            
            // Cek apakah query berhasil dijalankan
            if($run_query){
                $info = "Username berhasil diubah";
                $_SESSION['info'] = $info;
                
                // Query untuk mendapatkan username berdasarkan email
                $get_username_query = "SELECT username FROM users WHERE email = '$email'";
                $result = mysqli_query($con, $get_username_query);
                
                // Periksa apakah query berhasil dijalankan
                if($result) {
                    $row = mysqli_fetch_assoc($result);
                    $username = $row['username'];
                    // Redirect ke halaman edit-profile dengan username sebagai parameter
                    header("Location: ../Akun/edit-profile?$username");
                    exit(); // Pastikan agar skrip berhenti di sini
                } else {
                    echo "Gagal mendapatkan username dari database";
                }
                } else {
                    echo "Gagal mengupdate username";
            }
        }
    }

    if (!empty($_FILES['uploaded_file'])) {
        // Kosongkan pesan info
        $_SESSION['info'] = "";
        
        // Ambil email dari session (atau identifier unik lainnya)
        $email = $_SESSION['email']; // atau sesuai dengan identifikasi unik yang kamu gunakan
        
        // Lokasi direktori penyimpanan file yang diunggah
        $target_directory = "uploads/";
        
        // Path lengkap untuk file yang diunggah
        $target_file = $target_directory . basename($_FILES['uploaded_file']['name']);
        
        // Path file baru yang akan disimpan di database
        $new_uploaded_file = mysqli_real_escape_string($con, $target_file);
        
        // Query untuk mengupdate nama file di tabel users
        $update_uploaded_file_query = "UPDATE users SET profileimage = '$new_uploaded_file' WHERE email = '$email'";
        
        // Eksekusi query untuk mengupdate nama file di tabel users
        $run_query = mysqli_query($con, $update_uploaded_file_query);
        
        // Pindahkan file yang diunggah ke direktori target
        if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $target_file)) {
            // Query untuk mendapatkan username berdasarkan email
            $get_username_query = "SELECT username FROM users WHERE email = '$email'";
            $result = mysqli_query($con, $get_username_query);
            
            // Periksa apakah query berhasil dijalankan
            if($result) {
                $row = mysqli_fetch_assoc($result);
                $username = $row['username'];
                
                // Set pesan info dan redirect ke halaman edit-profile dengan username sebagai parameter
                $_SESSION['info'] = $info;
                header("Location: ../Akun/edit-profile?$username");
                exit(); // Pastikan agar skrip berhenti di sini
            } else {
                // Jika gagal mendapatkan username, set pesan error
                $errors['db-error'] = "Gagal mendapatkan username dari database!";
                // Simpan pesan kesalahan dalam sesi
                $_SESSION['errors'] = $errors;
                // Kembali ke halaman edit profil
                header('Location: ../Akun/edit-profile');
                exit(); // Pastikan agar skrip berhenti di sini
            }
        } else {
            // Jika gagal, atur pesan error
            $errors['db-error'] = "Gagal menghapus gambar profil!";
            // Simpan pesan kesalahan dalam sesi
            $_SESSION['errors'] = $errors;
            // Kembali ke halaman edit profil
            header('Location: ../Akun/edit-profile');
            exit(); // Pastikan agar skrip berhenti di sini
        }

    }

    if(isset($_POST['change-bio'])){
        // Kosongkan pesan info
        $_SESSION['info'] = "";
        
        // Ambil username baru dari form
        $new_bio = mysqli_real_escape_string($con, $_POST['bio']);
        
        // Ambil email dari session
        $email = $_SESSION['email'];
        
        // Query untuk mengupdate bio jika email tersedia
        $update_bio_query = "UPDATE users SET bio = '$new_bio' WHERE email = '$email'";
        
        // Eksekusi query untuk mengupdate bio
        $run_query = mysqli_query($con, $update_bio_query);
        
        // Cek apakah query berhasil dijalankan
        if($run_query){
            $info = "Bio berhasil diubah";
            $_SESSION['info'] = $info;
            
            // Query untuk mendapatkan username berdasarkan email
            $get_username_query = "SELECT username FROM users WHERE email = '$email'";
            $result = mysqli_query($con, $get_username_query);
            
            // Periksa apakah query berhasil dijalankan
            if($result) {
                $row = mysqli_fetch_assoc($result);
                $username = $row['username'];
                // Redirect ke halaman edit-profile dengan username sebagai parameter
                header("Location: ../Akun/edit-profile?$username");
                exit(); // Pastikan agar skrip berhenti di sini
            } else {
                echo "Gagal mendapatkan username dari database";
            }
            } else {
                echo "Gagal mengupdate bio";
        }
    }
    
    

    if(isset($_POST['hapus-profile'])){
        // Kosongkan pesan info
        $_SESSION['info'] = "";
        
        // Ambil email dari session (atau identifier unik lainnya)
        $email = $_SESSION['email']; // atau sesuai dengan identifikasi unik yang kamu gunakan
        
        // Query untuk mengupdate profileimage menjadi NULL
        $update_profileimage_query = "UPDATE users SET profileimage = '$profileimage' WHERE email = '$email'";
        
        // Eksekusi query untuk mengupdate profileimage
        if(mysqli_query($con, $update_profileimage_query)) {
            // Jika berhasil, atur pesan info
            $info = "Hapus profile berhasil";
            
            // Query untuk mendapatkan username berdasarkan email
            $get_username_query = "SELECT username FROM users WHERE email = '$email'";
            $result = mysqli_query($con, $get_username_query);
            
            // Periksa apakah query berhasil dijalankan
            if($result) {
                $row = mysqli_fetch_assoc($result);
                $username = $row['username'];
                
                // Set pesan info dan redirect ke halaman edit-profile dengan username sebagai parameter
                $_SESSION['info'] = $info;
                header("Location: ../Akun/edit-profile?$username");
                exit(); // Pastikan agar skrip berhenti di sini
            } else {
                // Jika gagal mendapatkan username, set pesan error
                $errors['db-error'] = "Gagal mendapatkan username dari database!";
                // Simpan pesan kesalahan dalam sesi
                $_SESSION['errors'] = $errors;
                // Kembali ke halaman edit profil
                header('Location: ../Akun/edit-profile');
                exit(); // Pastikan agar skrip berhenti di sini
            }
        } else {
            // Jika gagal, atur pesan error
            $errors['db-error'] = "Gagal menghapus gambar profil!";
            // Simpan pesan kesalahan dalam sesi
            $_SESSION['errors'] = $errors;
            // Kembali ke halaman edit profil
            header('Location: ../Akun/edit-profile');
            exit(); // Pastikan agar skrip berhenti di sini
        }
    }
    

    

        
    
    
    
    

   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: masuk.php');
    }

    

    

    

    
    ob_end_flush(); 
?>