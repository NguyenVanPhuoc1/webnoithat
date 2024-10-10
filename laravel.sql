-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2024 at 01:07 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noi_bat` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cate_name`, `noi_bat`, `created_at`, `updated_at`) VALUES
(1, 'Nội Thất Phòng Khách', 1, NULL, '2023-11-29 22:40:51'),
(2, 'Nội Thất Phòng Bếp', 1, NULL, '2023-11-29 21:08:58'),
(3, 'Nội Thất Phòng Ngủ', 1, NULL, '2023-11-29 21:09:12');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pro_id` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `pro_id`, `name`, `email`, `content`, `created_at`, `updated_at`) VALUES
(1, 42, 'phuoc031123', 'nguyenvanphuoc.261203@gmail.com', '123', '2023-11-30 01:25:44', '2023-11-30 01:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `cus_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_content` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_cus_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `cus_name`, `email`, `cus_phone`, `cus_content`, `created_at`, `updated_at`) VALUES
(1, 'Phước', 'phuoc031123.nina@gmail.com', '0707958117', 'tôi cần biết giá', '2023-11-29 21:37:25', '2023-11-29 21:37:25'),
(2, 'Chiến', 'chien180203@gmail.com', '0123456789', 'aaaa', '2023-11-30 01:38:46', '2023-11-30 01:38:46'),
(3, 'Nguyễn Văn Phước', '21211tt4646@mail.tdc.edu.vn', '0707958117', 'ssss', '2024-05-20 09:12:57', '2024-05-20 09:12:57'),
(4, 'Trần Quốc Sinh', 'tranquocsinh12003@gmail.com', '0912345678', 'ssss', '2024-05-20 09:31:39', '2024-05-20 09:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favicons`
--

DROP TABLE IF EXISTS `favicons`;
CREATE TABLE IF NOT EXISTS `favicons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favicons`
--

INSERT INTO `favicons` (`id`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 'logo_web.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `file_name`, `caption`, `created_at`, `updated_at`) VALUES
(87, 43, '6568297e19d4b_anh3.png', NULL, '2023-11-29 23:19:42', '2023-11-29 23:19:42'),
(88, 43, '6568297e1b1aa_anh4.png', NULL, '2023-11-29 23:19:42', '2023-11-29 23:19:42'),
(89, 43, '6568297e1bdf7_anh7.png', NULL, '2023-11-29 23:19:42', '2023-11-29 23:19:42'),
(90, 44, '656829b3b2237_anh9.png', NULL, '2023-11-29 23:20:35', '2023-11-29 23:20:35'),
(91, 44, '656829b3b34ac_anhgiuong3.png', NULL, '2023-11-29 23:20:35', '2023-11-29 23:20:35'),
(92, 44, '656829b3b4772_anhgiuong4.png', NULL, '2023-11-29 23:20:35', '2023-11-29 23:20:35'),
(93, 45, '656829d687c1c_anhbep1.png', NULL, '2023-11-29 23:21:10', '2023-11-29 23:21:10'),
(94, 45, '656829d6888b4_anhbep2.png', NULL, '2023-11-29 23:21:10', '2023-11-29 23:21:10'),
(95, 45, '656829d689467_anhgiuong3.png', NULL, '2023-11-29 23:21:10', '2023-11-29 23:21:10'),
(99, 47, '65682abc6a430_anhbanmake3.png', NULL, '2023-11-29 23:25:00', '2023-11-29 23:25:00'),
(100, 47, '65682abc6b335_anhbep1.png', NULL, '2023-11-29 23:25:00', '2023-11-29 23:25:00'),
(101, 47, '65682abc6bfb1_anhbep5.png', NULL, '2023-11-29 23:25:00', '2023-11-29 23:25:00'),
(108, 50, '65682b7469626_anhbanmake2.png', NULL, '2023-11-29 23:28:04', '2023-11-29 23:28:04'),
(109, 50, '65682b746abb1_anhbep1.png', NULL, '2023-11-29 23:28:04', '2023-11-29 23:28:04'),
(110, 50, '65682b746b93e_anhbep2.png', NULL, '2023-11-29 23:28:04', '2023-11-29 23:28:04'),
(111, 51, '65682bc3b802e_anh2.png', NULL, '2023-11-29 23:29:23', '2023-11-29 23:29:23'),
(112, 51, '65682bc3b8eaa_anh8.png', NULL, '2023-11-29 23:29:23', '2023-11-29 23:29:23'),
(113, 51, '65682bc3b9aef_anhbanmake3.png', NULL, '2023-11-29 23:29:23', '2023-11-29 23:29:23'),
(114, 52, '65682bfedf209_anh1.png', NULL, '2023-11-29 23:30:22', '2023-11-29 23:30:22'),
(115, 52, '65682bfedffff_anh3.png', NULL, '2023-11-29 23:30:22', '2023-11-29 23:30:22'),
(116, 52, '65682bfee1307_anh8.png', NULL, '2023-11-29 23:30:22', '2023-11-29 23:30:22'),
(120, 54, '65682ca668790_anh2.png', NULL, '2023-11-29 23:33:10', '2023-11-29 23:33:10'),
(121, 54, '65682ca66993b_anhbep2.png', NULL, '2023-11-29 23:33:10', '2023-11-29 23:33:10'),
(122, 54, '65682ca66a372_anhbep4.png', NULL, '2023-11-29 23:33:10', '2023-11-29 23:33:10'),
(123, 54, '65682ca66ad72_anhgiuong4.png', NULL, '2023-11-29 23:33:10', '2023-11-29 23:33:10'),
(124, 55, '65682d0129ae2_anh3.png', NULL, '2023-11-29 23:34:41', '2023-11-29 23:34:41'),
(125, 55, '65682d012a91c_anh4.png', NULL, '2023-11-29 23:34:41', '2023-11-29 23:34:41'),
(126, 55, '65682d012b423_anh5.png', NULL, '2023-11-29 23:34:41', '2023-11-29 23:34:41'),
(127, 55, '65682d012c6b6_anh7.png', NULL, '2023-11-29 23:34:41', '2023-11-29 23:34:41'),
(128, 55, '65682d012d2da_anh8.png', NULL, '2023-11-29 23:34:41', '2023-11-29 23:34:41'),
(130, 53, '664dd20a2fbc6_daytrangtri.jpg', NULL, '2024-05-22 04:07:54', '2024-05-22 04:07:54'),
(131, 49, '664dd299aa274_giuong-gap.jpg', NULL, '2024-05-22 04:10:17', '2024-05-22 04:10:17'),
(132, 48, '664dd2f97fecf_kesach.jpg', NULL, '2024-05-22 04:11:53', '2024-05-22 04:11:53'),
(133, 46, '664dd34f268f3_ke-go-goctuong.jpg', NULL, '2024-05-22 04:13:19', '2024-05-22 04:13:19'),
(134, 42, '664dd3de204ef_giuongngu.jpg', NULL, '2024-05-22 04:15:42', '2024-05-22 04:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `info_admin`
--

DROP TABLE IF EXISTS `info_admin`;
CREATE TABLE IF NOT EXISTS `info_admin` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `info_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotline` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioitinh` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `diachi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

DROP TABLE IF EXISTS `logos`;
CREATE TABLE IF NOT EXISTS `logos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `file_name`, `created_at`, `updated_at`) VALUES
(1, '1716220955_logonhom12.jpg', NULL, '2024-05-20 09:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_12_023053_create_product_table', 1),
(6, '2023_11_12_025246_create_product_image_table', 1),
(7, '2023_11_12_025730_create_comment_table', 1),
(8, '2023_11_12_030304_create_category_table', 1),
(9, '2023_11_12_031009_create_policy_table', 1),
(10, '2023_11_12_032129_create_customers_table', 1),
(11, '2023_11_12_041031_create_news_table', 1),
(12, '2023_11_12_044016_create_info_admin_table', 1),
(13, '2023_11_29_164312_create_logos_table', 2),
(14, '2023_11_29_182459_create_favicons_table', 2),
(15, '2024_05_20_034447_create_shopper_table', 3),
(16, '2024_05_20_035319_create_order_table', 3),
(17, '2024_05_20_035331_create_order_item_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `news_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cus_id` int NOT NULL,
  `noi_bat` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_name`, `news_image`, `news_desc`, `cus_id`, `noi_bat`, `created_at`, `updated_at`) VALUES
(2, 'Tin Tưc 5', 'noimage.png', '<p>Noi dung</p>', 0, 1, '2023-11-29 22:42:52', '2023-11-29 22:42:52'),
(3, 'Tin Tuc 1', 'thiet-ke-noi-that-14-2.jpg', '<p>noi dung</p>', 0, 1, '2023-11-29 23:58:39', '2023-11-29 23:58:39'),
(4, 'Tin Tưc 2', 'phong-cach-thiet-ke-noi-that.jpg', '<p>noi dung tin tuc 2</p>', 0, 1, '2023-11-29 23:59:02', '2023-11-29 23:59:02'),
(5, 'Tin Tuc 3', 'thiet-ke-noi-that-14-2.jpg', NULL, 0, 1, '2023-11-29 23:59:23', '2023-11-29 23:59:23'),
(6, 'Tin Tức 4', 'phong-cach-thiet-ke-noi-that.jpg', NULL, 0, 1, '2023-11-29 23:59:45', '2023-11-29 23:59:45'),
(7, 'Tin Tuc 6', 'tt6.jpg', '<p><br>Biệt thự 550m2 ở miền Trung lên báo Mỹ nhờ kiến trúc độc đáo, xoá nhoà ranh giới giữa thiên nhiên và con người</p>', 0, 1, '2023-11-30 00:01:43', '2023-11-30 00:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `shopper_id` int NOT NULL,
  `pay_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

DROP TABLE IF EXISTS `policy`;
CREATE TABLE IF NOT EXISTS `policy` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `poli_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poli_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poli_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `noi_bat` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`id`, `poli_name`, `poli_image`, `poli_desc`, `noi_bat`, `created_at`, `updated_at`) VALUES
(1, 'Chính Sách Đổi Trả', 'doitra.png', '<p>Nội dung<strong>Chính sách đổi hàng:</strong> Trong vòng 3 ngày tính từ ngày giao hàng thành công, không tính chủ nhật và các ngày lễ, tết; quý khách hàng được đổi sản phẩm miễn phí khi đủ 2 điều kiện:</p>', 1, '2023-11-29 21:13:03', '2023-11-30 00:52:25'),
(2, 'Chính Sách Bán Hàng', 'chinhsachmuaban.jpg', '<p>Nếu quý khách hàng không thanh toán toàn bộ giá trị đơn hàng trước khi giao hàng, thì với các đơn hàng có giá trị trên 10,000,000đ, quý khách hàng vui lòng đặt cọc 1,000,000đ. Phần giá trị còn lại của đơn hàng quý khách hàng vui lòng thanh toán ngay khi nhận hàng. Trong trường hợp quý khách hàng hủy đơn hàng, chúng tôi sẽ không hoàn lại 1,000,000đ đã đặt cọc.</p>', 1, '2023-11-30 00:34:59', '2023-11-30 00:52:14'),
(3, 'Chính Sách Bảo Hành', 'baohanh.png', '<p>Chúng tôi bảo hành miễn phí cho các sản phẩm bị hư hỏng do lỗi chất liệu (không bao gồm yếu tố màu sắc do mỗi đợt sản xuất màu gỗ, vân gỗ và mắt gỗ có thể chênh lệch đôi chút vì đặc tính tự nhiên của gỗ), lỗi kỹ thuật và lỗi lắp đặt từ phía chúng tôi.</p>', 1, '2023-11-30 00:38:21', '2023-11-30 00:52:03'),
(4, 'Chính Sách Đối Tác Bán Hàng', 'doitac.jpg', '<p><strong>ÁP DỤNG CHO TẤT CẢ CÁC LOẠI HÌNH DOANH NGHIỆP TRONG MỌI LĨNH VỰC&nbsp;</strong></p>', 1, '2023-11-30 00:40:56', '2023-11-30 00:51:48'),
(5, 'Chính Sách Giao Hàng', 'giaohang.png', '<p><strong>CHÚNG TÔI MIỄN PHÍ GIAO HÀNG &amp; LẮP ĐẶT TẠI TẤT CẢ QUẬN HUYỆN THUỘC TP. HCM, TP. THỦ ĐỨC, BIÊN HÒA VÀ MỘT SỐ KHU VỰC TẠI BÌNH DƯƠNG TRONG VÒNG 3 NGÀY</strong></p>', 1, '2023-11-30 00:42:30', '2023-11-30 00:51:29'),
(6, 'Chính Sách Ưu Đãi', 'uudai.jpg', '<p><strong>“Chúng tôi-mie – Trở thành người thân của chúng tôi”. Đối với chúng tôi, mỗi quý khách hàng đều là “người thân” – “homie” của chúng tôi, người mà chúng tôi luôn trân quý.</strong></p>', 1, '2023-11-30 00:44:13', '2023-11-30 00:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cate_id` int NOT NULL,
  `price` int NOT NULL,
  `discount_percent` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `noi_bat` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `cate_id`, `price`, `discount_percent`, `description`, `noi_bat`, `created_at`, `updated_at`) VALUES
(42, 'Giường Gỗ Bọc Nệm Kiểu Dáng Hiện Đại Vai Cao Đẹp Giá Tốt', 1, 2000000, 25, 'Mẫu giường nằm phòng ngủ bọc nệm đầu giường là sự lựa chọn tốt với xu hướng sống hiện đại ngày nay. Phần nệm mút êm ái giúp người dùng thoải mái hơn khi ngồi tựa lưng xem TV hay điện thoại giải trí ngay trên giường. Tấm nệm căng với độ đàn hồi cực tốt nâng cao tính an toàn, chống va đập cực tốt trong sinh hoạt hàng ngày.Giường gỗ công nghiệp thiết kế theo kiểu chân cao với 2 chân và vai giường làm cao 35cm so với mặt sàn. Chiều cao vừa phải, tiện lợi cho việc di chuyển lên xuống kể cả khi đặt thêm nệm. Chân giường làm sát đất tăng khả năng chịu lực, không bị bám bụi vào bên trong gầm giường. Tiết kiệm công sức dọn dẹp, vệ sinh hàng ngày.Đầu giường gỗ hiện đại hoàn thiện theo kiểu đầu chữ nhật với phần khung làm dày 10cm làm điểm tựa chịu lực cho toàn bộ kết cấu. Đầu giường tích hợp 1 kệ để đồ trang trí décor, khách hàng có thể tùy ý bài trí theo thẩm mỹ cá nhân. Phần kệ làm sâu 8cm tạo khoảng không gian đủ rộng, giữ đồ dùng không bị chênh vênh, rơi xuống giường khi bài trí.Bộ khung giường gồm hệ thang giường hoàn thiện dạng lưới đan xen vào nhau tăng cường khả năng chịu lực vá chịu tải trọng lớn. Vạt giường dạng vạt tấm liền bắt khít vào cạnh giường, không có khoảng trống giữa các khe hở, không gây âm thanh và tiếng động khi va chạm mạnh.Chất liệu làm giường được sử dụng từ gỗ mdf cao cấp với phần bề mặt dán melamine chống trầy và chống ẩm cực tốt. Khi tiếp xúc với mặt sàn không bị bong tróc tấm gỗ, dễ dàng làm sạch bề mặt khi dính nước hay các chất lỏng khác.', 1, '2023-11-29 22:57:36', '2024-05-22 04:18:02'),
(43, 'Giường xếp bố vải khung vuông 72cm sơn tĩnh điện thương hiệu Võng Xếp Thảo Điều - G3', 2, 90000, 10, '<p>Thông số sản phẩm -Bộ sản phẩm bao gồm :</p><p>&nbsp;gường xếp, phiếu bảo hành</p><p>-Kích thước : 192*77*35 cm</p><p>&nbsp;-Chất liệu : thép sơn tĩnh điện, vải bố</p><p>-Chịu lực tĩnh :180 kg -Màu sắc : hoa văn, sọc</p><p>&nbsp;-Bảo hành : 12 tháng Mô tả sản phẩm</p><p>-Thiết kế&nbsp;thông minh gắn liền với giường bằng dây đai cao cấp giúp gối ổn định không bị xê dịch dù bạn chỉnh giường ở bất cứ tư thế nào, đồng thời dễ dàng tháo rời để vệ sinh sau một thời gian sử dụng.</p><p>&nbsp;-Được làm từ sắt sơn tĩnh điện với độ bền cao, cùng khả năng chịu lực tốt, không bị gảy hay gỉ sét qua thời gian sử dụng</p><p>-Thiết kế độc đáo có thể nâng phần đầu giường để tạo nên chiếc ghế dài rất tiện dụng</p><p>-Chân giường được thiết kế dạng ống, bên dưới có lớp đệm cao su với độ ma sát cao, chống trượt hiệu quả. Có thể gấp gọn khi không sử dụng đến giúp tiết kiệm không gian tối đa</p><p>- Có thể điều chỉnh 3 cấp độ ( 45 đến 90 độ ) tùy vào sở thích của người sữ dụng có thể đọc sách hoặc xem tivi như giường hoặc ghế</p><p>&nbsp;-Dễ dàng gấp gọn khi không sử dụng giúp tiết kiệm diện tích tối đa.&nbsp;</p>', 0, '2023-11-29 23:19:42', '2024-05-22 04:18:03'),
(44, 'Giường gấp gọn thông minh gọn nhẹ NIKITA chắc chắn, giá rẻ cho người dùng - Mẫu mới 2023', 3, 90000, 10, '😍&nbsp;Giường&nbsp;gấp&nbsp;thông&nbsp;minh&nbsp;NIKITA&nbsp;là&nbsp;mẫu&nbsp;giường&nbsp;bán&nbsp;chạy,&nbsp;được&nbsp;nhiều&nbsp;khách&nbsp;hàng&nbsp;tin&nbsp;tưởng&nbsp;và&nbsp;lựa&nbsp;chọn&nbsp;nhất&nbsp;hiện&nbsp;nay.&nbsp;Chúng&nbsp;tôi&nbsp;mang&nbsp;đến&nbsp;cho&nbsp;quý&nbsp;khách&nbsp;hàng&nbsp;nhiều&nbsp;mẫu&nbsp;mã,&nbsp;với&nbsp;nhiều&nbsp;mức&nbsp;giá&nbsp;và&nbsp;kích&nbsp;thước&nbsp;khác&nbsp;nhau&nbsp;để&nbsp;quý&nbsp;khách&nbsp;hàng&nbsp;có&nbsp;thể&nbsp;lựa&nbsp;phù&nbsp;hợp&nbsp;với&nbsp;mục&nbsp;đích&nbsp;sử&nbsp;dụng&nbsp;và&nbsp;không&nbsp;gian&nbsp;của&nbsp;mình.&nbsp;●&nbsp;Giường&nbsp;gấp&nbsp;hai&nbsp;này&nbsp;là&nbsp;mẫu&nbsp;giường&nbsp;không&nbsp;đệm,&nbsp;thích&nbsp;hợp&nbsp;với&nbsp;người&nbsp;lớn&nbsp;tuổi&nbsp;nằm&nbsp;đệm&nbsp;bị&nbsp;đau&nbsp;lưng,&nbsp;hoặc&nbsp;các&nbsp;bạn&nbsp;sinh&nbsp;viên,&nbsp;công&nbsp;nhân&nbsp;có&nbsp;kinh&nbsp;phí&nbsp;thấp&nbsp;hoặc&nbsp;các&nbsp;công&nbsp;sưởng&nbsp;cần&nbsp;đầu&nbsp;tư&nbsp;số&nbsp;lượng&nbsp;nhiều&nbsp;cho&nbsp;nhân&nbsp;viên.●&nbsp;Giường&nbsp;có&nbsp;thể&nbsp;gấp&nbsp;gọn&nbsp;tiết&nbsp;kiệm&nbsp;không&nbsp;gian,&nbsp;thích&nbsp;hợp&nbsp;sử&nbsp;dụng&nbsp;trong&nbsp;các&nbsp;không&nbsp;gian&nbsp;nhỏ&nbsp;như&nbsp;phòng&nbsp;trọ,&nbsp;phòng&nbsp;nghỉ&nbsp;giải&nbsp;lao&nbsp;ở&nbsp;công&nbsp;ty,&nbsp;công&nbsp;sưởng.●&nbsp;Giường&nbsp;có&nbsp;trọng&nbsp;lượng&nbsp;nhẹ&nbsp;dễ&nbsp;di&nbsp;chuyển&nbsp;mang&nbsp;cất&nbsp;vào&nbsp;góc,&nbsp;hoặc&nbsp;trải&nbsp;ra&nbsp;sử&nbsp;dụng&nbsp;khi&nbsp;cần&nbsp;dù&nbsp;phụ&nbsp;nữ&nbsp;hay&nbsp;trẻ&nbsp;em&nbsp;trên&nbsp;13t&nbsp;đều&nbsp;thao&nbsp;tác&nbsp;dễ&nbsp;dàng..&nbsp;👉&nbsp;KÍCH&nbsp;THƯỚC&nbsp;GIƯỜNG:&nbsp;Q115', 1, '2023-11-29 23:20:35', '2024-05-14 21:40:33'),
(45, 'Ghế giường gấp gọn đa năng Xfurniture RC004 - hàng nhập khẩu', 3, 90000, 10, '<p>Ghế giường gấp gọn đa năng Xfurniture RC004</p><p>- Ghế giường gấp gọn đa năng Xfurniture RC004 vừa làm ghế vừa làm giường</p><p>- Có thể nằm thẳng hoặc nâng đầu như ghế tựa với 5 độ cao khác nhau tùy nhu cầu sử dụng khách hàng ngồi độc sách làm việc hoặc ngủ nghỉ cực tiện ích</p><p>- Gối tựa êm nhẹ, dễ dàng tháo rời và thay đổi vị trí tùy thích</p><p>- Có túi đựng đa năng vô cùng tiện lợi</p><p>- Khung bằng thép( bằng ống thép phi 25) được sơn tĩnh điện</p><p>- Chất liệu được làm từ vải bông siêu bền, thoáng mát, không thấm nước, chịu nắng gió.</p><p>- Được thiết kế đường cong ôm sát người giúp hỗ trợ xương khớp giúp bạn dễ chịu hơn khi nằm, cải thiện sức khỏe.</p><p>- Phù hợp với mọi loại không gian khác nhau, diện tích từ nhỏ đến lớn, đem đến cho bạn sự tiện nghi, thoải mái nhất</p><p>THÔNG SỐ:</p><p>• Kích thước: 200cm x 64 cm</p><p>• Kích thước gấp: 80cm x 65cm x 15cm</p><p>• Trọng lượng: 7 kg</p><p>• Tải trọng: 150 kg</p><p>- Hàng nhập khẩu nguyên thùng</p><p>- Xuất xứ: Hebei, China</p><p>- Có xuất hóa đơn VAT cho công ty</p><p>- Có giá sỉ cho đại lý</p><p>- Nhập khẩu: Công ty TNHH OKOK</p><p>- Phân phối online: okmua.com.vn</p><p>- Thương hiệu: Xfurniture</p><p>- Địa chỉ xem hàng: 119 Lương Thế Vinh, P. Tân Thới Hòa, Q. Tân Phú, TPHCM</p><p>- CSKH: 093 347 9619 chị Hạnh</p><p>- Đại lý/sỉ: 090 123 1800 anh Thắng</p>', 0, '2023-11-29 23:21:10', '2024-05-22 04:18:16'),
(46, 'Kệ góc tường, hiện đại, màu sắc đa dạng, kích thước đa dạng, dễ dàng lắp ráp kích thước 120x40x17cm', 3, 250000, 12, 'Kệ góc tường, hiện đại, màu sắc đa dạng, kích thước 120x40x17cm ►CHÍNH SÁCH BÁN HÀNG: ✔️ Về sản phẩm: Toàn bộ sản phẩm đều được chụp ảnh thật, shop cam kết đúng màu đúng hình ạ. ✔️ CAM KẾT 100% SẢN PHẨM BÁN RA ĐỀU LÀ HÀNG CHÍNH HÃNG ✔️Thời gian chuẩn bị hàng: Hàng có sẵn, thời gian chuẩn bị tối ưu nhất. ✔️ Luôn nhận được ưu đãi cũng như Voucher đặc biệt và thông báo khuyến mãi của shop 💟 ✔️ Giao hàng toàn quốc ✔️ Đổi/ trả theo đúng quy định của Shopee 🔸 CHÍNH SÁCH BẢO HÀNH - Bảo hành 1 đổi 1 miễn phí trong vòng 7 ngày nếu sản phẩm có lỗi kĩ thuật. - Bảo hành chất lượng sản phẩm 3 tháng các lỗi do nhà sản xuất - Chăm sóc &amp; tư vấn trọn đời', 1, '2023-11-29 23:22:32', '2024-05-22 04:17:56'),
(47, 'Kệ Gỗ Xương Rồng to, kệ sách đa năng xinh xắn, đa năng, bền đẹp chất gỗ MDF 40cm x 20cm x 120cm dày 12mm dễ lắp ráp BIG', 1, 90000, 10, '<p>Hãy tham gia các chương trình của shop để được nhận quà tặng và vô số ưu đãi ►CHÍNH SÁCH BÁN HÀNG: ✔️ Về sản phẩm: Toàn bộ sản phẩm đều được chụp ảnh thật, shop cam kết đúng màu đúng hình ạ. ✔️ CAM KẾT 100% SẢN PHẨM BÁN RA ĐỀU LÀ HÀNG CHÍNH HÃNG ✔️Thời gian chuẩn bị hàng: Hàng có sẵn, thời gian chuẩn bị tối ưu nhất. ✔️ Luôn nhận được ưu đãi cũng như Voucher đặc biệt và thông báo khuyến mãi của shop 💟 ✔️ Giao hàng toàn quốc ✔️ Đổi/ trả theo đúng quy định của Shopee 🔸 MÔ TẢ SẢN PHẨM ✔️ Chất liệu: Gỗ MDF nhập khẩu loại tốt, phủ nhựa menamin bóng láng. Bề mặt vật liệu không thấm nước, cấu trúc bền vững không ẩm mốc mối mọt. ✔️ Kích thước: 40cm x 20cm x 120cm (DxRxC) ✔️ Màu sắc vân gỗ tự nhiên, gỗ dày 10mm tạo nên sự sang trọng cho ngôi nhà bạn. ✔️ kiểu dáng tinh tế, màu sắc trang nhã. ✔️Kết hợp vừa là kệ treo, vừa làm kệ đựng quần áo, giày dép và các phụ kiện cần thiết.</p>', 1, '2023-11-29 23:25:00', '2023-11-29 23:25:00'),
(48, 'Kệ sách gỗ chữ U, kệ gỗ thông minh đa năng, bền và đẹp chất gỗ MDF dày 12mm dễ lắp ráp BIG SALE', 2, 179000, 15, 'Hãy tham gia các chương trình của shop để được nhận quà tặng và vô số ưu đãi ►CHÍNH SÁCH BÁN HÀNG: ✔️ Về sản phẩm: Toàn bộ sản phẩm đều được chụp ảnh thật, shop cam kết đúng màu đúng hình ạ. ✔️ CAM KẾT 100% SẢN PHẨM BÁN RA ĐỀU LÀ HÀNG CHÍNH HÃNG ✔️Thời gian chuẩn bị hàng: Hàng có sẵn, thời gian chuẩn bị tối ưu nhất. ✔️ Luôn nhận được ưu đãi cũng như Voucher đặc biệt và thông báo khuyến mãi của shop 💟 ✔️ Giao hàng toàn quốc ✔️ Đổi/ trả theo đúng quy định của Shopee', 1, '2023-11-29 23:25:53', '2024-05-22 04:17:57'),
(49, 'REITINGE ghế văn phòng Giường Ngủ Đơn Gấp Gọn Di Động Tiện Dụng ghế lười', 3, 90000, 10, 'Chất liệu: Kim loạiChiều rộng: 56cmChiều dài: 178cmQuà tặng: tựa đầu, mặt nạ che mắt mất điện, nắp che bụiTải trọng tối đa: 400kgĐo bằng tay có một số lỗi nhất định, tất cả đều lấy phép đo thực tế làm chuẩn.', 1, '2023-11-29 23:27:14', '2024-05-22 04:17:58'),
(50, 'Thảm Treo Tường Trang Trí Phòng Ngủ/Ký Túc Xá Thiết Kế Sang Trọng', 2, 90000, 10, 'Thông TIN SẢN PHẨMTên: xà phòng hoa hồngKích thước: tổng chiều dài khoảng 45cmBao gồm 2 kiểu, gấu đơn và hoa hồng + gấuChất liệu: Xà phòngSử dụng: trang trí nhà cửa, trang trí đám cưới, quà tặngĐóng gói: 1 mảnhChú ý1. Tất cả các hàng hóa gửi từ Trung Quốc, vui lòng tính đến thời gian vận chuyển khi mua sắm.2. Đối với các mặt hàng đã sẵn sàng trong kho, chúng tôi sẽ gửi đi trong vòng 2 ngày làm việc, đối với các mặt hàng đặt trước, chúng tôi sẽ gửi đi trong vòng 5 ngày làm việc.3. Nếu có bất kỳ vấn đề về sản phẩm, xin vui lòng liên hệ với chúng tôi, chúng tôi sẽ cố gắng hết sức để giải quyết vấn đề cho bạn.', 1, '2023-11-29 23:28:04', '2024-05-14 02:30:25'),
(51, 'Tấm che bụi máy giặt chống thấm chống nắng tiện lợi', 1, 90000, 10, '<p>Thời gian giao hàng dự kiến cho sản phẩm này là từ 7-9 ngày Đặc điểm sản phẩm: 1. Chất liệu: Được làm bằng PEVA chất lượng cao, bền, không thấm nước, chống bụi và chống nắng. 2. Hai kiểu dáng: Một kiểu có khóa kéo ở trên, thích hợp cho máy giặt mâm giặt. Một loại dây kéo khác có lỗ bên thích hợp cho máy giặt lồng giặt. 3. Thiết kế nửa: Mặt sau của sản phẩm này hở, thuận lợi cho việc tản nhiệt của máy giặt. 4. Hình thức: Lớp ngoài được in, chống nắng, thoáng khí, không thấm nước, khóa kéo kim loại, trơn tru và không có lực cản; đai co giãn sau lưng, dễ sử dụng. 5. Chức năng: Tấm che bụi này không chỉ có tác dụng ngăn bụi bẩn mà còn ngăn vết nước và ánh nắng mặt trời làm hỏng máy giặt, có thể kéo dài thời gian sử dụng của máy giặt.&nbsp;<br>&nbsp;</p>', 0, '2023-11-29 23:29:23', '2024-05-22 04:18:10'),
(52, 'Vỏ Bọc Máy Điều Hòa Chống Bụi Không Thấm Nước', 2, 90000, 10, 'Đặc điểm:1.Chất liệu - Vỏ chống bụi điều hòa của chúng tôi được làm bằng chất liệu polyester, bền, có thể giặt và dễ dàng làm sạch, có thể tái sử dụng trong thời gian dài.2.Chức năng- Chống bụi, ngăn côn trùng xâm nhập vào máy điều hòa, giảm tuổi thọ của máy điều hòa.3. Trang trí: Hoa văn in phong phú, cho phép bạn lựa chọn, đơn giản, tươi tắn và trang nhã, có thể thêm màu sắc tươi sáng trên những bức tường đơn điệu.&nbsp;100% thương hiệu mới và chất lượng caoMàu sắc: Như hình ảnhChất liệu: PolyesterSố: JB0345Kích thước:1p: Chiều rộng 80CM Độ dày 20CM Chiều cao 27CM2p: Chiều rộng 86CM Độ dày 23CM Chiều cao 30CM (Áp dụng 1.5P hoặc 2P)Vui lòng cho phép lỗi 0,5-1 inch kích thước do đo lường thủ công.', 1, '2023-11-29 23:30:22', '2024-05-14 02:30:24'),
(53, 'Dây Treo Trang Trí Năm Mới 2024 Màu Đỏ Phong Cách Trung Hoa', 1, 90000, 10, 'Đặc điểm 1. Thiết kế DIY, đẹp, phong cách, thiết kế đơn giản 2. Phong cách retro INS, có thể trang trí phòng, tường, cửa hàng, bảng, v.v. 3. Cũng có thể được sử dụng làm thẻ cảm ơn và bưu thiếp. 4. Sẽ đẹp và hoàn hảo hơn khi sử dụng chung với các nhãn dán của chúng tôi. 100% hàng mới và chất lượng cao Màu sắc: Như hình ảnh Chất liệu: Giấy Số hàng: EP0634 Kích thước: Xin vui lòng tham khảo hình ảnh để biết kích thước chi tiết Vui lòng cho phép lỗi 0,5-1 cm kích thước do đo lường thủ công. Gói hàng bao gồm: # 1: Thẻ trang trí * 1 bộ / 14 miếng # 2: Thẻ trang trí * 1 bộ / 13 miếng', 1, '2023-11-29 23:31:22', '2024-05-22 04:17:52'),
(54, 'Sticker Dán Tường Đa Chức Năng Tự Dính Họa Tiết Dễ Thương Bắt Mắt', 1, 90000, 10, 'Đặc điểm: 1. Chất liệu PVC: Tranh dán tường của chúng tôi được làm từ chất liệu PVC thân thiện với môi trường, không thấm nước, chống rỉ, có thể trang trí tường dễ dàng. 2. Dễ dàng chăm sóc: Tranh dán tường của chúng tôi có độ dính, dễ dàng tháo lắp và có thể tái sử dụng. Không để lại vết keo trong quá trình làm sạch và phá dỡ, và nó sẽ không ảnh hưởng đến hầu hết các bức tường theo bất kỳ cách nào. 3. Nhiều chức năng: Tranh dán tường đơn giản, thời trang, có thể dùng để trang trí mọi loại nhà, rất đẹp khi chụp ảnh tự sướng trong gương. Bạn cũng có thể sử dụng nó để che đi các vết xước, ẩn vết và hơn thế nữa. 4. Nhân dịp: Thích hợp cho phòng ngủ, phòng khách, phòng ăn, hành lang, cầu thang, nhà bếp, phòng trẻ em, v.v. Chú ý: Nếu tường đã dán ẩm, lão hóa, sơn mới hoặc không bằng phẳng, có thể làm cho tranh dán tường tự động rơi ra hoặc tường bị bong ra sau khi dán. Do đó, khách hàng được yêu cầu chọn vị trí dán cẩn thận. Màu sắc:#1,#2,#3,#4,#5,#6,#7,#8,#9,#10,#11,#12,#13,#14 Chất liệu: PVC Số: EP1068 Kích thước: 28 * 16 cm Do đo lường thủ công, xin vui lòng cho phép một lỗi 0,5-1 inch. Đóng gói bao gồm: Dán tường * 1 chiếc', 1, '2023-11-29 23:33:10', '2024-05-19 10:39:37'),
(55, 'Thảm Treo Tường Trang Trí In Hình Phong Cảnh Sáng Tạo', 2, 100000, 10, '1.Chất liệu: Tấm thảm này được làm bằng sợi polyester, thân thiện với môi trường, thân thiện với làn da và không phai màu.2. Thiết kế: Tấm thảm phong cảnh này, với hình in đẹp, tay nghề cao, màu sắc tươi sáng và đường nét rõ ràng, là vật trang trí tuyệt vời cho căn phòng của bạn.3. Thông số kỹ thuật: Loại này có nhiều kích cỡ và kiểu dáng, bạn có thể chọn kiểu mình thích.4. Phương pháp lắp đặt: Điều này có thể được lắp đặt bằng móc đinh không đánh dấu hoặc móc dính, đầu tiên đặt hàng móc đinh không đánh dấu hoặc móc dính, sau đó kẹp góc vải treo bằng móc Kẹp, và cuối cùng treo kẹp móc lên móc không đánh dấu hoặc móc dính. Móc, cài đặt đã hoàn tất.5. Nhân dịp: Vải treo này hoàn hảo để treo trên tường, trang trí phòng ngủ, trang trí ký túc xá, chăn dã ngoại, hiên nhà, khăn trải bàn, ga trải giường, rèm cửa, bọc ghế sofa hoặc các ý tưởng phòng khác.6. Giặt: Nên giặt nhẹ nhàng bằng nước lạnh. Không rửa ở nhiệt độ nước tối đa là 30°C, không tẩy, không khô, không giặt khô. Không tiếp xúc với ánh nắng mạnh.Lưu ý: Do màu sắc hiển thị trên máy tính khác nhau, màu sắc sản phẩm thực tế có thể hơi khác so với hình ảnh trên, vui lòng thông cảm.&nbsp;Màu sắc: #1/#2/#3/#4/#5Chất liệu: PolyesterSố: JZ0234Kích thước:S: 75 * 100 cm / 29,5 * 39,4 inchM: 100x150cm / 39,4 * 59,1 inchL: 130 x150cm / 51,2 * 59,1 inchVui lòng cho phép lỗi 0,5-1 inch kích thước do đo lường thủ công.', 1, '2023-11-29 23:34:41', '2024-05-22 04:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `shopper`
--

DROP TABLE IF EXISTS `shopper`;
CREATE TABLE IF NOT EXISTS `shopper` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123456@gmail.com', NULL, '$2y$10$p0VlS/pGxMZyzXBqFIhVMO26vKr9naj8/rQUQi1cYofMm/teu/Sj2', 1, NULL, NULL, '2024-05-20 09:29:40'),
(2, 'chien', 'chien180203@gmail.com', NULL, '$2y$10$qb7ewDlNMQ1UvN6IXzSK7O8PgHR48mZF0fhEzFTxFQvd3LLZl6Tb2', 0, NULL, '2024-05-14 09:44:04', '2024-05-14 09:44:04'),
(6, 'hung', 'hung123456@gmail.com', NULL, '$2y$10$FnoerymzWMmi/796zOXMHOY0ae3Cd9i/o1Ew9ASuMn1ZfcVpMN8jq', 0, NULL, '2024-05-15 22:40:25', '2024-05-15 22:40:25'),
(7, 'Phước Nguyễn Văn', 'phuoc031123.nina@gmail.com', NULL, '$2y$10$Y.Uy02Cup1M/81clEYWfIOoQZIhN.cXqH/conLoYQQQ.lZHcOYWF.', 0, NULL, '2024-05-16 09:26:48', '2024-05-20 09:01:26'),
(8, 'Nguyễn Văn Phước', '21211tt4646@mail.tdc.edu.vn', NULL, '$2y$10$09HkDWVSUOgDFbtHpypEDePcgz9TgLpI/eMCKnfFzVzQBCMdETHmq', 0, NULL, '2024-05-17 00:51:08', '2024-05-17 00:51:08'),
(9, 'Trần Minh Chiến', 'tranminhchien123456@gmail.com', NULL, '$2y$10$zlyJ5wtOWe96dtMFstcHOub4ocIcPBPHynYqyl8urQ8zbkl.1cy52', 0, NULL, '2024-05-19 22:57:10', '2024-05-19 22:57:10');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
