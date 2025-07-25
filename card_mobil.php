<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Proses Pembayaran | ManggaDua Transport</title>
    <link rel="stylesheet" href="./assets/css/tailwind.css" />
    <link rel="stylesheet" href="./assets/css/input.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
    <style>
      /* BUTTON ACTIVE BANK PEMBAYARAN */
      .bank-pembayaran-button-active {
        border: 2px solid #f97316;
      }
    </style>
  </head>

  <body>
    <!-- MAIN -->
    <main>
      <div id="content">
        <section class="mx-32">
          <div class="container py-[60px] md:py-[100px] lg:py-[120px]">
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mt-10">
             <?php
// Include file koneksi ke database
include 'db_connection.php';

// Query untuk mengambil data mobil
$sql = "SELECT id_mobil, nama_mobil, harga_mobil, harga_mobil + 600000 AS harga_supir, CONCAT('uploads/', gambar1) AS gambar
        FROM mobil";
$result = mysqli_query($conn, $sql);

// Memastikan hasil query tidak kosong
if (mysqli_num_rows($result) > 0) {
    // Loop untuk menampilkan setiap hasil query
    while ($row = mysqli_fetch_assoc($result)) {
?>
<article class="w-full group">
  <!-- DAFTAR PAKET CARD HEAD -->
  <div class="h-[190px] sm:h-[200px] md:h-[220px] w-full bg-slate-100 p-5">
<img class="h-full w-full object-cover" src="<?php echo $row['gambar']; ?>" alt="Image" />
  </div>
  <!-- DAFTAR PAKET CARD BODY -->
  <div class="bg-white py-3 px-5">
    <h2 class="font-semibold text-base md:text-lg text-gray-900"><?php echo $row['nama_mobil']; ?></h2>
    <div class="mt-2.5">
      <p class="text-[13px] text-gray-600 mb-1">Mulai Dari</p>
      <p class="text-[13px] text-gray-600">
        <strong class="font-semibold text-base text-gray-900 pr-1">Rp. <?php echo number_format($row['harga_mobil'], 0, ',', '.'); ?></strong>
        / Hari <span class="">(Tanpa Supir)</span>
      </p>
      <p class="text-[13px] text-gray-600">
        <strong class="font-semibold text-base text-gray-900 pr-1">Rp. <?php echo number_format($row['harga_supir'], 0, ',', '.'); ?></strong>
        / Hari <span class="">(Dengan Supir)</span>
      </p>
    </div>

    <div class="my-5 h-px w-full bg-slate-200"></div>
<a href="./detail_mobil.php?id=<?php echo $row['id_mobil']; ?>" class="inline-block w-full font-medium text-base text-gray-800 text-center py-2.5 border rounded-full group-hover:bg-gray-800 group-hover:text-white">Sewa Sekarang</a>
  </div>
</article>
<?php
    }
} else {
    echo "Tidak ada data mobil yang ditemukan.";
}

// Menutup koneksi database
mysqli_close($conn);
?>
            </div>
            <!-- LIHAT SEMUA -->
          </div>
        </section>
      </div>
    </main>

    <!-- MENGGUNAKAN FILE JQUERY CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- JAVASCRIPT -->
    <script>
      $(document).ready(function () {
        // OPEN NAVIGASI MOBILE
        $(".navigasi-mobile-open").click(function () {
          $("#navigasi-mobile").removeClass("translate-x-[120%]");
        });
        // TUTUP NAVIGASI MOBILE
        $(".navigasi-mobile-close").click(function () {
          $("#navigasi-mobile").addClass("translate-x-[120%]");
        });

        // GANTI KATEGORI PAKET
        $(".bank-pembayaran-button").click(function () {
          $(this).siblings().removeClass("bank-pembayaran-button-active");
          $(this).addClass("bank-pembayaran-button-active");
        });
      });
    </script>
  </body>
</html>
