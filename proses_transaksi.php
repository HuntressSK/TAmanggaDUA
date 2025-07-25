<?php
// Selalu mulai session di awal
session_start();

// Sambungkan ke database
require_once 'db_connection.php';

// PENJAGA KEAMANAN #1: Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, tendang ke halaman login
    header("Location: login.php");
    exit;
}

// PENJAGA KEAMANAN #2: Pastikan script ini diakses melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil semua data dari form tersembunyi di transaksi.php
    $id_mobil = $_POST['id_mobil'];
    $id_user = $_POST['id_user'];
    $tanggal_penyewaan = $_POST['tanggal_penyewaan'];
    $durasi_penyewaan = $_POST['durasi_penyewaan'];
    $dengan_supir = $_POST['dengan_supir'];
    $total_harga = $_POST['total_harga'];
    
    // Siapkan query INSERT menggunakan Prepared Statement untuk keamanan maksimal
    $sql_insert_transaksi = "INSERT INTO transaksi (
                                id_mobil, 
                                id_user, 
                                tanggal_penyewaan, 
                                durasi_penyewaan, 
                                dengan_supir, 
                                total_harga,
                                status_pembayaran 
                                -- waktu_booking akan terisi otomatis oleh database
                            ) VALUES (?, ?, ?, ?, ?, ?, 'menunggu')";

    $stmt = $conn->prepare($sql_insert_transaksi);
    
    // 'i' untuk integer, 's' untuk string, 'd' untuk double (decimal)
    $stmt->bind_param("iisidi", 
        $id_mobil, 
        $id_user, 
        $tanggal_penyewaan, 
        $durasi_penyewaan, 
        $dengan_supir, 
        $total_harga
    );

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil, arahkan ke halaman profil dengan pesan sukses
        header("Location: profil.php?status=booking_sukses");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error (untuk development)
        echo "Error: Gagal menyimpan transaksi. Silakan coba lagi.";
        // Untuk production, idealnya diarahkan ke halaman error khusus
        // echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();

} else {
    // Jika script diakses langsung tanpa melalui POST, arahkan ke halaman utama
    header("Location: index.php");
    exit;
}

// Tutup koneksi
$conn->close();
?>