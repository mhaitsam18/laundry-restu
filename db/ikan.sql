-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 09:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikan`
--

-- --------------------------------------------------------

--
-- Table structure for table `abundance`
--

CREATE TABLE `abundance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `abundance` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archipelago`
--

CREATE TABLE `archipelago` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distribution_id` bigint(20) UNSIGNED DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `archipelago` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `excerpt` text NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `excerpt`, `content`, `slug`, `author_id`, `article_category_id`, `article_type_id`, `thumbnail`, `views`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'satu dua tiga tes tes', 'satu dua tiga tes tes', 'satu dua tiga tes tes', 'satu-dua-tiga-tes-tes', 9, NULL, 1, 'artikel/64951db378c71.png', 0, NULL, '2023-06-22 01:22:54', '2023-06-22 01:22:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_type`
--

CREATE TABLE `article_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_type`
--

INSERT INTO `article_type` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Sejarah', '2023-06-21 19:00:09', '2023-06-21 19:00:09'),
(2, 'Budidaya', '2023-06-21 19:00:09', '2023-06-21 19:00:09'),
(3, 'Informasi', '2023-06-21 19:00:09', '2023-06-21 19:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `avatar`
--

CREATE TABLE `avatar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classifies`
--

CREATE TABLE `classifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classify` varchar(255) NOT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `phylum_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subphylum_id` bigint(20) UNSIGNED DEFAULT NULL,
  `infraphylum_id` bigint(20) UNSIGNED DEFAULT NULL,
  `superclass_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `species` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classifies`
--

INSERT INTO `classifies` (`id`, `classify`, `general_name`, `phylum_id`, `subphylum_id`, `infraphylum_id`, `superclass_id`, `description`, `picture`, `species`, `created_at`, `update_at`) VALUES
(1, 'Myxini', 'ikan seperti lintah laut', 9, 3, 1, 2, 'Ikan hag (bahasa Inggris: hagfish) adalah hewan serupa ikan yang memiliki tulang belakang (vertebra) semu. Hewan air ini dianggap sebagai bentuk ikan purba. Habitatnya adalah laut, sungai, dan danau.\r\n\r\nIkan hag tidak diklasifikasikan sebagai vertebrata karena tidak mempunyai tulang belakang (vertebra) sejati; juga tidak dapat dianggap avertebrata karena ia memiliki notokorda pada tahap awal perkembangan hidupnya dan tengkorak yang melindungi otaknya. Oleh para zoologiwan, remang dimasukkan ke dalam filum Chordata, klad Craniata, suprakelas Agnatha, kelas Myxini.', 'classify/64a3f55888fac.jpeg', 200, '2023-06-10 19:49:52', '2023-06-10 19:49:52'),
(2, 'Petromyzontidae', 'Ikan Lamprey', 9, 3, 1, 2, 'Lamprey adalah garis keturunan purba dari ikan tak berahang dari ordo Petromyzontiformes, ditempatkan di superclass Cyclostomata. Lamprey dewasa dapat dicirikan dengan mulut penghisap yang bergigi seperti corong.', 'classify/64a3f75277f80.jpeg', 0, '2023-06-10 19:52:30', '2023-06-10 19:52:30'),
(3, 'Petromyzontida', '', 9, 3, 1, 2, 'Hyperoartia or Petromyzontida is a disputed group of vertebrates that includes the modern lampreys and their fossil relatives. Examples of hyperoartians from early in their fossil record are Endeiolepis and Euphanerops (which possessed a calcified branchial basket), fish-like animals with hypocercal tails that lived during the Late Devonian Period. Some paleontologists still place these forms among the ', 'classify/64a3f75d6c5b3.jpeg', 0, '2023-06-10 19:54:29', '2023-06-10 19:54:29'),
(4, 'Conodonta', '', 9, 3, 1, 2, 'diklasifikasikan dalam kelas Conodonta. Selama bertahun-tahun, mereka hanya diketahui dari elemen oral mirip gigi yang ditemukan di pengasingan dan sekarang disebut elemen conodont. Pengetahuan mengenai jaringan halus masih terbatas.', 'classify/64a3f76b9ef63.jpeg', 0, '2023-06-10 19:56:27', '2023-06-10 19:56:27'),
(5, 'Placodermi', 'ikan berperisai', 9, 3, 2, 3, 'Placodermi (Dari bahasa yunani πλάξ = Perisai dan δέρμα = Kulit) adalah spesies ikan berperisai yang telah punah, diketahui dari fossilnya, spesies ini hidup diantara periode Silur, hingga periode Devon (periode) akhir. Kepala ikan ini, dilindungi oleh plat keras, sedangkan, seluruh bagian tubuh lainnya tidak diselimuti oleh perisai ini. Taxa Placodermi, dianggap sebagai paraphyleti yang berkerabat dengan seluruh ikan yang hidup saat ini.', 'classify/64a3f78e28ba0.jpeg', 0, '2023-06-10 19:58:34', '2023-06-10 19:58:34'),
(6, 'Chondrichthyes', 'ikan bertulang rawan', 9, 3, 2, 3, 'Chondrichthyes atau ikan bertulang rawan adalah ikan berahang, mempunyai sirip berpasangan, lubang hidung berpasangan, sisik, jantung beruang dua, dan rangka yang terdiri atas tulang rawan bukan tulang sejati. Mereka dibagi menjadi dua subkelas: Elasmobranchii (Hiu dan Pari ) dan Holocephali (kimera atau hiu hantu, terkadang dipisahkan menjadi kelas tersendiri).', 'classify/64a3f78423a86.jpg', 0, '2023-06-10 19:58:34', '2023-06-10 19:58:34'),
(7, 'Acanthodii', 'ikan Basal', 9, 3, 2, 3, 'Acanthodii atau acanthodians adalah kelas gnathostom yang telah punah. Mereka saat ini dianggap mewakili tingkat parafiletik dari berbagai garis keturunan ikan basal hingga Chondrichthyes yang masih ada, yang mencakup hiu, pari, dan chimaera yang masih hidup.', 'classify/64a3f79a18cc6.jpg', 0, '2023-06-10 19:58:34', '2023-06-10 19:58:34'),
(8, 'Actinopterygii', 'ikan bersirip kipas', 9, 3, 2, 4, 'Actinopterygii (/ˌæktɪnɒptəˈrɪdʒiaɪ/; dari actino-, berarti ', 'classify/64a3f7b7445cf.jpg', 0, '2023-06-10 19:58:34', '2023-06-10 19:58:34'),
(9, 'Sarcopterygii', 'ikan bersirip cuping', 9, 3, 2, 4, 'Sarcopterygii - Crossopterygii merupakan kelas dari Chordata bertulang sejati yang mengembangkan anggota badan berciri mirip tungkai: tebal, berdaging, dan juga memiliki tulang. Anggotanya adalah ', 'classify/64a3f7c295ef5.png', 0, '2023-06-10 19:58:34', '2023-06-10 19:58:34'),
(10, 'Mammalia laut', 'ikan seperti paus dan lumba-lumba', 9, 3, 2, NULL, '', 'classify/64a3f7cbed19e.jpg', 128, '2023-06-11 02:29:58', '2023-06-11 02:29:58'),
(11, 'Cephalaspidomorphi', 'ikan tak berahang (primitif)', 9, 3, NULL, NULL, 'Cephalaspidomorphs adalah sekelompok ikan tanpa rahang yang dinamai Cephalaspis dari osteostracans. Sebagian besar ahli biologi menganggap takson ini telah punah, tetapi nama ini kadang-kadang digunakan dalam klasifikasi lamprey, karena lamprey pernah dianggap berkerabat dengan sefalaspid. Jika lamprey dimasukkan, mereka akan memperluas jangkauan kelompok yang diketahui dari periode Silurian dan Devonian hingga saat ini. Mereka adalah kerabat terdekat ikan berahang, yang muncul dari dalam diri mereka dan akan bertahan hidup jika ikan berahang dimasukkan.', 'classify/64a3f83c83632.jpg', 0, '2023-06-11 02:38:31', '2023-06-11 02:38:31'),
(12, 'Amphibia', NULL, 9, 3, 2, 5, NULL, NULL, NULL, '2023-06-11 02:38:31', '2023-06-11 02:38:31'),
(13, 'Aves', NULL, 9, 3, 2, NULL, NULL, NULL, NULL, '2023-06-11 02:38:31', '2023-06-11 02:38:31'),
(14, 'Reptilia', NULL, 9, 3, 2, 5, NULL, NULL, NULL, '2023-06-11 02:38:31', '2023-06-11 02:38:31'),
(15, 'Sauropsida', NULL, 9, 3, 2, 5, 'Sauropsida (\"wajah kadal\") adalah klad amniota, secara luas setara dengan kelas Reptilia. Sauropsida adalah takson saudara Synapsida, klad amniota yang berisi mamalia sebagai satu-satunya representatif modern. Meskipun synapsida awal secara historis telah dirujuk sebagai \"reptil mirip mamalia\", seluruh synapsida lebih dekat kekerabatannya ke mamalia ketimbang reptil modern. Di sisi lain, sauropsida mengandung seluruh amniota yang lebih dekat ke reptil modern ketimbang mamalia. Ini termasuk Aves (burung), yang sekarang dikenal sebagai subkelompok reptil archosauria meskipun aslinya dinamai sebagai kelas terpisah di taksonomi Linnaeus.', NULL, NULL, '2023-06-11 02:40:04', '2023-06-11 02:40:04'),
(16, 'Synapsida', NULL, 9, 3, 2, 5, 'Synapsida (\'fused arch\'), atau theropsida (\'wajah hewan\'), adalah kelompok hewan yang termasuk mamalia dan segala kerabat dekatnya selain amniota hidup lainnya.[4] Anggota non-mamalia disebut sebagai reptil mirip mammalia dalam sistematika klasik,[5][6] tetapi disebut \"mamalia batang\" atau \"proto-mammalia\" dalam terminologi kladistika.', NULL, NULL, '2023-06-11 02:40:04', '2023-06-11 02:40:04'),
(17, 'Thelodonti', 'Ikan Purba', 9, 3, NULL, NULL, 'Thelodonti adalah kelas ikan tak berahang Paleozoikum yang telah punah dengan sisik yang khas, bukan pelat pelindung yang besar. Ada banyak perdebatan mengenai apakah kelompok tersebut mewakili pengelompokan monofiletik, atau kelompok induk yang berbeda dengan garis utama ikan tanpa rahang dan berahang.', NULL, NULL, '2023-06-11 02:51:48', '2023-06-11 02:51:48'),
(18, 'Anaspida', 'Ikan Purba', 9, 3, NULL, NULL, 'Anaspida adalah kelompok vertebrata tanpa rahang yang telah punah secara evolusioner yang ada dari periode Silur awal hingga akhir periode Devonian. Mereka secara klasik dianggap sebagai nenek moyang lamprey.', NULL, NULL, '2023-06-11 02:51:48', '2023-06-11 02:51:48'),
(19, 'Galeaspida', 'Ikan Purba', 9, 3, NULL, NULL, 'aleaspida adalah takson ikan laut dan air tawar yang sudah punah. Nama ini berasal dari galea, kata Latin untuk helm, dan mengacu pada perisai tulang besar di kepala mereka.', NULL, NULL, '2023-06-11 02:51:48', '2023-06-11 02:51:48'),
(20, 'Pituriaspida', 'Ikan Purba', 9, 3, NULL, NULL, 'Pituriaspida adalah sekelompok kecil ikan tanpa rahang lapis baja yang punah dengan mimbar seperti hidung yang luar biasa, yang hidup di lingkungan delta laut Devonian Tengah Australia', NULL, NULL, '2023-06-11 02:51:48', '2023-06-11 02:51:48'),
(21, 'Osteostraci', 'Ikan Purba', 9, 3, NULL, NULL, 'Kelas Osteostraci adalah takson ikan tanpa rahang berlapis tulang yang telah punah, disebut \"ostracoderms\", yang hidup di tempat yang sekarang disebut Amerika Utara, Eropa, dan Rusia dari Silur Tengah hingga Devon Akhir.', NULL, NULL, '2023-06-11 02:51:48', '2023-06-11 02:51:48'),
(22, 'Hyperoartia', 'Lamprey Modern', 9, 3, NULL, NULL, 'Hyperoartia atau Petromyzontida adalah kelompok vertebrata yang disengketakan yang mencakup lamprey modern dan kerabat fosilnya. Contoh hyperoartians dari awal catatan fosil mereka adalah Endeiolepis dan Euphanerops, hewan mirip ikan dengan ekor hypocercal yang hidup selama Periode Devon Akhir.', NULL, NULL, '2023-06-11 02:56:13', '2023-06-11 02:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `footer` varchar(255) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `header`, `title`, `content`, `footer`, `last_updated`) VALUES
(1, 'Illustration', '', '<p>Add some quality, svg illustrations to your project courtesy of <a\r\n                                            target=\"_blank\" rel=\"nofollow\" href=\"https://undraw.co/\">unDraw</a>, a\r\n                                        constantly updated collection of beautiful svg images that you can use\r\n                                        completely free and without attribution!</p>\r\n                                    <a target=\"_blank\" rel=\"nofollow\" href=\"https://undraw.co/\">Browse Illustrations on\r\n                                        unDraw &rarr;</a>', '', '2021-03-05 03:51:54'),
(2, 'Development Approach', '', '<p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce\r\n                                        CSS bloat and poor page performance. Custom CSS classes are used to create\r\n                                        custom components and custom utility classes.</p>\r\n                                    <p class=\"mb-0\">Before working with this theme, you should become familiar with the\r\n                                        Bootstrap framework, especially the utility classes.</p>', '', '2021-03-05 03:49:49'),
(3, 'Illustration', '', '<p>Add some quality, svg illustrations to your project courtesy of <a\r\n                                            target=\"_blank\" rel=\"nofollow\" href=\"https://undraw.co/\">unDraw</a>, a\r\n                                        constantly updated collection of beautiful svg images that you can use\r\n                                        completely free and without attribution!</p>\r\n                                    <a target=\"_blank\" rel=\"nofollow\" href=\"https://undraw.co/\">Browse Illustrations on\r\n                                        unDraw &rarr;</a>', '', '2021-03-05 03:51:44'),
(4, 'Development Approach', '', '<p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce\r\n                                        CSS bloat and poor page performance. Custom CSS classes are used to create\r\n                                        custom components and custom utility classes.</p>\r\n                                    <p class=\"mb-0\">Before working with this theme, you should become familiar with the\r\n                                        Bootstrap framework, especially the utility classes.</p>', '', '2021-03-05 03:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `continent`
--

CREATE TABLE `continent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `continent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `continent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `footer` varchar(256) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id`, `header`, `title`, `content`, `footer`, `icon`) VALUES
(1, 'About Application', 'IEI Jawa Barat', '<b>iei-jabar.com</b> Data Ikan <br>\nAlamatnya Jl. Ciganitri No.69 B, Cipagalo, Kec. Bojongsoang, Bandung, Jawa Barat 40287', 'Feby', 'fas fa-paw');

-- --------------------------------------------------------

--
-- Table structure for table `distribution`
--

CREATE TABLE `distribution` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distribution` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `family` varchar(255) NOT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `suborder_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fish`
--

CREATE TABLE `fish` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `scientific_name` varchar(255) NOT NULL,
  `general_name` varchar(255) NOT NULL,
  `synonim` varchar(255) NOT NULL,
  `species_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subspecies_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fish_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `abundance_id` bigint(20) UNSIGNED DEFAULT NULL,
  `length` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `information` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fish_distribution`
--

CREATE TABLE `fish_distribution` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fish_id` bigint(20) UNSIGNED DEFAULT NULL,
  `distribution_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fish_food`
--

CREATE TABLE `fish_food` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fish_id` bigint(20) UNSIGNED DEFAULT NULL,
  `food_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fish_habitat`
--

CREATE TABLE `fish_habitat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fish_id` bigint(20) UNSIGNED DEFAULT NULL,
  `habitat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fish_type`
--

CREATE TABLE `fish_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fish_type`
--

INSERT INTO `fish_type` (`id`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Ikan Endemik', 'Ikan endemik, di sisi lain, merujuk pada ikan yang hanya ditemukan di suatu wilayah tertentu dan tidak ada di tempat lain di dunia. Mereka secara alami berkembang biak dan hidup di wilayah tersebut, dan telah berevolusi dan beradaptasi dengan kondisi lingkungan setempat selama ribuan atau jutaan tahun.', '2023-06-13 09:33:05', '2023-06-13 09:33:05'),
(2, 'Ikan Introduksi', 'Ikan introduksi adalah ikan yang diperkenalkan atau diimpor ke suatu wilayah yang tidak asli bagi spesies ikan tersebut. Ini bisa dilakukan oleh manusia dengan tujuan tertentu, seperti untuk keperluan budidaya, perikanan, atau tujuan rekreasi seperti memancing.', '2023-06-13 09:33:05', '2023-06-13 09:33:05'),
(3, 'Ikan Migran', 'Ikan migran adalah jenis ikan yang melakukan perjalanan jarak jauh antara perairan air tawar dan laut. Mereka biasanya melakukan migrasi untuk tujuan pemijahan, mencari makanan, atau menghindari perubahan lingkungan yang tidak sesuai.', '2023-06-13 09:33:05', '2023-06-13 09:33:05'),
(4, 'Ikan Transplantasi', 'Ikan transplantasi mengacu pada ikan yang dipindahkan dari satu wilayah ke wilayah lain dalam batas yang lebih kecil daripada introduksi. Transplantasi sering dilakukan oleh manusia dengan tujuan mengisi populasi ikan yang berkurang atau untuk keperluan manajemen perikanan.', '2023-06-13 09:33:05', '2023-06-13 09:33:05'),
(5, 'Ikan Invasif', 'Ikan invasif adalah jenis ikan yang diperkenalkan ke suatu wilayah baru dan memiliki kemampuan untuk berkembang biak secara agresif dan mengganggu ekosistem setempat. Ikan invasif biasanya tidak memiliki pemangsa alami di wilayah baru mereka dan dapat menyebabkan kerusakan yang signifikan terhadap keanekaragaman hayati asli.', '2023-06-13 09:33:05', '2023-06-13 09:33:05'),
(6, 'Ikan Komersial', 'Ikan komersial merujuk pada jenis ikan yang ditangkap atau dibudidayakan untuk tujuan komersial, seperti untuk konsumsi manusia atau industri perikanan. Ikan komersial sering kali memiliki nilai ekonomi yang tinggi dan ditangkap dalam skala besar.', '2023-06-13 09:33:05', '2023-06-13 09:33:05'),
(7, 'Ikan Hias', 'Ikan hias adalah jenis ikan yang dipelihara dalam akuarium atau kolam sebagai hewan peliharaan. Mereka sering memiliki warna yang indah dan bentuk tubuh yang menarik. Ikan hias berasal dari berbagai wilayah di dunia dan telah menjadi bagian penting dari industri perdagangan hewan peliharaan.', '2023-06-13 09:33:05', '2023-06-13 09:33:05'),
(8, 'Ikan Purba', 'Ikan purba merujuk pada jenis ikan yang telah ada sejak zaman prasejarah dan masih bertahan sampai sekarang. Beberapa contoh ikan purba termasuk ikan pari, ikan hiu, dan coelacanth.', '2023-06-13 09:33:05', '2023-06-13 09:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `food` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `food`, `created_at`, `updated_at`) VALUES
(1, 'ikan', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(2, 'ikan kecil', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(3, 'larva ikan', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(4, 'telur ikan', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(5, 'krustasea', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(6, 'krustasea planktonik', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(7, 'krustasea kecil', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(8, 'moluska', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(9, 'kepiting', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(10, 'keong', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(11, 'kerang', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(12, 'katak', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(13, 'cacing', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(14, 'cacing tanah', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(15, 'cacing polychaetes', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(16, 'invertebrata', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(17, 'invertebrata bentik', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(18, 'organisme bentik', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(19, 'alga bentik', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(20, 'alga', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(21, 'larva', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(22, 'gurita', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(23, 'cumi-cumi', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(24, 'copepoda', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(25, 'mysids', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(26, 'lobster', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(27, 'udang', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(28, 'larva udang', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(29, 'plankton', '2023-06-08 00:29:45', '2023-06-08 07:29:45'),
(30, 'zooplankton', '2023-06-08 00:29:45', '2023-06-08 07:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `genera`
--

CREATE TABLE `genera` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genus` varchar(255) NOT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `family_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subfamily_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `habitats`
--

CREATE TABLE `habitats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `habitat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `habitats`
--

INSERT INTO `habitats` (`id`, `habitat`, `created_at`, `updated_at`) VALUES
(1, 'Perairan', '2023-06-13 08:28:30', '2023-06-12 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `infraphylum`
--

CREATE TABLE `infraphylum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `infraphylum` varchar(255) DEFAULT NULL,
  `local_name` varchar(255) DEFAULT NULL,
  `subphylum_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infraphylum`
--

INSERT INTO `infraphylum` (`id`, `infraphylum`, `local_name`, `subphylum_id`, `description`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'incertae sedis', 'Tidak diketahui', 3, 'Incertae sedis (dalam bahasa Latin berarti \"penempatan tidak pasti\") adalah istilah yang digunakan untuk mendefinisikan kelompok taksonomi yang status kekerabatannya tidak diketahui.', NULL, '2023-06-10 19:34:24', '2023-06-10 19:34:24'),
(2, 'Gnathostomata', NULL, 3, 'Gnathostomata (jepang: /ˌnæθoʊˈstɒmətə/) adalah kelompok vertebrata yang memiliki rahang. Istilah Gnathostomata diambil dari bahasa Yunani γνάθος (gnathos) \"rahang\" + στόμα (stoma) \"mulut\". Jenis Gnathostomata terdiri dari sekitar 60.000 spesies, atau sekitar 99% dari seluruh vertebrata. Gnathostome juga memiliki gigi, dan canalis semisirkularis horisontal di bagian dalam telinga, bersamaan dengan karakter anatomi fisik dan seluler seperti selubung mielin yang menyelubungi sel saraf. Selain itu gnathostomata juga memiliki sistem kekebalan tiruan.[2]', NULL, '2023-06-10 19:34:24', '2023-06-10 19:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `kingdoms`
--

CREATE TABLE `kingdoms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kingdom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kingdoms`
--

INSERT INTO `kingdoms` (`id`, `kingdom`, `description`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'Animalia', '', 'kingdom/animalia.jpeg', '2023-06-10 18:49:08', '2023-06-10 17:00:00'),
(2, 'Plantae', '', 'kingdom/plantae.png', '2023-06-10 17:00:00', '2023-06-10 18:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_name`
--

CREATE TABLE `local_name` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fish_id` bigint(20) UNSIGNED DEFAULT NULL,
  `local_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order` varchar(255) NOT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `classify_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subclass_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `origin`
--

CREATE TABLE `origin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fish_id` bigint(20) UNSIGNED DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_1`
--

CREATE TABLE `pertanyaan_1` (
  `id` int(11) NOT NULL,
  `pertanyaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pertanyaan_1`
--

INSERT INTO `pertanyaan_1` (`id`, `pertanyaan`) VALUES
(1, 'Apa nama mobil Favorit kamu?'),
(2, 'Siapa nama ibu kandung kamu?');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_2`
--

CREATE TABLE `pertanyaan_2` (
  `id` int(11) NOT NULL,
  `pertanyaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pertanyaan_2`
--

INSERT INTO `pertanyaan_2` (`id`, `pertanyaan`) VALUES
(1, 'Apa warna favorit kamu?'),
(2, 'Apa kutipan kata favorit kamu?');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_keamanan`
--

CREATE TABLE `pertanyaan_keamanan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pertanyaan_1` int(11) NOT NULL,
  `jawaban_1` varchar(255) NOT NULL,
  `id_pertanyaan_2` int(11) NOT NULL,
  `jawaban_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pertanyaan_keamanan`
--

INSERT INTO `pertanyaan_keamanan` (`id`, `id_user`, `id_pertanyaan_1`, `jawaban_1`, `id_pertanyaan_2`, `jawaban_2`) VALUES
(1, 1, 1, 'Vios', 2, 'Menang');

-- --------------------------------------------------------

--
-- Table structure for table `phylums`
--

CREATE TABLE `phylums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phylum` varchar(255) NOT NULL,
  `kingdom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phylums`
--

INSERT INTO `phylums` (`id`, `phylum`, `kingdom_id`, `description`, `picture`, `created_at`, `update_at`) VALUES
(1, 'Porifera', 1, NULL, NULL, '2023-06-10 18:50:42', '2023-06-10 18:50:52'),
(2, 'Platyhelminthes', 1, NULL, NULL, '2023-06-10 18:50:42', '2023-06-10 18:50:42'),
(3, 'Coelenterata', 1, NULL, NULL, '2023-06-10 18:50:42', '2023-06-10 18:50:42'),
(4, 'Nematoda', 1, NULL, NULL, '2023-06-10 18:50:42', '2023-06-10 18:50:42'),
(5, 'Annelida', 1, NULL, NULL, '2023-06-10 18:50:42', '2023-06-10 18:50:42'),
(6, 'Mollusca', 1, NULL, NULL, '2023-06-10 18:50:42', '2023-06-10 18:50:42'),
(7, 'Arthropoda', 1, NULL, NULL, '2023-06-10 18:50:42', '2023-06-10 18:50:42'),
(8, 'Echinodermata', 1, NULL, NULL, '2023-06-10 18:50:42', '2023-06-10 18:50:42'),
(9, 'Chordata', 1, 'Filum Chordata adalah kelompok hewan, termasuk vertebrata dan beberapa binatang yang mirip invertebrata yang memiliki ciri-ciri yang serupa. Semua anggota kelompok ini, pada suatu saat dalam kehidupan mereka, memiliki notokorda, tali saraf dorsal berongga, celah faring (pharyngeal slits), endostyle, dan ekor berotot yang melewati anus. Vertebrata merupakan kelompok hewan yang memiliki tulang belakang. Dalam sistem klasifikasi, vertebrata merupakan subfilum dari filum Chordata. Chordata terbagi menjadi empat subfilum: Vertebrata, Urochordata, Cephalochordata, dan Hemichordata. Urochordata dan Cephalochordata tergolong invertebrata.', 'phylum/chordata.jpg', '2023-06-10 18:50:42', '2023-06-10 18:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

CREATE TABLE `species` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `species` varchar(255) NOT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `genus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subgenus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subclass`
--

CREATE TABLE `subclass` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `subclass` varchar(255) DEFAULT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `classify_id` bigint(11) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subclass`
--

INSERT INTO `subclass` (`id`, `subclass`, `general_name`, `classify_id`, `description`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'Pteraspidomorphi', 'Ikan Tanpa Rahang', NULL, 'Pteraspidomorphi adalah kelas ikan tanpa rahang awal yang telah punah. Mereka telah lama dianggap sebagai kerabat dekat atau bahkan nenek moyang vertebrata berahang, tetapi beberapa karakteristik yang mereka miliki dengan yang terakhir sekarang dianggap sebagai sifat dasar untuk semua vertebrata.', NULL, '2023-06-11 03:18:16', '2023-06-11 03:18:16'),
(2, 'Coelacanthimorpha', 'ikan bersirip lobus', 8, 'Coelacanth adalah kelompok kuno ikan bersirip lobus di kelas Actinistia. Sebagai sarcopterygian, mereka lebih dekat hubungannya dengan lungfish dan tetrapoda daripada ikan bersirip pari.', NULL, '2023-06-11 03:18:16', '2023-06-11 03:18:16'),
(3, 'Dipnoi', 'Ikan lempung', 9, 'Ikan lempung adalah vertebrata rhipidistia dari ordo Dipnoi. Ikan lempung terkenal karena mempertahankan ciri-ciri nenek moyang dalam Osteichthyes, termasuk kemampuannya menghirup udara, dan struktur tubuh nenek moyang dalam Sarcopterygii, termasuk adanya sirip lobus dengan kerangka dalam yang telah berkembang dengan baik. Ikan lempung mewakili kerabat terdekat tetrapoda yang masih hidup.', NULL, '2023-06-11 03:18:16', '2023-06-11 03:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `subfamily`
--

CREATE TABLE `subfamily` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subfamily` varchar(255) DEFAULT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `family_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `craeted_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subgenus`
--

CREATE TABLE `subgenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subgenus` varchar(255) DEFAULT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `genus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `craeted_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suborder`
--

CREATE TABLE `suborder` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `suborder` varchar(255) DEFAULT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `craeted_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subphylum`
--

CREATE TABLE `subphylum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subphylum` varchar(255) DEFAULT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `phylum_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subphylum`
--

INSERT INTO `subphylum` (`id`, `subphylum`, `general_name`, `phylum_id`, `description`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'Urochordata', 'Tunikata', 9, 'Urochordata merupakan sebuah subfilum dari chordata. Urochordata berasal dari bahasa latin (Uro: ekor, chorda: batang penyokong tubuh dalam). Yang paling menonjol adalah tunicates laut squirts (kelas Ascidiacea). Berbagai macam tumbuh di koloni. Sebagian besar dari tubuh yang diduduki insang yang sangat besar dengan berbagai tekak insang slits yang berfungsi sebagai saringan untuk makanan.', NULL, '2023-06-10 19:26:49', '2023-06-10 19:26:49'),
(2, 'Cephalochordata', NULL, 9, 'Cephalochordata (dari bahasa Yunani: κεφαλή kephalé, \"kepala\" and χορδή khordé, \"chord\") adalah subfilum dari anggota hewan bertulang belakang yang termasuk dalam filum Chordata, Acraniata.[2] Bentuk tubuh seperti ikan tanpa sirip, pipih memanjang, transparan. Notokorda, saraf dorsal, dan celah faring berkembang bagus. Sistem sirkulasi tanpa jantung. Aliran darah dibagian ventral mengalir ke depan, sedangkan di sisi dorsal mengalir ke belakang. Memiliki alat peraba dimulutnya yang disebut sirus. Pada ujung anterior terdapat bintik mata dan pembau. Reproduksi secara seksual, memiliki kelamin terpisah dan mengalami fertilisasi eksternal. Biasanya hidup terkubur di bawah pasir perairan dangkal. Contohnya Branchiostoma sp. (amphioxus).', NULL, '2023-06-10 19:26:49', '2023-06-10 19:26:49'),
(3, 'Vertebrata', 'Hewan bertulang belakang', 9, 'Vertebrata adalah subfilum dari Chordata, mencakup semua hewan yang memiliki tulang belakang yang tersusun dari vertebra. Vertebrata adalah subfilum terbesar dari Chordata. Ke dalam vertebrata dapat dimasukkan semua jenis ikan (kecuali remang, belut dan \"lintah laut\" atau hagfish), amfibia, reptil, burung, serta hewan menyusui (mamalia). Kecuali jenis-jenis ikan, vertebrata diketahui memiliki dua pasang tungkai.', NULL, '2023-06-10 19:26:49', '2023-06-10 19:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `subspecies`
--

CREATE TABLE `subspecies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subspecies` varchar(255) DEFAULT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `species_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `craeted_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superclass`
--

CREATE TABLE `superclass` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `superclass` varchar(255) DEFAULT NULL,
  `general_name` varchar(255) DEFAULT NULL,
  `infraphylum_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superclass`
--

INSERT INTO `superclass` (`id`, `superclass`, `general_name`, `infraphylum_id`, `description`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'Agnatha', 'hewan tidak berahang', 1, 'Agnatha (\"hewan tidak berahang\") atau Cyclostomata (\"hewan bermulut lingkar\") adalah salah satu superkelas dari Craniata (hewan bertengkorak). Walaupun hidup di air, agnatha tidak dapat dikatakan sebagai ikan secara biologi karena tidak berahang, siripnya tidak berpasangan,dan rangka tubuhnya tersusun dari tulang rawan.\r\n\r\nKe dalam agnatha termasuk semua lamprey (Petromyzodonti) dan remang (Myxini).', NULL, '2023-06-10 19:40:02', '2023-06-10 19:40:02'),
(2, 'Cyclostomata', 'hewan bermulut lingkar', 1, 'Agnatha (\"hewan tidak berahang\") atau Cyclostomata (\"hewan bermulut lingkar\") adalah salah satu superkelas dari Craniata (hewan bertengkorak). Walaupun hidup di air, agnatha tidak dapat dikatakan sebagai ikan secara biologi karena tidak berahang, siripnya tidak berpasangan,dan rangka tubuhnya tersusun dari tulang rawan.\r\n\r\nKe dalam agnatha termasuk semua lamprey (Petromyzodonti) dan remang (Myxini).', NULL, '2023-06-10 19:40:02', '2023-06-10 19:40:02'),
(3, 'Incertae sedis', 'penempatan tidak pasti', 2, 'ncertae sedis (dalam bahasa Latin berarti \"penempatan tidak pasti\")[1] adalah istilah yang digunakan untuk mendefinisikan kelompok taksonomi yang status kekerabatannya tidak diketahui.', NULL, '2023-06-10 19:44:29', '2023-06-10 19:44:29'),
(4, 'Osteichthyes', 'Ikan bertulang sejati', 2, 'Osteichthyes atau disebut juga Ikan bertulang sejati adalah kelas dari anggota hewan bertulang belakang yang merupakan subfilum dari Pisces.[1] Osteichthyes berasal dari bahasa Yunani, yaitu osteon yang berati tulang dan ichthyes yang berarti ikan.[2] Ikan jenis ini hidup di laut, rawa-rawa, atau air tawar.', NULL, '2023-06-10 19:44:29', '2023-06-10 19:44:29'),
(5, 'Tetrapoda', 'berkaki-empat', 2, 'Tetrapoda (Yunani τετραποδη tetrapoda, Latin quadrupedal, \"berkaki-empat\") adalah hewan vertebrata yang berkaki empat, kaki atau seperti kaki. Amfibia, reptil, dinosaurus, unggas, dan mamalia merupakan bagian dari tetrapoda, dan bahkan ular yang tidak memiliki kaki juga merupakan tetrapoda menurut keturunan. Tetrapoda awal berasal dari Sarcopterygii atau ikan bersirip lobus.', NULL, '2023-06-10 19:44:29', '2023-06-10 19:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `gender` varchar(128) NOT NULL,
  `place_of_birth` varchar(128) NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone_number` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `email`, `gender`, `place_of_birth`, `birthday`, `phone_number`, `address`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'feby', 'Feby', 'feby@gmail.com', 'Perempuan', 'Bandung', '1999-02-18', '081214222446', 'Jl. Bandung ', 'default.png', '$2y$10$54Ajl0R.ArBF45hyXCsJZOnTdLzoegtv9nJbBRs3ICk1QBv1kS5yW', 1, 1, 1614472317),
(9, 'amel', 'Amel', 'amel@gmail.com', 'Perempuan', 'Bandung', '2002-06-12', '0821148321', 'Bandung', 'default.jpg', '$2y$10$54Ajl0R.ArBF45hyXCsJZOnTdLzoegtv9nJbBRs3ICk1QBv1kS5yW', 3, 1, 1614472317),
(10, 'geby', 'Geby', 'geby@gmail.com', 'Perempuan', 'Bandung', '2002-06-12', '0128938123', 'Bandung', 'default.jpg', '$2y$10$54Ajl0R.ArBF45hyXCsJZOnTdLzoegtv9nJbBRs3ICk1QBv1kS5yW', 2, 1, 1614472317);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(6, 1, 5),
(8, 1, 7),
(11, 2, 8),
(21, 3, 2),
(23, 3, 8),
(24, 1, 8),
(26, 1, 14),
(33, 3, 17);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `active`) VALUES
(1, 'Admin', 1),
(2, 'User', 1),
(3, 'Menu', 1),
(14, 'DataMaster', 1),
(15, 'Lainnya', 1),
(17, 'Artikel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'member'),
(3, 'adminartikel');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/', 'box', 0),
(2, 2, 'Dashboard', 'user/', 'box', 1),
(3, 2, 'Edit Profile', 'user/edit', 'user', 1),
(4, 3, 'Menu Management', 'menu/', 'list', 1),
(5, 3, 'Submenu Management', 'menu/subMenu', 'list', 1),
(6, 1, 'Role Management', 'admin/role', 'users', 1),
(7, 2, 'Change Password', 'user/changePassword', 'key', 1),
(8, 1, 'Data User', 'admin/dataUser/', 'users', 1),
(10, 14, 'Data Master', 'DataMaster/', 'list', 0),
(20, 14, 'Data Ikan', 'DataMaster/fish/', 'box', 1),
(21, 14, 'Data Spesies', 'DataMaster/species', 'activity', 1),
(22, 15, 'Tentang Aplikasi', 'Lainnya/tentang', 'box', 1),
(23, 15, 'Pengaturan', 'Lainnya/pengaturan', 'box', 1),
(24, 15, 'Hubungi Kami', 'Lainnya/hubungi', 'box', 1),
(25, 15, 'Bantuan', 'Lainnya/bantuan', 'box', 1),
(26, 15, 'FAQ', 'Lainnya/faq', 'box', 1),
(27, 14, 'Data Genus', 'DataMaster/genus', 'box', 1),
(28, 14, 'Data Famili', 'DataMaster/family', 'box', 1),
(30, 14, 'Data Ordo', 'DataMaster/order', 'box', 1),
(31, 14, 'Data Kelas', 'DataMaster/classify', 'box', 1),
(41, 14, 'Data Filum', 'DataMaster/phylum', 'box', 1),
(42, 14, 'Data Kingdom', 'DataMaster/kingdom', 'box', 1),
(43, 14, 'Data Distribusi', 'DataMaster/distribution', 'box', 1),
(44, 14, 'Data Makanan\r\n', 'DataMaster/food', 'box', 1),
(45, 14, 'Data Habitat', 'DataMaster/habitat', 'box', 1),
(46, 14, 'Data Kepulauan', 'DataMaster/archipelago', 'box', 1),
(47, 14, 'Data Provinsi\r\n', 'DataMaster/province', 'box', 1),
(48, 14, 'Data Negara', 'DataMaster/country', 'box', 1),
(49, 14, 'Data Benua', 'DataMaster/continent', 'box', 1),
(50, 14, 'Data Jenis Ikan', 'DataMaster/fishType', 'box', 1),
(51, 14, 'Data Kelimpahan', 'DataMaster/abundance', 'box', 1),
(52, 17, 'Data Artikel', 'Artikel/index', 'file', 1),
(53, 17, 'Data Tipe Artikel', 'Artikel/tipeArtikel', 'file', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(4, 'haitsam03@gmail.com', 'iscmRCWne+lTCfqz/25n5R8VUX5MUkaN02Bhum3gVsU=', 1609930420),
(5, 'haitsam03@gmail.com', 'n5QKD1D9vUL9QiROw9MO4pgD/fbbdFGYrGd8znIJWe4=', 1609932048),
(6, 'haitsam03@gmail.com', 'wPG+3htmGqTKAArzVlpS/b0eoqor9TKqG16H5cDvMqA=', 1609932054),
(7, 'aa@aa.a', 'oIK0LUztcU02aYAE6HG86eh7Fq5/TcK17wF7B/To+/k=', 1609941391),
(8, 'wahyuhidayat@gmail.com', 'h5OYZb29deEXYS/1Bc69GOaWseVwGEhhSXVKert9Oog=', 1610019862),
(9, 'pramuko@gmail.com', 'ijlFNaUwBrUcqEbANwlEml1FluVkgWAOvEPf3VtE9H4=', 1610019892),
(10, 'elyrosely@gmail.com', 'zLt8OC5aT9LrQaCipRl09/n95aUTUUjwCiVtKM150uA=', 1610019940),
(11, 'inne@gmail.com', '6kl2FFh6027PAQ51K03uIlFz8f3+e59snpxLo3jAOBE=', 1610019985),
(12, 'wawa@gmail.com', '/g7m4I60ysY6Ljs6xsHhye5zWPyA0eR/4qwv7r7czlo=', 1610020015),
(13, 'fasaldo1999@gmail.com', 'fOSWX9UdFnoi7ejSOIkhye7te1tVdT+cXmd1hh0YZCQ=', 1610023446),
(15, 'muhammadbarja@gmail.com', 'VpatS/tgTK/bfTZLlDDoVX9aaD6Kb3YoeS2/ozJOhXI=', 1610280453),
(16, 'januarizqi5@gmail.com', '8QKHOpK1ROQrW679QbREt1fb2wdgcsffl5PLahNGPws=', 1610507816),
(17, 'suryatiningsih@gmail.com', 'IvVR3KjJpnh+lnQgeWOmpht3w235j9Vax2GkkDCzUBE=', 1610509684),
(18, 'ersanum@gmail.com', 'Tst2ygGt8n2wUa+RsqvtHguZMn1KPTaiNE63D4wwehQ=', 1610529882),
(19, 'haitsamhaitsam18@yahoo.com', '06vONmPAIi0hj/xgLH72Ck6FSDDyqs96P9pxA5bOU54=', 1610556667),
(20, 'shibghotul7@gmail.com', 'zLT3U4RCMM6pc1pVBCI3SodKzlAVJmG13PbfY8ijFnU=', 1610556792),
(21, 'haitsam03@gmail.com', 'oVyGSYjGv4lTvFvUKawPJ96cj42FYlkQW8QcyPDghSQ=', 1611588824),
(22, 'akibdahlan20@gmail.com', 'Q5sF4roomYzNnHkIS0zKCHKteza6KwrK5GYaHqlJr8w=', 1614472096),
(23, 'akibdahlan21@gmail.com', 'M23yBdkPPwctLera1YG1Eccpx5PFhn1vNyKEeEqVpT0=', 1614472317),
(24, 'hariadiarfah21263@gmail.com', 'TqbWx3Vf3Z/kDFKSrDmJkBOb7q2ps/51az1qHxWSnW0=', 1626429149),
(26, 'annisayusmaniah2001@gmail.com', 'HERMzOgp9QFhAQjXuW/UBvpxJxzR4g/Mlq1/bhbpvCI=', 1626430676),
(28, 'sstrngrr2001@gmail.com', 'rAoYoQRGelEDyk/iDQjzdLMmt6vooxHKa/cvuHEDnwU=', 1626440828),
(29, 'chairanimiskah@gmail.com', 'wB9PFxOaMhwhgxI85esrVc49YsQywDungnQz/fRSroU=', 1628927224),
(30, 'umar@gmail.com', 'NczUWm85jMIxmCsRMTc4p/434OhbqvoRuLpvpALdd+g=', 1649893588);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abundance`
--
ALTER TABLE `abundance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archipelago`
--
ALTER TABLE `archipelago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distribution_id` (`distribution_id`),
  ADD KEY `provinsi_id` (`province_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_author_id_foreign` (`author_id`);

--
-- Indexes for table `article_type`
--
ALTER TABLE `article_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classifies`
--
ALTER TABLE `classifies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phylum_id` (`phylum_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `continent`
--
ALTER TABLE `continent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distribution_id` (`continent_id`),
  ADD KEY `benua_id` (`continent_id`);

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distribution`
--
ALTER TABLE `distribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `fish`
--
ALTER TABLE `fish`
  ADD PRIMARY KEY (`id`),
  ADD KEY `species_id` (`species_id`);

--
-- Indexes for table `fish_distribution`
--
ALTER TABLE `fish_distribution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fish_id` (`fish_id`),
  ADD KEY `distribution_id` (`distribution_id`);

--
-- Indexes for table `fish_food`
--
ALTER TABLE `fish_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fish_id` (`fish_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `fish_habitat`
--
ALTER TABLE `fish_habitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fish_id` (`fish_id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Indexes for table `fish_type`
--
ALTER TABLE `fish_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genera`
--
ALTER TABLE `genera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family_id` (`family_id`);

--
-- Indexes for table `habitats`
--
ALTER TABLE `habitats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infraphylum`
--
ALTER TABLE `infraphylum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kingdoms`
--
ALTER TABLE `kingdoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_article_id_foreign` (`article_id`);

--
-- Indexes for table `local_name`
--
ALTER TABLE `local_name`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fish_id` (`fish_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classify_id` (`classify_id`);

--
-- Indexes for table `origin`
--
ALTER TABLE `origin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fish_id` (`fish_id`);

--
-- Indexes for table `pertanyaan_1`
--
ALTER TABLE `pertanyaan_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanyaan_2`
--
ALTER TABLE `pertanyaan_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanyaan_keamanan`
--
ALTER TABLE `pertanyaan_keamanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phylums`
--
ALTER TABLE `phylums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kingdom_id` (`kingdom_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`),
  ADD KEY `negara_id` (`country_id`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genus_id` (`genus_id`);

--
-- Indexes for table `subclass`
--
ALTER TABLE `subclass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subfamily`
--
ALTER TABLE `subfamily`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subgenus`
--
ALTER TABLE `subgenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suborder`
--
ALTER TABLE `suborder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subphylum`
--
ALTER TABLE `subphylum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subspecies`
--
ALTER TABLE `subspecies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superclass`
--
ALTER TABLE `superclass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abundance`
--
ALTER TABLE `abundance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archipelago`
--
ALTER TABLE `archipelago`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article_type`
--
ALTER TABLE `article_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classifies`
--
ALTER TABLE `classifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `continent`
--
ALTER TABLE `continent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `distribution`
--
ALTER TABLE `distribution`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fish`
--
ALTER TABLE `fish`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fish_distribution`
--
ALTER TABLE `fish_distribution`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fish_food`
--
ALTER TABLE `fish_food`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fish_habitat`
--
ALTER TABLE `fish_habitat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fish_type`
--
ALTER TABLE `fish_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `genera`
--
ALTER TABLE `genera`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `habitats`
--
ALTER TABLE `habitats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `infraphylum`
--
ALTER TABLE `infraphylum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kingdoms`
--
ALTER TABLE `kingdoms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_name`
--
ALTER TABLE `local_name`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `origin`
--
ALTER TABLE `origin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pertanyaan_1`
--
ALTER TABLE `pertanyaan_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pertanyaan_2`
--
ALTER TABLE `pertanyaan_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pertanyaan_keamanan`
--
ALTER TABLE `pertanyaan_keamanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `phylums`
--
ALTER TABLE `phylums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `species`
--
ALTER TABLE `species`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subclass`
--
ALTER TABLE `subclass`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subfamily`
--
ALTER TABLE `subfamily`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subgenus`
--
ALTER TABLE `subgenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suborder`
--
ALTER TABLE `suborder`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subphylum`
--
ALTER TABLE `subphylum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subspecies`
--
ALTER TABLE `subspecies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superclass`
--
ALTER TABLE `superclass`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archipelago`
--
ALTER TABLE `archipelago`
  ADD CONSTRAINT `archipelago_ibfk_1` FOREIGN KEY (`distribution_id`) REFERENCES `distribution` (`id`),
  ADD CONSTRAINT `archipelago_ibfk_2` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`);

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `classifies`
--
ALTER TABLE `classifies`
  ADD CONSTRAINT `classifies_ibfk_1` FOREIGN KEY (`phylum_id`) REFERENCES `phylums` (`id`);

--
-- Constraints for table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `country_ibfk_1` FOREIGN KEY (`continent_id`) REFERENCES `continent` (`id`);

--
-- Constraints for table `families`
--
ALTER TABLE `families`
  ADD CONSTRAINT `families_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `fish`
--
ALTER TABLE `fish`
  ADD CONSTRAINT `fish_ibfk_1` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`);

--
-- Constraints for table `fish_distribution`
--
ALTER TABLE `fish_distribution`
  ADD CONSTRAINT `fish_distribution_ibfk_1` FOREIGN KEY (`fish_id`) REFERENCES `fish` (`id`),
  ADD CONSTRAINT `fish_distribution_ibfk_2` FOREIGN KEY (`distribution_id`) REFERENCES `distribution` (`id`);

--
-- Constraints for table `fish_food`
--
ALTER TABLE `fish_food`
  ADD CONSTRAINT `fish_food_ibfk_1` FOREIGN KEY (`fish_id`) REFERENCES `fish` (`id`),
  ADD CONSTRAINT `fish_food_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`);

--
-- Constraints for table `fish_habitat`
--
ALTER TABLE `fish_habitat`
  ADD CONSTRAINT `fish_habitat_ibfk_1` FOREIGN KEY (`fish_id`) REFERENCES `fish` (`id`),
  ADD CONSTRAINT `fish_habitat_ibfk_2` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`);

--
-- Constraints for table `genera`
--
ALTER TABLE `genera`
  ADD CONSTRAINT `genera_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `local_name`
--
ALTER TABLE `local_name`
  ADD CONSTRAINT `local_name_ibfk_1` FOREIGN KEY (`fish_id`) REFERENCES `fish` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`classify_id`) REFERENCES `classifies` (`id`);

--
-- Constraints for table `origin`
--
ALTER TABLE `origin`
  ADD CONSTRAINT `origin_ibfk_1` FOREIGN KEY (`fish_id`) REFERENCES `fish` (`id`);

--
-- Constraints for table `phylums`
--
ALTER TABLE `phylums`
  ADD CONSTRAINT `phylums_ibfk_1` FOREIGN KEY (`kingdom_id`) REFERENCES `kingdoms` (`id`);

--
-- Constraints for table `province`
--
ALTER TABLE `province`
  ADD CONSTRAINT `province_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Constraints for table `species`
--
ALTER TABLE `species`
  ADD CONSTRAINT `species_ibfk_1` FOREIGN KEY (`genus_id`) REFERENCES `genera` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
