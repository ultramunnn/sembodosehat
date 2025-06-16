-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2025 at 02:13 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sembodo_sehat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `email`, `password`) VALUES
(5, 'admin sembodo sehat', 'sembodosehat@admin', '$2y$10$qEnfVq3kOiAFftOUq8Lswu2UCoIquYfmxPd3Qh7PIyshNr5U/t7iC');

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `id` int NOT NULL,
  `judul` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_konten` enum('Artikel','Video') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_artikel` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `video_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konten`
--

INSERT INTO `konten` (`id`, `judul`, `deskripsi`, `gambar`, `tipe_konten`, `isi_artikel`, `video_link`) VALUES
(30, 'Penyakit Jantung: Musuh Diam yang Mengancam Kesehatan Jantung Anda', 'Penyakit jantung merupakan salah satu masalah kesehatan yang sangat serius dan menjadi penyebab utama kematian di seluruh dunia', '1.jpg', 'Artikel', 'Penyakit jantung merupakan salah satu masalah kesehatan yang sangat serius dan menjadi penyebab utama kematian di seluruh dunia, termasuk di Indonesia. Penyakit ini mencakup berbagai gangguan yang menyerang jantung dan pembuluh darah, seperti penyakit jantung koroner, gagal jantung, aritmia, dan berbagai kondisi lain yang dapat mengganggu fungsi jantung secara keseluruhan. Penyakit jantung biasanya berkembang secara perlahan dalam tubuh dan sering kali tidak menunjukkan gejala yang jelas pada tahap awal, sehingga banyak orang tidak menyadari keberadaannya hingga terjadi serangan jantung atau komplikasi berbahaya lainnya. Faktor risiko penyakit jantung sangat beragam, meliputi kebiasaan merokok, tekanan darah tinggi yang tidak terkontrol, kadar kolesterol yang tinggi, diabetes, obesitas, pola makan yang tidak sehat dengan banyak lemak jenuh dan gula, kurangnya aktivitas fisik, hingga stres yang berkepanjangan. Semua faktor ini berkontribusi terhadap kerusakan pembuluh darah dan melemahkan fungsi jantung sehingga berpotensi memicu berbagai gangguan jantung. Oleh sebab itu, penting bagi setiap orang untuk memahami tanda-tanda awal penyakit jantung, menjalani pemeriksaan kesehatan secara rutin, dan melakukan perubahan gaya hidup yang mendukung kesehatan jantung. Pencegahan dan pengelolaan penyakit jantung tidak hanya dapat memperpanjang usia, tetapi juga meningkatkan kualitas hidup dengan cara menjaga jantung tetap sehat dan bekerja optimal. Melalui edukasi, kesadaran, serta tindakan preventif yang konsisten, risiko terkena penyakit jantung dapat diminimalisir, sehingga kita dapat hidup lebih sehat dan produktif tanpa harus terbebani oleh ancaman penyakit yang mematikan ini.', NULL),
(32, 'Lambung: Organ Vital dalam Sistem Pencernaan', 'Lambung merupakan salah satu organ penting dalam sistem pencernaan manusia yang memiliki peran sentral dalam mengolah makanan', '2.jpg', 'Artikel', 'Lambung merupakan salah satu organ penting dalam sistem pencernaan manusia yang memiliki peran sentral dalam mengolah makanan menjadi bentuk yang lebih sederhana agar dapat diserap oleh tubuh. Di dalam lambung, makanan bercampur dengan asam lambung dan enzim pencernaan yang memecah zat-zat kompleks menjadi nutrisi yang berguna. Asam lambung yang bersifat sangat kuat ini juga berfungsi membunuh bakteri dan patogen yang masuk bersama makanan, sehingga melindungi tubuh dari infeksi. Namun, fungsi lambung bisa terganggu oleh berbagai kondisi seperti gastritis, tukak lambung, dan bahkan kanker lambung yang berpotensi mengancam nyawa. Penyebab gangguan lambung umumnya berkaitan dengan pola makan yang tidak sehat, stres, konsumsi alkohol, merokok, serta infeksi bakteri Helicobacter pylori. Untuk menjaga kesehatan lambung, sangat penting menerapkan pola hidup sehat, mengatur pola makan dengan benar, serta menghindari faktor risiko yang dapat merusak dinding lambung. Selain itu, mengenali gejala gangguan lambung sejak dini dan melakukan pemeriksaan medis secara rutin sangat membantu dalam mencegah komplikasi yang lebih serius.', NULL),
(33, 'Maag: Penyakit Lambung yang Sering Terabaikan', 'Maag adalah istilah populer untuk menggambarkan kondisi gangguan pada lambung yang sering terjadi, terutama gastritis atau tukak lambung.', '3.jpg', 'Artikel', 'Maag adalah istilah yang sering digunakan untuk menggambarkan kondisi gangguan pada lambung yang ditandai dengan peradangan atau luka pada dinding lambung, seperti gastritis dan tukak lambung. Kondisi ini dapat menimbulkan rasa nyeri, perih, dan tidak nyaman di bagian perut atas atau ulu hati. Maag biasanya muncul akibat berbagai faktor, termasuk pola makan yang tidak teratur, konsumsi makanan pedas, asam, dan berlemak secara berlebihan, serta kebiasaan buruk seperti merokok dan mengonsumsi alkohol. Selain itu, stres yang berkepanjangan dan infeksi bakteri Helicobacter pylori juga merupakan penyebab umum yang memicu terjadinya maag. Gejala yang sering dialami penderita maag meliputi rasa terbakar atau nyeri di ulu hati, mual, kembung, dan terkadang muntah. Jika maag tidak segera ditangani dengan benar, kondisi ini dapat berkembang menjadi komplikasi serius seperti perdarahan lambung atau tukak yang parah, yang berpotensi mengancam kesehatan. Oleh sebab itu, penting untuk mengenali gejala maag sejak dini dan menerapkan perubahan gaya hidup yang sehat, seperti mengatur pola makan dengan makan dalam porsi kecil tetapi sering, menghindari makanan dan minuman yang memicu iritasi lambung, serta mengelola stres dengan baik. Pengobatan medis juga sering diperlukan, termasuk penggunaan obat antasida atau penghambat asam lambung yang diresepkan oleh dokter. Dengan perawatan yang tepat dan pola hidup sehat, maag dapat dikendalikan sehingga kesehatan lambung tetap terjaga dan proses pencernaan berlangsung optimal.', NULL),
(34, 'Tipe-Tipe Penyakit Jantung', 'Penyakit jantung merupakan istilah luas yang mencakup berbagai kondisi yang memengaruhi jantung dan pembuluh darah.', '4.jpg', 'Artikel', 'Penyakit jantung merupakan kumpulan berbagai kondisi yang memengaruhi fungsi dan struktur jantung, yang dapat menimbulkan dampak serius bagi kesehatan. Ada beberapa tipe penyakit jantung yang umum ditemui, masing-masing dengan penyebab, gejala, dan penanganan yang berbeda. Salah satu tipe yang paling sering terjadi adalah penyakit jantung koroner, yang disebabkan oleh penyempitan atau penyumbatan arteri koroner akibat penumpukan plak lemak. Kondisi ini mengurangi aliran darah dan oksigen ke otot jantung, sehingga menimbulkan gejala seperti nyeri dada dan sesak napas, dan dapat berujung pada serangan jantung. Selain itu, gagal jantung juga merupakan tipe penting di mana jantung kehilangan kemampuan memompa darah secara efektif, biasanya akibat kerusakan jaringan jantung setelah serangan jantung atau tekanan darah tinggi yang berkepanjangan. Gejala gagal jantung meliputi sesak napas, kelelahan, dan pembengkakan pada kaki. Tipe lain yang sering ditemukan adalah aritmia, yaitu gangguan irama detak jantung yang bisa menyebabkan jantung berdetak terlalu cepat, lambat, atau tidak teratur, yang dapat menimbulkan palpitasi, pusing, hingga pingsan. Penyakit katup jantung juga menjadi tipe penyakit jantung yang penting, di mana katup yang mengatur aliran darah antar ruang jantung mengalami kerusakan, seperti bocor atau menyempit, sehingga mengganggu aliran darah dan menyebabkan gejala seperti kelelahan dan sesak napas. Selain itu, penyakit jantung bawaan yang merupakan kelainan struktural jantung sejak lahir juga merupakan salah satu tipe penyakit jantung yang memerlukan perhatian khusus, karena dapat memengaruhi fungsi jantung dan peredaran darah secara signifikan, dan seringkali memerlukan penanganan sejak dini. Memahami tipe-tipe penyakit jantung ini penting agar setiap orang dapat mengenali risiko dan gejala, serta menjalani pencegahan dan pengobatan yang tepat guna menjaga kesehatan jantung dan kualitas hidup secara keseluruhan.\r\n\r\n', NULL),
(35, 'Kenapa Jantung Identik dengan Perasaan Kaget?', 'Jantung sering kali dikaitkan dengan perasaan kaget atau terkejut ', '5.jpg', 'Artikel', 'Jantung sering kali dikaitkan dengan perasaan kaget atau terkejut karena secara fisiologis, respons tubuh terhadap kejadian yang mengejutkan atau menegangkan langsung memengaruhi kerja jantung. Ketika seseorang mengalami rasa kaget, sistem saraf simpatik di tubuh akan merespons dengan melepaskan hormon stres seperti adrenalin. Hormon ini memicu jantung untuk berdetak lebih cepat dan kuat, sebagai bagian dari respons “fight or flight” atau melawan dan melarikan diri. Detak jantung yang meningkat tersebut memberi sinyal bahwa tubuh sedang dalam kondisi siaga dan siap menghadapi situasi darurat. Oleh karena itu, sensasi detak jantung yang cepat atau “jantung berdebar” sering dirasakan saat seseorang merasa terkejut, takut, atau cemas. Selain itu, perasaan kaget juga dapat menyebabkan kontraksi otot yang intens, termasuk otot di sekitar jantung, sehingga membuat sensasi jantung terasa lebih kuat dan jelas. Karena jantung adalah simbol utama kehidupan dan emosi, maka secara budaya dan bahasa sehari-hari, jantung pun identik dengan respons emosional kuat seperti kaget, cinta, takut, atau bahagia. Singkatnya, jantung berperan sebagai indikator fisik dari reaksi emosional dan stres yang dialami tubuh, sehingga tak heran jika jantung selalu dikaitkan erat dengan perasaan kaget.', NULL),
(36, 'Mengapa Orang Berumur Tua Sering Mengalami Penyakit Jantung?', 'Penyakit jantung menjadi salah satu masalah kesehatan yang paling umum dialami oleh orang berumur tua.', '6.jpg', 'Artikel', 'Penyakit jantung menjadi salah satu masalah kesehatan yang paling umum dialami oleh orang berumur tua. Hal ini terjadi karena seiring bertambahnya usia, berbagai perubahan alami dalam tubuh memengaruhi fungsi jantung dan pembuluh darah. Salah satu penyebab utama meningkatnya risiko penyakit jantung pada usia lanjut adalah proses penuaan pembuluh darah. Seiring waktu, pembuluh darah menjadi lebih kaku dan kehilangan elastisitasnya, yang membuat jantung harus bekerja lebih keras untuk memompa darah ke seluruh tubuh. Kondisi ini sering kali menyebabkan tekanan darah tinggi, yang merupakan faktor risiko utama penyakit jantung. Selain itu, akumulasi plak lemak di dinding arteri (aterosklerosis) juga lebih sering terjadi pada orang tua, yang dapat menyebabkan penyempitan atau penyumbatan pembuluh darah jantung dan berujung pada penyakit jantung koroner. Faktor lain yang turut berkontribusi adalah adanya gangguan metabolisme seperti diabetes dan kolesterol tinggi yang umum dialami oleh lansia. Kebiasaan gaya hidup yang kurang aktif serta pola makan yang kurang sehat selama bertahun-tahun juga memperbesar risiko munculnya masalah jantung. Tak kalah penting, sistem kekebalan tubuh dan kemampuan regenerasi jaringan menurun seiring usia, sehingga jantung lebih rentan terhadap kerusakan dan kurang mampu memperbaiki diri setelah mengalami cedera. Oleh karena itu, menjaga kesehatan jantung di usia tua memerlukan perhatian lebih, seperti menjalani pola hidup sehat, rutin memeriksakan kondisi kesehatan, dan mengontrol faktor risiko yang dapat memperparah penyakit jantung. Dengan langkah pencegahan yang tepat, kualitas hidup di masa tua dapat tetap terjaga dan risiko komplikasi penyakit jantung dapat diminimalkan.\r\n\r\n', NULL),
(37, 'Mengapa Mahasiswa Sering Terkena Maag?', 'Mahasiswa adalah salah satu kelompok yang rentan mengalami gangguan lambung, khususnya maag', '7.jpg', 'Artikel', 'Mahasiswa adalah salah satu kelompok yang rentan mengalami gangguan lambung, khususnya maag. Hal ini disebabkan oleh berbagai faktor yang berhubungan dengan gaya hidup dan tekanan akademik yang dialami selama masa perkuliahan. Salah satu penyebab utama mahasiswa sering terkena maag adalah pola makan yang tidak teratur dan kurang sehat. Karena kesibukan kuliah, banyak mahasiswa yang melewatkan waktu makan, mengonsumsi makanan cepat saji, atau makanan yang tidak bergizi, serta sering mengonsumsi minuman berkafein seperti kopi dan minuman energi yang dapat merangsang produksi asam lambung berlebihan. Selain itu, stres yang tinggi akibat tugas, ujian, dan tekanan akademik juga berperan besar dalam memicu naiknya asam lambung. Stres dapat memengaruhi fungsi sistem pencernaan dan memperburuk kondisi lambung. Kebiasaan begadang atau tidur yang tidak cukup juga dapat meningkatkan risiko gangguan lambung karena proses regenerasi lambung menjadi terganggu. Faktor lain yang turut memperparah kondisi maag pada mahasiswa adalah konsumsi obat-obatan seperti painkiller secara berlebihan tanpa pengawasan dokter. Kombinasi dari kebiasaan tersebut menyebabkan dinding lambung menjadi mudah teriritasi dan memicu gejala maag seperti nyeri ulu hati, rasa terbakar, mual, dan perut kembung. Oleh karena itu, penting bagi mahasiswa untuk menjaga pola makan yang teratur dan sehat, mengelola stres dengan baik, serta memperhatikan waktu istirahat agar gangguan maag dapat dicegah. Kesadaran akan pentingnya menjaga kesehatan lambung sangat diperlukan supaya aktivitas akademik dan keseharian tetap optimal tanpa terganggu oleh masalah pencernaan.', NULL),
(38, 'Kenapa Jantung Identik dengan Perasaan Kaget?', 'Jantung sering kali dikaitkan dengan perasaan kaget', NULL, 'Video', NULL, 'https://youtu.be/KWIJJUIK1Gg?si=zAvSplQpZCD3O0IE');

-- --------------------------------------------------------

--
-- Table structure for table `konten_penyakit`
--

CREATE TABLE `konten_penyakit` (
  `id` int NOT NULL,
  `konten_id` int NOT NULL,
  `penyakit_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konten_penyakit`
--

INSERT INTO `konten_penyakit` (`id`, `konten_id`, `penyakit_id`) VALUES
(27, 30, 29),
(29, 32, 32),
(30, 33, 28),
(31, 34, 29),
(32, 35, 29),
(33, 36, 29),
(34, 37, 28);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_penyakit`
--

CREATE TABLE `riwayat_penyakit` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_penyakit`
--

INSERT INTO `riwayat_penyakit` (`id`, `nama`) VALUES
(29, 'Jantung'),
(32, 'Lambung'),
(28, 'Maag');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','Lainnya') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `foto_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `usia` int DEFAULT NULL,
  `penyakit_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `nama_lengkap`, `jenis_kelamin`, `bio`, `foto_user`, `alamat`, `usia`, `penyakit_id`) VALUES
(1, 'munn', 'm@e', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'munir', 'mmm@email.com', '$2y$10$DfWkW8M.FATL6BA0Q.4Awu16poAUIekd8vXPQxnRUxgEOz.5SMcEe', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '', 'aaa@gmail.com\r\n', '5baced2b910bca80d029c0e3c556230b', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'munir', 'munir@email.com', '$2y$10$e0AtsFp9s3twqizroFIzOeKT5NjVqw6UaSuJ/AUz7LsuKKlFwTDJi', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'arga', 'aaa@gmail.com', '$2y$10$qbWFG7E1GmGX5VYkI7HYjuMt6e.0q2Ss7fK0rY77i4yUyGIvEdTVS', 'Muhammad Arga Padundun', 'Laki-laki', 'sakit sakitan\r\n\r\n\r\n\r\n\r\n', 'uploads/684641096018d_pas foto.jpg', 'kos 18 A jl.terusan cikampek depannya smp bss', 18, 29),
(6, 'tedi', 'ttt@gmail.com', '$2y$10$DM5nWrdZksTOeUgo4HFeUOS2ztRfUglCy2KoE.rVSjlw6xSvmDBjW', 'Muhammad tediber', 'Laki-laki', 'penyakit jantung saya sudah parah', 'uploads/6842d2b412d56_pas foto.jpg', 'kos 18 A jl.terusan cikampek depannya smp bss', 20, 29);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten_penyakit`
--
ALTER TABLE `konten_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_konten_penyakit` (`konten_id`,`penyakit_id`),
  ADD KEY `penyakit_id` (`penyakit_id`);

--
-- Indexes for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_penyakit` (`penyakit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `konten`
--
ALTER TABLE `konten`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `konten_penyakit`
--
ALTER TABLE `konten_penyakit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konten_penyakit`
--
ALTER TABLE `konten_penyakit`
  ADD CONSTRAINT `konten_penyakit_ibfk_1` FOREIGN KEY (`konten_id`) REFERENCES `konten` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `konten_penyakit_ibfk_2` FOREIGN KEY (`penyakit_id`) REFERENCES `riwayat_penyakit` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_penyakit` FOREIGN KEY (`penyakit_id`) REFERENCES `riwayat_penyakit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
