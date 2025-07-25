<?php
session_start();
require_once '../db_connection.php';

// Keamanan: Cek jika admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_admin.php");
    exit;
}

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data teks dari form
    $nama_mobil = $_POST['nama_mobil'];
    $harga_mobil = $_POST['harga_mobil'];
    $supir = $_POST['supir'];
    $deskripsi_p1 = $_POST['deskripsi_p1'];
    $deskripsi_p2 = $_POST['deskripsi_p2'];
    $deskripsi_p3 = $_POST['deskripsi_p3'];
    $deskripsi_p4 = $_POST['deskripsi_p4'];

    // Proses Upload Gambar
    $gambar_names = [];
    $target_dir = "../assets/images/images/"; // Folder tujuan upload (../ karena kita ada di folder admin)

    for ($i = 1; $i <= 4; $i++) {
        $gambar_key = 'gambar' . $i;
        if (isset($_FILES[$gambar_key]) && $_FILES[$gambar_key]['error'] == 0) {
            // Buat nama file unik untuk menghindari tumpang tindih
            $nama_file_unik = time() . '_' . basename($_FILES[$gambar_key]["name"]);
            $target_file = $target_dir . $nama_file_unik;
            
            // Pindahkan file yang diupload ke folder tujuan
            if (move_uploaded_file($_FILES[$gambar_key]["tmp_name"], $target_file)) {
                $gambar_names[$i] = $nama_file_unik;
            } else {
                die("Error saat mengupload gambar " . $i);
            }
        } else {
            // Jika ada file gambar yang tidak diisi (kecuali gambar 1 yang required)
            $gambar_names[$i] = null;
        }
    }

    // Simpan ke database menggunakan prepared statement
    $sql = "INSERT INTO mobil (nama_mobil, harga_mobil, supir, deskripsi_p1, deskripsi_p2, deskripsi_p3, deskripsi_p4, gambar1, gambar2, gambar3, gambar4) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sddssssssss", 
        $nama_mobil, 
        $harga_mobil, 
        $supir, 
        $deskripsi_p1,
        $deskripsi_p2,
        $deskripsi_p3,
        $deskripsi_p4,
        $gambar_names[1],
        $gambar_names[2],
        $gambar_names[3],
        $gambar_names[4]
    );

    if ($stmt->execute()) {
        // Jika berhasil, redirect kembali ke halaman produk
        header("Location: dashboard_product.php?status=tambah_sukses");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: tambah_mobil.php");
    exit();
}
?>