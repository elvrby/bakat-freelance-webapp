<?php
session_start();

// Hapus semua data sesi
session_destroy();

// Redirect pengguna ke halaman login atau halaman lain yang sesuai
header("Location: login.php");
exit();
?>
