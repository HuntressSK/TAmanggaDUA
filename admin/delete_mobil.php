<?php
session_start();
require_once '../db_connection.php';

// Keamanan: Cek jika admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_admin.php");
    exit;
}

// Pastikan ada ID mobil yang dikirim melalui GET
if (isset($_GET['id'])) {
    $id_mobil = $_GET['id'];
    $target_dir = "../assets/images/images//";

    // Langkah 1: Ambil nama file gambar dari database SEBELUM menghapus datanya
    $sql_select = "SELECT gambar1, gambar2, gambar3, gambar4 FROM mobil WHERE id_mobil = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $id_mobil);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();
    
    if ($result_select->num_rows > 0) {
        $gambar_files = $result_select->fetch_assoc();

        // Langkah 2: Hapus data mobil dari database
        $sql_delete = "DELETE FROM mobil WHERE id_mobil = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id_mobil);

        if ($stmt_delete->execute()) {
            // Jika berhasil menghapus dari DB, lanjutkan menghapus file gambar
            foreach ($gambar_files as $file_name) {
                if (!empty($file_name) && file_exists($target_dir . $file_name)) {
                    unlink($target_dir . $file_name);
                }
            }
            // Redirect kembali dengan status sukses
            header("Location: dashboard_product.php?status=hapus_sukses");
            exit();
        } else {
            // Jika gagal menghapus dari DB
            header("Location: dashboard_product.php?status=hapus_gagal");
            exit();
        }
    } else {
        // Jika mobil dengan ID tersebut tidak ditemukan
        header("Location: dashboard_product.php?status=not_found");
        exit();
    }

} else {
    // Jika tidak ada ID yang dikirim, redirect
    header("Location: dashboard_product.php");
    exit();
}
?>