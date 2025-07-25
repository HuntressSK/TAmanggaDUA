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
    $id_mobil = $_POST['id_mobil'];
    $nama_mobil = $_POST['nama_mobil'];
    $harga_mobil = $_POST['harga_mobil'];
    $supir = $_POST['supir'];
    $deskripsi_p1 = $_POST['deskripsi_p1'];
    $deskripsi_p2 = $_POST['deskripsi_p2'];
    $deskripsi_p3 = $_POST['deskripsi_p3'];
    $deskripsi_p4 = $_POST['deskripsi_p4'];
    
    // Array untuk menampung nama file gambar (baru atau lama)
    $gambar_names = [];
    $target_dir = "../uploads/";

    // Loop untuk memproses 4 gambar
    for ($i = 1; $i <= 4; $i++) {
        $gambar_key = 'gambar' . $i;
        $gambar_lama_key = 'gambar' . $i . '_lama';

        // Cek jika ada file gambar baru yang diupload
        if (isset($_FILES[$gambar_key]) && $_FILES[$gambar_key]['error'] == 0) {
            $nama_file_unik = time() . '_' . basename($_FILES[$gambar_key]["name"]);
            $target_file = $target_dir . $nama_file_unik;
            
            if (move_uploaded_file($_FILES[$gambar_key]["tmp_name"], $target_file)) {
                $gambar_names[$i] = $nama_file_unik;
                // Hapus file gambar lama jika perlu dan jika ada
                if (!empty($_POST[$gambar_lama_key])) {
                    $file_lama = $target_dir . $_POST[$gambar_lama_key];
                    if (file_exists($file_lama)) {
                        unlink($file_lama);
                    }
                }
            } else {
                die("Error saat mengupload gambar " . $i);
            }
        } else {
            // Jika tidak ada gambar baru, gunakan nama gambar lama
            $gambar_names[$i] = $_POST[$gambar_lama_key];
        }
    }

    // Update data di database (Query dan bind_param yang sudah LENGKAP)
    $sql = "UPDATE mobil SET 
                nama_mobil=?, harga_mobil=?, supir=?, 
                deskripsi_p1=?, deskripsi_p2=?, deskripsi_p3=?, deskripsi_p4=?, 
                gambar1=?, gambar2=?, gambar3=?, gambar4=? 
            WHERE id_mobil=?";
    
    $stmt = $conn->prepare($sql);
    // Tipe data: s (string), d (double/decimal), i (integer)
    // Total 12: 1 string, 2 double, 4 string, 4 string, 1 integer
    $stmt->bind_param("sddssssssssi", 
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
        $gambar_names[4],
        $id_mobil
    );

    if ($stmt->execute()) {
        header("Location: dashboard_product.php?status=edit_sukses");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: dashboard_product.php");
    exit();
}
?>