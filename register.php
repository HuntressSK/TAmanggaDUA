<?php
// LOGIKA PHP UNTUK PROSES REGISTRASI
session_start(); // Mulai session di paling atas
include 'db_connection.php'; // Sambungkan ke database

$pesan_error = "";
$pesan_sukses = "";

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $konfirmasi_password = mysqli_real_escape_string($conn, $_POST['konfirmasi_password']);

    // Validasi sederhana
    if ($password !== $konfirmasi_password) {
        $pesan_error = "Password dan Konfirmasi Password tidak cocok!";
    } else {
        // Cek apakah email sudah terdaftar
        $sql_cek_email = "SELECT id_user FROM users WHERE email = ?";
        $stmt_cek = $conn->prepare($sql_cek_email);
        $stmt_cek->bind_param("s", $email);
        $stmt_cek->execute();
        $result_cek = $stmt_cek->get_result();

        if ($result_cek->num_rows > 0) {
            $pesan_error = "Email sudah terdaftar. Silakan gunakan email lain atau login.";
        } else {
            // Jika semua aman, hash password sebelum disimpan
            // Ini sangat penting untuk keamanan!
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            // Buat query INSERT menggunakan prepared statement untuk keamanan
            $sql_insert = "INSERT INTO users (nama_lengkap, email, no_hp, password) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ssss", $nama_lengkap, $email, $no_hp, $password_hashed);

            if ($stmt_insert->execute()) {
                $pesan_sukses = "Pendaftaran berhasil! Silakan login.";
            } else {
                $pesan_error = "Terjadi kesalahan. Silakan coba lagi. Error: " . $stmt_insert->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Akun Baru | ManggaDua Transport</title>
    <link rel="stylesheet" href="./assets/css/tailwind.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-slate-50">
    <nav class="h-[80px] w-full bg-white border-b">
        <div class="container h-full flex items-center justify-between">
            <div>
                <a href="./index.php">
                    <img src="./assets/images/logos/logoipsum-260.svg" class="object-cover w-[140px] h-auto" alt="Logo" />
                </a>
            </div>
            <div class="hidden font-medium text-base text-gray-800 md:flex items-center gap-x-6">
                <a href="./index.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Home</a>
                <a href="./daftar-paket.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Daftar Paket</a>
                <a href="./artikel.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">Wisata</a>
                <a href="./faq.php" class="pb-1.5 border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500">FAQ</a>
            </div>
        </div>
    </nav>

    <main class="flex justify-center items-center min-h-screen pt-[80px]">
        <div class="w-full max-w-md mx-auto p-6">
            <div class="bg-white p-8 rounded-lg shadow-md border border-slate-200">
                <h1 class="font-bold text-2xl md:text-3xl text-center text-gray-800 mb-6">Buat Akun Baru</h1>

                <?php if(!empty($pesan_error)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline"><?php echo $pesan_error; ?></span>
                    </div>
                <?php endif; ?>
                <?php if(!empty($pesan_sukses)): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline"><?php echo $pesan_sukses; ?></span>
                    </div>
                <?php endif; ?>

                <form action="register.php" method="POST">
                    <div class="mb-4">
                        <label class="block font-semibold text-base text-gray-800 mb-2" for="nama_lengkap">Nama Lengkap *</label>
                        <input name="nama_lengkap" id="nama_lengkap" type="text" class="bg-slate-100 py-3 px-4 border border-slate-200 w-full rounded-md" placeholder="Nama Lengkap Anda" required />
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold text-base text-gray-800 mb-2" for="email">Email *</label>
                        <input name="email" id="email" type="email" class="bg-slate-100 py-3 px-4 border border-slate-200 w-full rounded-md" placeholder="Alamat Email Anda" required />
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold text-base text-gray-800 mb-2" for="no_hp">Nomor HP *</label>
                        <input name="no_hp" id="no_hp" type="tel" class="bg-slate-100 py-3 px-4 border border-slate-200 w-full rounded-md" placeholder="08123456789" required />
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold text-base text-gray-800 mb-2" for="password">Password *</label>
                        <input name="password" id="password" type="password" class="bg-slate-100 py-3 px-4 border border-slate-200 w-full rounded-md" placeholder="Minimal 6 karakter" required />
                    </div>
                    <div class="mb-6">
                        <label class="block font-semibold text-base text-gray-800 mb-2" for="konfirmasi_password">Konfirmasi Password *</label>
                        <input name="konfirmasi_password" id="konfirmasi_password" type="password" class="bg-slate-100 py-3 px-4 border border-slate-200 w-full rounded-md" placeholder="Ulangi password" required />
                    </div>
                    <div>
                        <button type="submit" class="w-full inline-block py-3 md:py-4 px-8 rounded-md font-medium text-base md:text-xl text-white bg-blue-500 hover:bg-blue-600 transition duration-300 ease-in-out shadow-lg">
                            Daftar
                        </button>
                    </div>
                </form>

                <p class="text-center text-sm text-gray-600 mt-6">
                    Sudah punya akun? 
                    <a href="login.php" class="font-semibold text-orange-500 hover:underline">
                        Login di sini
                    </a>
                </p>

            </div>
        </div>
    </main>

</body>
</html>