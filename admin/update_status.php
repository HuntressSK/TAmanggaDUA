<?php
// Selalu mulai session di awal
session_start();

// PENJAGA KEAMANAN #1: Pastikan yang mengakses adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Akses ditolak. Anda bukan admin.");
}

// Sambungkan ke database
require_once '../db_connection.php';

// PENJAGA KEAMANAN #2: Pastikan script diakses melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Cek apakah data yang dibutuhkan ada
    if (isset($_POST['id_transaksi']) && isset($_POST['status_baru'])) {
        
        $id_transaksi = $_POST['id_transaksi'];
        $status_baru = $_POST['status_baru'];

        // Validasi sederhana untuk memastikan status yang diinput valid
        $status_valid = ['menunggu', 'lunas', 'batal'];
        if (in_array($status_baru, $status_valid)) {

            // Siapkan query UPDATE menggunakan Prepared Statement
            $sql_update = "UPDATE transaksi SET status_pembayaran = ? WHERE id_transaksi = ?";
            $stmt = $conn->prepare($sql_update);
            
            // 's' untuk string (status_baru), 'i' untuk integer (id_transaksi)
            $stmt->bind_param("si", $status_baru, $id_transaksi);

            // Eksekusi query
            if ($stmt->execute()) {
                // Jika berhasil, arahkan kembali ke halaman manajemen transaksi
                header("Location: transaksi_admin.php?update=sukses");
                exit();
            } else {
                // Jika gagal
                header("Location: transaksi_admin.php?update=gagal");
                exit();
            }
            $stmt->close();
        } else {
            // Jika status yang dikirim tidak valid
            die("Status tidak valid.");
        }
    } else {
        // Jika data yang dikirim tidak lengkap
        die("Data tidak lengkap.");
    }
} else {
    // Jika file diakses langsung, tendang ke dashboard
    header("Location: dashboard_home.php");
    exit();
}

$conn->close();
?>