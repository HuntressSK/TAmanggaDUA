<?php
session_start();
require_once '../db_connection.php';

// Keamanan: Cek jika admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil semua data dari form
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $about = $_POST['about'];
    $subjudul1 = $_POST['subjudul1'] ?? null;
    $teks1 = $_POST['teks1'] ?? null;
    // ... ambil subjudul dan teks 2, 3, 4, 5 ...

    // Proses Upload Gambar
    $gambar_names = [];
    $gambar_fields = ['judul_gambar', 'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5'];
    $target_dir = "../assets/images/images/";

    foreach ($gambar_fields as $field) {
        $gambar_lama_key = $field . '_lama';
        
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
            $nama_file_unik = time() . '_' . basename($_FILES[$field]["name"]);
            $target_file = $target_dir . $nama_file_unik;
            
            if (move_uploaded_file($_FILES[$field]["tmp_name"], $target_file)) {
                $gambar_names[$field] = $nama_file_unik;
                // Hapus file gambar lama jika ada
                if (!empty($_POST[$gambar_lama_key])) {
                    $file_lama = $target_dir . $_POST[$gambar_lama_key];
                    if (file_exists($file_lama)) {
                        unlink($file_lama);
                    }
                }
            } else {
                die("Error saat mengupload gambar: " . $field);
            }
        } else {
            // Jika tidak ada gambar baru, gunakan nama gambar lama
            $gambar_names[$field] = $_POST[$gambar_lama_key];
        }
    }

    // Update data di database
    // Catatan: Query ini disederhanakan. Lengkapi dengan semua kolom yang ingin di-update.
    $sql = "UPDATE artikel SET 
                judul=?, judul_gambar=?, about=?, 
                subjudul1=?, gambar1=?, teks1=?
            WHERE id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", 
        $judul, 
        $gambar_names['judul_gambar'],
        $about,
        $subjudul1,
        $gambar_names['gambar1'],
        $teks1,
        $id
    );

    if ($stmt->execute()) {
        header("Location: artikel_admin.php?status=edit_sukses");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: artikel_admin.php");
    exit();
}
?>