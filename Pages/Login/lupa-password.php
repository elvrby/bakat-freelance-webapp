<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="cssbin/lupa-password.css"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>lupa-password</title>
    
</head>


<body>
    
    
<div class="penjelasan">
<div class="floating-element"></div>
    <h1>Kamu Lupa Passwordmu?</h1>
    <p>Mulai cari dan dapatkan penawaran terbaik yang di tawarkan oleh
        user hanya untukmu, dan mulai karir anda dan tawarkan layanan yang anda akan berikan
    </p>
    <div class="floating-element2"></div>
</div>
    </div>
    <form method="POST" action="">
    <fieldset id="form">
    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert-salah">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
        <div class="form-group">
        <div class="daftar-box">
        <h1 class="register-judul">Lupa Password</h1>
        <div class="user-field">
            <ul>
            
            <li>
                <label for="email">Email</label>
                <input type="email" class="kolum" name="email" id="email" required>
            </li>
            <p>Masukan email yang terdaftar untuk mendapatkan kode verifikasi
                jika anda sudah pernah mendaftarkan akun <a href="">Customer Service</a> 
                    </p>
                <div class="tombol2">
                <button type="button" name="previous" onclick="changeURL()" value="Previous"> Kembali</button>
                <button type="submit" name="check-email">Verifikasi</button>
                </div>
                <div class="masuk">
                    <p>Belum memiliki akun? <a href="daftar.php">Daftar</a></p>
                </div>
            </ul>
        </div>
        
        </div>
    </fieldset>

    </form>
</div>
</div>  

</body>
<script>
            function changeURL() {
                window.location.href = 'masuk.php';
            }
</script>
<script src="functions.js"></script>