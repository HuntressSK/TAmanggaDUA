<?php
// Masukkan file koneksi ke database
require_once('../db_connection.php');

// Memeriksa apakah form telah dikirimkan
if (isset($_POST['submit'])) {
    // Mengambil data dari formulir edit mobil dan menyanitasi
    $id_mobil = mysqli_real_escape_string($conn, $_POST['id_mobil']);
    $nama_mobil = mysqli_real_escape_string($conn, $_POST['nama_mobil']);
    $harga_mobil = mysqli_real_escape_string($conn, $_POST['harga_mobil']);
    $deskripsi_p1 = mysqli_real_escape_string($conn, $_POST['deskripsi_p1']);
    $deskripsi_p2 = mysqli_real_escape_string($conn, $_POST['deskripsi_p2']);
    $deskripsi_p3 = mysqli_real_escape_string($conn, $_POST['deskripsi_p3']);
    $deskripsi_p4 = mysqli_real_escape_string($conn, $_POST['deskripsi_p4']);

    // Menangani gambar
    $gambar1 = $_POST['gambar1_current'];
    if (!empty($_FILES['gambar1']['name'])) {
        $gambar1 = uniqid() . "_" . basename($_FILES['gambar1']['name']);
        $target1 = "../uploads/" . $gambar1;
        move_uploaded_file($_FILES['gambar1']['tmp_name'], $target1);
    }

    $gambar2 = $_POST['gambar2_current'];
    if (!empty($_FILES['gambar2']['name'])) {
        $gambar2 = uniqid() . "_" . basename($_FILES['gambar2']['name']);
        $target2 = "../uploads/" . $gambar2;
        move_uploaded_file($_FILES['gambar2']['tmp_name'], $target2);
    }

    $gambar3 = $_POST['gambar3_current'];
    if (!empty($_FILES['gambar3']['name'])) {
        $gambar3 = uniqid() . "_" . basename($_FILES['gambar3']['name']);
        $target3 = "../uploads/" . $gambar3;
        move_uploaded_file($_FILES['gambar3']['tmp_name'], $target3);
    }

    $gambar4 = $_POST['gambar4_current'];
    if (!empty($_FILES['gambar4']['name'])) {
        $gambar4 = uniqid() . "_" . basename($_FILES['gambar4']['name']);
        $target4 = "../uploads/" . $gambar4;
        move_uploaded_file($_FILES['gambar4']['tmp_name'], $target4);
    }

    // Query untuk update data mobil berdasarkan id_mobil
    $sql = "UPDATE mobil SET 
            nama_mobil = '$nama_mobil', 
            harga_mobil = '$harga_mobil', 
            deskripsi_p1 = '$deskripsi_p1', 
            deskripsi_p2 = '$deskripsi_p2', 
            deskripsi_p3 = '$deskripsi_p3', 
            deskripsi_p4 = '$deskripsi_p4',
            gambar1 = '$gambar1',
            gambar2 = '$gambar2',
            gambar3 = '$gambar3',
            gambar4 = '$gambar4'
            WHERE id_mobil = $id_mobil";

    if (mysqli_query($conn, $sql)) {
        // Redirect ke halaman dashboard atau halaman lain jika berhasil
        header("Location: dashboard_product.php");
        exit();
    } else {
        // Jika query gagal dieksekusi
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Menutup koneksi database
    mysqli_close($conn);
}
?>
