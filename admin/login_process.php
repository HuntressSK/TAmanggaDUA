<?php
// Selalu mulai session di paling atas file
session_start();

// Sambungkan ke database (path ../ karena kita ada di dalam folder /admin)
require_once '../db_connection.php';

// Cek apakah form sudah disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cari admin berdasarkan username menggunakan Prepared Statement
    $sql = "SELECT id_admin, username, password, role FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Jika username admin ditemukan
        $admin = $result->fetch_assoc();

        // Verifikasi password yang diinput dengan hash di database
        if (password_verify($password, $admin['password'])) {
            // Jika password cocok, LOGIN BERHASIL!
            // Simpan "Kartu Akses" (data penting) ke dalam Session
            $_SESSION['admin_id'] = $admin['id_admin'];
            $_SESSION['username'] = $admin['username'];
            $_SESSION['role'] = $admin['role']; // <-- INI YANG PALING PENTING!

            // Arahkan ke dashboard utama admin
            header("Location: dashboard_home.php");
            exit();
        } else {
            // Jika password salah
            // Redirect kembali ke halaman login dengan pesan error
            header("Location: login_admin.php?error=invalid_credentials");
            exit();
        }
    } else {
        // Jika username tidak ditemukan
        header("Location: login_admin.php?error=invalid_credentials");
        exit();
    }

    $stmt->close();
    $conn->close();

} else {
    // Jika file diakses langsung, tendang ke halaman utama
    header("Location: ../index.php");
    exit();
}
?>