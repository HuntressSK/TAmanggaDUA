<?php
// LOGIKA PHP UNTUK PROSES LOGIN
session_start(); // Wajib ada untuk memulai session

// Jika user sudah login, arahkan ke halaman utama
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include 'db_connection.php'; // Sambungkan ke database

$pesan_error = "";

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Cari user berdasarkan email
    $sql = "SELECT id_user, nama_lengkap, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Jika email ditemukan, ambil datanya
        $user = $result->fetch_assoc();

        // Verifikasi password yang diinput dengan hash di database
        // Ini adalah cara aman untuk memeriksa password
        if (password_verify($password, $user['password'])) {
            // Jika password cocok, login berhasil!
            // Simpan informasi user ke dalam SESSION
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['email'] = $user['email'];

            // Arahkan (redirect) ke halaman utama
            header("Location: index.php");
            exit(); // Pastikan untuk exit setelah redirect
        } else {
            // Jika password salah
            $pesan_error = "Email atau password salah.";
        }
    } else {
        // Jika email tidak ditemukan
        $pesan_error = "Email atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | ManggaDua Transport</title>
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
                <h1 class="font-bold text-2xl md:text-3xl text-center text-gray-800 mb-6">Login ke Akun Anda</h1>

                <?php if(!empty($pesan_error)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline"><?php echo $pesan_error; ?></span>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="mb-4">
                        <label class="block font-semibold text-base text-gray-800 mb-2" for="email">Email *</label>
                        <input name="email" id="email" type="email" class="bg-slate-100 py-3 px-4 border border-slate-200 w-full rounded-md" placeholder="Alamat Email Anda" required />
                    </div>
                    <div class="mb-6">
                        <label class="block font-semibold text-base text-gray-800 mb-2" for="password">Password *</label>
                        <input name="password" id="password" type="password" class="bg-slate-100 py-3 px-4 border border-slate-200 w-full rounded-md" placeholder="Masukkan password Anda" required />
                    </div>
                    <div>
                        <button type="submit" class="w-full inline-block py-3 md:py-4 px-8 rounded-md font-medium text-base md:text-xl text-white bg-blue-500 hover:bg-blue-600 transition duration-300 ease-in-out shadow-lg">
                            Login
                        </button>
                    </div>
                </form>

                 <p class="text-center text-sm text-gray-600 mt-6">
                    Belum punya akun? 
                    <a href="register.php" class="font-semibold text-orange-500 hover:underline">
                        Daftar di sini
                    </a>
                </p>

            </div>
        </div>
    </main>

</body>
</html>