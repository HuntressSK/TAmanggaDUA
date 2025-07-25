<?php
session_start();
include 'db_connection.php';

// Query untuk mengambil data mobil (misalnya kita ambil 8 mobil saja)
$sql_mobil = "SELECT * FROM mobil LIMIT 8";
$result_mobil = mysqli_query($conn, $sql_mobil);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rental Mobil & Sewa Supir Di ManggaDua Transport</title>
    <!-- PANGGIL FILE TAILWIND CSS -->
    <link rel="stylesheet" href="./assets/css/tailwind.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
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
    <!-- HEADER -->
    <header class="h-[100vh] w-full bg-cover bg-center" style="background-image: url('./assets/images/images/index-header.jpg')">
      <div class="container h-full relative flex items-center pt-[80px]">
        <div class="w-full md:w-8/12 lg:w-6/12 text-white">
          <h1 class="font-bold text-4xl mb-4">ManggaDua Transport – Solusi Rental Mobil & Rental Supir</h1>
          <p class="font-semibold text-xl">Dapatkan pengalaman baru dalam menyewa mobil dengan mudah dan nyaman, tinggalkan cara konvensional. #CobaSekarang</p>
          <div class="flex items-center gap-x-3 mt-5">
            <img class="w-[150px]" src="./assets/images/images/gp.webp" alt="GP" />
            <img class="w-[150px]" src="./assets/images/images/ios.webp" alt="IOS" />
          </div>
        </div>
      </div>
    </header>
    <!-- PROFIL PERUSAHAAN -->
    <section class="bg-white">
      <div class="container flex flex-wrap md:flex-nowrap items-center gap-5 py-[60px] md:py-[100px] lg:py-[120px]">
        <article class="order-2 md:order-1 w-full md:w-1/2">
          <h2 class="font-bold text-xl md:text-3xl text-gray-900 mb-5">Selamat Datang di ManggaDua Transport Rental Mobil & Sewa Supir Terpercaya di Yogyakarta dan Sekitarnya</h2>
          <p class="text-lg text-gray-700">
            ManggaDua Transport adalah penyedia layanan sewa mobil dan sewa supir yang sudah belasan tahun beroperasi di Yogyakarta. Menggunakan armada mobil keluaran baru, dengan kondisi terawat untuk disewakan kepada Anda. Pilihan mobil
            yang kami sediakan sangat variatif dan harga yang sangat kompetitif di Yogyakarta. Kami menawarkan untuk Anda seperti: Toyota Alphard, Vellfire, Camry, rental Toyota Innova.
          </p>
        </article>
        <article class="order-1 md:order-2 w-full md:w-1/2 flex justify-end">
          <img class="w-full md:w-10/12 h-[400px] object-cover" src="./assets/images/images/company.jpg" alt="company" />
        </article>
      </div>
    </section>
    <!-- PILIHAN MOBIL -->
    <main>
      <div class="container py-[60px] md:py-[100px] lg:py-[120px]">
        <div class="w-full sm:max-w-[600px] md:max-w-[700px] mx-auto text-center">
          <h2 class="font-semibold text-2xl sm:text-3xl md:text-4xl text-gray-900 mb-3">Pilih Paket Favoritmu</h2>
          <p class="text-base text-gray-700">Paket yang tersedia adalah yang terbaik, dan kenyamanan kendaraan adalah prioritas ManggaDua Transport.</p>
        </div>
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mt-10">

          <?php while($mobil = mysqli_fetch_assoc($result_mobil)): ?>
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
                  / Hari
                </p>
            </div>
          </article>
          <?php endwhile; ?>
          
        </div>
      </div>
    </main>

    <!-- KENAPA PILIH KAMI -->
    <main class="bg-white">
      <div class="container py-[60px] md:py-[100px] lg:py-[120px]">
        <div class="w-full sm:max-w-[600px] md:max-w-[700px] mx-auto text-center">
          <h2 class="font-semibold text-2xl sm:text-3xl md:text-4xl text-gray-900 mb-3">Kenapa Sewa Mobil di ManggaDua Transport</h2>
          <p class="text-base text-gray-700">Kepuasan Pelanggan selalu menjadi prioritas kami dalam setiap pelayanan</p>
        </div>
        <div class="w-full flex flex-wrap lg:flex-nowrap items-start gap-y-5 md:gap-x-6 lg:gap-x-10 mt-6 md:mt-10">
          <article class="w-full sm:w-6/12 md:w-4/12 p-5">
            <div class="flex items-center gap-x-4 mb-4">
              <div class="h-12 w-12 flex items-center justify-center bg-orange-500 text-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                </svg>
              </div>
              <h3 class="font-semibold text-xl md:text-2xl text-gray-900">Harga Terjangkau</h3>
            </div>
            <div>
              <p class="text-base text-gray-800">Harga layanan yang ManggaDua Transport Transport berikan sangat kompetitif dengan tetap mengutamakan kualitas. Terdapat banyak promo potongan harga.</p>
            </div>
          </article>
          <article class="w-full sm:w-6/12 md:w-4/12 p-5">
            <div class="flex items-center gap-x-4 mb-4">
              <div class="h-12 w-12 flex items-center justify-center bg-orange-500 text-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="h-8 w-8" viewBox="0 0 16 16">
                  <path
                    d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
                </svg>
              </div>
              <h3 class="font-semibold text-xl md:text-2xl text-gray-900">Variasi Pilihan Mobil</h3>
            </div>
            <div>
              <p class="text-base text-gray-800">
                100+ unit kendaraan terdaftar di aplikasi ManggaDua Transport. Anda dapat menyewa Avanza, Innova, Xenia, Calya, Sigra, Brio, Xpander, Terios, Fortuner, hingga Hiace, serta puluhan jenis mobil lainnya.
              </p>
            </div>
          </article>
          <article class="w-full sm:w-6/12 md:w-4/12 p-5">
            <div class="flex items-center gap-x-4 mb-4">
              <div class="h-12 w-12 flex items-center justify-center bg-orange-500 text-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                </svg>
              </div>
              <h3 class="font-semibold text-xl md:text-2xl text-gray-900">Network Area</h3>
            </div>
            <div>
              <p class="text-base text-gray-800">Jaringan ManggaDua Transport yang luas di beberapa Kota sehingga dapat memenuhi kebutuhan pelanggan.</p>
            </div>
          </article>
        </div>
      </div>
    </main>
    
        <!-- 123 -->

        <!-- Add review modal -->
        <!-- <div id="review-modal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-[120] hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 antialiased">
          <div class="relative max-h-full w-full max-w-2xl p-4">

            <div class="relative rounded-lg bg-white shadow">

              <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
                <div>
                  <h3 class="mb-1 text-lg font-semibold text-gray-900">Add a review for:</h3>
                  <a href="#" class="font-medium text-primary-700 hover:underline dark:text-primary-500">Rental Mobil & Sewa Supir Di ManggaDua Transport</a>
                </div>
                <button type="button" class="absolute right-5 top-5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-red-500 hover:bg-red-600 hover:text-white" data-modal-toggle="review-modal">
                  <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>

              <form class="p-4 md:p-5">
                <div class="mb-4 grid grid-cols-2 gap-4">
                  <div class="col-span-2">
                    <div class="flex items-center">
                      <svg class="h-6 w-6 text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                          d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                      </svg>
                      <svg class="ms-2 h-6 w-6 text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                          d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                      </svg>
                      <svg class="ms-2 h-6 w-6 text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                          d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                      </svg>
                      <svg class="ms-2 h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                          d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                      </svg>
                      <svg class="ms-2 h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                          d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                      </svg>
                      <span class="ms-2 text-lg font-bold text-gray-900">3.0 out of 5</span>
                    </div>
                  </div>


                  <div class="col-span-2">
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" name="name" id="name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600" required="" />
                  </div>

                  <div class="col-span-2">
                    <label for="title" class="mb-2 block text-sm font-medium text-gray-900">Judul review</label>
                    <input type="text" name="title" id="title" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600" required="" />
                  </div>


                  <div class="col-span-2">
                    <label for="description" class="mb-2 block text-sm font-medium text-gray-900"> Deskripsi review</label>
                    <textarea id="description" rows="6" class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" required=""></textarea>
                    <p class="ms-auto text-xs text-gray-500 dark:text-gray-400">Problems with the product or delivery? <a href="#" class="text-primary-600 hover:underline dark:text-primary-500">Send a report</a>.</p>
                  </div>
                  <div class="col-span-2">
                    <p class="mb-2 block text-sm font-medium text-gray-900">Add real photos of the product to help other customers <span class="text-gray-500 dark:text-gray-400">(Optional)</span></p>
                    <div class="flex w-full items-center justify-center">
                      <label for="dropzone-file" class="dark:hover:bg-bray-800 flex h-52 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pb-6 pt-5">
                          <svg class="mb-4 h-8 w-8 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                          </svg>
                          <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                          <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" />
                      </label>
                    </div>
                  </div>
                  <div class="col-span-2">
                    <div class="flex items-center">
                      <input id="review-checkbox" type="checkbox" value="" class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500" />
                      <label for="review-checkbox" class="ms-2 text-sm font-medium text-gray-500">By publishing this review you agree with the <a href="#" class="text-primary-600 hover:underline">terms and conditions</a>.</label>
                    </div>
                  </div>
                </div>
                <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
                  <button type="submit" class="me-2 inline-flex items-center rounded-lg bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                    Add review
                  </button>
                  <button
                    type="button"
                    data-modal-toggle="review-modal"
                    class="me-2 rounded-lg border border-gray-200 bg-red-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">
                    Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div> -->

        
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
      });
    </script>
  </body>
</html>
