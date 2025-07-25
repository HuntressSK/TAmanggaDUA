<?php
session_start();
include 'db_connection.php';

// Query untuk mengambil SEMUA data mobil, diurutkan berdasarkan nama
$sql_semua_mobil = "SELECT id_mobil, nama_mobil, harga_mobil, supir, gambar1 FROM mobil ORDER BY nama_mobil ASC";
$result_semua_mobil = mysqli_query($conn, $sql_semua_mobil);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Paket | ManggaDua Transport</title>
    <!-- PANGGIL FILE TAILWIND CSS -->
    <link rel="stylesheet" href="./assets/css/tailwind.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <style>
      /* BUTTON ACTIVE UNTUK KATEGORI PAKET */
      .main-kategori-button-active {
        background-color: #f97316 !important;
        color: white !important;
      }
    </style>
  </head>

  <body>
    <!-- NAVIGASI -->
    <nav class="h-[80px] w-full fixed top-0 left-0 z-[100] bg-white border-b">
      <div class="container h-full flex items-center justify-between">
        <!-- NAVIGASI KIRI -->
        <div>
          <a href="./index.php">
            <img src="./assets/images/logos/logoipsum-260.svg" class="object-cover w-[140px] h-auto" height="60" width="80" alt="260" />
          </a>
        </div>
        <!-- NAVIGASI KANAN -->
        <div class="hidden font-medium text-base text-gray-800 md:flex items-center gap-x-6">
          <a href="./index.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Home</a>
          <a href="./daftar-paket.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Daftar Paket</a>
          <a href="./artikel.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Wisata</a>
          <a href="./faq.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">FAQ</a>

          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="./profil.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Profil</a>
            <a href="./logout.php" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Logout</a>
          <?php else: ?>
            <a href="./login.php" class="font-semibold text-gray-800 hover:text-orange-500">Login</a>
            <a href="./register.php" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Daftar</a>
          <?php endif; ?>

          <a href="#" class="pb-1.5 border-b-2 border-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
          </a>
        </div>
        <!-- NAVIGASI MOBILE MUNCUL -->
        <div class="flex md:hidden">
          <button type="button" class="navigasi-mobile-open">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
      </div>
    </nav>
    <!-- NAVIGASI MOBILE -->
    <aside id="navigasi-mobile" class="block md:hidden h-full w-full bg-white fixed top-0 right-0 z-[120] transition-all duration-300 transform translate-x-[120%]">
      <div class="relative h-full w-full py-8 px-5">
        <div class="text-center mb-8">
          <a href="./index.php">
            <img src="./assets/images/logos/logoipsum-260.svg" class="object-cover w-[180px] h-auto mx-auto" height="60" width="80" alt="260" />
          </a>
        </div>
        <div>
          <h3 class="font-medium text-lg text-gray-900">Menu</h3>
          <div class="flex flex-col gap-y-3.5 font-medium text-base text-gray-800 mt-5">
            <a href="./index.php">Home</a>
            <a href="./daftar-paket.php" class="text-orange-500">Daftar Paket</a>
            <a href="./artikel.php">Wisata</a>
            <a href="./faq.php">FAQ</a>
            <a href="./index.php"
              ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
              </svg>
            </a>
          </div>
        </div>
        <!-- CLOSE NAVIGASI MOBILE -->
        <button type="button" class="navigasi-mobile-close h-10 w-10 absolute bottom-14 left-1/2 transform -translate-x-1/2 flex items-center justify-center bg-black text-white rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </aside>
    <!-- HEADER -->
    <header>
      <div class="w-full flex flex-wrap pt-[80px]">
        <!-- HEADER KIRI -->
        <div class="w-full md:w-1/2 absolute md:static flex items-center flex-col md:bg-gray-800 pt-[80px] md:pt-[100px] px-5 md:px-4 lg:px-8 z-10">
          <h2 class="w-full md:w-10/12 font-semibold text-2xl md:text-3xl lg:text-5xl text-white mb-5">Rental Mobil <span class="text-orange-500">Yogyakarta</span> Murah Lepas Kunci dan Dengan Sopir</h2>
          <p class="w-full md:w-10/12 text-white">
            Rental dan Sewa Mobil <span class="text-orange-500 font-medium">ManggaDua Transport</span>. Aplikasi rental mobil lepas kunci atau dengan sopir. Dapatkan harga sewa mobil dengan tarif termurah di berbagai destinasi.
          </p>
        </div>
        <!-- HEADER KANAN -->
        <div class="w-full md:w-1/2 bg-gray-800">
          <!-- HEADER GAMBAR -->
          <img class="w-full h-[400px] md:h-[auto] object-cover contrast-50 md:contrast-100" src="./assets/images/images/daftar-paket-header.avif" alt="City" />
        </div>
      </div>
    </header>
    <!-- MAIN -->
    <main>
      <div class="container flex flex-wrap md:flex-nowrap items-start py-12 md:py-12 lg:py-14">
        <!-- KATEGORI PAKET -->
        <div class="w-full md:w-[370px] static md:sticky top-[100px] left-0 md:px-5 lg:px-7 mb-6 md:mb-0">
          <div class="flex flex-wrap md:flex-col gap-y-3 gap-x-2 border rounded-md p-4 md:p-5 bg-white">
            <button type="button" class="main-kategori-button w-auto md:w-full text-center py-1.5 md:py-2 px-5 font-medium text-sm text-gray-700 border rounded-full">Mobil</button>
            <button type="button" class="main-kategori-button w-auto md:w-full text-center py-1.5 md:py-2 px-5 font-medium text-sm text-gray-700 border rounded-full">Supir</button>
            <button type="button" class="main-kategori-button main-kategori-button-active w-auto md:w-full text-center py-1.5 md:py-2 px-5 font-medium text-sm text-gray-700 border rounded-full">Mobil + Supir</button>
          </div>
        </div>
        <!-- DAFTAR PAKET -->
        <div class="grow w-full">
          <div class="flex flex-wrap items-center justify-between mb-6 md:mb-8">
            <h2 class="font-semibold text-xl md:text-2xl text-gray-900">Pilihan Mobil Terfavorit di Yogyakarta</h2>
            <div class="flex items-center gap-x-4 mt-3 md:mt-0">
              <div class="relative flex items-center gap-x-2 cursor-pointer">
                <strong class="font-semibold text-sm md:text-base text-gray-700">Urutkan:</strong>
                <!-- DROPDOWN -->
                <select name="urutkan" id="urutkan" class="bg-white py-2 px-5 font-semibold border rounded-md">
                  <option value="terbaru">Terbaru</option>
                  <option value="terbaru">Terlaris</option>
                </select>
              </div>
            </div>
          </div>
          <!-- DAFTAR PAKET LIST -->
<!-- DAFTAR PAKET LIST -->
      <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-5 md:gap-4 lg:gap-5">
        <?php
        // untuk mengecek apakah ada data mobil
        if (mysqli_num_rows($result_semua_mobil) > 0) {
          while ($mobil = mysqli_fetch_assoc($result_semua_mobil)) {
        ?>
          <article class="w-full group">
            <div class="h-[190px] sm:h-[200px] md:h-[220px] w-full bg-slate-100 p-5">
              <img class="h-full w-full object-cover" src="assets/images/images/<?php echo htmlspecialchars($mobil['gambar1']); ?>" alt="<?php echo htmlspecialchars($mobil['nama_mobil']); ?>" />
            </div>
            <div class="bg-white py-3 px-5">
              <h2 class="font-semibold text-base md:text-lg text-gray-900"><?php echo htmlspecialchars($mobil['nama_mobil']); ?></h2>
              <div class="mt-2.5">
                <p class="text-[13px] text-gray-600 mb-1">Mulai Dari</p>
                <p class="text-[13px] text-gray-600">
                  <strong class="font-semibold text-base text-gray-900 pr-1">Rp. <?php echo number_format($mobil['harga_mobil'], 0, ',', '.'); ?></strong>
                  / Hari <span class="">(Tanpa Supir)</span>
                </p>
                <p class="text-[13px] text-gray-600">
                  <strong class="font-semibold text-base text-gray-900 pr-1">Rp. <?php echo number_format($mobil['harga_mobil'] + $mobil['supir'], 0, ',', '.'); ?></strong>
                  / Hari <span class="">(Dengan Supir)</span>
                </p>
              </div>
              <div class="my-5 h-px w-full bg-slate-200"></div>
              <a href="./detail_mobil.php?id_mobil=<?php echo $mobil['id_mobil']; ?>" class="inline-block w-full font-medium text-base text-gray-800 text-center py-2.5 border rounded-full group-hover:bg-gray-800 group-hover:text-white">Sewa Sekarang</a>
            </div>
          </article>
        <?php
          }
        } else {
            echo "<p class='col-span-full text-center text-gray-500'>Tidak ada data mobil yang ditemukan.</p>";
          }
        ?>
      </div>
          <!-- PAGINATION -->
          <div class="flex items-center justify-center md:justify-end gap-x-2 md:gap-x-3 mt-8 md:mt-10 lg:mt-12">
            <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
              </svg>
            </button>
            <button type="button" class="bg-blue-500 text-white font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">1</button>
            <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">2</button>
            <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">3</button>
            <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">4</button>
            <button type="button" class="bg-slate-100 text-gray-700 font-semibold text-sm md:text-base h-[40px] md:h-[46px] lg:h-[50px] w-[40px] md:w-[46px] lg:w-[50px] inline-flex justify-center items-center border rounded-md">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </main>
    <!-- FOOTER -->
    <footer class="bg-white">
      <!-- FOOTER PERTAMA -->
      <div class="py-12 md:py-12 lg:py-14 border-y border-slate-200">
        <div class="container flex flex-wrap md:flex-nowrap items-start justify-between gap-x-[120px]">
          <!-- FOOTER PERTAMA KIRI -->
          <div class="w-full md:w-auto mb-6 md:mb-0">
            <h2 class="font-semibold text-base md:text-base lg:text-lg text-[#20202C]">ManggaDua Transport</h2>
            <div class="flex flex-col gap-y-3 text-sm md:text-sm lg:text-base text-gray-700 mt-2 md:mt-4">
              <a href="./index.php" rel="noreferrer noopener" class="hover:text-orange-600">Tentang Kami</a>
              <a href="./daftar-paket.php" rel="noreferrer noopener" class="hover:text-orange-600">Daftar Paket</a>
              <a href="./artikel.php" rel="noreferrer noopener" class="hover:text-orange-600">Wisata</a>
              <a href="./faq.php" rel="noreferrer noopener" class="hover:text-orange-600">FAQ</a>
            </div>
          </div>
          <!-- FOOTER PERTAMA TENGAH -->
          <div class="w-full md:w-auto mb-6 md:mb-0">
            <h3 class="font-semibold text-base md:text-base lg:text-lg text-[#20202C]">PERTANYAAN?</h3>
            <div class="flex flex-col gap-y-4 text-base md:text-base lg:text-lg mt-2 md:mt-4">
              <a href="mailto:tanya@traave.com" class="flex items-center gap-x-2.5 text-gray-800 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <span class="inline-block -mt-px text-sm md:text-sm lg:text-base">tanya@manggaduatransport.com</span>
              </a>
              <a href="tel:08123456789" class="flex items-center gap-x-2.5 text-gray-800 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                <span class="inline-block -mt-px text-sm md:text-sm lg:text-base">08123456789</span>
              </a>
            </div>
          </div>
          <!-- FOOTER PERTAMA KANAN -->
          <div class="w-full md:w-[300px]">
            <div class="mb-6 md:mb-12">
              <h3 class="font-semibold text-base md:text-base lg:text-lg text-[#20202C]">PEMBAYARAN</h3>
              <!-- FOOTER PEMBAYARAN ICON -->
              <div class="w-full flex flex-wrap md:flex-nowrap gap-1 md:gap-2.5 text-sm text-gray-500 mt-2 md:mt-4">
                <div class="h-[36px] w-3/12 flex items-center justify-center border border-slate-200 rounded">
                  <img src="./assets/images/logos/logoipsum-259.svg" class="object-cover w-[80%] h-auto" height="60" width="80" alt="259" />
                </div>
                <div class="h-[36px] w-3/12 flex items-center justify-center border border-slate-200 rounded">
                  <img src="./assets/images/logos/logoipsum-260.svg" class="object-cover w-[80%] h-auto" height="60" width="80" alt="260" />
                </div>
                <div class="h-[36px] w-3/12 flex items-center justify-center border border-slate-200 rounded">
                  <img src="./assets/images/logos/logoipsum-261.svg" class="object-cover w-[80%] h-auto" height="60" width="80" alt="261" />
                </div>
                <div class="h-[36px] w-3/12 flex items-center justify-center border border-slate-200 rounded">
                  <img src="./assets/images/logos/logoipsum-262.svg" class="object-cover w-[80%] h-auto" height="60" width="80" alt="262" />
                </div>
              </div>
            </div>
            <div>
              <h3 class="font-semibold text-base md:text-base lg:text-lg text-[#20202C] uppercase mb-5 md:mb-0">PASANG APP ManggaDua Transport</h3>
              <div class="flex flex-wrap md:flex-nowrap gap-x-1 md:gap-x-3 gap-y-5 mt-2 md:mt-4">
                <div class="w-full md:w-1/2">
                  <img src="./assets/images/logos/logoipsum-263.svg" class="w-full h-[50px]" height="50" width="150" alt="263" />
                </div>
                <div class="w-full md:w-1/2">
                  <img src="./assets/images/logos/logoipsum-264.svg" class="w-full h-[50px]" height="50" width="150" alt="264" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- FOOTER: KEDUA -->
      <div class="py-5">
        <div class="container flex flex-wrap md:flex-nowrap justify-between items-center">
          <div class="w-full md:w-auto flex items-center justify-between md:justify-start md:gap-x-10 lg:gap-x-14">
            <!-- LOGO SOCIAL MEDIA -->
            <div class="w-full md:w-auto flex justify-center md:justify-start items-center gap-x-3">
              <a href="https://www.facebook.com/" target="_blank" rel="noreferrer noopener" aria-label="Facebook" class="h-[40px] w-[40px] flex items-center justify-center text-slate-600 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook h-6 w-6" viewBox="0 0 16 16">
                  <path
                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                </svg>
              </a>
              <a href="https://twitter.com/" target="_blank" rel="noreferrer noopener" aria-label="Twitter" class="h-[40px] w-[40px] flex items-center justify-center text-slate-600 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter h-6 w-6" viewBox="0 0 16 16">
                  <path
                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15" />
                </svg>
              </a>
              <a href="https://www.instagram.com/" target="_blank" rel="noreferrer noopener" aria-label="Instagram" class="h-[40px] w-[40px] flex items-center justify-center text-slate-600 hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram h-6 w-6" viewBox="0 0 16 16">
                  <path
                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                </svg>
              </a>
            </div>
          </div>
          <div class="w-full md:w-auto mt-5 md:mt-0">
            <!-- COPYRIGHT FOOTER -->
            <h4 class="font-medium text-sm text-[#20202C] text-center">© 2024 <strong>ManggaDua Transport</strong> Semua hak dilindungi undang-undang.</h4>
          </div>
        </div>
      </div>
    </footer>
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
        $(".main-kategori-button").click(function () {
          $(this).siblings().removeClass("main-kategori-button-active");
          $(this).addClass("main-kategori-button-active");
        });
      });
    </script>
  </body>
</html>
