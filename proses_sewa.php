<?php
// Pastikan ada data yang dikirim melalui $_POST
if(isset($_POST['submit'])) {
    // Koneksi ke database
    require_once 'db_connection.php';

    // Ambil nilai dari $_POST
    $id_mobil = $_POST['id_mobil'];
    $rental_date = $_POST['tanggal_penyewaan'];
    $rental_date_mysql_format = date('Y-m-d', strtotime($rental_date)); // Ubah format tanggal ke YYYY-MM-DD
    $rental_duration = $_POST['durasi_penyewaan'];
    $with_driver = isset($_POST['dengan_supir']) ? $_POST['dengan_supir'] : 0;

    // Query untuk mendapatkan harga mobil berdasarkan id_mobil
    $query = "SELECT harga_mobil FROM mobil WHERE id_mobil = $id_mobil";
    $result = mysqli_query($conn, $query);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $harga_mobil = $row['harga_mobil'];

        // Hitung total harga tanpa biaya admin
        $total_harga = $harga_mobil * $rental_duration;
        if ($with_driver) {
            $total_harga += 400000; // Tambah biaya supir
        }

        // Tambah biaya admin
        $total_harga += 5000; // Biaya admin Rp 5,000

        // Query untuk menyimpan transaksi ke database
        $insert_query = "INSERT INTO transaksi (id_mobil, tanggal_penyewaan, durasi_penyewaan, dengan_supir, total_harga) 
                        VALUES ($id_mobil, '$rental_date_mysql_format', $rental_duration, $with_driver, $total_harga)";
        $insert_result = mysqli_query($conn, $insert_query);

        if($insert_result) {
            // Ambil id_transaksi yang baru saja dimasukkan
            $id_transaksi = mysqli_insert_id($conn);

            // Redirect ke halaman transaksi dengan parameter id_transaksi dan id_mobil
            header("Location: transaksi.php?id_transaksi=$id_transaksi&id_mobil=$id_mobil");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
} else {
    // Jika tidak ada data yang dikirimkan, redirect ke halaman lain atau berikan pesan kesalahan
    echo "Data tidak ditemukan!";
}
?>
