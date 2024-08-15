<?php require_once "controllerUserData.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="cssbin/masuk.css"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Registrasi</title>
    
</head>


<body>
    
    
<div class="penjelasan">

    <h1>Selamat Datang Kembali</h1>
    <p>Mulai cari dan dapatkan penawaran terbaik yang di tawarkan oleh
        user hanya untukmu, dan mulai karir anda dan tawarkan layanan yang anda akan berikan
    </p>
</div>
    </div>
    
    <form method="POST" action="">
    <fieldset id="form1" >
    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert-salah">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
        <div class="form-group">
        <div class="daftar-box">
        <h1 class="register-judul">Login</h1>
        
        <ul>
            <div class="user-field">
            <li class="username-box">
            <label for="email">Username atau Email</label>
            <input type="text" class="kolum" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}|[a-zA-Z0-9]+">
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
            <p class="pemberitahuan"> Masukan Username atau Email untuk login ke
                akun anda yang telah terdaftar <a href="">Customer Service</a> 
            </p>
            </div>
        
            
            <div class="tombol">
            <button type="button" name="forget" onclick="changeURL()" value="Next" >Lupa Password</button>
            <button type="submit" name="masuk">Masuk</button>

            


            </div>
            <div class="masuk">
                <p>Belum memiliki akun? <a href="daftar.php">daftar</a></p>
            </div>
        </ul>
        </div>
    </fieldset>
    </form>
</div>
</div>  
</body>
<script>
            function changeURL() {
                window.location.href = 'lupa-password.php';
            }
            </script>

<script src="functions.js"></script>
<script>
   
</script>

</html>

