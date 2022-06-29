-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 02:52 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_pmsn_tiket_wisata_bali`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `IdTransaksi` bigint(20) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdWisata` int(11) NOT NULL,
  `StatusPembelian` enum('menunggu pembayaran','menunggu verifikasi','terverifikasi','kadaluarsa','dibatalkan','ditolak') NOT NULL,
  `UrlBuktiPembayaran` text DEFAULT NULL,
  `TanggalPembelian` int(11) NOT NULL,
  `JumlahTiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `IdUser` int(11) NOT NULL,
  `Nama` varchar(200) NOT NULL,
  `UrlGambarProfile` text DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `NomorTelp` varchar(20) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `Role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`IdUser`, `Nama`, `UrlGambarProfile`, `Username`, `Password`, `NomorTelp`, `Alamat`, `Role`) VALUES
(24, 'user', '', 'username', '$2y$10$dnfkwlp0.6maqEeHe9zXg.gANYVGJv/apVrj8mkdJT5N02P.YbfWy', '08933112341', 'jln.majapahit no d4', 'admin'),
(42, 'test', '', 'test', '$2y$10$NYxElN/34E0Q9kvKZ/mInO/An5HQKjNs69eXRqr4BRnHfYwUIbYhi', '089123834134', 'jln. sutra enmah maneh no 69', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `IdWisata` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Deskripsi` longtext NOT NULL,
  `NoRekening` text NOT NULL DEFAULT 'a:3:{s:12:"100-519-5418";a:2:{s:9:"nama_bank";s:4:"BRIS";s:9:"atas_nama";s:13:"PT Duta Aries";}s:12:"27-9300-3056";a:2:{s:9:"nama_bank";s:3:"BCA";s:9:"atas_nama";s:13:"PT Duta Aries";}s:18:"0005-01-00130-7304";a:2:{s:9:"nama_bank";s:3:"BRI";s:9:"atas_nama";s:13:"PT Duta Aries";}}',
  `Harga` int(11) NOT NULL,
  `UrlGaleriWST` text NOT NULL,
  `UrlThumbnailWST` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`IdWisata`, `Nama`, `Deskripsi`, `NoRekening`, `Harga`, `UrlGaleriWST`, `UrlThumbnailWST`) VALUES
(174, 'Air Terjun Kanto Lampo', 'Air Terjun Kanto Lampo mempunyai panorama memikat dan memberikan suasana yang sejuk, asri, dan menyegarkan. Wisatawan juga dapat mendengar suara deburan air terjun yang menenangkan. Air Terjun Kanto Lampo terletak di dataran rendah sehingga membuatnya memiliki akses perjalanan yang tidak terlalu susah. Air terjun ini terlihat semakin menakjubkan dengan bentuknya yang berundak-undak yang membuatnya lain daripada yang lain.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 94000, 'a:3:{i:0;s:105:\"./assets/img/DataWisata/Air Terjun Kanto Lampo/Trekking-Menuju-Air-Terjun-Kanto-Lampo - Richis Salmon.jpg\";i:1;s:109:\"./assets/img/DataWisata/Air Terjun Kanto Lampo/air_terjun_kanto_lampo_waterfall_in_bali_2 - Richis Salmon.jpg\";i:2;s:92:\"./assets/img/DataWisata/Air Terjun Kanto Lampo/kanto-lampo20191030142716 - Richis Salmon.jpg\";}', './assets/img/DataWisata/Air Terjun Kanto Lampo/cover/air_terjun_kanto_lampo_waterfall_in_bali_1 - Richis Salmon.jpg'),
(175, 'Air Terjun Leke Leke', 'Nama Leke-Leke mungkin masih asing dan jarang didengar oleh kebanyakan wisatawan yang berlibur ke Pulau Dewata. Air terjun ini berlokasi di Desa Mekarsari, Kecamatan Baturiti, Tabanan, Bali. Tenang dan rindang, dua kata yang dapat menggambarkan situasi di sana. Anda bisa menikmati kesejukan udara yang dikeluarkan dari pepohonan dengan gemercik suara air yang menghantam batu. Leke-Leke akan jadi destinasi wisata yang tepat bagi Anda yang suka alam dan kesunyian.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 36000, 'a:3:{i:0;s:95:\"./assets/img/DataWisata/Air Terjun Leke Leke/042655900_1578301256-leke-leke - Richis Salmon.jpg\";i:1;s:94:\"./assets/img/DataWisata/Air Terjun Leke Leke/062741000_1578301256-lekeleke - Richis Salmon.jpg\";i:2;s:97:\"./assets/img/DataWisata/Air Terjun Leke Leke/ab9ce6a83ea2580bac252926cd0671f7 - Richis Salmon.jpg\";}', './assets/img/DataWisata/Air Terjun Leke Leke/cover/042655900_1578301256-leke-leke - Richis Salmon.jpg'),
(176, 'Air Terjun Nungnung', 'Air Terjun Nungnung yang terletak di Kabupaten Badung Bali kini menjadi lokasi persinggahan banyak wisatawan. Tak hanya wisatawan domestik, mereka yang datang ke tempat ini juga adalah para wisatawan mancanegara. Pemandangan eksotis yang bisa dijumpai di lokasi air terjun ini pun sanggup mengalihkan perhatian para wisatawan. Suasana alami yang masih asri memberikan sensasi ketenangan untuk para pengunjung Air Terjun Nungnung. Lokasinya yang berada di area pedesaan, membuat keasrian tempat ini masih terjaga dengan baik. Di sisi lain, fasilitas pendukung yang disediakan oleh pemerintah setempat untuk kenyamanan para wisatawan pun cukup memadai. Air Terjun Nungnung ini berlokasi di Banjar Nungnung Desa Pelaga di Kecamatan Petang, Kabupaten Badung, Bali.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 620000, 'a:3:{i:0;s:83:\"./assets/img/DataWisata/Air Terjun Nungnung/Air-Terjun-Nungnung - Richis Salmon.jpg\";i:1;s:68:\"./assets/img/DataWisata/Air Terjun Nungnung/ii-1 - Richis Salmon.jpg\";i:2;s:68:\"./assets/img/DataWisata/Air Terjun Nungnung/w644 - Richis Salmon.jpg\";}', './assets/img/DataWisata/Air Terjun Nungnung/cover/nungnung-waterfall-bali - Richis Salmon (1).jpg'),
(177, 'Air Terjun Tegenungan', 'Air terjun Tegenungan adalah air terjun yang terletak di Desa Kemenuh, Kecamatan Sukawati, Kabupaten Gianyar, berjarak 30 km dari Kota Denpasar. Air terjun ini memiliki ketinggian 15 meter. Meski tidak begitu tinggi, debit airnya sangat deras. Sebagai objek wisata yang berlokasi tak jauh dari Ubud, Air Terjun ini sudah sangat populer di telinga wisatawan asing. Tidak hanya daya tariknya yang sangat memukau, tapi juga dikenal sebagai tempat wisata yang masih kental dengan budaya, sejarah, dan kesenian. Kalo kamu pengen menikmati tempat wisata yang berbeda di Ubud, cobalah untuk berkunjung ke air terjun ini.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 360000, 'a:4:{i:0;s:96:\"./assets/img/DataWisata/Air Terjun Tegenungan/Air-Terjun-Tegenungan-Facebook - Richis Salmon.jpg\";i:1;s:74:\"./assets/img/DataWisata/Air Terjun Tegenungan/IMG_0654 - Richis Salmon.jpg\";i:2;s:103:\"./assets/img/DataWisata/Air Terjun Tegenungan/Tegenungan-Waterfall-evgeniya_buteeva - Richis Salmon.jpg\";i:3;s:86:\"./assets/img/DataWisata/Air Terjun Tegenungan/tegenungan-waterfall - Richis Salmon.jpg\";}', './assets/img/DataWisata/Air Terjun Tegenungan/cover/1200px-Tegenungan_Waterfall_Ubud_Indonesia_-_panoramio_(6) - Richis Salmon.jpg'),
(178, 'Air Terjun Yeh Ho', 'Air terjun Yeh Hoo (Ho) dikenal juga dengan nama air terjun Giri Kusuma. Lokasi dari objek wisata alam ini di Banjar Gunungsari Umakaya, desa Jatiluwih, Kecamatan Penebel, Kabupaten Tabanan. Air terjun Yeh Ho memang tidak terlalu tinggi, hanya sekitar 8 meter, namun debit airnya cukup deras, berasal dari mata air pegunungan, sehingga airnya jernih, menikmati pesona indah air terjun ini, maka anda bisa juga mandi dan berendam merasakan segarnya air pegunungan.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 920000, 'a:3:{i:0;s:72:\"./assets/img/DataWisata/Air Terjun Yeh Ho/2017-11-02 - Richis Salmon.jpg\";i:1;s:89:\"./assets/img/DataWisata/Air Terjun Yeh Ho/air-terjun-yeh-hoo-2-scaled - Richis Salmon.jpg\";i:2;s:94:\"./assets/img/DataWisata/Air Terjun Yeh Ho/mathis-jrdl-AL0tyBvxkIk-unsplash - Richis Salmon.jpg\";}', './assets/img/DataWisata/Air Terjun Yeh Ho/cover/air-terjun-yeh-ho - Richis Salmon.jpg'),
(179, 'Bukit Campuhan Ubud', 'Bukit Campuhan, salah satu tempat yang disebut-sebut paling fotogenik di Pulau Dewata. Bukit ini sangat mudah diakses, pun tak perlu berlama-lama trekking untuk tiba di puncaknya. Tak heran banyak warga lokal dan wisatawan asing yang menjadikan Bukit Campuhan lokasi jogging pada pagi maupun sore hari. Bukit Campuhan terletak di Jalan Bangkiang Sidem, Ubud, Kabupaten Gianyar, Bali. Bukit ini terletak satu kawasan dengan Pura Gunung Lebah.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 76000, 'a:3:{i:0;s:78:\"./assets/img/DataWisata/Bukit Campuhan Ubud/Bukit campuhan - Richis Salmon.jpg\";i:1;s:88:\"./assets/img/DataWisata/Bukit Campuhan Ubud/bukit-campuhan-ubud-bali - Richis Salmon.jpg\";i:2;s:88:\"./assets/img/DataWisata/Bukit Campuhan Ubud/pura-gunung-lebah-temple - Richis Salmon.jpg\";}', './assets/img/DataWisata/Bukit Campuhan Ubud/cover/21040991_118515102138679_1897479369840918528_n-847x1024 - Richis Salmon.jpg'),
(180, 'Jatiluwih rice terrace', 'Jatiluwih merupakan sebuah desa wisata yang berada di Kecamatan Penebel, Kabupaten Tabanan, Bali. Desa ini dikenal dunia karena memiliki kawasan persawahan yang sangat cantik. Sistem persawahan di Jatiluwih bahkan masuk sebagai situs Warisan Dunia UNESCO. Di Jatiluwih, kamu akan disuguhkan hamparan lahan hijau dan luas ditanami padi, spot asyik untuk bersantai menikmati alam.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 340000, 'a:3:{i:0;s:99:\"./assets/img/DataWisata/Jatiluwih rice terrace/75f5d8767c547a0d11c551f6a3f02a7c - Richis Salmon.jpg\";i:1;s:99:\"./assets/img/DataWisata/Jatiluwih rice terrace/79c9b04f9db778caa8ac6e40b4958c27 - Richis Salmon.jpg\";i:2;s:99:\"./assets/img/DataWisata/Jatiluwih rice terrace/92557176ac96dd1860dda71bb0e832f6 - Richis Salmon.jpg\";}', './assets/img/DataWisata/Jatiluwih rice terrace/cover/Tour Sepeda Listrik Jatiluwih Rice Terrace (Subak Jatiluwih) di Bali - Richis Salmon.jpg'),
(181, 'Pantai Gunung Payung', 'Pantai Gunung Payung memiliki pasir putih bertekstur lembut, air laut berwarna biru bergradasi hijau, serta tidak ada banyak pengunjung di pantai ini. Jadi pantai ini sangat cocok bagi anda yang menginginkan berlibur ke pantai sepi, alami dan menginginkan privasi.\r\nDi pantai ini juga menyediakan suttle bus dan kano bagi kalian yang ingin menikmati pantai dengan cara yang berbeda.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 82000, 'a:3:{i:0;s:98:\"./assets/img/DataWisata/Pantai Gunung Payung/7d6ab936af1c301026397675a73f623d - Desy Prashanti.jpg\";i:1;s:98:\"./assets/img/DataWisata/Pantai Gunung Payung/84db2495f50396de11e65c5ec3dc5545 - Desy Prashanti.jpg\";i:2;s:98:\"./assets/img/DataWisata/Pantai Gunung Payung/8f7e99c44633774a8c10d6334c527726 - Desy Prashanti.jpg\";}', './assets/img/DataWisata/Pantai Gunung Payung/cover/872b6ea16fed66742efb96392897797a - Desy Prashanti.jpg'),
(182, 'Pantai Padang-padang', 'Pantai padang padang Bali berada di Desa Pecatu, Kecamatan Kuta Selatan, Kabupaten Badung. Pantai ini adalah salah satu objek wisata Bali yang pernah menjadi lokasi syuting seperti film Hollywood Eat Pray Love dan video klip grup musik Michael Learn To Rock. Hal unik yang dimiliki pantai padang yang merupakan salah satu dari ratusan pantai di Bali ialah panorama yang dikelilingi bukit dan tebing yang rindang.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 46000, 'a:3:{i:0;s:130:\"./assets/img/DataWisata/Pantai Padang-padang/julia-robert-bawa-keberkahan-pantai-padang-padang-bali-ff9PYd7ITF - Richis Salmon.jpg\";i:1;s:84:\"./assets/img/DataWisata/Pantai Padang-padang/padang-padang-beach - Richis Salmon.jpg\";i:2;s:78:\"./assets/img/DataWisata/Pantai Padang-padang/padang_padang - Richis Salmon.jpg\";}', './assets/img/DataWisata/Pantai Padang-padang/cover/pantai-padang-padang-bali - Richis Salmon.jpg'),
(183, 'Pantai Tegal Wangi', 'Pantai Tegal Wangi menjadi salah satu wisata alam yang wajib kamu kunjungi ketika berlibur di Bali. Pantai ini punya pemandangan yang luar biasa menakjubkan. Kamu juga akan disuguhkan pesona pantai yang disempurnakan dengan tebing-tebing tinggi. Lokasi dari pantai Tegal Wangi Jimbaran berada di wilayah desa adat Jimbaran, tepatnya jalan menuju arah hotel Ayana Resort.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 44000, 'a:3:{i:0;s:86:\"./assets/img/DataWisata/Pantai Tegal Wangi/pantai-tegal-wangi-bali - Richis Salmon.jpg\";i:1;s:166:\"./assets/img/DataWisata/Pantai Tegal Wangi/pantai-tegal-wangi-beach-bali-island-indonesia-pantai-tegal-wangi-beach-bali-island-indonesia-158065054 - Richis Salmon.jpg\";i:2;s:66:\"./assets/img/DataWisata/Pantai Tegal Wangi/ptw - Richis Salmon.jpg\";}', './assets/img/DataWisata/Pantai Tegal Wangi/cover/Mau-foto-prawedding-juga-di-Pantai-Tegal-Wangi-Pastikan-kamu - Richis Salmon.jpg'),
(184, 'Pura Gunung kawi', 'Pura Gunung Kawi Sebatu adalah pura yang berada jauh dari keramaian kota sangat cocok untuk anda yang menyukai suasana tenang, penuh kedamaian, hawa sejuk, dan keindahaan alam pedesaan serta suasana asli bali. adalah pilihat tepat untuk salah satu tempat yang bisa anda kunjungi bersama keluarga. Nyatanya, Pura ini hanya salah satu pura yang indah di kabupaten Gianyar, jika pada hari anda berkunjung ke pura ini dan memiliki cukup waktu datanglah ke Candi Tebing Kunung Kawi dimana candi ini terukir indah tepat disisi tebing.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 52000, 'a:4:{i:0;s:69:\"./assets/img/DataWisata/Pura Gunung kawi/P1270850 - Richis Salmon.jpg\";i:1;s:69:\"./assets/img/DataWisata/Pura Gunung kawi/P1270861 - Richis Salmon.jpg\";i:2;s:69:\"./assets/img/DataWisata/Pura Gunung kawi/P1270874 - Richis Salmon.jpg\";i:3;s:79:\"./assets/img/DataWisata/Pura Gunung kawi/gunung-kawi-temple - Richis Salmon.jpg\";}', './assets/img/DataWisata/Pura Gunung kawi/cover/20220409_003656 - Richis Salmon.jpg'),
(185, 'Pura Taman ayun', 'Pura Taman Ayun menjadi salah satu destinasi wisata lain yang bisa Anda kunjungi ketika bertandang ke Pulau Dewata Bali.  Bali memang tempatnya pura cantik bertebaran, seperti salah satunya Pura Taman Ayun yang bisa Anda jumpai di Pulau Dewata Bali. Taman Ayun Bali merupakan pura Ibu (Paibon) bagi keluarga Mengwi yang lokasinya berada di Desa  Mengwi, jaraknya mencapai 17 km barat laut jika dari kota Denpasar.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 420000, 'a:3:{i:0;s:79:\"./assets/img/DataWisata/Pura Taman ayun/1501562021-Mengwi-1 - Richis Salmon.jpg\";i:1;s:75:\"./assets/img/DataWisata/Pura Taman ayun/Pura_taman_ayun - Richis Salmon.jpg\";i:2;s:62:\"./assets/img/DataWisata/Pura Taman ayun/d1 - Richis Salmon.jpg\";}', './assets/img/DataWisata/Pura Taman ayun/cover/_mg_1570 - Richis Salmon.jpg'),
(186, 'Sangeh Monkey Forest', 'Obyek wisata Sangeh, merupakan kawasan hutan lindung yang di dominasi pohon pala. Selain itu, anda juga dapat melihat ratusan monyet di taman wisata alam Sangeh. Obyek wisata Sangeh berlokasi di Jalan Brahmana, desa Sangeh, kecamatan Abiansemal, wilayah Kabupaten Badung. Hal yang harus di perhatikan jika anda berkunjung ke obyek wisata Sangeh Monkey Forest adalah: Tidak memakai perhiasan seperti kalung dan anting-anting, Jangan memakai kaca mata, Tidak menggangu monyet. Ini bertujuan untuk menghindari kejadian yang tidak di inginkan, seperti monyet mengambil perhiasan anda atau barang bawaan yang anda bawa.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 720000, 'a:3:{i:0;s:76:\"./assets/img/DataWisata/Sangeh Monkey Forest/inside-view - Richis Salmon.jpg\";i:1;s:90:\"./assets/img/DataWisata/Sangeh Monkey Forest/sangeh-bali-monkey-forest - Richis Salmon.jpg\";i:2;s:124:\"./assets/img/DataWisata/Sangeh Monkey Forest/ubud-heritage-tour_288b3fb8133eb89d18237c9178233a491a9e39a1 - Richis Salmon.jpg\";}', './assets/img/DataWisata/Sangeh Monkey Forest/cover/monyet-sangeh - Richis Salmon.jpg'),
(187, 'Tegalalang rice terrace', 'Tegalalang Rice Terrace merupakan areal persawahan yang menawarkan pemandangan yang unik dan asri. Berbeda dari areal persawahan di kota-kota lainnya, areal persawahan ini didesain secara berundak (terassering), sehingga menciptakan teras-teras hijau yang memesona. Undakan-undakan tersebut membentuk semacam teras-teras sawah yang bisa Anda telusuri. Areal ini juga tampak semakin asri dengan banyaknya pepohonan yang menciptakan suasana teduh di bawah teriknya cahaya matahari. Sembari berjalan menyusuri areal persawahan, Anda pun bisa melihat para petani yang sedang menanam padi atau membajak sawah.', 'a:3:{s:12:\"100-519-5418\";a:2:{s:9:\"nama_bank\";s:4:\"BRIS\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:12:\"27-9300-3056\";a:2:{s:9:\"nama_bank\";s:3:\"BCA\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}s:18:\"0005-01-00130-7304\";a:2:{s:9:\"nama_bank\";s:3:\"BRI\";s:9:\"atas_nama\";s:13:\"PT Duta Aries\";}}', 74000, 'a:4:{i:0;s:100:\"./assets/img/DataWisata/Tegalalang rice terrace/882423eb6f4849a5951d8017310f7f90 - Richis Salmon.jpg\";i:1;s:80:\"./assets/img/DataWisata/Tegalalang rice terrace/image-asset - Richis Salmon.jpeg\";i:2;s:91:\"./assets/img/DataWisata/Tegalalang rice terrace/tegalalang-rice-terrace - Richis Salmon.jpg\";i:3;s:80:\"./assets/img/DataWisata/Tegalalang rice terrace/untitled_4_3 - Richis Salmon.jpg\";}', './assets/img/DataWisata/Tegalalang rice terrace/cover/2d965328feeba27568a1ac32664c253e - Richis Salmon.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`IdTransaksi`),
  ADD KEY `fk_users` (`IdUser`) USING BTREE,
  ADD KEY `fk_wisata` (`IdWisata`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`IdWisata`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `IdWisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_wisata` FOREIGN KEY (`IdWisata`) REFERENCES `wisata` (`IdWisata`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
