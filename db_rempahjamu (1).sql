-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 01:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rempahjamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `jamu`
--

CREATE TABLE `jamu` (
  `id_jamu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_jamu` varchar(50) NOT NULL,
  `ket_jamu` varchar(200) NOT NULL,
  `gambar_jamu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jamu`
--

INSERT INTO `jamu` (`id_jamu`, `id_user`, `nama_jamu`, `ket_jamu`, `gambar_jamu`) VALUES
(19, 10, 'asi booster', '', 'WhatsApp Image 2023-09-25 at 10.19.22.jpeg'),
(20, 10, 'gadis remaja', '', 'WhatsApp Image 2023-09-25 at 10.19.20.jpeg'),
(23, 10, 'feminia', '', 'WhatsApp Image 2023-09-25 at 10.19.09.jpeg'),
(25, 10, 'rapet harum asmara', '', 'WhatsApp Image 2023-09-25 at 10.19.11.jpeg'),
(26, 10, 'awet muda', '', 'WhatsApp Image 2023-09-25 at 10.19.07.jpeg'),
(27, 10, 'jakuat', '', 'WhatsApp Image 2023-09-25 at 10.19.02.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `khasiat`
--

CREATE TABLE `khasiat` (
  `id_khasiat` int(11) NOT NULL,
  `khasiat` varchar(100) NOT NULL,
  `ket_khasiat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khasiat`
--

INSERT INTO `khasiat` (`id_khasiat`, `khasiat`, `ket_khasiat`) VALUES
(3, 'menambah stamina tubuh', ''),
(4, 'mempelancar haid', ''),
(5, 'mengurangi bau badan', ''),
(6, 'membuat rapet dan kesed area kewanitaan', ''),
(7, 'mengatasi keputihan', ''),
(8, 'menimbulkan sensasi denyut saat berhubungan', ''),
(9, 'mengurangi lemak dalam tubuh', ''),
(10, 'menambah nafsu makan', ''),
(11, 'melancarkan BAB', ''),
(12, 'mengurangi nyeri haid', ''),
(13, 'melancarkan peredaran darah', ''),
(14, 'melancarkan keluarnya ASI', ''),
(15, 'mengatasi lendir berlebih di are kewanitaan', ''),
(16, 'menyegarkan bau badan dengan aroma khas rempah khas', ''),
(17, 'mengatasi gatal akibat bakteri dan jamur', ''),
(18, 'bau kurang sedap', ''),
(19, 'mencegah timbulnya varises', ''),
(20, 'perawatan khusus pasca melahirkan dengan mengembalikan tubuh seperti semula', ''),
(21, 'membuat kulit bersih dan lebih cerah', ''),
(22, 'menjaga tubuh tetap prima', ''),
(23, 'membuat hubungan suami istri makin mesra', ''),
(24, 'menyuburkan kandungan', ''),
(25, 'mengatasi ketombe', ''),
(26, 'mengatasi rontok rambut', ''),
(27, 'mengencangkan kulit dan area khusus baik pria maupun wanita', ''),
(28, 'mencerahkan wajah', ''),
(29, 'memudarkan bekas jerawat', ''),
(30, 'mengecilkan pori-pori', ''),
(31, 'mengurangi capek', ''),
(32, 'nyeri sendi', ''),
(33, 'mengatsi alergi pada kulit', ''),
(34, 'menurunkan kadar gula dalam darah', ''),
(35, 'mengharmoniskan hubungan suami istri', ''),
(36, 'menambah masa otot', ''),
(37, 'menjaga stamina tubuh agar tetap fit', ''),
(38, 'menurunkan tekanan darah tinggi', ''),
(39, 'Untuk segala macam penyakit', ''),
(40, 'menetralisir sirkulasi jantung', ''),
(41, 'Menormalkan sirkulasi jantung', ''),
(42, 'Memberi kemesraan yg luar biasa dlm perhubungan suami istri', ''),
(43, 'Menyembuhkan penyakit darah putih (piktay) serta bau busuk dalam rahim yg sangat menjijikan', ''),
(44, ' Melenyapkan rasa gatal² dlm rahim shg menyebabkan wanita merasa tdk selera dan tenteram', ''),
(45, 'Mengeringkan rahim dan lendir yg berlebihan supaya menjadi kering dan ketal shg menimbulkan kenikmat', ''),
(46, '.Memulihkan elastisitas organ intim wanita', ''),
(47, 'Mengencangkan otot² miss V', ''),
(48, 'Mengencangkan payudara', ''),
(49, 'Mengencangkan seluruh kulit shg tampak lebih muda', ''),
(50, 'Menambah gairah dan semangat dalam berhubungan suami istri', ''),
(51, 'Menghilangkan gatal² di miss V', ''),
(52, 'Awet Muda Wajah Berseri', ''),
(53, 'Melegitkan dan menghaluskan vagina', ''),
(54, 'Mengencangkan otot kendor setelah melahirkan', ''),
(55, 'Menghilangkan bau serta gatal', ''),
(56, 'Mengatasi masalah² ibu yg ikut bermacam² KB', ''),
(57, 'Membuat awet muda dan cantik', ''),
(58, 'Menyembuhkan radang gusi', ''),
(59, 'radang tenggorokan', ''),
(60, 'sakit gigi', ''),
(61, ' sakit kepala', ''),
(62, 'amandel', ''),
(63, 'ambeyen', ''),
(64, 'demam', ''),
(65, 'kolestrol', ''),
(66, 'mendetox darah', ''),
(67, 'Melangsingkan badan', ''),
(68, 'mengecilkan dan mengencangkan perut kendur', ''),
(69, 'memadatkan tubuh', ''),
(70, 'membuat wajah segar dan tidak mudah keriput', ''),
(71, 'menghilangkan selulit.', '');

-- --------------------------------------------------------

--
-- Table structure for table `khasiat_jamu`
--

CREATE TABLE `khasiat_jamu` (
  `id_khasiatjamu` int(11) NOT NULL,
  `id_jamu` int(11) NOT NULL,
  `id_khasiat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khasiat_jamu`
--

INSERT INTO `khasiat_jamu` (`id_khasiatjamu`, `id_jamu`, `id_khasiat`) VALUES
(45, 19, 14),
(46, 26, 7),
(47, 26, 46),
(48, 26, 47),
(49, 26, 55),
(50, 23, 5),
(51, 23, 6),
(52, 23, 7),
(53, 23, 18),
(54, 23, 47),
(55, 23, 48),
(56, 20, 5),
(57, 20, 7),
(58, 20, 29),
(59, 27, 3),
(60, 27, 22),
(61, 27, 23),
(62, 25, 7),
(63, 25, 15),
(64, 25, 18),
(65, 25, 23),
(66, 25, 47),
(67, 25, 51);

-- --------------------------------------------------------

--
-- Table structure for table `komposisi`
--

CREATE TABLE `komposisi` (
  `id_komposisi` int(11) NOT NULL,
  `id_jamu` int(11) NOT NULL,
  `id_rempah` int(11) NOT NULL,
  `banyak_rempah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komposisi`
--

INSERT INTO `komposisi` (`id_komposisi`, `id_jamu`, `id_rempah`, `banyak_rempah`) VALUES
(40, 19, 81, ''),
(41, 19, 82, ''),
(42, 19, 83, ''),
(43, 26, 8, ''),
(44, 26, 15, ''),
(45, 26, 19, ''),
(46, 23, 77, ''),
(47, 23, 78, ''),
(48, 23, 87, ''),
(49, 20, 77, ''),
(50, 20, 84, ''),
(51, 20, 85, ''),
(52, 20, 86, ''),
(53, 27, 89, ''),
(54, 27, 90, ''),
(55, 27, 91, ''),
(56, 27, 92, ''),
(57, 25, 77, ''),
(58, 25, 85, ''),
(59, 25, 87, ''),
(60, 25, 88, '');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `ket_kota` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`, `ket_kota`) VALUES
(2, 'Bangkalan', 'Madura'),
(3, 'Sampang', 'Madura'),
(4, 'Pamekasan', 'Madura'),
(5, 'Sumenep', 'Madura');

-- --------------------------------------------------------

--
-- Table structure for table `rempah`
--

CREATE TABLE `rempah` (
  `id_rempah` int(11) NOT NULL,
  `nama_rempah` varchar(50) NOT NULL,
  `ket_rempah` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rempah`
--

INSERT INTO `rempah` (`id_rempah`, `nama_rempah`, `ket_rempah`) VALUES
(6, 'kunci', ''),
(7, 'kunyit', ''),
(8, 'pinang muda', ''),
(9, 'parabes', ''),
(10, 'daun sirih', ''),
(11, 'delima putih', ''),
(12, 'kulit manggis', ''),
(13, 'temulawak', ''),
(14, 'jahe merah', ''),
(15, 'jahe emprit', ''),
(16, 'daun ketule', ''),
(17, 'kedawung', ''),
(18, 'temu ireng', ''),
(19, 'manjakani', ''),
(20, 'air kapur sirih', ''),
(21, 'kayu gaharu', ''),
(22, 'sentok', ''),
(23, 'temu gunung', ''),
(24, 'seccang', ''),
(25, 'pandiyang', ''),
(26, 'jamu asi', ''),
(27, 'param atas', ''),
(28, 'param bawah', ''),
(29, 'cebokan', ''),
(30, 'dupa', ''),
(31, 'godokan temulawak', ''),
(32, 'jamu 40hari tapel pales', ''),
(33, 'jeruk purut', ''),
(34, 'panduyang', ''),
(35, 'manyir', ''),
(36, 'kulit jeruk perut', ''),
(37, 'bengkoang', ''),
(38, 'tepung beras', ''),
(39, 'lempuyang', ''),
(40, 'laos', ''),
(41, 'cabe jamu', ''),
(42, 'kencur', ''),
(43, 'merica', ''),
(44, 'ketumbar', ''),
(45, 'sentok peok', ''),
(46, 'sambel loto', ''),
(47, 'daun bawang', ''),
(48, 'bawang putih', ''),
(49, 'kayu manis', ''),
(50, 'cengkeh', ''),
(51, 'madu', ''),
(52, 'gingseng', ''),
(53, 'pasak bumi', ''),
(54, 'daun salam', ''),
(55, 'meniran', ''),
(56, 'pare', ''),
(57, 'adas manis', ''),
(58, 'sambiloto', ''),
(59, 'lengkuas', ''),
(60, 'partai cina', ''),
(61, 'delima', ''),
(62, 'asam gelugur', ''),
(63, 'kubeba', ''),
(64, 'jintan hitam', ''),
(65, 'jahe', ''),
(66, 'kapulaga', ''),
(67, 'kemukus', ''),
(68, 'jintan putih', ''),
(69, 'fenugreek', ''),
(70, 'lada jawa', ''),
(71, 'daun kacip', ''),
(72, 'gambir', ''),
(73, 'kulit jeruk', ''),
(74, 'asam', ''),
(75, 'kopi', ''),
(76, 'paramecia nigeria ', '40mg'),
(77, 'boesenbergiae rotunda', ''),
(78, 'quercus infectoria', ''),
(79, ' apis mallifera ', ''),
(80, 'Na.benzoat', ''),
(81, 'flore insertus', ''),
(82, 'venerable aerospace', ''),
(83, 'curcuma domesticae', ''),
(84, 'piper betie', ''),
(85, 'curcuma longa', ''),
(86, 'piper cubeba', ''),
(87, 'kaemferia rotunda', ''),
(88, 'quercus infectoria', ''),
(89, 'zingiberis rhozoma', ''),
(90, 'areca catechu', ''),
(91, 'panax quinque folios', ''),
(92, 'royal jelly', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `id_kota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `pw`, `id_kota`) VALUES
(1, 'admin', 'admin@gmail.com', '12345', 2),
(10, 'PT JAFIR (Jamu Firdaus)', 'jafir@gmail.com', 'jafir123', 2),
(11, 'Ribkah Maryam Jokotole', 'jokole@gmail.com', 'jokotole123', 2),
(12, 'UD. Madura Sari', 'madurasari@gmail.com', 'mdr123', 3),
(13, 'RATOHQU', 'ratohqu@gmail.com', 'ratoh123', 3),
(14, 'TOKO BU EMA', 'ema@gmail.com', 'ema123', 4),
(15, 'Mustika Madura', 'mustikamadura@gmail.com', 'mustika123', 4),
(16, 'TOKO ANGGREK', 'anggrek@gmail.com', 'anggrek123', 5),
(17, 'Wahyu Sejati', 'wahyu@gmail.com', 'wahyu123', 5),
(18, 'TRESNA', 'tresna@gmail.com', 'tresna123', 2),
(19, 'NATURNA', 'naturna@gmail.com', 'naturna123', 2),
(20, 'TOKO NUR', 'nur@gmail.com', 'nur123', 4),
(21, 'WARDA', 'warda@gmail.com', 'warda123', 4),
(22, 'IBU MASTURAH', 'masturah@gmail.com', 'masturah123', 2),
(23, 'PT JAFIR (Jamu Firdaus)', 'jafir@gmail.com', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jamu`
--
ALTER TABLE `jamu`
  ADD PRIMARY KEY (`id_jamu`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `khasiat`
--
ALTER TABLE `khasiat`
  ADD PRIMARY KEY (`id_khasiat`);

--
-- Indexes for table `khasiat_jamu`
--
ALTER TABLE `khasiat_jamu`
  ADD PRIMARY KEY (`id_khasiatjamu`),
  ADD KEY `id_jamu` (`id_jamu`),
  ADD KEY `id_khasiat` (`id_khasiat`);

--
-- Indexes for table `komposisi`
--
ALTER TABLE `komposisi`
  ADD PRIMARY KEY (`id_komposisi`),
  ADD KEY `id_user` (`id_jamu`,`id_rempah`),
  ADD KEY `komposisi_ibfk_3` (`id_rempah`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `rempah`
--
ALTER TABLE `rempah`
  ADD PRIMARY KEY (`id_rempah`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_kota` (`id_kota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jamu`
--
ALTER TABLE `jamu`
  MODIFY `id_jamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `khasiat`
--
ALTER TABLE `khasiat`
  MODIFY `id_khasiat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `khasiat_jamu`
--
ALTER TABLE `khasiat_jamu`
  MODIFY `id_khasiatjamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `komposisi`
--
ALTER TABLE `komposisi`
  MODIFY `id_komposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rempah`
--
ALTER TABLE `rempah`
  MODIFY `id_rempah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jamu`
--
ALTER TABLE `jamu`
  ADD CONSTRAINT `jamu_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `khasiat_jamu`
--
ALTER TABLE `khasiat_jamu`
  ADD CONSTRAINT `khasiat_jamu_ibfk_1` FOREIGN KEY (`id_jamu`) REFERENCES `jamu` (`id_jamu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `khasiat_jamu_ibfk_2` FOREIGN KEY (`id_khasiat`) REFERENCES `khasiat` (`id_khasiat`);

--
-- Constraints for table `komposisi`
--
ALTER TABLE `komposisi`
  ADD CONSTRAINT `komposisi_ibfk_1` FOREIGN KEY (`id_jamu`) REFERENCES `jamu` (`id_jamu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `komposisi_ibfk_3` FOREIGN KEY (`id_rempah`) REFERENCES `rempah` (`id_rempah`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
