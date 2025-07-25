-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 05:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `temp_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `password`, `role`) VALUES
(1, 'ahmadeus', 'tuwaga', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `judul_gambar` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `waktu_rilis` timestamp NULL DEFAULT current_timestamp(),
  `subjudul1` varchar(255) DEFAULT NULL,
  `gambar1` varchar(255) DEFAULT NULL,
  `teks1` text DEFAULT NULL,
  `subjudul2` varchar(255) DEFAULT NULL,
  `gambar2` varchar(255) DEFAULT NULL,
  `teks2` text DEFAULT NULL,
  `subjudul3` varchar(255) DEFAULT NULL,
  `gambar3` varchar(255) DEFAULT NULL,
  `teks3` text DEFAULT NULL,
  `subjudul4` varchar(255) DEFAULT NULL,
  `gambar4` varchar(255) DEFAULT NULL,
  `teks4` text DEFAULT NULL,
  `subjudul5` varchar(255) DEFAULT NULL,
  `gambar5` varchar(255) DEFAULT NULL,
  `teks5` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `judul_gambar`, `about`, `waktu_rilis`, `subjudul1`, `gambar1`, `teks1`, `subjudul2`, `gambar2`, `teks2`, `subjudul3`, `gambar3`, `teks3`, `subjudul4`, `gambar4`, `teks4`, `subjudul5`, `gambar5`, `teks5`) VALUES
(18, '5 Tempat Wisata di Jogja: Populer dan Berdekatan (2024)', 'prambanan.jpg', 'Yogyakarta, atau lebih akrab disebut Jogja, telah lama menjadi magnet bagi para wisatawan, baik dari dalam maupun luar negeri. Salah satu daya tarik utama Jogja adalah keberagaman seni dan budaya yang dapat ditemui di setiap sudutnya.\r\nJika Anda berencana mengunjungi Jogja, jangan sampai melewatkan tempat wisata yang populer, seperti rekomendasi 10 tempat wisata di Jogja yang masih berdekatan dan tentunya populer untuk dikunjungi ini.\r\n10 Tempat Wisata di Jogja Banyaknya tempat wisata di Jogja terkadang membuat kita bingung. Tapi tak perlu khawatir karena kami punya 10 tempat wisata populer yang lokasinya masih berdekatan satu sama lain.', '2024-07-10 05:01:00', '1. Candi Prambanan', 'prambanan.jpg', 'Terletak di sebelah timur Yogyakarta, candi ini menarik minat wisatawan dari seluruh dunia dengan keindahan dan kompleksitasnya.\r\nCandi Prambanan, yang juga dikenal sebagai Candi Rara Jonggrang, didirikan pada abad ke-9 oleh Wangsa Mataram dan menghadirkan puncak kemegahan arsitektur Hindu di tanah Jawa.', '2. Jalan Malioboro', 'malioboro.png', 'Tempat wisata di Jogja selanjutnya adalah Jalan Malioboro. Jalan ini terkenal dengan keramahan warga setempat, warung khas, dan pusat perbelanjaan.\r\n\r\nMalioboro menawarkan pengalaman berbelanja yang unik dengan beragam barang kerajinan tangan dan oleh-oleh. Di malam hari, lampu-lampu warna-warni mempercantik suasana, sementara pedagang kaki lima menawarkan kuliner lezat.', '3. HeHa Sky View', 'heha sky.png', 'Berlokasi di Gunung Kidul, HEHA Sky View menawarkan pengalaman melihat kota dari ketinggian. Dengan menaiki menara observasi, pengunjung dapat menikmati pemandangan spektakuler Yogyakarta, termasuk Candi Prambanan.\r\n\r\nTempat wisata di Jogja ini juga dilengkapi wahana menarik dan area rekreasi, menjadikannya destinasi wisata menarik untuk keluarga dan wisatawan.', '4. HeHa Ocean View', 'heha ocena.png', 'HeHa Ocean View menawarkan panorama laut yang indah. Sama seperti HeHa Sky View, tempat wisata di Jogja ini juga berlokasi di Gunung Kidul.\r\n\r\nSaat memasuki area tempat wisata ini, Anda akan melihat panorama laut yang indah. Anda bisa melihatnya dari ketinggian tempat wisata ini. Tempat wisata yang tergolong baru ini juga memiliki spot foto Instagramable.', '5. taman sari', 'taman sari.png', 'Taman Sari adalah situs sejarah yang menarik dan bersejarah. Dahulu merupakan kompleks keindahan keraton, Taman Sari menawarkan kolam-kolam, paviliun, dan terowongan bawah tanah.\n\nDibangun pada abad ke-18, tempat ini mencerminkan kemegahan budaya Jawa. Saat ini, Taman Sari menjadi tujuan wisata populer yang menawarkan wisata sejarah dan keindahan arsitektur di tengah Kota Yogyakarta.'),
(31, '10 Tempat Wisata di Jogja: Populer dan Berdekatan (2099)', '668e20fee593d_malioboro.png', 'Yogyakarta, atau lebih akrab disebut Jogja, telah lama menjadi magnet bagi para wisatawan, baik dari dalam maupun luar negeri. Salah satu daya tarik utama Jogja adalah keberagaman seni dan budaya yang dapat ditemui di setiap sudutnya.\r\n\r\nJika Anda berencana mengunjungi Jogja, jangan sampai melewatkan tempat wisata yang populer, seperti rekomendasi 10 tempat wisata di Jogja yang masih berdekatan dan tentunya populer untuk dikunjungi ini.\r\n', '2024-07-10 05:47:00', '1. Candi Prambanan', '668e20fee5b7e_prambanan.jpg', 'Terletak di sebelah timur Yogyakarta, candi ini menarik minat wisatawan dari seluruh dunia dengan keindahan dan kompleksitasnya.\r\n<br>\r\n<br>\r\nCandi Prambanan, yang juga dikenal sebagai Candi Rara Jonggrang, didirikan pada abad ke-9 oleh Wangsa Mataram dan menghadirkan puncak kemegahan arsitektur Hindu di tanah Jawa.', '2. Jalan Malioboro', '668e20fee5d4b_malioboro.png', 'Tempat wisata di Jogja selanjutnya adalah Jalan Malioboro. Jalan ini terkenal dengan keramahan warga setempat, warung khas, dan pusat perbelanjaan.\r\n\r\nMalioboro menawarkan pengalaman berbelanja yang unik dengan beragam barang kerajinan tangan dan oleh-oleh. Di malam hari, lampu-lampu warna-warni mempercantik suasana, sementara pedagang kaki lima menawarkan kuliner lezat.', '3. Tebing Breksi', '668e20fee5f09_tebing breksi.png', 'Tempat wisata di Jogja selanjutnya bernuansa alam bebas. Tebing Breksi adalah situs alam yang menakjubkan dengan formasi batu kapur yang unik.\r\n\r\nTerletak dekat dengan Candi Prambanan, tebing ini menawarkan pemandangan spektakuler dan area rekreasi. Anda dapat menikmati keindahan alam, naik tebing, atau sekadar bersantai sambil menikmati suasana.', '4. Bukit Bintang', '668e20fee6183_bukit bintang.png', 'Menikmati indahnya malam bisa dilakukan di Bukit Bintang. Masih berlokasi di Gunung Kidul, tempat ini bisa Anda jadikan tempat nongkrong yang asik.\r\n\r\nView yang akan Anda dapatkan adalah city view. Gemerlapnya lampu kota di malam hari membuat suasana obrolan semakin mengalir. Anda juga bisa menikmati sajian-sajian yang ditawarkan.', '5. Kaliurang', '668e20fee63ea_kaliurang.png', 'Kaliurang di Jogja adalah destinasi wisata yang terletak di lereng Gunung Merapi. Tempat wisata di jogja ini menawarkan udara sejuk dan pemandangan alam yang indah.\r\n\r\nBeberapa atraksi di Kaliurang termasuk Taman Nasional Gunung Merapi, Museum Ullen Sentalu yang menampilkan seni dan budaya Jawa, serta wisata alam lainnya.'),
(33, '5 Oleh-oleh khas  Yogyakarta, Ada Surjan hingga Yangko!', '668e27df7e6f6_Bakpia_Pathok_phinemo.com.width-800.format-webp.png', 'Oleh-oleh khas  Yogyakarta ada banyak lho, Moms mulai dari bakpia yang paling populer, hingga cokelat khas Yogyakarta.\r\n\r\nTidak hanya oleh-olehnya, kota ini juga terkenal dengan makanan daerahnya yang juga populer, yaitu gudeg.\r\n\r\nJika bosan dengan oleh-oleh makanan, Moms juga bisa membeli batik khas Yogyakarta yang ramai dipasarkan khususnya di Jalan Malioboro.\r\n\r\nYuk, intip oleh-oleh khas Yogyakarta untuk dibawa pulang dan diberikan kepada orang terdekat!\r\n\r\n<br>\r\n<br>\r\nDeretan Oleh-Oleh khas Yogyakarta\r\nIni dia Moms rekomendasi oleh-oleh khas Yogyakarta yang bisa Moms jadikan pilihan.', '2024-07-10 06:16:00', '1. Bakpia Pathok', '668e2996b87e2.png', 'Oleh-oleh khas  Yogyakarta yang paling populer adalah bakpia pathok. Bakpia ini diketahui berasal dari Bantul dan memiliki rasa yang enak.\r\n\r\nUkurannya kecil dan tersedia dalam berbagai rasa, seperti kacang hijau, kumbu hitam, cokelat, keju, hingga rasa buah-buahan.\r\n\r\nSaking enaknya, untuk bisa mendapatkan bakpia ini, harus mengantre terlebih dahulu, lho Moms.\r\n\r\n<br>\r\n<br>\r\n\r\nToko Bakpia Pathok 25 adalah tempat yang sering dikunjungi wisatawan untuk membeli bakpia ini, Moms.\r\n\r\nLokasi: Jl. Karel Sasuit Tubun No.504, Sanggrahan, Ngampilan,  Kota Yogyakarta Yogyakarta, Daerah Istimewa Yogyakarta 55132 <br>\r\nKisaran harga: Rp10.000 - Rp35.000 tergantung jumlah perkotak.\r\n\r\n', '2. Gudeg', '668e295144d31.png', 'Gudeg memiliki rasa pedas, manis, dan gurih. Isiannya cukup banyak mulai dari telur, ayam, tahu, atau krecek.\r\n\r\nMakanan ini bisa Moms jumpai di mana saja di Yogyakarta. Namun, yang paling terkenal adalah Gudeg Yu Djum yang tersebar di banyak tempat.\r\n<br>\r\nLokasi:  Jl. Malioboro Jl. Dagen No.2C, Sosromenduran, Gedong Tengen,  Kota Yogyakarta Yogyakarta, Daerah Istimewa Yogyakarta 55271', '3. Tasuba', '668e30153f856.png', 'Selain itu, tasuba atau tahu susu bakso juga menjadi oleh-oleh khas Yogyakarta.\r\n\r\nTahu yang dijadikan bakso ini berasal dari tahu susu yang bertekstur lembut dan padat, lho Moms.\r\n\r\nTasuba memiliki rasa asin dan gurih. Adonan baksonya juga terlihat padat, ya Moms.', '4.  Geplak', '668e30153fa82.png', 'Geplak adalah oleh-oleh khas Yogyakarta selain gudeg. Geplak adalah jajanan tradisional yang terbuat dari parutan kelapa.\r\n\r\nAgar lebih enak, geplak dimakan bersamaan dengan gula pasir atau gula jawa sebagai penambah rasa.\r\n\r\nGeplak hadir dalam berbagai warna agar terlihat lebih menarik, seperti merah muda, kuning, dan hijau.\r\n\r\nMoms bisa membelinya di Geplak Mbok Tumpuk daerah Bantul.', '5. Yangko', '668e30153fc0c.png', 'Yangko juga merupakan makanan  Yogyakarta yang kerap dijadikan oleh-oleh.\r\n\r\nBahan utamanya adalah tepung ketan yang dicampur dengan gula dan kacang cincang sehingga memiliki rasa kenyal.\r\n\r\nYangko disebut sebagai mochi Jawa karena pembuatan dan teksturnya mirip.\r\n\r\nNamun, yangko kini hadir dengan berbagai macam rasa, lho Moms. Moms bisa mendapatkan yangko di toko oleh-oleh Yogyakarta.');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` varchar(255) NOT NULL,
  `harga_mobil` decimal(10,2) NOT NULL,
  `deskripsi_p1` text NOT NULL,
  `deskripsi_p2` text NOT NULL,
  `deskripsi_p3` text NOT NULL,
  `deskripsi_p4` text DEFAULT NULL,
  `gambar1` varchar(255) NOT NULL,
  `gambar2` varchar(255) NOT NULL,
  `gambar3` varchar(255) NOT NULL,
  `gambar4` varchar(255) NOT NULL,
  `supir` decimal(10,2) DEFAULT 0.00,
  `tanggal_sewa` date DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `nama_mobil`, `harga_mobil`, `deskripsi_p1`, `deskripsi_p2`, `deskripsi_p3`, `deskripsi_p4`, `gambar1`, `gambar2`, `gambar3`, `gambar4`, `supir`, `tanggal_sewa`, `durasi`) VALUES
(1, 'Mobil ferrari', 500000.00, 'Deskripsi paragraf 1 wkwkw', 'Deskripsi paragraf 2', 'Deskripsi paragraf 3', NULL, 'ferari.jpg', 'detail_product (2).jpg', 'detail_product (3).jpg', 'detail_product (4).jpg', 200.00, NULL, NULL),
(2, 'Avanjay', 500000.00, 'Jenis Mobil : Mini Cooper S 2023', 'Jumlah Pintu : 2 Pintu', 'persneling : Manual', NULL, 'detail_product (2).jpg', 'detail_product (1).jpg', 'detail_product (3).jpg', 'detail_product (4).jpg', 0.00, NULL, NULL),
(3, 'Mobil A', 500000.00, 'Deskripsi paragraf 1', 'Deskripsi paragraf 2', 'Deskripsi paragraf 3', NULL, 'detail_product (3).jpg', 'detail_product (2).jpg', 'detail_product (1).jpg', 'detail_product (4).jpg', NULL, NULL, NULL),
(4, 'Mobil Kodok', 700000.00, 'Jenis Mobil : Mini Cooper S 2023', 'Jumlah Pintu : 2 Pintu', 'persneling : Manual', ' Mini Cooper S 2023 adalah mobil sport kompak yang menawarkan kombinasi sempurna antara gaya dan performa. Dengan mesin yang bertenaga, desain yang ikonik, dan kabin yang stylish, mobil ini cocok untuk pengemudi yang\n                  menginginkan pengalaman mengemudi yang dinamis dan menyenangkan.Nikmati kebebasan berkendara dengan Mini Cooper kami yang selalu terjaga kualitasnya, siap menemani perjalanan Anda dengan gaya dan kenyamanan.', 'detail_product (4).jpg', 'detail_product (2).jpg', 'detail_product (3).jpg', 'detail_product (1).jpg', NULL, NULL, NULL),
(5, 'Mobil C', 500000.00, 'Deskripsi paragraf 1', 'Deskripsi paragraf 2', 'Deskripsi paragraf 3', NULL, 'fast-car.jpg', 'detail_product (2).jpg', 'detail_product (3).jpg', 'detail_product (4).jpg', NULL, NULL, NULL),
(6, 'Mobil D', 500000.00, 'Deskripsi paragraf 1', 'Deskripsi paragraf 2', 'Deskripsi paragraf 3', NULL, 'galery-rental (3).jpg', 'detail_product (2).jpg', 'detail_product (3).jpg', 'detail_product (4).jpg', NULL, NULL, NULL),
(7, 'Mobil E', 500000.00, 'Deskripsi paragraf 1', 'Deskripsi paragraf 2', 'Deskripsi paragraf 3', NULL, 'galery-rental (5).jpg', 'detail_product (2).jpg', 'detail_product (3).jpg', 'detail_product (4).jpg', NULL, NULL, NULL),
(8, 'Mobil F', 500000.00, 'Deskripsi paragraf 1', 'Deskripsi paragraf 2', 'Deskripsi paragraf 3', NULL, 'galery-rental (1).jpg', 'detail_product (2).jpg', 'detail_product (3).jpg', 'detail_product (4).jpg', NULL, NULL, NULL),
(16, 'Daihatsu Grand New Xenia', 250000.00, 'Kenapa harus Sewa Grand New Xenia di Bali?', 'Ingin liburan bareng keluarga ke Bali? Sewa Mobil Grand New Xenia aja. Mobil ini memiliki kapasitas 7 penumpang dengan bagasi yang cukup luas. Pihak Daihatsu mengklaim, bagasi Grand New Xenia dapat menampung hingga 4 galon air. MPV bertenaga 1.500CC ini juga dilengkapi dengan konfigurasi kenyamanan yang lebih baik melebihi mobil keluarga lainnya. Buktinya, interior Grand New Xenia dilengkapi dengan segenap fasilitas yang modern yaitu head unit pioneer, pemindai AC digital, 6 audio speaker dan 16 cup holder. Lengkap banget kan!', 'Bukan hanya itu, Grand New Xenia juga dibekali dengan fitur keselamatan yang lengkap seperti Rem ABS, EBD dan sistem Front Corner yang akan mempermudah anda ketika parkir. Yuk langsung aja Sewa Mobil Grand New Xenia yang serba bisa ini di Bali Citra Medina sekarang!', '', 'paket-4.png', 'paket-8.png', 'galery-rental (3).jpg', 'paket-4.png', 0.00, NULL, NULL),
(24, 'dfthfyghfgj', 90000.00, 'jhkbghjkghjkb', '', '', '', '2744995718.jpg', '', '', '', 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_penyewaan` date NOT NULL,
  `durasi_penyewaan` int(11) NOT NULL,
  `dengan_supir` tinyint(1) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `pickup_location` varchar(100) DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `status_pembayaran` enum('menunggu','lunas','batal') NOT NULL DEFAULT 'menunggu',
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `waktu_booking` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
