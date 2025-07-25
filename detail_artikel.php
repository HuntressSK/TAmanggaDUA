<?php
session_start();
include 'db_connection.php'; // Sertakan file koneksi database

// Path dasar untuk gambar
$baseImagePath = './assets/images/images/';

// Ambil nilai ID artikel dari parameter URL (misalnya ?id=1)
$article_id = isset($_GET['id']) ? $_GET['id'] : null;

// Periksa apakah ID artikel telah diberikan
if ($article_id !== null) {
    // Query untuk mengambil data artikel dari tabel berdasarkan ID
    $sql = "SELECT judul_gambar, judul, waktu_rilis, about, subjudul1, gambar1, teks1, subjudul2, gambar2, teks2, subjudul3, gambar3, teks3, subjudul4, gambar4, teks4, subjudul5, gambar5, teks5 
            FROM artikel
            WHERE id = $article_id";

    $result = mysqli_query($conn, $sql);

    // Periksa apakah query berhasil dieksekusi dan artikel ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Looping untuk setiap baris hasil query
        while ($row = mysqli_fetch_assoc($result)) {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wisata | ManggaDua Transport</title>
    <link rel="stylesheet" href="./assets/css/tailwind.css" />
    <link rel="stylesheet" href="./assets/css/input.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
  </head>
  <body>
    <header class="">
      <div>
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
                    <a href="./profil.php" class="pb-1.5 border-b-2 border-orange-500 text-orange-500">Profil</a>
                    <a href="./logout.php" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Logout</a>
                <?php else: ?>
                    <a href="./login.php" class="font-semibold text-gray-800 hover:text-orange-500">Login</a>
                    <a href="./register.php" class="bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600">Daftar</a>
                <?php endif; ?>
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
                <a href="./index.php" class="text-orange-500">Home</a>
                <a href="./daftar-paket.php">Daftar Paket</a>
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
      </div>
      <!-- <div class="jumbotron">
        <div class="mx-32 mt-10 flex flex-wrap pt-[80px]">
          <img class="rounded-2xl shadow-2xl" src="./assets/images/images/banner.jpg" alt="banner" />
        </div>
      </div> -->
    </header>

    <main class="flex flex-col md:flex-row justify-between mx-4 md:mx-32">
        <div id="content" class="content w-full md:w-2/3">
            <article class="mt-10 md:mt-20 pt-2">
                <div class="w-full md:w-[735px] h-auto md:h-[578px] overflow-hidden my-6">
                    <img src="<?php echo $baseImagePath . $row['judul_gambar']; ?>" alt="<?php echo $row['judul_gambar']; ?>"
                        class="w-full h-full object-cover rounded-2xl" />
                </div>
                <div class="text-2xl md:text-5xl font-bold text-gray-900">
                    <a class="bg-orange-500 px-3 text-white font-medium py-1 rounded-md text-sm mx-auto">Wisata</a>
                    <h1 class="mt-3"><?php echo $row['judul']; ?></h1>
                </div>
                <div class="my-5">
                    <p class="my-1 text-gray-400 text-sm"><?php echo $row['waktu_rilis']; ?></p>
                    <p><?php echo $row['about']; ?></p>
                </div>
            </article>

            <div class="text-base font-bold">
                <h2><?php echo $row['judul']; ?></h2>
            </div>

            <article class="my-7 mb-10 text-base">
                <h2 class="font-bold mb-4"><?php echo $row['subjudul1']; ?></h2>
                <?php if (!empty($row['gambar1'])): ?>
                    <div class="w-full md:w-[735px] h-auto md:h-[578px] overflow-hidden">
                        <img src="<?php echo $baseImagePath . $row['gambar1']; ?>" alt="<?php echo $row['gambar1']; ?>"
                            class="w-full h-full object-cover rounded-2xl" />
                    </div>
                <?php endif; ?>
                <p class="my-10"><?php echo $row['teks1']; ?></p>
            </article>


            <article class="my-7 mb-10 text-base">
                <h2 class="font-bold mb-4"><?php echo $row['subjudul2']; ?></h2>
                <?php if (!empty($row['gambar2'])): ?>
                    <div class="w-full md:w-[735px] h-auto md:h-[578px] overflow-hidden">
                        <img src="<?php echo $baseImagePath . $row['gambar2']; ?>" alt="<?php echo $row['gambar2']; ?>"
                            class="w-full h-full object-cover rounded-2xl" />
                    </div>
                <?php endif; ?>
                <p class="my-10"><?php echo $row['teks2']; ?></p>
            </article>


            <article class="my-7 mb-10 text-base">
                <h2 class="font-bold mb-4"><?php echo $row['subjudul3']; ?></h2>
                <?php if (!empty($row['gambar3'])): ?>
                    <div class="w-full md:w-[735px] h-auto md:h-[578px] overflow-hidden">
                        <img src="<?php echo $baseImagePath . $row['gambar3']; ?>" alt="<?php echo $row['gambar3']; ?>"
                            class="w-full h-full object-cover rounded-2xl" />
                    </div>
                <?php endif; ?>
                <p class="my-10"><?php echo $row['teks3']; ?></p>
            </article>

            <article class="my-7 mb-10 text-base">
                <h2 class="font-bold mb-4"><?php echo $row['subjudul4']; ?></h2>
                <?php if (!empty($row['gambar4'])): ?>
                    <div class="w-full md:w-[735px] h-auto md:h-[578px] overflow-hidden">
                        <img src="<?php echo $baseImagePath . $row['gambar4']; ?>" alt="<?php echo $row['gambar4']; ?>"
                            class="w-full h-full object-cover rounded-2xl" />
                    </div>
                <?php endif; ?>
                <p class="my-10"><?php echo $row['teks4']; ?></p>
            </article>

            <article class="my-7 mb-10 text-base">
                <h2 class="font-bold mb-4"><?php echo $row['subjudul5']; ?></h2>
                <?php if (!empty($row['gambar5'])): ?>
                    <div class="w-full md:w-[735px] h-auto md:h-[578px] overflow-hidden">
                        <img src="<?php echo $baseImagePath . $row['gambar5']; ?>" alt="<?php echo $row['gambar5']; ?>"
                            class="w-full h-full object-cover rounded-2xl" />
                    </div>
                <?php endif; ?>
                <p class="my-10"><?php echo $row['teks5']; ?></p>
            </article>

            <article class="my-7 mb-10 text-base">
                <h2 class="font-bold mb-4"><span></span>Jelajahi Wisata Air Bali dengan Rental Mobil Di ManggaDua
                    Transport</h2>
                <div class="h-[370px] w-full bg-cover bg-center rounded-xl"
                    style="background-image: url('./assets/images/images/index-header.jpg')">
                    <div class="container h-full relative flex items-center">
                        <div class="w-full md:w-8/12 lg:w-6/12 text-white">
                            <h1 class="font-bold text-2xl md:text-4xl mb-4">ManggaDua Transport – Solusi Rental Mobil & Rental
                                Supir</h1>
                            <p class="font-semibold text-xl">Dapatkan pengalaman baru dalam menyewa mobil dengan
                                mudah dan nyaman, tinggalkan cara konvensional. #CobaSekarang</p>
                            <div class="flex items-center gap-x-3 mt-5">
                                <img class="w-[100px] md:w-[150px]" src="./assets/images/images/gp.webp" alt="GP" />
                                <img class="w-[100px] md:w-[150px]" src="./assets/images/images/ios.webp" alt="IOS" />
                                <a class="flex bg-black py-2.5 px-4 rounded-lg text-sm md:text-xl font-medium text-white hover:bg-orange-500"
                                    href="./index.php"> <i class="fas text-lg fa-globe mt-0.5 mr-3"></i> Website </a>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="my-10">
                    Rancang perjalanan dari sekarang dan tentukan sendiri waktu penggunaan, lokasi, durasi hingga
                    jenis kendaraan dengan mudah lewat aplikasi ManggaDua Transport. Download aplikasinya di Google
                    Playstore atau Apple Appstore ya.
                </p>
                <p class="mb-10">
                    Dapatkan rekomendasi destinasi wisata di Yogyakarta maupun di berbagai kota di Indonesia melalui
                    Instagram @manggadua_transport, Facebook ManggaDua Transport, maupun Twitter @ManggaDuaTrans. Follow
                    media sosial ManggaDua Transport dan jadilah yang paling depan mengetahui informasi penawaran
                    menarik berbagai layanan ManggaDua Transport.
                </p>
                <p>Kemanapun treknya, pakai ManggaDua Transport aja!</p>
            </article>
        </div>

      <aside class="md:w-2/4 md:mt-20 mt-10 w-full">
        <article class="my-7 ml-10">
          <form class="max-w-md">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
              </div>
              <input
                type="search"
                id="default-search"
                class="block w-full p-6 ps-10 text-sm rounded-full text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukan kata pencarian"
                required />
              <button type="submit" class="text-white text-lg absolute end-1 bottom-1 bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full px-8 py-4 d">Cari</button>
            </div>
          </form>
        </article>
        <article class="sticky top-24">
          <div class="ml-10">
            <section class="my-5">
              <h1 class="text-2xl font-bold">Artikel Terbaru dan Terpopuler</h1>
            </section>
            <section>
              <div class="flex flex-wrap items-center gap-2 ml-3">
                <button type="button" class="kategori-wisata-button kategori-wisata-active whitespace-nowrap text-[13px] font-semibold text-gray-700 border-b-2 py-2 px-4 hover:text-orange-500 text-base">Terbaru</button>
                <button type="button" class="kategori-wisata-button whitespace-nowrap text-[13px] font-semibold text-gray-700 border-b-2 border-transparent py-2 px-4 hover:text-orange-500 text-base">Terpopuler</button>
              </div>

              <script>
                $(document).ready(function () {
                  // Set default active button to "Terbaru"
                  $(".kategori-wisata-button").first().addClass("text-orange-500 border-orange-500");

                  $(".kategori-wisata-button").click(function () {
                    $(".kategori-wisata-button").removeClass("text-orange-500 border-orange-500").addClass("text-gray-700 border-transparent");
                    $(this).removeClass("text-gray-700 border-transparent").addClass("text-orange-500 border-orange-500");
                  });
                });
              </script>
            </section>
          </div>

          <div class="grid mx-10 grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-6">
            <!-- Card 1 -->
            <section class="flex gap-x-4 bg-white rounded-lg overflow-hidden shadow-lg mt-6">
              <div class="max-w-[100px] h-[117px] overflow-hidden flex justify-center items-center">
                <img src="./assets/images/images/prambanan.jpg" alt="Gambar TB" class="w-full h-full object-cover" />
              </div>
              <div class="mt-2 flex-1">
                <a class="bg-orange-500 px-3 hover:bg-orange-600 text-white font-medium py-1 rounded-md text-sm" href="">Wisata</a>
                <h1 class="font-bold text-lg my-1">7 Spot Instagramable di Yogyakarta yang Wajib Dikunjungi</h1>
                <p class="text-gray-400 text-sm">22 Juli 2024</p>
              </div>
            </section>

            <!-- Card 2 -->
            <section class="flex gap-x-4 bg-white rounded-lg overflow-hidden shadow-lg mt-6">
              <div class="max-w-[100px] h-[117px] overflow-hidden flex justify-center items-center">
                <img src="./assets/images/images/wisata-1.jpg" alt="Gambar TB" class="w-full h-full object-cover" />
              </div>
              <div class="mt-2 flex-1">
                <a class="bg-orange-500 px-3 hover:bg-orange-600 text-white font-medium py-1 rounded-md text-sm" href="">Wisata</a>
                <h1 class="font-bold text-lg my-1">5 Oleh-oleh khas Yogyakarta, Ada Surjan hingga Yangko!</h1>
                <p class="text-gray-400 text-sm">12 Juli 2024</p>
              </div>
            </section>

            <!-- Card 3 -->
            <section class="flex gap-x-4 bg-white rounded-lg overflow-hidden shadow-lg mt-6">
              <div class="max-w-[100px] h-[117px] overflow-hidden flex justify-center items-center">
                <img src="./assets/images/images/banner.jpg" alt="Gambar TB" class="w-full h-full object-cover" />
              </div>
              <div class="mt-2 flex-1">
                <a class="bg-orange-500 px-3 hover:bg-orange-600 text-white font-medium py-1 rounded-md text-sm" href="">Promo</a>
                <h1 class="font-bold text-lg my-1">Liburan menggunakan jasa kami tanpa ribet dengan DISCOUNT 50%</h1>
                <p class="text-gray-400 text-sm">09 Juli 2024</p>
              </div>
            </section>
          </div>

          <section class="mx-10 my-10">
            <h1 class="text-2xl font-bold">Kategori Artikel</h1>
            <div class="my-5 flex gap-x-3">
              <a class="bg-orange-500 text-white px-4 rounded-md hover:bg-orange-600 font-bold py-1.5" href="">Promo</a>
              <a class="bg-orange-500 text-white px-4 rounded-md hover:bg-orange-600 font-bold py-1.5" href="">Wisata</a>
            </div>
          </section>

          <section class="mx-10 my-10">
            <h1 class="text-2xl font-bold">Tag</h1>
            <div class="my-5 flex gap-x-3">
              <a class="text-black border border-gray-400 px-4 rounded-md font-bold py-1.5" href="">Yogyakarta</a>
              <a class="text-black border border-gray-400 px-4 rounded-md font-bold py-1.5" href="">Wisata yogyakarta</a>
              <a class="text-black border border-gray-400 px-4 rounded-md font-bold py-1.5" href="">Wisata Bali</a>
            </div>
          </section>
        </article>
      </aside>
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


    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
</html>
<?php
        } // Tutup perulangan while
    } else {
        echo "Artikel dengan ID $article_id tidak ditemukan.";
    }
} else {
    echo "ID artikel tidak diberikan.";
}

// Tutup koneksi database
mysqli_close($conn);
?>