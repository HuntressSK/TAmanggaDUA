

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wisata | ManggaDua Transport</title>
    <!-- PANGGIL FILE TAILWIND CSS -->
    <link rel="stylesheet" href="./assets/css/tailwind.css" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>

<?php
include './db_connection.php'; // Sertakan file koneksi database

// Path dasar untuk gambar
$baseImagePath = './uploads/';

// Query untuk mengambil data artikel dari tabel yang sesuai
$sql = "SELECT id, judul_gambar, judul, waktu_rilis, about FROM artikel";

$result = mysqli_query($conn, $sql);

// Periksa apakah query berhasil dieksekusi
if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-y-5 gap-x-5">
    <?php
    // Looping untuk setiap baris hasil query
    while ($row = mysqli_fetch_assoc($result)) {
        // Inisialisasi $shortAbout untuk menghindari error "Undefined variable"
        $shortAbout = isset($row['about']) ? substr($row['about'], 0, 100) . "..." : "";

        // Tampilkan konten artikel
        ?>
        <article class="relative md:w-auto overflow-hidden group border border-slate-200 rounded-md bg-white">
            <!-- ARTIKEL CARD HEAD -->
            <div class="relative overflow-hidden w-full h-[200px] md:h-[220px] lg:h-[250px] rounded-t">
                <!-- BUTTON LOVE -->
                <button type="button" class="h-10 w-10 flex items-center justify-center absolute top-2.5 right-2.5 z-10 text-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="rgba(0, 0, 0, 0.85)" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </button>
                <!-- GAMBAR ARTIKEL -->
                <a href="detail_artikel.php?id=<?php echo $row['id']; ?>">
                    <img class="h-full w-full object-cover transition-all duration-300 group-hover:scale-110" src="<?php echo $baseImagePath . $row['judul_gambar']; ?>" alt="<?php echo $row['judul']; ?>" />
                </a>
            </div>
            <!-- ARTIKEL CARD BODY -->
            <section class="p-4">
                <div class="flex items-center justify-between mb-1.5">
                    <p class="font-semibold text-[13px] text-[#fd9704]">
                        <a href="#">Wisata</a>
                    </p>
                    <div class="flex items-center gap-x-1 text-[#fd9704]">
                        <strong class="font-normal text-gray-800 text-sm"><?php echo $row['waktu_rilis']; ?></strong>
                    </div>
                </div>
                <!-- JUDUL ARTIKEL -->
                <h3 class="font-semibold text-lg text-gray-900">
                    <a href="detail_artikel.php?id=<?php echo $row['id']; ?>"><?php echo $row['judul']; ?></a>
                </h3>
                <p class="text-sm text-gray-700"><?php echo $shortAbout; ?></p>
            </section>
        </article>
        <?php
    }
    ?>
    </div>
    <?php
} else {
    echo "Tidak ada artikel yang ditemukan.";
}

// Tutup koneksi database
mysqli_close($conn);
?>


     

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

        // GANTI KATEGORI WISATA
        $(".kategori-wisata-button").click(function () {
          $(this).siblings().removeClass("kategori-wisata-active");
          $(this).addClass("kategori-wisata-active");
        });
      });
    </script>
  </body>
</html>
