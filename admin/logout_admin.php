<?php
session_start();

// Hapus semua session
session_unset();

// Hapus session data dari server
session_destroy();

// Redirect ke halaman login_admin.php setelah logout
header("Location: login_admin.php");
exit();
?>
