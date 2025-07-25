<?php
session_start();
require_once '../db_connection.php';

// Keamanan: Cek jika admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data teks dari form
    $judul = $_POST['judul'];
    $about = $_POST['about'];
    $subjudul1 = $_POST['subjudul1'] ?? null;
    $teks1 = $_POST['teks1'] ?? null;
    $subjudul2 = $_POST['subjudul2'] ?? null;
    $teks2 = $_POST['teks2'] ?? null;
    // ... ambil subjudul dan teks 3, 4, 5 jika ada ...

    // Proses Upload Gambar
    $gambar_names = [];
    $gambar_fields = ['judul_gambar', 'gambar1', 'gambar2']; // Tambahkan 'gambar3', 'gambar4', 'gambar5' jika ada
    $target_dir = "../assets/images/images/";

    foreach ($gambar_fields as $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
            $nama_file_unik = time() . '_' . basename($_FILES[$field]["name"]);
            $target_file = $target_dir . $nama_file_unik;
            
            if (move_uploaded_file($_FILES[$field]["tmp_name"], $target_file)) {
                $gambar_names[$field] = $nama_file_unik;
            } else {
                die("Error saat mengupload gambar: " . $field);
            }
        } else {
            $gambar_names[$field] = null;
        }
    }

    // Simpan ke database
    $sql = "INSERT INTO artikel (judul, judul_gambar, about, subjudul1, gambar1, teks1, subjudul2, gambar2, teks2) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            // Tambahkan '?' untuk setiap kolom subjudul/gambar/teks 3, 4, 5
    
    $stmt = $conn->prepare($sql);
    // Sesuaikan tipe data 's' (string) dengan jumlah kolom
    $stmt->bind_param("sssssssss", 
        $judul, 
        $gambar_names['judul_gambar'],
        $about,
        $subjudul1,
        $gambar_names['gambar1'],
        $teks1,
        $subjudul2,
        $gambar_names['gambar2'],
        $teks2
        // Tambahkan variabel untuk subjudul/gambar/teks 3, 4, 5
    );

    if ($stmt->execute()) {
        header("Location: artikel_admin.php?status=tambah_sukses");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: tambah_artikel.php");
    exit();
}
?>