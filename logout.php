<?php
// Selalu mulai session di awal untuk bisa memanipulasinya
session_start();

// 1. Hapus semua variabel di dalam session
$_SESSION = array();

// 2. Hancurkan session-nya secara total
session_destroy();

// 3. Arahkan pengguna kembali ke halaman login dengan pesan
// (Kita bisa tambahkan pesan jika mau, tapi untuk sekarang langsung redirect saja)
header("Location: login.php");
exit; // Pastikan tidak ada kode lain yang dijalankan setelah redirect
?>