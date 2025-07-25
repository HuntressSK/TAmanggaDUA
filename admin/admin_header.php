<?php
// Kita mulai session di sini agar semua halaman yang menggunakan header ini otomatis punya session
session_start();

// Penjaga keamanan untuk semua halaman admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_admin.php");
    exit;
}

// Ambil nama username admin dari session untuk ditampilkan
$admin_username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Dashboard Admin'; ?> | ManggaDua Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body class="bg-gray-100">

<div class="flex h-screen bg-gray-100">
    <aside class="w-64 bg-blue-600 text-white flex flex-col">
        <div class="h-20 flex items-center justify-center border-b border-blue-700">
            <a href="dashboard_home.php" class="text-2xl font-bold">ManggaDua Admin</a>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="dashboard_home.php" class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 hover:bg-blue-700 <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard_home.php') echo 'bg-blue-800'; ?>">
                <i class="fas fa-tachometer-alt w-6"></i>
                <span class="ml-4">Dashboard</span>
            </a>
            <a href="dashboard_product.php" class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 hover:bg-blue-700 <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard_product.php') echo 'bg-blue-800'; ?>">
                <i class="fas fa-box w-6"></i>
                <span class="ml-4">Products</span>
            </a>
            <a href="artikel_admin.php" class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 hover:bg-blue-700 <?php if(basename($_SERVER['PHP_SELF']) == 'artikel_admin.php') echo 'bg-blue-800'; ?>">
                <i class="fas fa-newspaper w-6"></i>
                <span class="ml-4">Articles</span>
            </a>
            <a href="transaksi_admin.php" class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 hover:bg-blue-700 <?php if(basename($_SERVER['PHP_SELF']) == 'transaksi_admin.php') echo 'bg-blue-800'; ?>">
                <i class="fas fa-inbox w-6"></i>
                <span class="ml-4">Transaksi</span>
            </a>
        </nav>
        <div class="px-4 py-6 border-t border-blue-700">
            <a href="logout_admin.php" class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 hover:bg-blue-700">
                <i class="fas fa-sign-out-alt w-6"></i>
                <span class="ml-4">Log out</span>
            </a>
        </div>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="h-20 bg-white shadow-md flex items-center justify-between px-8">
            <div>
                </div>
            <div class="flex items-center">
                <span class="mr-4">Selamat datang, <?php echo htmlspecialchars($admin_username); ?></span>
                <img class="h-10 w-10 rounded-full object-cover" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Admin Profile">
            </div>
        </header>

        <main class="flex-1 p-8 overflow-y-auto">