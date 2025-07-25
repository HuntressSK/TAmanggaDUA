<?php
session_start();
require_once 'db_connection.php';

// Keamanan: Cek jika user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pastikan data yang dibutuhkan ada
    if (isset($_POST['id_transaksi']) && isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == 0) {
        
        $id_transaksi = $_POST['id_transaksi'];
        $id_user = $_SESSION['user_id']; // Ambil id user dari session untuk keamanan

        // Tentukan folder tujuan upload
        $target_dir = "assets/images/bukti_pembayaran/";
        // Buat nama file unik untuk menghindari nama yang sama
        $nama_file_unik = $id_transaksi . '_' . time() . '_' . basename($_FILES["bukti_pembayaran"]["name"]);
        $target_file = $target_dir . $nama_file_unik;

        // Pindahkan file yang diupload ke folder tujuan
        if (move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $target_file)) {
            
            // Jika upload berhasil, update nama filenya ke database
            // Query UPDATE ini SANGAT PENTING, kita tambahkan WHERE id_user untuk memastikan user tidak bisa update transaksi orang lain
            $sql_update = "UPDATE transaksi SET bukti_pembayaran = ? WHERE id_transaksi = ? AND id_user = ?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("sii", $nama_file_unik, $id_transaksi, $id_user);

            if ($stmt->execute()) {
                // Berhasil! Redirect kembali ke halaman profil
                header("Location: profil.php?upload=sukses");
                exit();
            } else {
                die("Gagal memperbarui database.");
            }

        } else {
            die("Error saat mengupload file.");
        }
    } else {
        die("Data tidak lengkap atau terjadi error saat upload.");
    }

} else {
    header("Location: index.php");
    exit();
}
?>