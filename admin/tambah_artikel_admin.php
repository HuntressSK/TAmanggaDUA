<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel Baru | ManggaDua Transport</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100">
       <!-- awal header -->
    <header>
      <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
          <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
              <button
                data-drawer-target="logo-sidebar"
                data-drawer-toggle="logo-sidebar"
                aria-controls="logo-sidebar"
                type="button"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
              </button>
            <div>
              <a href="../admin/dashboard_product.php">
                <img src="../assets/images/logos/logoipsum-260.svg" class="object-cover w-[140px] h-auto" height="60" width="80" alt="260" />
              </a>
            </div>
            </div>
            <div class="flex items-center">
              <div class="flex items-center ms-3">
                <div>
                  <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-12 h-12 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo" />
                  </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
                  <div class="px-4 py-3" role="none">
                    <p class="text-sm text-gray-900" role="none">Admin</p>
                    <p class="text-sm font-medium text-gray-900 truncate">admin@gmail.com</p>
                  </div>
                  <ul class="py-1" role="none">
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Dashboard</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profil</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <!-- akhir header -->
    <main class="flex justify-center pt-24 md:ml-20 bg-white shadow-md rounded-lg ">
        <div id="content" class="w-2/3 ">
            <h2 class="text-2xl font-bold mb-4">Form Tambah Artikel</h2>
            <form action="tambah_artikel.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-bold mb-2">Judul Artikel:</label>
                    <input type="text" id="judul" name="judul" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                    <div class="mb-4">
                        <label for="judul_gambar" class="block text-gray-700 font-bold mb-2">Gambar Utama:</label>
                        <input type="file" id="judul_gambar" name="judul_gambar" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                    </div>


                <div class="mb-4">
                    <label for="about" class="block text-gray-700 font-bold mb-2">About:</label>
                    <textarea id="about" name="about" rows="4" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
                </div>

                <div class="mb-4">
                    <label for="waktu_rilis" class="block text-gray-700 font-bold mb-2">Waktu Rilis:</label>
                    <div class="fb-input">
                        <input type="datetime-local" id="waktu_rilis" name="waktu_rilis" required class="px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <!-- Bagian 1 -->
                <h2 class="text-2xl font-bold mb-4 mt-10">Bagian Artikel 1</h2>
                <div class="mb-4">
                    <label for="subjudul1" class="block text-gray-700 font-bold mb-2">Subjudul 1:</label>
                    <input type="text" id="subjudul1" name="subjudul1" placeholder="" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="gambar1" class="block text-gray-700 font-bold mb-2">Gambar 1:</label>
                    <input type="file" id="gambar1" name="gambar1" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="teks1" class="block text-gray-700 font-bold mb-2">Teks 1:</label>
                    <textarea id="teks1" name="teks1" rows="4" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
                </div>

                <!-- Bagian 2 -->
                <h2 class="text-2xl font-bold mb-4">Bagian Artikel 2</h2>
                <div class="mb-4">
                    <label for="subjudul2" class="block text-gray-700 font-bold mb-2">Subjudul 2:</label>
                    <input type="text" id="subjudul2" name="subjudul2" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="gambar2" class="block text-gray-700 font-bold mb-2">Gambar 2:</label>
                    <input type="file" id="gambar2" name="gambar2" accept="image/*" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="teks2" class="block text-gray-700 font-bold mb-2">Teks 2:</label>
                    <textarea id="teks2" name="teks2" rows="4" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
                </div>

                <!-- Bagian 3 -->
                <h2 class="text-2xl font-bold mb-4">Bagian Artikel 3</h2>
                <div class="mb-4">
                    <label for="subjudul3" class="block text-gray-700 font-bold mb-2">Subjudul 3:</label>
                    <input type="text" id="subjudul3" name="subjudul3" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="gambar3" class="block text-gray-700 font-bold mb-2">Gambar 3:</label>
                    <input type="file" id="gambar3" name="gambar3" accept="image/*" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="teks3" class="block text-gray-700 font-bold mb-2">Teks 3:</label>
                    <textarea id="teks3" name="teks3" rows="4" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
                </div>

                <!-- Bagian 4 -->
                <h2 class="text-2xl font-bold mb-4">Bagian Artikel 4</h2>
                <div class="mb-4">
                    <label for="subjudul4" class="block text-gray-700 font-bold mb-2">Subjudul 4:</label>
                    <input type="text" id="subjudul4" name="subjudul4" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="gambar4" class="block text-gray-700 font-bold mb-2">Gambar 4:</label>
                    <input type="file" id="gambar4" name="gambar4" accept="image/*" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="teks4" class="block text-gray-700 font-bold mb-2">Teks 4:</label>
                    <textarea id="teks4" name="teks4" rows="4" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
                </div>

                <!-- Bagian 5 -->
                <h2 class="text-2xl font-bold mb-4">Bagian Artikel 5</h2>
                <div class="mb-4">
                    <label for="subjudul5" class="block text-gray-700 font-bold mb-2">Subjudul 5:</label>
                    <input type="text" id="subjudul5" name="subjudul5" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="gambar5" class="block text-gray-700 font-bold mb-2">Gambar 5:</label>
                    <input type="file" id="gambar5" name="gambar5" accept="image/*" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="teks5" class="block text-gray-700 font-bold mb-2">Teks 5:</label>
                    <textarea id="teks5" name="teks5" rows="4" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
                </div>

            <div class="my-6 flex">
                <input type="submit" value="Tambah Artikel" class="px-4 py-2 bg-blue-500 text-white rounded-md cursor-pointer hover:bg-blue-600 mr-4">
                <button type="button" class="px-4 py-2 bg-red-500 text-white rounded-md cursor-pointer hover:bg-red-600" onclick="window.location.href = './artikel_admin.php'">Cancel</button>
            </div>

            </form>
        </div>
              <!-- awal sidebar (aside) -->
      <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 mt-10 h-screen pt-20 transition-transform -translate-x-full bg-blue-600 border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-600">
          <ul class="space-y-2 font-medium">
            <!-- dashbord -->
            <li>
              <a href="../admin/dashboard_home.php" class="flex items-center p-2 text-blue bg-white rounded-lg ">
                <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path
                    d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                </svg>
                <span class="ms-3">Dashboard</span>
              </a>
            </li>

            <!-- product -->
            <li>
              <a href="../admin/dashboard_product.php" class="flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-black">
                <svg class="flex-shrink-0 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                  <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
              </a>
            </li>

            <!-- users -->
            <li>
              <a href="./artikel_admin.php" class="flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-black">
                <i class="fa-solid fa-newspaper text-xl"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Articles</span>
              </a>
            </li>

            <!-- notifikasi -->
            <li>
              <a href="../admin/pesan_admin.php" class="flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-black">
                <i class="fa-solid fa-bell text-xl font-semibold"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-600 bg-white rounded-full">3</span>
              </a>
            </li>
          </ul>

          <ul class="space-y-2 mt-4 border-t border-gray-200 pt-4">
            <!-- log out -->
            <li class="">
              <a href="logout_admin.php" class="flex items-center p-2 text-white rounded-lg hover:bg-white hover:text-red-600">
                <i class="fa-solid fa-power-off text-2xl"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Log out</span>
              </a>
            </li>
          </ul>
        </div>
      </aside>
    </main>
    <!-- Include Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
</html>
