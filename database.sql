-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 28, 2026 lúc 09:58 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `matbao-corev1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addons`
--

CREATE TABLE `addons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `is_purchased` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `addons`
--

INSERT INTO `addons` (`id`, `code`, `name`, `price`, `description`, `is_purchased`, `created_at`, `updated_at`) VALUES
(1, 'shipping_api', 'Kết nối API vận chuyển', 500000.00, 'Mở khóa kết nối API đồng bộ đơn hàng với các đối tác vận chuyển lớn: SPX Express, Viettel Post, GHTK, GHN, J&T Express.', 0, '2026-06-25 23:28:02', '2026-06-25 23:28:02'),
(2, 'vnpay', 'Tích hợp cổng thanh toán VNPAY', 1000000.00, 'Tích hợp cổng thanh toán VNPAY trực tuyến. Hỗ trợ khách hàng quét mã QR ngân hàng hoặc thanh toán thẻ ATM/Visa/Mastercard.', 0, '2026-06-25 23:28:02', '2026-06-25 23:28:02'),
(3, 'sepay', 'Cổng thanh toán tự động Sepay', 800000.00, 'Cổng tự động nhận chuyển khoản ngân hàng qua quét QR VietQR, tự động nhận dạng giao dịch qua Webhook trong 1-3 giây.', 0, '2026-06-25 23:28:02', '2026-06-25 23:28:02'),
(4, 'stripe', 'Cổng thanh toán quốc tế Stripe', 1500000.00, 'Tích hợp cổng thanh toán thẻ quốc tế Stripe dành cho khách hàng nước ngoài thanh toán bằng thẻ Visa/Master/JCB/Amex.', 0, '2026-06-25 23:28:02', '2026-06-25 23:28:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_activity_logs`
--

CREATE TABLE `admin_activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `changes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`changes`)),
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_activity_logs`
--

INSERT INTO `admin_activity_logs` (`id`, `user_id`, `action`, `subject_type`, `subject_id`, `description`, `changes`, `ip_address`, `created_at`) VALUES
(1, 1, 'refunded', 'App\\Models\\Order', 1, 'Ghi nhận hoàn tiền đơn hàng ORD-2026-0001', '{\"amount\":2200000,\"type\":\"partial\"}', '127.0.0.1', '2026-07-18 06:18:04'),
(2, 1, 'updated', NULL, NULL, 'Cập nhật cấu hình website', '{\"updated_keys\":[\"shop_name\",\"contact\",\"theme\",\"seo\",\"social_links\",\"embed_header\",\"embed_footer\",\"smtp\"]}', '127.0.0.1', '2026-07-18 06:34:16'),
(3, 1, 'updated', NULL, NULL, 'Cập nhật cấu hình website', '{\"updated_keys\":[\"shop_name\",\"contact\",\"theme\",\"seo\",\"social_links\",\"embed_header\",\"embed_footer\",\"smtp\",\"favicon_url\"]}', '127.0.0.1', '2026-07-21 21:39:07'),
(4, 1, 'updated', NULL, NULL, 'Cập nhật cấu hình website', '{\"updated_keys\":[\"shop_name\",\"contact\",\"seo\",\"social_links\",\"embed_header\",\"embed_footer\",\"multilingual\",\"smtp\"]}', '127.0.0.1', '2026-07-22 01:25:13'),
(5, 1, 'updated', NULL, NULL, 'Cập nhật cấu hình website', '{\"updated_keys\":[\"shop_name\",\"contact\",\"seo\",\"social_links\",\"embed_header\",\"embed_footer\",\"multilingual\",\"smtp\",\"favicon_url\"]}', '127.0.0.1', '2026-07-22 01:30:25'),
(6, 1, 'updated', NULL, NULL, 'Cập nhật cấu hình website', '{\"updated_keys\":[\"shop_name\",\"contact\",\"seo\",\"social_links\",\"embed_header\",\"embed_footer\",\"multilingual\",\"smtp\",\"favicon_url\"]}', '127.0.0.1', '2026-07-22 01:31:28'),
(7, 1, 'updated', NULL, NULL, 'Cập nhật cấu hình website', '{\"updated_keys\":[\"shop_name\",\"contact\",\"seo\",\"social_links\",\"embed_header\",\"embed_footer\",\"multilingual\",\"smtp\",\"favicon_url\"]}', '127.0.0.1', '2026-07-22 01:32:18'),
(8, 1, 'bulk_status_changed', NULL, NULL, 'Cập nhật trạng thái hàng loạt bài viết', '{\"model\":\"App\\\\Models\\\\Post\",\"ids\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\"],\"count\":15,\"is_active\":true}', '127.0.0.1', '2026-07-22 05:00:08'),
(9, 1, 'bulk_deleted', NULL, NULL, 'Xóa hàng loạt bài viết', '{\"model\":\"App\\\\Models\\\\Post\",\"ids\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\"],\"count\":15}', '127.0.0.1', '2026-07-22 05:00:21'),
(10, 1, 'bulk_deleted', NULL, NULL, 'Xóa hàng loạt banner', '{\"model\":\"App\\\\Models\\\\Banner\",\"ids\":[\"6\",\"7\"],\"count\":2}', '127.0.0.1', '2026-07-22 05:02:22'),
(11, 1, 'bulk_status_changed', NULL, NULL, 'Cập nhật trạng thái hàng loạt sản phẩm', '{\"model\":\"App\\\\Models\\\\Product\",\"ids\":[\"79\",\"20\",\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\"],\"count\":10,\"is_active\":false}', '127.0.0.1', '2026-07-22 09:59:01'),
(12, 1, 'bulk_status_changed', NULL, NULL, 'Cập nhật trạng thái hàng loạt sản phẩm', '{\"model\":\"App\\\\Models\\\\Product\",\"ids\":[\"79\",\"20\",\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\"],\"count\":10,\"is_active\":true}', '127.0.0.1', '2026-07-22 09:59:08'),
(13, 1, 'updated', NULL, NULL, 'Cập nhật cấu hình website', '{\"updated_keys\":[\"shop_name\",\"contact\",\"seo\",\"social_links\",\"embed_header\",\"embed_footer\",\"multilingual\",\"smtp\",\"favicon_url\"]}', '127.0.0.1', '2026-07-22 10:06:29'),
(14, 1, 'updated', 'App\\Models\\User', 1, 'Cập nhật tài khoản pductoandev@gmail.com', '{\"old\":{\"name\":\"Phan \\u0110\\u1ee9c To\\u00e0n\",\"email\":\"pductoandev@gmail.com\",\"role_id\":3,\"is_active\":true},\"new\":{\"name\":\"Phan \\u0110\\u1ee9c To\\u00e0n\",\"email\":\"pductoandev@gmail.com\",\"role_id\":\"3\",\"is_active\":true}}', '127.0.0.1', '2026-07-22 10:18:55'),
(15, 1, 'deleted', 'App\\Models\\User', 5, 'Xóa tài khoản pductoandevb@gmail.comv', '{\"old\":{\"name\":\"Phan \\u0110\\u1ee9c To\\u00e0n\",\"email\":\"pductoandevb@gmail.comv\",\"role_id\":null,\"is_active\":true}}', '127.0.0.1', '2026-07-22 10:19:09'),
(16, 1, 'deleted', 'App\\Models\\User', 7, 'Xóa tài khoản toanphan06vip@gmail.com', '{\"old\":{\"name\":\"Phan \\u0110\\u1ee9c To\\u00e0n\",\"email\":\"toanphan06vip@gmail.com\",\"role_id\":null,\"is_active\":true}}', '127.0.0.1', '2026-07-22 10:19:14'),
(17, 6, 'impersonated', 'App\\Models\\User', 6, 'Đăng nhập nhanh vào tài khoản toanphan01vip@gmail.com', NULL, '127.0.0.1', '2026-07-22 10:29:07'),
(18, 1, 'updated', 'App\\Models\\User', 1, 'Cập nhật tài khoản pductoandev@gmail.com', '{\"old\":{\"name\":\"Phan \\u0110\\u1ee9c To\\u00e0n\",\"email\":\"pductoandev@gmail.com\",\"role_id\":3,\"is_active\":true},\"new\":{\"name\":\"Phan \\u0110\\u1ee9c To\\u00e0n\",\"email\":\"pductoandev@gmail.com\",\"role_id\":\"3\",\"is_active\":true}}', '127.0.0.1', '2026-07-23 19:48:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `position` varchar(255) NOT NULL DEFAULT 'home_main',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `title`, `image_path`, `link_url`, `position`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'iPhone 15 Pro Max 256GB', 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=1200&h=600&q=80', '/category?cat=phone', 'home_main', 1, 1, '2026-07-09 19:59:57', '2026-07-09 19:59:57'),
(2, 'Galaxy S24 Ultra', 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?auto=format&fit=crop&w=1200&h=600&q=80', '/category?cat=phone', 'home_main', 2, 1, '2026-07-09 19:59:57', '2026-07-09 19:59:57'),
(3, 'MacBook Air M3 Đời Mới', 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=1200&h=600&q=80', '/category?cat=laptop', 'home_main', 3, 1, '2026-07-09 19:59:57', '2026-07-09 19:59:57'),
(4, 'Loa & Phụ Kiện Giảm 50%', 'https://images.unsplash.com/photo-1608156639585-b3a032ef9689?auto=format&fit=crop&w=1200&h=600&q=80', '/category?cat=phu-kien', 'home_main', 4, 1, '2026-07-09 19:59:57', '2026-07-09 19:59:57'),
(5, 'Smart TV 4K Màn Hình Lớn', 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?auto=format&fit=crop&w=1200&h=600&q=80', '/category?cat=phu-kien', 'home_main', 5, 1, '2026-07-09 19:59:57', '2026-07-09 19:59:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` varchar(255) NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `image_url` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `description`, `image_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '{\"vi\":\"A&O Corporation\"}', 'a-o-corporation', '{\"vi\":\"Thương hiệu vật liệu xây dựng hàng đầu\"}', NULL, 0, 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand_voucher`
--

CREATE TABLE `brand_voucher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-8f46c873bf2f85b0478cb0648d99e23a', 'i:1;', 1785212959),
('laravel-cache-8f46c873bf2f85b0478cb0648d99e23a:timer', 'i:1785212959;', 1785212959),
('laravel-cache-f308d141f8e743855287570e37f633ed', 'i:1;', 1785212959),
('laravel-cache-f308d141f8e743855287570e37f633ed:timer', 'i:1785212959;', 1785212959),
('laravel-cache-multilingual.admin_languages.v1', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;O:19:\"App\\Models\\Language\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"languages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:1;s:4:\"code\";s:2:\"vi\";s:4:\"name\";s:10:\"Vietnamese\";s:11:\"native_name\";s:14:\"Tiếng Việt\";s:8:\"regional\";s:5:\"vi_VN\";s:9:\"flag_path\";s:48:\"admin-assets/images/flag/Flag_of_Vietnam.svg.png\";s:9:\"is_active\";i:1;s:10:\"is_default\";i:1;s:19:\"is_content_fallback\";i:0;s:10:\"sort_order\";i:0;s:10:\"created_at\";s:19:\"2026-07-22 07:42:51\";s:10:\"updated_at\";s:19:\"2026-07-24 02:50:30\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:1;s:4:\"code\";s:2:\"vi\";s:4:\"name\";s:10:\"Vietnamese\";s:11:\"native_name\";s:14:\"Tiếng Việt\";s:8:\"regional\";s:5:\"vi_VN\";s:9:\"flag_path\";s:48:\"admin-assets/images/flag/Flag_of_Vietnam.svg.png\";s:9:\"is_active\";i:1;s:10:\"is_default\";i:1;s:19:\"is_content_fallback\";i:0;s:10:\"sort_order\";i:0;s:10:\"created_at\";s:19:\"2026-07-22 07:42:51\";s:10:\"updated_at\";s:19:\"2026-07-24 02:50:30\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"is_default\";s:7:\"boolean\";s:19:\"is_content_fallback\";s:7:\"boolean\";s:10:\"sort_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"code\";i:1;s:4:\"name\";i:2;s:11:\"native_name\";i:3;s:8:\"regional\";i:4;s:9:\"flag_path\";i:5;s:9:\"is_active\";i:6;s:10:\"is_default\";i:7;s:19:\"is_content_fallback\";i:8;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:19:\"App\\Models\\Language\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"languages\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:12:{s:2:\"id\";i:2;s:4:\"code\";s:2:\"en\";s:4:\"name\";s:7:\"English\";s:11:\"native_name\";s:7:\"English\";s:8:\"regional\";s:5:\"en_US\";s:9:\"flag_path\";s:41:\"admin-assets/images/flag/icon-flag-en.svg\";s:9:\"is_active\";i:1;s:10:\"is_default\";i:0;s:19:\"is_content_fallback\";i:1;s:10:\"sort_order\";i:10;s:10:\"created_at\";s:19:\"2026-07-22 07:42:51\";s:10:\"updated_at\";s:19:\"2026-07-24 02:50:30\";}s:11:\"\0*\0original\";a:12:{s:2:\"id\";i:2;s:4:\"code\";s:2:\"en\";s:4:\"name\";s:7:\"English\";s:11:\"native_name\";s:7:\"English\";s:8:\"regional\";s:5:\"en_US\";s:9:\"flag_path\";s:41:\"admin-assets/images/flag/icon-flag-en.svg\";s:9:\"is_active\";i:1;s:10:\"is_default\";i:0;s:19:\"is_content_fallback\";i:1;s:10:\"sort_order\";i:10;s:10:\"created_at\";s:19:\"2026-07-22 07:42:51\";s:10:\"updated_at\";s:19:\"2026-07-24 02:50:30\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:9:\"is_active\";s:7:\"boolean\";s:10:\"is_default\";s:7:\"boolean\";s:19:\"is_content_fallback\";s:7:\"boolean\";s:10:\"sort_order\";s:7:\"integer\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:9:{i:0;s:4:\"code\";i:1;s:4:\"name\";i:2;s:11:\"native_name\";i:3;s:8:\"regional\";i:4;s:9:\"flag_path\";i:5;s:9:\"is_active\";i:6;s:10:\"is_default\";i:7;s:19:\"is_content_fallback\";i:8;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1785213197),
('laravel-cache-multilingual.project_settings.v1', 'a:3:{s:7:\"enabled\";b:0;s:4:\"mode\";s:6:\"manual\";s:10:\"gtranslate\";a:5:{s:14:\"target_locales\";a:0:{}s:11:\"widget_look\";s:5:\"float\";s:8:\"position\";s:12:\"bottom_right\";s:23:\"detect_browser_language\";b:1;s:21:\"native_language_names\";b:1;}}', 1785213210);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` varchar(255) NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `meta_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_title`)),
  `meta_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_description`)),
  `image_url` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `show_on_homepage` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `image_url`, `sort_order`, `is_active`, `show_on_homepage`, `created_at`, `updated_at`) VALUES
(1, NULL, '{\"vi\":\"Vật liệu cách nhiệt\",\"en\":\"INSULATION\",\"ko\":\"단열재\"}', 'insulation', '{\"vi\":\"Các dòng vật liệu cách nhiệt, cách âm cao cấp phục vụ xây dựng xanh.\",\"en\":\"Premium thermal and acoustic insulation materials for green construction.\",\"ko\":\"친환경 건축을 위한 프리미엄 열 및 음향 단열재.\"}', NULL, NULL, '/images/categories/insulation.png', 4, 1, 1, '2026-07-17 07:58:20', '2026-07-23 20:06:47'),
(2, NULL, '{\"vi\":\"Hệ thống ngoài trời\",\"en\":\"EXTERIOR SYSTEM\",\"ko\":\"외장 시스템\"}', 'exterior-system', '{\"vi\":\"Vật liệu ốp lát trang trí mặt tiền, chống chịu thời tiết khắc nghiệt.\",\"en\":\"Cladding and decoration materials for exteriors, weather-resistant.\",\"ko\":\"기후 변화에 강한 외장용 마감 및 데코 자재.\"}', NULL, NULL, '/images/categories/exterior.png', 0, 1, 1, '2026-07-17 07:58:20', '2026-07-23 20:06:47'),
(3, NULL, '{\"vi\":\"Hệ thống trong nhà\",\"en\":\"INTERIOR SYSTEM\",\"ko\":\"내장 시스템\"}', 'interior-system', '{\"vi\":\"Giải pháp cách âm, tiêu âm, trang trí không gian trong nhà.\",\"en\":\"Acoustic, noise-reduction, and decoration solutions for indoor spaces.\",\"ko\":\"실내 공간을 위한 음향, 소음 감소 및 데코 솔루션.\"}', NULL, NULL, '/images/categories/interior.png', 3, 1, 1, '2026-07-17 07:58:20', '2026-07-23 20:06:47'),
(4, NULL, '{\"vi\":\"Chưa phân loại\",\"en\":\"Uncategorized\"}', 'chua-phan-loai', '{\"vi\":\"Danh mục mặc định cho các sản phẩm chưa được phân loại.\",\"en\":\"Default category for uncategorized products.\"}', NULL, NULL, NULL, 1, 1, 1, '2026-07-17 08:31:03', '2026-07-23 20:06:47'),
(16, NULL, '{\"vi\":\"Demo biến thể V2\",\"en\":\"Variant V2 demo\"}', 'demo-variant-v2', '{\"vi\":\"Danh mục dữ liệu mẫu để kiểm tra biến thể nâng cao.\",\"en\":\"Sample category for advanced variant testing.\"}', NULL, NULL, NULL, 2, 1, 1, '2026-07-18 06:53:00', '2026-07-23 20:06:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_voucher`
--

CREATE TABLE `category_voucher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `phone`, `email`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Phan Đức Toàn', '0916110241', 'pductoandevV@gmail.com', 'Tư vấn mua hàng (Surface, Phụ kiện)', 'Chào admin nha', 'read', '2026-07-09 20:45:46', '2026-07-09 20:46:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `value_type` varchar(255) NOT NULL DEFAULT 'boolean',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `features`
--

INSERT INTO `features` (`id`, `code`, `name`, `description`, `value_type`, `created_at`, `updated_at`) VALUES
(1, 'catalog', 'Catalog', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(2, 'cart', 'Cart', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(3, 'cod_order', 'COD Order', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(4, 'online_payment', 'Online Payment', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(5, 'voucher', 'Voucher', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(6, 'review', 'Review', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(7, 'zalo_oa', 'Zalo OA', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(8, 'cms_page', 'CMS Page', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(9, 'banner', 'Banner', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(10, 'menu', 'Menu', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(11, 'multi_admin', 'Multi Admin', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(12, 'inventory_log', 'Inventory Log', NULL, 'boolean', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(13, 'max_products', 'Max Products', NULL, 'number', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(14, 'max_admin_users', 'Max Admin Users', NULL, 'number', '2026-06-25 23:28:01', '2026-06-25 23:28:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feature_settings`
--

CREATE TABLE `feature_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_code` varchar(255) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `limit_value` varchar(255) DEFAULT NULL,
  `config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config`)),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `feature_settings`
--

INSERT INTO `feature_settings` (`id`, `feature_code`, `is_enabled`, `limit_value`, `config`, `updated_at`) VALUES
(1, 'catalog', 1, NULL, NULL, '2026-07-17 07:58:20'),
(2, 'cart', 1, NULL, NULL, '2026-07-17 07:58:20'),
(3, 'cod_order', 1, NULL, NULL, '2026-07-17 07:58:20'),
(4, 'online_payment', 1, NULL, NULL, '2026-07-17 07:58:20'),
(5, 'voucher', 1, NULL, NULL, '2026-07-17 07:58:20'),
(6, 'review', 1, NULL, NULL, '2026-07-17 07:58:20'),
(7, 'zalo_oa', 1, NULL, NULL, '2026-07-18 01:32:41'),
(8, 'cms_page', 1, NULL, NULL, '2026-07-17 07:58:20'),
(9, 'banner', 1, NULL, NULL, '2026-07-17 07:58:20'),
(10, 'menu', 1, NULL, NULL, '2026-07-17 07:58:20'),
(11, 'multi_admin', 1, NULL, NULL, '2026-07-17 07:58:20'),
(12, 'inventory_log', 1, NULL, NULL, '2026-07-17 07:58:20'),
(13, 'max_products', 1, '200', NULL, '2026-07-17 07:58:20'),
(14, 'max_admin_users', 1, '3', NULL, '2026-07-17 07:58:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inventory_movements`
--

CREATE TABLE `inventory_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(32) NOT NULL,
  `direction` varchar(8) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `product_stock_after` int(10) UNSIGNED DEFAULT NULL,
  `variant_stock_after` int(10) UNSIGNED DEFAULT NULL,
  `idempotency_key` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `inventory_movements`
--

INSERT INTO `inventory_movements` (`id`, `product_id`, `product_variant_id`, `order_id`, `order_item_id`, `action`, `direction`, `quantity`, `product_stock_after`, `variant_stock_after`, `idempotency_key`, `note`, `metadata`, `created_by`, `created_at`) VALUES
(3, 1, NULL, 1, 1, 'refund', 'in', 1, 101, NULL, 'order:1:item:1:refund:1', 'Hoàn kho theo hoàn tiền đơn hàng', '{\"order_number\":\"ORD-2026-0001\",\"sku\":\"AO-GWWF\"}', 1, '2026-07-18 06:18:04'),
(4, 2, NULL, 1, 2, 'refund', 'in', 1, 151, NULL, 'order:1:item:2:refund:1', 'Hoàn kho theo hoàn tiền đơn hàng', '{\"order_number\":\"ORD-2026-0001\",\"sku\":\"AO-GW\"}', 1, '2026-07-18 06:18:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `billing_date` date NOT NULL,
  `due_date` date NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `addon_code` varchar(255) DEFAULT NULL,
  `sepay_transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `package_name`, `amount`, `status`, `billing_date`, `due_date`, `payment_method`, `addon_code`, `sepay_transaction_id`, `created_at`, `updated_at`) VALUES
(1, 'INV-2026-001', 'Premium E-commerce Plan', 500000.00, 'paid', '2026-04-22', '2026-05-22', 'bank_transfer', NULL, NULL, '2026-06-25 23:28:00', '2026-06-25 23:28:00'),
(2, 'INV-2026-002', 'Premium E-commerce Plan', 500000.00, 'paid', '2026-05-22', '2026-06-22', 'bank_transfer', NULL, NULL, '2026-06-25 23:28:00', '2026-06-25 23:28:00'),
(3, 'INV-2026-003', 'Premium E-commerce Plan', 500000.00, 'pending', '2026-06-22', '2026-07-22', NULL, NULL, NULL, '2026-06-25 23:28:00', '2026-06-25 23:28:00'),
(4, 'INV-ADDON-6TJ03BKD', 'Addon: Kết nối API vận chuyển', 500000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'shipping_api', NULL, '2026-06-26 00:03:21', '2026-06-26 00:03:21'),
(5, 'INV-ADDON-MSX3NB8M', 'Addon: Cổng thanh toán quốc tế Stripe', 1500000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'stripe', NULL, '2026-06-26 00:04:24', '2026-06-26 00:04:24'),
(6, 'INV-ADDON-RWYHHJV5', 'Addon: Kết nối API vận chuyển', 500000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'shipping_api', NULL, '2026-06-26 00:09:52', '2026-06-26 00:09:52'),
(7, 'INV-ADDON-AQMUPBA8', 'Addon: Kết nối API vận chuyển', 500000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'shipping_api', NULL, '2026-06-26 00:11:06', '2026-06-26 00:11:06'),
(8, 'INV-ADDON-4TWLBXK8', 'Addon: Kết nối API vận chuyển', 500000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'shipping_api', NULL, '2026-06-26 00:11:09', '2026-06-26 00:11:09'),
(9, 'INV-ADDON-ONF7K1QQ', 'Addon: Tích hợp cổng thanh toán VNPAY', 1000000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'vnpay', NULL, '2026-06-26 00:11:41', '2026-06-26 00:11:41'),
(10, 'INV-ADDON-CSUP6RXJ', 'Addon: Kết nối API vận chuyển', 500000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'shipping_api', NULL, '2026-06-26 00:25:07', '2026-06-26 00:25:07'),
(11, 'INV-ADDON-HMGEJLGI', 'Addon: Kết nối API vận chuyển', 500000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'shipping_api', NULL, '2026-06-26 00:43:12', '2026-06-26 00:43:12'),
(12, 'INV-ADDON-GANOGVQM', 'Addon: Cổng thanh toán tự động Sepay', 800000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'sepay', NULL, '2026-06-26 00:43:41', '2026-06-26 00:43:41'),
(13, 'INV-ADDON-YCX07MTM', 'Addon: Kết nối API vận chuyển', 500000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'shipping_api', NULL, '2026-06-26 00:44:17', '2026-06-26 00:44:17'),
(14, 'INV-ADDON-DYTPXZRZ', 'Addon: Kết nối API vận chuyển', 500000.00, 'pending', '2026-06-26', '2026-07-03', 'sepay', 'shipping_api', NULL, '2026-06-26 00:44:23', '2026-06-26 00:44:23'),
(15, 'INV-ADDON-RH0H2MBE', 'Addon: Kết nối API vận chuyển', 500000.00, 'pending', '2026-06-29', '2026-07-06', 'sepay', 'shipping_api', NULL, '2026-06-28 19:10:29', '2026-06-28 19:10:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(16) NOT NULL,
  `name` varchar(100) NOT NULL,
  `native_name` varchar(100) NOT NULL,
  `regional` varchar(24) DEFAULT NULL,
  `flag_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_content_fallback` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `native_name`, `regional`, `flag_path`, `is_active`, `is_default`, `is_content_fallback`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'vi', 'Vietnamese', 'Tiếng Việt', 'vi_VN', 'admin-assets/images/flag/Flag_of_Vietnam.svg.png', 1, 1, 0, 0, '2026-07-22 00:42:51', '2026-07-23 19:50:30'),
(2, 'en', 'English', 'English', 'en_US', 'admin-assets/images/flag/icon-flag-en.svg', 1, 0, 1, 10, '2026-07-22 00:42:51', '2026-07-23 19:50:30'),
(3, 'zh', 'Chinese', '汉字', 'zh_CN', 'admin-assets/images/flag/flag-chinese.png', 0, 0, 0, 20, '2026-07-23 19:51:34', '2026-07-23 19:53:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `localized_slugs`
--

CREATE TABLE `localized_slugs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sluggable_type` varchar(120) NOT NULL,
  `sluggable_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(16) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `localized_slugs`
--

INSERT INTO `localized_slugs` (`id`, `sluggable_type`, `sluggable_id`, `locale`, `slug`, `is_current`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Product', 1, 'vi', 'glasswool-water-free', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(2, 'App\\Models\\Product', 1, 'en', 'glasswool-water-free', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(3, 'App\\Models\\Product', 2, 'vi', 'glasswool', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(4, 'App\\Models\\Product', 2, 'en', 'glasswool', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(5, 'App\\Models\\Product', 3, 'vi', 'ceramic-wool', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(6, 'App\\Models\\Product', 3, 'en', 'ceramic-wool', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(7, 'App\\Models\\Product', 4, 'vi', 'mineral-wool', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(8, 'App\\Models\\Product', 4, 'en', 'mineral-wool', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(9, 'App\\Models\\Product', 5, 'vi', 'isopink', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(10, 'App\\Models\\Product', 5, 'en', 'isopink', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(11, 'App\\Models\\Product', 6, 'vi', 'bace-panel', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(12, 'App\\Models\\Product', 6, 'en', 'bace-panel', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(13, 'App\\Models\\Product', 7, 'vi', 'green-bace-panel', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(14, 'App\\Models\\Product', 7, 'en', 'green-bace-panel', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(15, 'App\\Models\\Product', 8, 'vi', 'ventwall', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(16, 'App\\Models\\Product', 8, 'en', 'ventwall', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(17, 'App\\Models\\Product', 20, 'vi', 'legacy-orphan-skus-20', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(18, 'App\\Models\\Product', 20, 'en', 'unmatched-legacy-sku-data-20', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(19, 'App\\Models\\Product', 79, 'vi', 'ao-khoac-outdoor-variant-v2-demo', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(20, 'App\\Models\\Product', 79, 'en', 'four-season-outdoor-jacket-variant-v2-demo', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(21, 'App\\Models\\Category', 1, 'vi', 'insulation', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(22, 'App\\Models\\Category', 1, 'en', 'insulation', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(23, 'App\\Models\\Category', 2, 'vi', 'exterior-system', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(24, 'App\\Models\\Category', 2, 'en', 'exterior-system', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(25, 'App\\Models\\Category', 3, 'vi', 'interior-system', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(26, 'App\\Models\\Category', 3, 'en', 'interior-system', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(27, 'App\\Models\\Category', 4, 'vi', 'chua-phan-loai', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(28, 'App\\Models\\Category', 4, 'en', 'uncategorized', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(29, 'App\\Models\\Category', 16, 'vi', 'demo-variant-v2', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(30, 'App\\Models\\Category', 16, 'en', 'variant-v2-demo', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(31, 'App\\Models\\Brand', 1, 'vi', 'a-o-corporation', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(62, 'App\\Models\\Post', 16, 'vi', 'bai-viet-tin-tuc-so-16', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(63, 'App\\Models\\Post', 16, 'en', 'news-post-number-16', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(64, 'App\\Models\\Post', 17, 'vi', 'bai-viet-tin-tuc-so-17', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(65, 'App\\Models\\Post', 17, 'en', 'news-post-number-17', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(66, 'App\\Models\\Post', 18, 'vi', 'bai-viet-tin-tuc-so-18', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(67, 'App\\Models\\Post', 18, 'en', 'news-post-number-18', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(68, 'App\\Models\\Post', 19, 'vi', 'bai-viet-tin-tuc-so-19', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(69, 'App\\Models\\Post', 19, 'en', 'news-post-number-19', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(70, 'App\\Models\\Post', 20, 'vi', 'bai-viet-tin-tuc-so-20', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(71, 'App\\Models\\Post', 20, 'en', 'news-post-number-20', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(72, 'App\\Models\\Post', 21, 'vi', 'bai-viet-tin-tuc-so-21', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(73, 'App\\Models\\Post', 21, 'en', 'news-post-number-21', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(74, 'App\\Models\\Post', 22, 'vi', 'bai-viet-tin-tuc-so-22', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(75, 'App\\Models\\Post', 22, 'en', 'news-post-number-22', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(76, 'App\\Models\\Post', 23, 'vi', 'bai-viet-tin-tuc-so-23', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(77, 'App\\Models\\Post', 23, 'en', 'news-post-number-23', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(78, 'App\\Models\\Post', 24, 'vi', 'bai-viet-tin-tuc-so-24', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(79, 'App\\Models\\Post', 24, 'en', 'news-post-number-24', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(80, 'App\\Models\\Post', 25, 'vi', 'bai-viet-tin-tuc-so-25', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(81, 'App\\Models\\Post', 25, 'en', 'news-post-number-25', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(82, 'App\\Models\\Post', 26, 'vi', 'bai-viet-tin-tuc-so-26', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(83, 'App\\Models\\Post', 26, 'en', 'news-post-number-26', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(84, 'App\\Models\\Post', 27, 'vi', 'bai-viet-tin-tuc-so-27', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(85, 'App\\Models\\Post', 27, 'en', 'news-post-number-27', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(86, 'App\\Models\\Post', 28, 'vi', 'bai-viet-tin-tuc-so-28', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(87, 'App\\Models\\Post', 28, 'en', 'news-post-number-28', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(88, 'App\\Models\\PostCategory', 1, 'vi', 'tin-tuc', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(89, 'App\\Models\\PostCategory', 1, 'en', 'news', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(90, 'App\\Models\\PostCategory', 2, 'vi', 'huong-dan', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(91, 'App\\Models\\PostCategory', 2, 'en', 'guides', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(92, 'App\\Models\\PostCategory', 3, 'vi', 'danh-gia', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(93, 'App\\Models\\PostCategory', 3, 'en', 'reviews', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(94, 'App\\Models\\PostCategory', 4, 'vi', 'tin-tuc-trong-nuoc', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(95, 'App\\Models\\PostCategory', 4, 'en', 'domestic-news', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(96, 'App\\Models\\PostCategory', 5, 'vi', 'tin-tuc-quoc-te', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(97, 'App\\Models\\PostCategory', 5, 'en', 'international-news', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(98, 'App\\Models\\PostCategory', 6, 'vi', 'huong-dan-ky-thuat', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(99, 'App\\Models\\PostCategory', 6, 'en', 'technical-guides', 1, '2026-07-22 00:42:51', '2026-07-22 00:42:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_22_150000_create_packages_table', 1),
(5, '2026_06_22_150001_create_features_table', 1),
(6, '2026_06_22_150002_create_roles_table', 1),
(7, '2026_06_22_150003_create_package_features_table', 1),
(8, '2026_06_22_150004_create_project_subscription_table', 1),
(9, '2026_06_22_150005_create_feature_settings_table', 1),
(10, '2026_06_22_150006_create_project_settings_table', 1),
(11, '2026_06_22_150007_add_admin_fields_to_users_table', 1),
(12, '2026_06_23_075727_create_personal_access_tokens_table', 1),
(13, '2026_06_23_160000_create_categories_table', 1),
(14, '2026_06_23_160001_create_products_table', 1),
(15, '2026_06_23_160002_create_product_variants_table', 1),
(16, '2026_06_25_122139_create_superadmin_role_and_assign_to_admin', 1),
(17, '2026_06_25_124435_create_invoices_table', 1),
(18, '2026_06_25_160000_create_brands_table', 1),
(19, '2026_06_25_160001_add_brand_id_to_products_table', 1),
(20, '2026_06_25_220000_create_orders_and_order_items_tables', 1),
(21, '2026_06_25_230000_create_post_categories_table', 1),
(22, '2026_06_25_230001_create_posts_table', 1),
(23, '2026_06_25_231000_add_parent_id_to_post_categories_table', 1),
(24, '2026_06_25_240000_create_vouchers_table', 1),
(25, '2026_06_25_250000_create_reviews_table', 1),
(26, '2026_06_25_260000_add_shipping_fields_to_orders_table', 1),
(27, '2026_06_25_260000_create_user_addresses_table', 1),
(28, '2026_06_26_101000_create_shipping_partners_table', 1),
(29, '2026_06_26_105000_create_payment_methods_table', 1),
(30, '2026_06_26_132000_create_addons_table', 1),
(31, '2026_06_26_072931_create_banners_table', 2),
(32, '2026_06_29_090000_add_images_to_products_table', 3),
(33, '2026_07_07_000000_add_product_scope_to_vouchers_table', 4),
(34, '2026_07_07_000001_extend_vouchers_for_reusable_promotions', 4),
(35, '2026_07_07_000002_add_advanced_promotion_fields_to_vouchers', 4),
(36, '2026_07_07_000003_move_superadmin_role_to_env', 4),
(37, '2026_07_10_020958_create_contact_messages_table', 5),
(38, '2026_07_10_031701_add_views_to_posts_table', 6),
(39, '2026_07_10_031933_add_phone_to_users_table', 7),
(40, '2026_07_10_033027_add_special_promotion_to_products_table', 8),
(41, '2026_07_10_035543_add_flash_sale_fields_to_products_table', 9),
(42, '2026_07_10_040649_add_show_on_homepage_to_categories_table', 10),
(43, '2026_07_10_050000_create_revoked_tokens_table', 11),
(44, '2026_07_18_000000_encrypt_sensitive_settings', 12),
(45, '2026_07_18_010000_create_permissions_and_harden_system_roles', 12),
(46, '2026_07_18_020000_create_admin_activity_logs_table', 12),
(47, '2026_07_18_030000_create_order_lifecycle_tables', 12),
(48, '2026_07_18_040000_create_inventory_movements_table', 13),
(49, '2026_07_18_050000_create_payment_transactions_table', 13),
(50, '2026_07_18_060000_add_seo_fields_to_catalog', 14),
(51, '2026_07_18_070000_replace_legacy_product_variants_with_v2', 15),
(52, '2026_07_18_080000_create_promotions_and_snapshot_order_discounts', 16),
(53, '2026_07_22_000000_add_shipping_status_to_orders_table', 17),
(54, '2026_07_22_010000_remove_wildcard_from_non_system_roles', 18),
(55, '2026_07_22_020000_add_carrier_fee_and_webhook_events', 18),
(56, '2026_07_22_030000_create_multilingual_foundation', 19);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `locale` varchar(16) NOT NULL DEFAULT 'vi',
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `shipping_address` text NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `shipping_carrier` varchar(255) DEFAULT NULL,
  `shipping_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `carrier_shipping_fee` decimal(15,2) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `shipping_status` varchar(255) NOT NULL DEFAULT 'not_shipped',
  `shipping_status_updated_at` timestamp NULL DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `subtotal` decimal(15,2) NOT NULL,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `promotion_discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(15,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `locale`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `payment_method`, `shipping_carrier`, `shipping_fee`, `carrier_shipping_fee`, `tracking_number`, `shipping_status`, `shipping_status_updated_at`, `payment_status`, `status`, `subtotal`, `discount`, `promotion_discount`, `grand_total`, `notes`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ORD-2026-0001', 'vi', 'Lê Hoàng Châu', 'chau.le@example.com', '0905123456', '34 Hùng Vương, Nha Trang, Khánh Hòa', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'partially_refunded', 'pending', 4400000.00, 0.00, 0.00, 4400000.00, NULL, '2026-07-16 06:58:20', '2026-07-18 06:18:04'),
(2, NULL, 'ORD-2026-0002', 'vi', 'Trần Thị Bình', 'binh.tran@example.com', '0987654321', '123 Đường Láng, Đống Đa, Hà Nội', 'online', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'completed', 3030000.00, 0.00, 0.00, 3030000.00, NULL, '2026-07-15 05:58:20', '2026-07-17 07:58:20'),
(3, NULL, 'ORD-2026-0003', 'vi', 'Lý Kim Chi', 'chi.ly@example.com', '0858123456', '34 Hùng Vương, Nha Trang, Khánh Hòa', 'online', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'processing', 4690000.00, 0.00, 0.00, 4690000.00, 'Giao hàng giờ hành chính giúp em.', '2026-07-14 04:58:20', '2026-07-17 07:58:20'),
(4, NULL, 'ORD-2026-0004', 'vi', 'Nguyễn Văn An', 'an.nguyen@example.com', '0912345678', '789 Trần Hưng Đạo, Ninh Kiều, Cần Thơ', 'bank_transfer', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'pending', 3850000.00, 0.00, 0.00, 3850000.00, NULL, '2026-07-13 03:58:20', '2026-07-17 07:58:20'),
(5, NULL, 'ORD-2026-0005', 'vi', 'Phạm Minh Đức', 'duc.pham@example.com', '0934567890', '56 Quang Trung, Hồng Bàng, Hải Phòng', 'online', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'pending', 890000.00, 50000.00, 0.00, 840000.00, NULL, '2026-07-12 02:58:20', '2026-07-17 07:58:20'),
(6, NULL, 'ORD-2026-0006', 'vi', 'Lê Hoàng Châu', 'chau.le@example.com', '0905123456', '12 Lê Lợi, Hải Châu, Đà Nẵng', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'processing', 6360000.00, 0.00, 0.00, 6360000.00, 'Giao hàng giờ hành chính giúp em.', '2026-07-11 01:58:20', '2026-07-17 07:58:20'),
(7, NULL, 'ORD-2026-0007', 'vi', 'Nguyễn Văn An', 'an.nguyen@example.com', '0912345678', '12 Lê Lợi, Hải Châu, Đà Nẵng', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'processing', 3390000.00, 0.00, 0.00, 3390000.00, NULL, '2026-07-10 00:58:20', '2026-07-17 07:58:20'),
(8, NULL, 'ORD-2026-0008', 'vi', 'Hoàng Anh Tuấn', 'tuan.hoang@example.com', '0978123456', '34 Hùng Vương, Nha Trang, Khánh Hòa', 'online', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'cancelled', 3150000.00, 0.00, 0.00, 3150000.00, NULL, '2026-07-08 23:58:20', '2026-07-17 07:58:20'),
(9, NULL, 'ORD-2026-0009', 'vi', 'Nguyễn Văn An', 'an.nguyen@example.com', '0912345678', '34 Hùng Vương, Nha Trang, Khánh Hòa', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'cancelled', 3860000.00, 0.00, 0.00, 3860000.00, 'Giao hàng giờ hành chính giúp em.', '2026-07-07 22:58:20', '2026-07-17 07:58:20'),
(10, NULL, 'ORD-2026-0010', 'vi', 'Vũ Quốc Khánh', 'khanh.vu@example.com', '0967890123', '56 Quang Trung, Hồng Bàng, Hải Phòng', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'processing', 4650000.00, 50000.00, 0.00, 4600000.00, NULL, '2026-07-06 21:58:20', '2026-07-17 07:58:20'),
(11, NULL, 'ORD-2026-0011', 'vi', 'Hoàng Anh Tuấn', 'tuan.hoang@example.com', '0978123456', '789 Trần Hưng Đạo, Ninh Kiều, Cần Thơ', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'pending', 4730000.00, 0.00, 0.00, 4730000.00, NULL, '2026-07-05 20:58:20', '2026-07-17 07:58:20'),
(12, NULL, 'ORD-2026-0012', 'vi', 'Lý Kim Chi', 'chi.ly@example.com', '0858123456', '56 Quang Trung, Hồng Bàng, Hải Phòng', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'cancelled', 6350000.00, 0.00, 0.00, 6350000.00, 'Giao hàng giờ hành chính giúp em.', '2026-07-04 19:58:20', '2026-07-17 07:58:20'),
(13, NULL, 'ORD-2026-0013', 'vi', 'Đặng Ngọc Lan', 'lan.dang@example.com', '0945678901', '456 Nguyễn Thị Minh Khai, Quận 3, TP. Hồ Chí Minh', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'pending', 1360000.00, 0.00, 0.00, 1360000.00, NULL, '2026-07-03 18:58:20', '2026-07-17 07:58:20'),
(14, NULL, 'ORD-2026-0014', 'vi', 'Hoàng Anh Tuấn', 'tuan.hoang@example.com', '0978123456', '78 Hoàng Văn Thụ, Thái Nguyên', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'completed', 680000.00, 0.00, 0.00, 680000.00, NULL, '2026-07-02 17:58:20', '2026-07-17 07:58:20'),
(15, NULL, 'ORD-2026-0015', 'vi', 'Ngô Hồng Sơn', 'son.ngo@example.com', '0868123456', '78 Hoàng Văn Thụ, Thái Nguyên', 'online', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'processing', 1900000.00, 50000.00, 0.00, 1850000.00, 'Giao hàng giờ hành chính giúp em.', '2026-07-01 16:58:20', '2026-07-17 07:58:20'),
(16, NULL, 'ORD-2026-0016', 'vi', 'Phạm Minh Đức', 'duc.pham@example.com', '0934567890', '56 Quang Trung, Hồng Bàng, Hải Phòng', 'bank_transfer', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'completed', 1570000.00, 0.00, 0.00, 1570000.00, NULL, '2026-06-30 15:58:20', '2026-07-17 07:58:20'),
(17, NULL, 'ORD-2026-0017', 'vi', 'Ngô Hồng Sơn', 'son.ngo@example.com', '0868123456', '12 Lê Lợi, Hải Châu, Đà Nẵng', 'bank_transfer', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'processing', 8250000.00, 0.00, 0.00, 8250000.00, NULL, '2026-06-29 14:58:20', '2026-07-17 07:58:20'),
(18, NULL, 'ORD-2026-0018', 'vi', 'Hoàng Anh Tuấn', 'tuan.hoang@example.com', '0978123456', '789 Trần Hưng Đạo, Ninh Kiều, Cần Thơ', 'bank_transfer', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'processing', 1880000.00, 0.00, 0.00, 1880000.00, 'Giao hàng giờ hành chính giúp em.', '2026-06-28 13:58:20', '2026-07-17 07:58:20'),
(19, NULL, 'ORD-2026-0019', 'vi', 'Bùi Tuyết Mai', 'mai.bui@example.com', '0898765432', '34 Hùng Vương, Nha Trang, Khánh Hòa', 'bank_transfer', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'completed', 5150000.00, 0.00, 0.00, 5150000.00, NULL, '2026-06-27 12:58:20', '2026-07-17 07:58:20'),
(20, NULL, 'ORD-2026-0020', 'vi', 'Hoàng Anh Tuấn', 'tuan.hoang@example.com', '0978123456', '34 Hùng Vương, Nha Trang, Khánh Hòa', 'bank_transfer', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'completed', 1250000.00, 50000.00, 0.00, 1200000.00, NULL, '2026-06-26 11:58:20', '2026-07-17 07:58:20'),
(21, NULL, 'ORD-2026-0021', 'vi', 'Đỗ Thanh Hải', 'hai.do@example.com', '0888123456', '12 Lê Lợi, Hải Châu, Đà Nẵng', 'online', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'pending', 4800000.00, 0.00, 0.00, 4800000.00, 'Giao hàng giờ hành chính giúp em.', '2026-06-25 10:58:20', '2026-07-17 07:58:20'),
(22, NULL, 'ORD-2026-0022', 'vi', 'Lê Hoàng Châu', 'chau.le@example.com', '0905123456', '456 Nguyễn Thị Minh Khai, Quận 3, TP. Hồ Chí Minh', 'online', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'pending', 'cancelled', 1900000.00, 0.00, 0.00, 1900000.00, NULL, '2026-06-24 09:58:20', '2026-07-17 07:58:20'),
(23, NULL, 'ORD-2026-0023', 'vi', 'Nguyễn Văn An', 'an.nguyen@example.com', '0912345678', '12 Lê Lợi, Hải Châu, Đà Nẵng', 'bank_transfer', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'completed', 950000.00, 0.00, 0.00, 950000.00, NULL, '2026-06-23 08:58:20', '2026-07-17 07:58:20'),
(24, NULL, 'ORD-2026-0024', 'vi', 'Lê Hoàng Châu', 'chau.le@example.com', '0905123456', '56 Quang Trung, Hồng Bàng, Hải Phòng', 'cod', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'cancelled', 2990000.00, 0.00, 0.00, 2990000.00, 'Giao hàng giờ hành chính giúp em.', '2026-06-22 07:58:20', '2026-07-17 07:58:20'),
(25, NULL, 'ORD-2026-0025', 'vi', 'Hoàng Anh Tuấn', 'tuan.hoang@example.com', '0978123456', '78 Hoàng Văn Thụ, Thái Nguyên', 'online', NULL, 0.00, NULL, NULL, 'not_shipped', NULL, 'paid', 'pending', 3280000.00, 50000.00, 0.00, 3230000.00, NULL, '2026-06-21 06:58:20', '2026-07-17 07:58:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `promotion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `variant_name` varchar(255) DEFAULT NULL,
  `promotion_name` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `original_price` decimal(15,2) DEFAULT NULL,
  `promotion_discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `total` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_variant_id`, `promotion_id`, `product_name`, `variant_name`, `promotion_name`, `sku`, `price`, `original_price`, `promotion_discount`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 2, 2500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(2, 1, 2, NULL, NULL, 'GLASSWOOL', NULL, NULL, 'AO-GW', 950000.00, NULL, 0.00, 2, 1900000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(3, 2, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 1, 1250000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(4, 2, 8, NULL, NULL, 'VENTWALL', NULL, NULL, 'AO-VW', 890000.00, NULL, 0.00, 2, 1780000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(5, 3, 4, NULL, NULL, 'MINERAL WOOL', NULL, NULL, 'AO-MW', 1550000.00, NULL, 0.00, 1, 1550000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(6, 3, 6, NULL, NULL, 'BACE PANEL', NULL, NULL, 'AO-BP', 680000.00, NULL, 0.00, 2, 1360000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(7, 3, 8, NULL, NULL, 'VENTWALL', NULL, NULL, 'AO-VW', 890000.00, NULL, 0.00, 2, 1780000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(8, 4, 4, NULL, NULL, 'MINERAL WOOL', NULL, NULL, 'AO-MW', 1550000.00, NULL, 0.00, 2, 3100000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(9, 4, 7, NULL, NULL, 'GREEN BACE PANEL', NULL, NULL, 'AO-GBP', 750000.00, NULL, 0.00, 1, 750000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(10, 5, 8, NULL, NULL, 'VENTWALL', NULL, NULL, 'AO-VW', 890000.00, NULL, 0.00, 1, 890000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(11, 6, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 2, 2500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(12, 6, 4, NULL, NULL, 'MINERAL WOOL', NULL, NULL, 'AO-MW', 1550000.00, NULL, 0.00, 2, 3100000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(13, 6, 5, NULL, NULL, 'ISOPINK', NULL, NULL, 'AO-IP', 380000.00, NULL, 0.00, 2, 760000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(14, 7, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 2, 2500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(15, 7, 8, NULL, NULL, 'VENTWALL', NULL, NULL, 'AO-VW', 890000.00, NULL, 0.00, 1, 890000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(16, 8, 3, NULL, NULL, 'CERAMIC WOOL', NULL, NULL, 'AO-CW', 2400000.00, NULL, 0.00, 1, 2400000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(17, 8, 7, NULL, NULL, 'GREEN BACE PANEL', NULL, NULL, 'AO-GBP', 750000.00, NULL, 0.00, 1, 750000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(18, 9, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 2, 2500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(19, 9, 6, NULL, NULL, 'BACE PANEL', NULL, NULL, 'AO-BP', 680000.00, NULL, 0.00, 2, 1360000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(20, 10, 3, NULL, NULL, 'CERAMIC WOOL', NULL, NULL, 'AO-CW', 2400000.00, NULL, 0.00, 1, 2400000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(21, 10, 6, NULL, NULL, 'BACE PANEL', NULL, NULL, 'AO-BP', 680000.00, NULL, 0.00, 2, 1360000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(22, 10, 8, NULL, NULL, 'VENTWALL', NULL, NULL, 'AO-VW', 890000.00, NULL, 0.00, 1, 890000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(23, 11, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 2, 2500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(24, 11, 4, NULL, NULL, 'MINERAL WOOL', NULL, NULL, 'AO-MW', 1550000.00, NULL, 0.00, 1, 1550000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(25, 11, 6, NULL, NULL, 'BACE PANEL', NULL, NULL, 'AO-BP', 680000.00, NULL, 0.00, 1, 680000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(26, 12, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 2, 2500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(27, 12, 4, NULL, NULL, 'MINERAL WOOL', NULL, NULL, 'AO-MW', 1550000.00, NULL, 0.00, 2, 3100000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(28, 12, 7, NULL, NULL, 'GREEN BACE PANEL', NULL, NULL, 'AO-GBP', 750000.00, NULL, 0.00, 1, 750000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(29, 13, 6, NULL, NULL, 'BACE PANEL', NULL, NULL, 'AO-BP', 680000.00, NULL, 0.00, 2, 1360000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(30, 14, 6, NULL, NULL, 'BACE PANEL', NULL, NULL, 'AO-BP', 680000.00, NULL, 0.00, 1, 680000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(31, 15, 2, NULL, NULL, 'GLASSWOOL', NULL, NULL, 'AO-GW', 950000.00, NULL, 0.00, 2, 1900000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(32, 16, 6, NULL, NULL, 'BACE PANEL', NULL, NULL, 'AO-BP', 680000.00, NULL, 0.00, 1, 680000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(33, 16, 8, NULL, NULL, 'VENTWALL', NULL, NULL, 'AO-VW', 890000.00, NULL, 0.00, 1, 890000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(34, 17, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 2, 2500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(35, 17, 2, NULL, NULL, 'GLASSWOOL', NULL, NULL, 'AO-GW', 950000.00, NULL, 0.00, 1, 950000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(36, 17, 3, NULL, NULL, 'CERAMIC WOOL', NULL, NULL, 'AO-CW', 2400000.00, NULL, 0.00, 2, 4800000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(37, 18, 5, NULL, NULL, 'ISOPINK', NULL, NULL, 'AO-IP', 380000.00, NULL, 0.00, 1, 380000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(38, 18, 7, NULL, NULL, 'GREEN BACE PANEL', NULL, NULL, 'AO-GBP', 750000.00, NULL, 0.00, 2, 1500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(39, 19, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 1, 1250000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(40, 19, 3, NULL, NULL, 'CERAMIC WOOL', NULL, NULL, 'AO-CW', 2400000.00, NULL, 0.00, 1, 2400000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(41, 19, 7, NULL, NULL, 'GREEN BACE PANEL', NULL, NULL, 'AO-GBP', 750000.00, NULL, 0.00, 2, 1500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(42, 20, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 1, 1250000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(43, 21, 3, NULL, NULL, 'CERAMIC WOOL', NULL, NULL, 'AO-CW', 2400000.00, NULL, 0.00, 2, 4800000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(44, 22, 2, NULL, NULL, 'GLASSWOOL', NULL, NULL, 'AO-GW', 950000.00, NULL, 0.00, 2, 1900000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(45, 23, 2, NULL, NULL, 'GLASSWOOL', NULL, NULL, 'AO-GW', 950000.00, NULL, 0.00, 1, 950000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(46, 24, 1, NULL, NULL, 'GLASSWOOL WATER FREE', NULL, NULL, 'AO-GWWF', 1250000.00, NULL, 0.00, 1, 1250000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(47, 24, 5, NULL, NULL, 'ISOPINK', NULL, NULL, 'AO-IP', 380000.00, NULL, 0.00, 1, 380000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(48, 24, 6, NULL, NULL, 'BACE PANEL', NULL, NULL, 'AO-BP', 680000.00, NULL, 0.00, 2, 1360000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(49, 25, 7, NULL, NULL, 'GREEN BACE PANEL', NULL, NULL, 'AO-GBP', 750000.00, NULL, 0.00, 2, 1500000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(50, 25, 8, NULL, NULL, 'VENTWALL', NULL, NULL, 'AO-VW', 890000.00, NULL, 0.00, 2, 1780000.00, '2026-07-17 07:58:20', '2026-07-17 07:58:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_refunds`
--

CREATE TABLE `order_refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'partial',
  `reason` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_refunds`
--

INSERT INTO `order_refunds` (`id`, `order_id`, `amount`, `type`, `reason`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2200000.00, 'partial', NULL, 1, '2026-07-18 06:18:04', '2026-07-18 06:18:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_refund_items`
--

CREATE TABLE `order_refund_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_refund_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_refund_items`
--

INSERT INTO `order_refund_items` (`id`, `order_refund_id`, `order_item_id`, `quantity`, `amount`) VALUES
(1, 1, 1, 1, 1250000.00),
(2, 1, 2, 1, 950000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_status_histories`
--

CREATE TABLE `order_status_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `from_status` varchar(255) DEFAULT NULL,
  `to_status` varchar(255) NOT NULL,
  `from_payment_status` varchar(255) DEFAULT NULL,
  `to_payment_status` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `changed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_status_histories`
--

INSERT INTO `order_status_histories` (`id`, `order_id`, `from_status`, `to_status`, `from_payment_status`, `to_payment_status`, `note`, `changed_by`, `created_at`) VALUES
(8, 1, 'pending', 'pending', 'paid', 'partially_refunded', 'Hoàn tiền', 1, '2026-07-18 06:18:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `packages`
--

INSERT INTO `packages` (`id`, `code`, `name`, `price`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'basic_2m', 'Basic 2M', 2000000.00, 'Basic ecommerce package.', 1, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(2, 'standard_4m', 'Standard 4M', 4000000.00, 'Standard ecommerce package.', 1, '2026-06-25 23:28:01', '2026-06-25 23:28:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `package_features`
--

CREATE TABLE `package_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `limit_value` varchar(255) DEFAULT NULL,
  `config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `package_features`
--

INSERT INTO `package_features` (`id`, `package_id`, `feature_id`, `is_enabled`, `limit_value`, `config`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(2, 1, 2, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(3, 1, 3, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(4, 1, 4, 0, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(5, 1, 5, 0, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(6, 1, 6, 0, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(7, 1, 7, 0, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(8, 1, 8, 0, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(9, 1, 9, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(10, 1, 10, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(11, 1, 11, 0, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(12, 1, 12, 0, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(13, 1, 13, 1, '50', NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(14, 1, 14, 1, '1', NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(15, 2, 1, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(16, 2, 2, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(17, 2, 3, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(18, 2, 4, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(19, 2, 5, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(20, 2, 6, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(21, 2, 7, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(22, 2, 8, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(23, 2, 9, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(24, 2, 10, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(25, 2, 11, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(26, 2, 12, 1, NULL, NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(27, 2, 13, 1, '200', NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(28, 2, 14, 1, '3', NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('pductoandev@gmail.com', '$2y$12$dWLM4c27pNEcoloZDcJBJ.yUIp6qAylBIfUQuIF.pIJzMupMWbOGK', '2026-07-22 00:20:45'),
('toanphan01vip@gmail.com', '$2y$12$ARfz/lmKWBp5RVHSiGSMvObPc4DCCdmvzFbQ539kl40wyplFqGh6S', '2026-07-08 01:27:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'custom',
  `status` varchar(255) NOT NULL DEFAULT 'inactive',
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`)),
  `logo_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_code`, `name`, `account_name`, `type`, `status`, `settings`, `logo_url`, `created_at`, `updated_at`) VALUES
(1, 'cod', 'Thanh toán khi nhận hàng (COD)', 'Cash on Delivery', 'custom', 'active', '\"eyJpdiI6ImgrTGM3QXNrdzNiYWg0dlIzT0NPNEE9PSIsInZhbHVlIjoidjNrNWk2aGRZRlRzWURzRGRkTWJuNGRZdW9uTE1TN0wyRHZ1dHBPeWl2TzNXL1g1S0ErVFBrY3lQbGJWWllSdFBqVENyVXM3elhXZ3ptcm9aN2ZsVXQ1Y0JOU2RjR1NzTDMrY1dwTEpRaDNhN1RVVS9tMmhPUTUya1VyazJnakciLCJtYWMiOiI1NDRiMTljNjUxZDMyM2Y1ZTg4ZmU0YjAxM2UyZmQzMGExNTNiZDk1YjY3NjFjNWI5Y2U5ZWFmNDczZWE4MjJiIiwidGFnIjoiIn0=\"', NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(2, 'bank_transfer', 'Chuyển khoản ngân hàng', NULL, 'custom', 'inactive', '\"eyJpdiI6IkJhZVBWemVFMHhta24rcnpuWUZONUE9PSIsInZhbHVlIjoiUFREU1ZnemlVMkxSeFlKdjlTRU9qZnhqZ0N0UGdKdTV6TlJ1TzhNR0dQK29XbTZobFNwcHNramNyaGw2RkQzNW9KeVJ4WTZ2QWNPUDhXSWx5VCtmOEN3TVZML0o3bmd1VmY0ZGRmWTdOSU50eFZ5K2lHTUw5NUM4b3ozZEw1Y3YrSGYvaUhjVWVWeDVxY2U2M2dDR1NRL2w0d3I2YktkemUxWTg5Ui9QbWN3TkRBTUZmc1F2bjR1S1pRcWRtMW1BSHpTTGFxbEpUb0NKMDJmMnlHSmdXaThHUWY0akFhWUhDakpBTG9OZVNwY2xwdk9keDd6VUtRVTVTdmlPb0x2OU5Hbk80YXhkREtFb1lXZk5EUGZsNTdpeGMzL3Q5NHNOSzZLSDNJY3RLVk11Z3FFcGloYjg4V0U2WjdCOVliOHlOOEN3amJ2azlaYUJSRnhGWStYc2pnPT0iLCJtYWMiOiJjNjhkOTMzNzQ1MmUyZDQ5MmRkNmY4ZmY2YjY5YjE0OWI3MmEzOTE1OTQ4ZDY5NDExZGY2MTYzY2E3ZTRlMmVhIiwidGFnIjoiIn0=\"', NULL, '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(3, 'sepay', 'Cổng thanh toán tự động Sepay', NULL, 'connected', 'inactive', '\"eyJpdiI6ImhQZElKdm9UK0JEZG82ZXBhc1hpTnc9PSIsInZhbHVlIjoiVHUzamRmZWxhVUlnR01IS3pqTktLN1VqSWRqbDVzQzFaRktPODREdUh2dlllM1JyMTk3SlVNT2MxTHRFT0JsViIsIm1hYyI6ImYzMzg2ZTY2ODVhODRkZjJlNzI4NjcwNWY4Njk4ZmEzZjI2MGZkN2UyNzFjMTQ1ZGYwNzM5MTNlOGFkNWE3ZDMiLCJ0YWciOiIifQ==\"', 'sepay-logo.png', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(4, 'stripe', 'Cổng thanh toán quốc tế Stripe', NULL, 'connected', 'inactive', '\"eyJpdiI6Ikc3R1VnN3ZDV3ZxbG5pU0Y2UEV5MUE9PSIsInZhbHVlIjoiZTArOG9DdFc2aW1GbGVVVC9MWUZEUTVRQk8rV2N5TUJhODRycTdMdmE5bXVvKy9QZnk5Vnl1eEYzMTNZL3lHQU9aU1MyenNvOEt1bVEwZFVNTXZiaFE9PSIsIm1hYyI6ImQyMDRjNTBlMGQwYTNiNzNjOGFjZWY2NjdiOWIyOTIxZjhjZjY0NDVkNGM5Yjg2YWY4MDlkMWY5NjE3ZDc5YjUiLCJ0YWciOiIifQ==\"', 'stripe-logo.png', '2026-06-25 23:28:01', '2026-06-25 23:28:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_transactions`
--

CREATE TABLE `payment_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `gateway` varchar(100) NOT NULL,
  `transaction_reference` varchar(100) NOT NULL,
  `gateway_transaction_id` varchar(100) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` varchar(32) NOT NULL,
  `response_code` varchar(50) DEFAULT NULL,
  `idempotency_key` varchar(255) NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payload`)),
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `code`, `name`, `group`, `description`, `created_at`, `updated_at`) VALUES
(1, 'manage_products', 'Quản lý sản phẩm', 'catalog', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(2, 'manage_orders', 'Quản lý đơn hàng', 'orders', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(3, 'view_audit_log', 'Xem nhật ký hoạt động', 'system', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(4, 'manage_vouchers', 'Quản lý mã giảm giá', 'marketing', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(5, 'manage_banners', 'Quản lý banner', 'marketing', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(6, 'manage_posts', 'Quản lý bài viết', 'marketing', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(7, 'manage_reviews', 'Quản lý đánh giá', 'marketing', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(8, 'manage_users', 'Quản lý tài khoản', 'users', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(9, 'manage_roles', 'Quản lý vai trò và phân quyền', 'users', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(10, 'manage_settings', 'Cấu hình website', 'settings', NULL, '2026-07-18 05:12:44', '2026-07-18 05:12:44'),
(11, 'view_customers', 'Xem hồ sơ khách hàng', 'orders', NULL, '2026-07-18 06:23:04', '2026-07-18 06:23:04'),
(12, 'manage_media', 'Quản lý thư viện tệp', 'system', NULL, '2026-07-21 23:26:20', '2026-07-21 23:26:20'),
(13, 'manage_languages', 'Quản lý ngôn ngữ', 'settings', NULL, '2026-07-22 00:42:51', '2026-07-22 00:42:51'),
(14, 'translate_content', 'Dịch nội dung tự động', 'system', NULL, '2026-07-22 00:42:51', '2026-07-22 00:42:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`title`)),
  `slug` varchar(255) NOT NULL,
  `summary` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`summary`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `image_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `seo_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`seo_title`)),
  `seo_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`seo_description`)),
  `seo_keys` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `slug`, `summary`, `content`, `image_url`, `is_active`, `views`, `seo_title`, `seo_description`, `seo_keys`, `published_at`, `created_at`, `updated_at`) VALUES
(16, 5, '{\"vi\":\"Bài viết tin tức số 16\",\"en\":\"News Post Number 16\"}', 'bai-viet-tin-tuc-so-16', '{\"vi\":\"Tóm tắt bài viết số 16\",\"en\":\"Summary of post number 16\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 16 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 16 for general news.</p>\"}', NULL, 0, 0, '{\"vi\":\"Tiêu đề SEO bài viết 16\",\"en\":\"SEO Title of Post 16\"}', '{\"vi\":\"Mô tả SEO bài viết 16 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 16 for search engines optimization.\"}', 'bài viết', '2026-07-01 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(17, 6, '{\"vi\":\"Bài viết tin tức số 17\",\"en\":\"News Post Number 17\"}', 'bai-viet-tin-tuc-so-17', '{\"vi\":\"Tóm tắt bài viết số 17\",\"en\":\"Summary of post number 17\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 17 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 17 for general news.</p>\"}', NULL, 1, 0, '{\"vi\":\"Tiêu đề SEO bài viết 17\",\"en\":\"SEO Title of Post 17\"}', '{\"vi\":\"Mô tả SEO bài viết 17 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 17 for search engines optimization.\"}', 'bài viết', '2026-06-30 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(18, 4, '{\"vi\":\"Bài viết tin tức số 18\",\"en\":\"News Post Number 18\"}', 'bai-viet-tin-tuc-so-18', '{\"vi\":\"Tóm tắt bài viết số 18\",\"en\":\"Summary of post number 18\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 18 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 18 for general news.</p>\"}', NULL, 1, 0, '{\"vi\":\"Tiêu đề SEO bài viết 18\",\"en\":\"SEO Title of Post 18\"}', '{\"vi\":\"Mô tả SEO bài viết 18 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 18 for search engines optimization.\"}', 'bài viết', '2026-06-29 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(19, 5, '{\"vi\":\"Bài viết tin tức số 19\",\"en\":\"News Post Number 19\"}', 'bai-viet-tin-tuc-so-19', '{\"vi\":\"Tóm tắt bài viết số 19\",\"en\":\"Summary of post number 19\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 19 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 19 for general news.</p>\"}', NULL, 1, 0, '{\"vi\":\"Tiêu đề SEO bài viết 19\",\"en\":\"SEO Title of Post 19\"}', '{\"vi\":\"Mô tả SEO bài viết 19 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 19 for search engines optimization.\"}', 'bài viết', '2026-06-28 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(20, 6, '{\"vi\":\"Bài viết tin tức số 20\",\"en\":\"News Post Number 20\"}', 'bai-viet-tin-tuc-so-20', '{\"vi\":\"Tóm tắt bài viết số 20\",\"en\":\"Summary of post number 20\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 20 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 20 for general news.</p>\"}', NULL, 0, 0, '{\"vi\":\"Tiêu đề SEO bài viết 20\",\"en\":\"SEO Title of Post 20\"}', '{\"vi\":\"Mô tả SEO bài viết 20 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 20 for search engines optimization.\"}', 'bài viết', '2026-06-27 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(21, 4, '{\"vi\":\"Bài viết tin tức số 21\",\"en\":\"News Post Number 21\"}', 'bai-viet-tin-tuc-so-21', '{\"vi\":\"Tóm tắt bài viết số 21\",\"en\":\"Summary of post number 21\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 21 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 21 for general news.</p>\"}', NULL, 1, 0, '{\"vi\":\"Tiêu đề SEO bài viết 21\",\"en\":\"SEO Title of Post 21\"}', '{\"vi\":\"Mô tả SEO bài viết 21 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 21 for search engines optimization.\"}', 'bài viết', '2026-06-26 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(22, 5, '{\"vi\":\"Bài viết tin tức số 22\",\"en\":\"News Post Number 22\"}', 'bai-viet-tin-tuc-so-22', '{\"vi\":\"Tóm tắt bài viết số 22\",\"en\":\"Summary of post number 22\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 22 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 22 for general news.</p>\"}', NULL, 1, 0, '{\"vi\":\"Tiêu đề SEO bài viết 22\",\"en\":\"SEO Title of Post 22\"}', '{\"vi\":\"Mô tả SEO bài viết 22 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 22 for search engines optimization.\"}', 'bài viết', '2026-06-25 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(23, 6, '{\"vi\":\"Bài viết tin tức số 23\",\"en\":\"News Post Number 23\"}', 'bai-viet-tin-tuc-so-23', '{\"vi\":\"Tóm tắt bài viết số 23\",\"en\":\"Summary of post number 23\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 23 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 23 for general news.</p>\"}', NULL, 1, 0, '{\"vi\":\"Tiêu đề SEO bài viết 23\",\"en\":\"SEO Title of Post 23\"}', '{\"vi\":\"Mô tả SEO bài viết 23 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 23 for search engines optimization.\"}', 'bài viết', '2026-06-24 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(24, 4, '{\"vi\":\"Bài viết tin tức số 24\",\"en\":\"News Post Number 24\"}', 'bai-viet-tin-tuc-so-24', '{\"vi\":\"Tóm tắt bài viết số 24\",\"en\":\"Summary of post number 24\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 24 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 24 for general news.</p>\"}', NULL, 0, 0, '{\"vi\":\"Tiêu đề SEO bài viết 24\",\"en\":\"SEO Title of Post 24\"}', '{\"vi\":\"Mô tả SEO bài viết 24 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 24 for search engines optimization.\"}', 'bài viết', '2026-06-23 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(25, 5, '{\"vi\":\"Bài viết tin tức số 25\",\"en\":\"News Post Number 25\"}', 'bai-viet-tin-tuc-so-25', '{\"vi\":\"Tóm tắt bài viết số 25\",\"en\":\"Summary of post number 25\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 25 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 25 for general news.</p>\"}', NULL, 1, 0, '{\"vi\":\"Tiêu đề SEO bài viết 25\",\"en\":\"SEO Title of Post 25\"}', '{\"vi\":\"Mô tả SEO bài viết 25 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 25 for search engines optimization.\"}', 'bài viết', '2026-06-22 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(26, 6, '{\"vi\":\"Bài viết tin tức số 26\",\"en\":\"News Post Number 26\"}', 'bai-viet-tin-tuc-so-26', '{\"vi\":\"Tóm tắt bài viết số 26\",\"en\":\"Summary of post number 26\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 26 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 26 for general news.</p>\"}', NULL, 1, 0, '{\"vi\":\"Tiêu đề SEO bài viết 26\",\"en\":\"SEO Title of Post 26\"}', '{\"vi\":\"Mô tả SEO bài viết 26 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 26 for search engines optimization.\"}', 'bài viết', '2026-06-21 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(27, 4, '{\"vi\":\"Bài viết tin tức số 27\",\"en\":\"News Post Number 27\"}', 'bai-viet-tin-tuc-so-27', '{\"vi\":\"Tóm tắt bài viết số 27\",\"en\":\"Summary of post number 27\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 27 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 27 for general news.</p>\"}', NULL, 1, 0, '{\"vi\":\"Tiêu đề SEO bài viết 27\",\"en\":\"SEO Title of Post 27\"}', '{\"vi\":\"Mô tả SEO bài viết 27 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 27 for search engines optimization.\"}', 'bài viết', '2026-06-20 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(28, 5, '{\"vi\":\"Bài viết tin tức số 28\",\"en\":\"News Post Number 28\"}', 'bai-viet-tin-tuc-so-28', '{\"vi\":\"Tóm tắt bài viết số 28\",\"en\":\"Summary of post number 28\"}', '{\"vi\":\"<p>Nội dung chi tiết bài viết số 28 cho mục tin tức chung.</p>\",\"en\":\"<p>Detailed content of post number 28 for general news.</p>\"}', NULL, 0, 0, '{\"vi\":\"Tiêu đề SEO bài viết 28\",\"en\":\"SEO Title of Post 28\"}', '{\"vi\":\"Mô tả SEO bài viết 28 giúp tối ưu hóa công cụ tìm kiếm chuẩn SEO.\",\"en\":\"SEO description of post 28 for search engines optimization.\"}', 'bài viết', '2026-06-19 07:58:20', '2026-07-17 07:58:20', '2026-07-17 07:58:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` varchar(255) NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post_categories`
--

INSERT INTO `post_categories` (`id`, `parent_id`, `name`, `slug`, `description`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, NULL, '{\"vi\":\"Tin tức\",\"en\":\"News\"}', 'tin-tuc', '{\"vi\":\"Cập nhật tin tức mới nhất về thương mại điện tử và công nghệ.\",\"en\":\"Latest updates about e-commerce and technology.\"}', 1, 0, '2026-07-17 07:58:20', '2026-07-22 05:09:21'),
(2, NULL, '{\"vi\":\"Hướng dẫn\",\"en\":\"Guides\"}', 'huong-dan', '{\"vi\":\"Các bài viết hướng dẫn sử dụng và tối ưu hóa cửa hàng bán hàng.\",\"en\":\"Step-by-step guides to optimize your online store.\"}', 1, 2, '2026-07-17 07:58:20', '2026-07-22 05:09:21'),
(3, NULL, '{\"vi\":\"Đánh giá\",\"en\":\"Reviews\"}', 'danh-gia', '{\"vi\":\"Đánh giá chi tiết các tính năng, giải pháp và ứng dụng hỗ trợ.\",\"en\":\"Detailed reviews of tools, features, and third-party integrations.\"}', 1, 1, '2026-07-17 07:58:20', '2026-07-22 05:09:21'),
(4, 1, '{\"vi\":\"Tin tức Trong nước\",\"en\":\"Domestic News\"}', 'tin-tuc-trong-nuoc', '{\"vi\":\"Tin tức thương mại điện tử trong nước.\",\"en\":\"Domestic e-commerce news.\"}', 1, 0, '2026-07-17 07:58:20', '2026-07-22 05:09:18'),
(5, 1, '{\"vi\":\"Tin tức Quốc tế\",\"en\":\"International News\"}', 'tin-tuc-quoc-te', '{\"vi\":\"Tin tức thương mại điện tử toàn cầu.\",\"en\":\"Global e-commerce news.\"}', 1, 1, '2026-07-17 07:58:20', '2026-07-22 05:09:18'),
(6, 2, '{\"vi\":\"Hướng dẫn Kỹ thuật\",\"en\":\"Technical Guides\"}', 'huong-dan-ky-thuat', '{\"vi\":\"Hướng dẫn kỹ thuật, code và cấu hình.\",\"en\":\"Technical guides, coding and configurations.\"}', 1, 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `short_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`short_description`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `meta_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_title`)),
  `meta_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_description`)),
  `special_promotion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`special_promotion`)),
  `image_url` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `compare_at_price` decimal(15,2) DEFAULT NULL,
  `cost_price` decimal(15,2) DEFAULT NULL,
  `stock_quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `manage_stock` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_flash_sale` tinyint(1) NOT NULL DEFAULT 0,
  `flash_sale_price` decimal(15,2) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `name`, `slug`, `sku`, `short_description`, `description`, `meta_title`, `meta_description`, `special_promotion`, `image_url`, `images`, `price`, `compare_at_price`, `cost_price`, `stock_quantity`, `manage_stock`, `is_active`, `is_featured`, `is_flash_sale`, `flash_sale_price`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '{\"vi\":\"GLASSWOOL WATER FREE\",\"en\":\"GLASSWOOL WATER FREE\",\"ko\":\"GLASSWOOL WATER FREE\"}', 'glasswool-water-free', 'AO-GWWF', '{\"vi\":\"Bông thủy tinh không thấm nước, hiệu suất cách nhiệt vượt trội.\",\"en\":\"Waterproof glasswool, outstanding thermal insulation performance.\",\"ko\":\"방수 글라스울, 우수한 단열 성능.\"}', '{\"vi\":\"<p class=\\\"mb-4 text-base\\\">Bông thủy tinh <strong>Glasswool Water Free</strong> là dòng vật liệu cách nhiệt, cách âm thế hệ mới sở hữu công nghệ chống thấm nước đột phá. Khác với bông thủy tinh truyền thống dễ bị ngậm nước gây xẹp và giảm hiệu suất, sản phẩm này được xử lý kỵ nước đặc biệt, giữ cho kết cấu luôn khô ráo và bền bỉ trong mọi điều kiện thời tiết.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/glasswool_water_free.png\\\" alt=\\\"Glasswool Water Free\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Bông thủy tinh kỵ nước Glasswool Water Free thế hệ mới</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Ưu điểm vượt trội</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Kháng nước tuyệt đối:</strong> Ngăn ngừa tích tụ hơi ẩm, chống ẩm mốc và duy trì hệ số cách nhiệt lâu dài.</li><li><strong>Cách nhiệt hiệu quả:</strong> Hệ số dẫn nhiệt thấp giúp tiết kiệm năng lượng tối đa cho công trình.</li><li><strong>Không cháy:</strong> Đạt tiêu chuẩn chống cháy tối ưu, bảo vệ an toàn cho nhà xưởng và cao ốc.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Ứng dụng thực tế</h4><p class=\\\"text-sm\\\">Sản phẩm cực kỳ lý tưởng cho các dự án xây dựng công nghiệp như mái nhà xưởng, hệ thống đường ống dẫn khí HVAC, vách cách âm phòng máy và các khu vực có độ ẩm cao.</p>\",\"en\":\"<p class=\\\"mb-4 text-base\\\"><strong>Glasswool Water Free</strong> is a next-generation thermal and acoustic insulation material featuring breakthrough waterproof technology. Unlike traditional glasswool, which absorbs moisture and loses its insulation value, this product is treated with special hydrophobic agents to remain dry and effective under any weather conditions.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/glasswool_water_free.png\\\" alt=\\\"Glasswool Water Free\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Next-generation Hydrophobic Glasswool Water Free</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Key Advantages</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Absolute Waterproofing:</strong> Prevents moisture accumulation, mold growth, and sustains long-term thermal resistance.</li><li><strong>Thermal Insulation:</strong> Very low thermal conductivity helps optimize energy efficiency for buildings.</li><li><strong>Non-combustible:</strong> Meets stringent fire protection standards, enhancing structural safety.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Applications</h4><p class=\\\"text-sm\\\">Ideal for factory roofs, HVAC duct systems, mechanical room sound insulation, and highly humid environments.</p>\",\"ko\":\"<p class=\\\"mb-4 text-base\\\"><strong>Glasswool Water Free</strong>는 혁신적인 수분 방지 공법을 적용한 차세대 열 및 음향 단열재입니다. 수분을 머금어 쉽게 뭉치고 성능이 떨어지는 기존 글라스울과 달리, 특수 발수 처리 공정을 거쳐 다습한 기후 조건에서도 구조적 건조함과 탁월한 단열 성능을 유지합니다.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/glasswool_water_free.png\\\" alt=\\\"Glasswool Water Free\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">차세대 발수 글라스울 워터 프리</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">주요 장점</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>완벽한 방수 성능:</strong> 내부 습기 응축과 곰팡이 번식을 억제하여 단열재의 수명을 극대화합니다.</li><li><strong>뛰어난 열 효율성:</strong> 극히 낮은 열전도율로 빌딩 및 공장의 냉난방 비용을 획기적으로 낮춥니다.</li><li><strong>안전한 불연재:</strong> 최고 수준의 화재 안전 등급을 획득하여 안심하고 시공할 수 있습니다.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">시공 적용 분야</h4><p class=\\\"text-sm\\\">산업용 공장 지붕, 공조 설비 덕트 보온, 기계실 방음벽 및 고온 다습한 실내외 주요 골조 단열에 널리 사용됩니다.</p>\"}', NULL, NULL, NULL, '/images/products/glasswool_water_free.png', NULL, 1250000.00, 1400000.00, NULL, 101, 1, 1, 1, 0, NULL, '2026-07-17 07:58:20', '2026-07-17 07:58:20', '2026-07-22 09:59:08'),
(2, 1, 1, '{\"vi\":\"GLASSWOOL\",\"en\":\"GLASSWOOL\",\"ko\":\"GLASSWOOL\"}', 'glasswool', 'AO-GW', '{\"vi\":\"Bông thủy tinh cách nhiệt cách âm tiêu chuẩn.\",\"en\":\"Standard thermal and acoustic insulation glasswool.\",\"ko\":\"표준 열 및 음향 단열용 글라스울.\"}', '{\"vi\":\"<p class=\\\"mb-4 text-base\\\">Bông thủy tinh <strong>Glasswool</strong> tiêu chuẩn là sự lựa chọn hàng đầu cho các dự án xây dựng dân dụng và công nghiệp cần giải pháp cách nhiệt, cách âm hiệu quả với chi phí tối ưu. Được liên kết chặt chẽ từ các sợi thủy tinh siêu mịn, sản phẩm mang lại khả năng ngăn chặn truyền nhiệt và giảm thiểu tiếng ồn cực tốt.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/glasswool.png\\\" alt=\\\"Glasswool\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Bông thủy tinh cách nhiệt tiêu chuẩn</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Đặc tính kỹ thuật</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Cách âm vượt trội:</strong> Cấu trúc dạng sợi giúp hấp thụ và triệt tiêu sóng âm đi qua hệ thống tường và trần.</li><li><strong>Chống cháy tốt:</strong> Khả năng chống chịu nhiệt độ cao giúp bảo vệ kết cấu thép bên trong công trình khi xảy ra sự cố.</li><li><strong>Thân thiện môi trường:</strong> Không chứa amiăng, an toàn cho thợ thi công và người sử dụng.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Ứng dụng phù hợp</h4><p class=\\\"text-sm\\\">Sử dụng để lót sàn, vách trần thạch cao, bọc ống gió cách nhiệt cho hệ thống điều hòa trung tâm văn phòng, nhà xưởng.</p>\",\"en\":\"<p class=\\\"mb-4 text-base\\\">Standard <strong>Glasswool</strong> is a top-choice insulation solution for residential and industrial projects requiring budget-friendly thermal and acoustic management. Composed of fine, resilient glass fibers, it provides high resistance to heat flow and significantly minimizes sound transmission.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/glasswool.png\\\" alt=\\\"Glasswool\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Standard Thermal Insulation Glasswool</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Technical Highlights</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Excellent Acoustic Control:</strong> Fibrous structure dampens and absorbs sound waves passing through walls and ceilings.</li><li><strong>Fire Protection:</strong> Highly heat resistant, protecting structural steel in case of fire incidents.</li><li><strong>Eco-friendly & Safe:</strong> Asbestos-free, safe to handle and install under standard guidelines.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Key Applications</h4><p class=\\\"text-sm\\\">Ideal for ceiling and wall partitions, under-roof installation in factories, and thermal wraps for central air conditioning duct systems.</p>\",\"ko\":\"<p class=\\\"mb-4 text-base\\\">표준 <strong>Glasswool</strong>은 경제적이면서도 확실한 단열 및 차음 성능을 제공하여 주거용 및 산업용 건축에 가장 널리 사용되는 베스트셀러 제품입니다. 탄력성 높은 미세 유리섬유가 촘촘하게 얽혀 열의 흐름을 차단하고 외부 소음 유입을 최소화합니다.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/glasswool.png\\\" alt=\\\"Glasswool\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">표준 단열재 글라스울</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">기술적 장점</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>탁월한 흡음 성능:</strong> 다공성 섬유 구조가 벽체와 천장을 통과하는 소음 에너지를 효과적으로 흡수합니다.</li><li><strong>검증된 방화 기능:</strong> 고온을 견디며 연소를 지연시켜 화재 발생 시 대피 시간을 확보해 줍니다.</li><li><strong>친환경성 및 안전성:</strong> 석면 무함유 친환경 소재로 시공자와 거주자 모두에게 안전합니다.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">주요 적용 용도</h4><p class=\\\"text-sm\\\">석고보드 칸막이벽 내부 충진, 주택 및 공장 지붕 하부 단열, 빌딩 중앙 집중식 냉난방 공조관 보온재로 널리 시공됩니다.</p>\"}', NULL, NULL, NULL, '/images/products/glasswool.png', NULL, 950000.00, 1100000.00, NULL, 151, 1, 1, 1, 0, NULL, '2026-07-17 07:58:20', '2026-07-17 07:58:20', '2026-07-22 09:59:08'),
(3, 1, 1, '{\"vi\":\"CERAMIC WOOL\",\"en\":\"CERAMIC WOOL\",\"ko\":\"CERAMIC WOOL\"}', 'ceramic-wool', 'AO-CW', '{\"vi\":\"Bông gốm chịu nhiệt độ cao siêu hạng lên tới 1260 độ C.\",\"en\":\"Super high heat-resistant ceramic wool up to 1260°C.\",\"ko\":\"최대 1260°C의 초고온을 견디는 세라믹울.\"}', '{\"vi\":\"<p class=\\\"mb-4 text-base\\\">Bông gốm siêu chịu nhiệt <strong>Ceramic Wool</strong> (còn gọi là Ceramic Blanket) là vật liệu bảo ôn cao cấp chuyên dụng cho các môi trường nhiệt độ cực cao lên đến 1260°C. Được sản xuất từ các sợi gốm silicat tinh khiết thông qua quá trình nung thổi cường độ cao, sản phẩm sở hữu tính bền nhiệt tuyệt đối và hệ số tích nhiệt cực thấp.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/ceramic_wool.png\\\" alt=\\\"Ceramic Wool\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Bông gốm siêu chịu nhiệt Ceramic Wool 1260°C</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Tính năng nổi bật</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Khả năng chịu nhiệt cực đại:</strong> Hoạt động ổn định liên tục trong các lò công nghiệp có nhiệt độ lên đến 1260°C.</li><li><strong>Độ bền cơ học cao:</strong> Kết cấu đan xen chặt chẽ giúp cuộn bông gốm không bị rách hay biến dạng khi thi công kéo căng.</li><li><strong>Chống hóa chất:</strong> Kháng hầu hết các loại axit và chất ăn mòn hóa học (ngoại trừ axit huỳnh thạch và phốt-phô).</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Ứng dụng tiêu biểu</h4><p class=\\\"text-sm\\\">Bọc bảo ôn lò nung sắt thép, lò gốm sứ, lò hơi công nghiệp, đường ống dẫn hơi áp suất cao và các thiết bị chịu nhiệt trong ngành luyện kim, hóa chất.</p>\",\"en\":\"<p class=\\\"mb-4 text-base\\\">High-temperature <strong>Ceramic Wool</strong> (also known as Ceramic Blanket) is a premium insulation material specialized for extreme heat environments up to 1260°C. Manufactured from high-purity alumina-silica fibers, this product delivers excellent thermal stability and extremely low heat storage.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/ceramic_wool.png\\\" alt=\\\"Ceramic Wool\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Ultra High Temperature Ceramic Wool 1260°C</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Key Features</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Extreme Temperature Stability:</strong> Performs reliably in continuous industrial furnace environments up to 1260°C.</li><li><strong>High Tensile Strength:</strong> Woven structures ensure the blanket resists tearing or warping during tight installations.</li><li><strong>Chemical Resistance:</strong> Unaffected by most acids and corrosive chemicals (except hydrofluoric and phosphoric acids).</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Applications</h4><p class=\\\"text-sm\\\">Widely applied for lining industrial furnaces, ceramic kilns, heavy-duty boilers, high-pressure steam pipelines, and thermal insulation in metallurgical processes.</p>\",\"ko\":\"<p class=\\\"mb-4 text-base\\\">초고온용 <strong>Ceramic Wool</strong>(세라믹 블랭킷)은 최대 1260°C에 이르는 극도의 열적 환경을 견디도록 개발된 프리미엄 내화 단열재입니다. 고순도 규산알루미늄 섬유를 특수 공법으로 압착 가공하여 열전도도가 낮고 열 보존력이 뛰어나 에너지를 대폭 절감해 줍니다.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/ceramic_wool.png\\\" alt=\\\"Ceramic Wool\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">1260°C 초고온용 세라믹울</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">주요 제품 특징</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>독보적인 열 내구성:</strong> 1200도 이상의 초고온 용해로 및 열처리로 내부에서도 화학적 성질이 변하지 않고 유지됩니다.</li><li><strong>우수한 기계적 강도:</strong> 치밀하게 얽힌 섬유 구조 덕분에 인장 강도가 높아 시공 시 찢어지거나 마모되지 않습니다.</li><li><strong>강력한 내화학성:</strong> 불산 및 인산을 제외한 대부분의 산성 물질 및 화학 부식성 가스에 뛰어난 저항력을 지닙니다.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">추천 시공 현장</h4><p class=\\\"text-sm\\\">제철/제강 산업의 용해로 보온, 도자기 가마 내벽 라이닝, 발전소 고압 스팀 배관 보온, 정유 및 화학 공장의 열 차단벽에 적합합니다.</p>\"}', NULL, NULL, NULL, '/images/products/ceramic_wool.png', NULL, 2400000.00, NULL, NULL, 80, 1, 1, 1, 0, NULL, '2026-07-17 07:58:20', '2026-07-17 07:58:20', '2026-07-22 09:59:08'),
(4, 1, 1, '{\"vi\":\"MINERAL WOOL\",\"en\":\"MINERAL WOOL\",\"ko\":\"MINERAL WOOL\"}', 'mineral-wool', 'AO-MW', '{\"vi\":\"Bông khoáng cách âm chống cháy tỷ trọng cao.\",\"en\":\"High-density acoustic and fire-resistant rockwool.\",\"ko\":\"고밀도 방음 및 방화용 미네랄울.\"}', '{\"vi\":\"<p class=\\\"mb-4 text-base\\\">Bông khoáng <strong>Mineral Wool</strong> (Rockwool) là giải pháp cách âm chuyên nghiệp và chống cháy lan thụ động hàng đầu hiện nay. Được sản xuất từ đá basalt và quặng nung chảy ở nhiệt độ cao, bông khoáng sở hữu tỷ trọng lớn, kết cấu vững chắc, mang lại hiệu quả tiêu âm và ngăn cháy cực kỳ ấn tượng.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/mineral_wool.png\\\" alt=\\\"Mineral Wool\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Bông khoáng cách âm chống cháy Mineral Wool</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Lợi ích cốt lõi</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Chống cháy lan chủ động:</strong> Điểm nóng chảy vượt trội trên 1000°C giúp ngăn chặn đám cháy phát triển rộng.</li><li><strong>Tiêu âm tối ưu:</strong> Tỷ trọng cao giúp triệt tiêu các tần số âm thanh từ trung đến trầm, giảm độ vang vọng trong không gian.</li><li><strong>Cách nhiệt bền bỉ:</strong> Không bị co ngót hay suy giảm khả năng bảo ôn theo thời gian sử dụng.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Khuyên dùng cho</h4><p class=\\\"text-sm\\\">Hệ vách tiêu âm phòng thu âm, rạp chiếu phim, quán karaoke, phòng máy phát điện công nghiệp đòi hỏi khắt khe về cách âm và an toàn phòng cháy chữa cháy.</p>\",\"en\":\"<p class=\\\"mb-4 text-base\\\"><strong>Mineral Wool</strong> (Rockwool) is a leading solution for professional acoustic management and passive fire protection. Engineered from volcanic basalt rock and slag melted at extreme temperatures, it features high density and rigid structural integrity, ensuring optimal sound absorption and flame barrier performance.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/mineral_wool.png\\\" alt=\\\"Mineral Wool\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">High Density Acoustic Mineral Wool</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Core Value</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Fire Containment:</strong> Extremely high melting point above 1000°C effectively prevents flame spread.</li><li><strong>Sound Absorption:</strong> Denser composition dampens mid-to-low sound frequencies, minimizing echo.</li><li><strong>Durability:</strong> Retains its insulation capacity and shape over decades without sagging.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Recommended For</h4><p class=\\\"text-sm\\\">Ideal for soundproofing recording studios, cinemas, karaoke lounges, and generator enclosures requiring fire safety and sound damping.</p>\",\"ko\":\"<p class=\\\"mb-4 text-base\\\">고밀도 <strong>Mineral Wool</strong>(락울/미네랄울)은 프로페셔널한 음향 설계와 방화 시스템 구축을 위한 최적의 건축 자재입니다. 천연 현무암과 고로슬래그를 고온에서 융해하여 섬유 형태로 제작한 자재로, 압도적인 소음 차단(NRC) 및 화재 전파 지연 효과를 발휘합니다.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/mineral_wool.png\\\" alt=\\\"Mineral Wool\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">고밀도 방음 및 방화용 미네랄울</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">핵심 특장점</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>강력한 화재 확산 방지:</strong> 녹는점이 1000°C 이상으로 매우 높아, 화재 시 구조물 붕괴를 예방하고 불길이 번지는 것을 원천 차단합니다.</li><li><strong>최상의 소음 흡수력:</strong> 조밀한 중-저주파 대역 차음 효과로 내부 소리가 밖으로 새거나 외부 노이즈가 유입되는 것을 방지합니다.</li><li><strong>반영구적 수명:</strong> 장기간 사용 시에도 수축이나 꺼짐 현상 없이 초기 밀도와 구조적 강도를 그대로 유지합니다.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">추천 적용처</h4><p class=\\\"text-sm\\\">방음이 생명인 레코딩 스튜디오, 영화관, 고출력 발전기실 및 건물 외벽의 방화 구획선 시공에 적극 추천됩니다.</p>\"}', NULL, NULL, NULL, '/images/products/mineral_wool.png', NULL, 1550000.00, NULL, NULL, 120, 1, 1, 1, 0, NULL, '2026-07-17 07:58:20', '2026-07-17 07:58:20', '2026-07-22 09:59:08'),
(5, 1, 1, '{\"vi\":\"ISOPINK\",\"en\":\"ISOPINK\",\"ko\":\"ISOPINK\"}', 'isopink', 'AO-IP', '{\"vi\":\"Tấm cách nhiệt XPS màu hồng cường độ nén cao.\",\"en\":\"High compression strength pink XPS insulation board.\",\"ko\":\"고압축 강도의 핑크색 XPS 단열 보드.\"}', '{\"vi\":\"<p class=\\\"mb-4 text-base\\\">Tấm xốp cách nhiệt <strong>Isopink</strong> (XPS) màu hồng cao cấp là vật liệu chống thất thoát nhiệt lý tưởng cho các sàn bê tông nặng, móng, tường tầng hầm nhờ cường độ nén chịu lực cực cao. Được cấu tạo từ hạt nhựa Polystyrene cùng bọt nở thông qua công nghệ đùn ép tiên tiến, sản phẩm có cấu trúc hạt kín 100% không cho nước và hơi ẩm đi qua.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/isopink.png\\\" alt=\\\"Isopink\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Tấm cách nhiệt cường độ chịu nén cao Isopink XPS</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Ưu điểm nổi bật</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Khả năng chịu nén siêu hạng:</strong> Chịu đựng được tải trọng nén cực lớn của các lớp sàn bê tông dày mà không bị biến dạng.</li><li><strong>Kháng ẩm tối đa:</strong> Hệ số hấp thụ nước gần như bằng 0, ngăn cản hiện tượng ẩm mốc và rò rỉ nước ngầm tại tầng hầm.</li><li><strong>Hiệu suất cách nhiệt vượt trội:</strong> Giữ nhiệt độ phòng luôn ổn định, giảm thất thoát năng lượng điều hòa.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Lĩnh vực ứng dụng</h4><p class=\\\"text-sm\\\">Lót sàn kho lạnh, cách nhiệt mái bê tông đổ phẳng, chống nồm ẩm cho sàn nhà dân dụng, cách nhiệt nền móng và tường tầng hầm.</p>\",\"en\":\"<p class=\\\"mb-4 text-base\\\">Premium pink <strong>Isopink</strong> (XPS) foam board is the ultimate thermal barrier for heavy-load concrete floors, foundations, and basement walls, engineered with exceptionally high compressive strength. Formed through continuous extrusion of polystyrene with closed-cell structure, it effectively blocks heat, water, and humidity.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/isopink.png\\\" alt=\\\"Isopink\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">High Compression Strength Isopink XPS Board</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Key Benefits</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Superb Compressive Strength:</strong> Withstands heavy concrete slab loads and high mechanical pressure without deformation.</li><li><strong>Water & Moisture Block:</strong> Near-zero water absorption prevents underground moisture seepage and structural mold.</li><li><strong>Energy Conservation:</strong> Excellent R-value minimizes indoor heat loss or gain, lowering HVAC utility costs.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Applications</h4><p class=\\\"text-sm\\\">Perfect for cold storage floor insulation, flat concrete roof insulation, basement foundation walls, and moisture control beneath residential flooring.</p>\",\"ko\":\"<p class=\\\"mb-4 text-base\\\">벽산 정품 <strong>Isopink</strong> (아이소핑크) 압출법 보온판은 고압축 강도와 우수한 습기 차단 기능을 지녀 콘크리트 바닥, 기초 매트, 지하실 외벽 단열에 가장 이상적인 분홍색 XPS 폼 보드입니다. 완전한 미세 독립 기포 구조로 형성되어 장기적인 열전도율 변화가 없으며 물을 전혀 흡수하지 않습니다.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/isopink.png\\\" alt=\\\"Isopink\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">벽산 정품 고강도 아이소핑크 XPS 보드</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">제품 강점</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>압도적인 압축 강도:</strong> 콘크리트 하중 및 기계 진동 하에서도 변형이나 함몰 없이 지지 구조를 형성합니다.</li><li><strong>완벽한 투습 저항:</strong> 수분 흡수율이 제로에 가까워 지하수 침투와 벽체 결로에 따른 곰팡이 발생을 막아줍니다.</li><li><strong>장기 단열성 유지:</strong> 충진 가스의 안정성과 독립 기포 구조 덕분에 시간이 흘러도 초기 단열 등급을 높게 유지합니다.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">시공 적용 범위</h4><p class=\\\"text-sm\\\">냉동창고 바닥 보온, 아파트 및 빌딩의 옥상 평슬래브 옥상 단열, 지하실 옹벽 방습 및 바닥 nồm 억제용 시공.</p>\"}', NULL, NULL, NULL, '/images/products/isopink.png', NULL, 380000.00, NULL, NULL, 500, 1, 1, 1, 0, NULL, '2026-07-17 07:58:20', '2026-07-17 07:58:20', '2026-07-22 09:59:08'),
(6, 2, 1, '{\"vi\":\"BACE PANEL\",\"en\":\"BACE PANEL\",\"ko\":\"BACE PANEL\"}', 'bace-panel', 'AO-BP', '{\"vi\":\"Tấm ốp xi măng sợi chịu lực cao ngoài trời.\",\"en\":\"High-strength fiber cement exterior cladding panel.\",\"ko\":\"고강도 섬유 시멘트 외장 패널.\"}', '{\"vi\":\"<p class=\\\"mb-4 text-base\\\">Tấm ốp ngoại thất <strong>Bace Panel</strong> là vật liệu kiến trúc hiện đại bằng xi măng sợi chịu lực cao ngoài trời. Được sản xuất với công nghệ ép thủy tinh cường lực và sấy chưng áp Autoclave, sản phẩm có thể chống chọi với mọi điều kiện khí hậu nóng ẩm, mưa bão khắc nghiệt mà không hề bị cong vênh hay mối mọt.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/exterior_wood_wall.png\\\" alt=\\\"Bace Panel\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Tấm ốp xi măng sợi Bace Panel chống chịu thời tiết ngoài trời</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Tính chất nổi bật</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Bền bỉ tuyệt đối:</strong> Kháng tia cực tím (UV), không phai màu hay nứt vỡ dưới ánh nắng mặt trời trực tiếp.</li><li><strong>Chống thấm nước & Chống cháy:</strong> Đạt tiêu chuẩn chống cháy loại A, ngăn thấm nước mưa hoàn hảo bảo vệ hệ tường gạch bên trong.</li><li><strong>Thẩm mỹ sang trọng:</strong> Bề mặt phẳng mịn có thể sơn phủ màu sắc linh hoạt, tạo điểm nhấn kiến trúc độc đáo.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Ứng dụng kiến trúc</h4><p class=\\\"text-sm\\\">Ốp lát trang trí mặt tiền villa, biệt thự nghỉ dưỡng, tòa nhà văn phòng, làm vách ngăn bao ngoài chịu lực cho nhà lắp ghép thông minh.</p>\",\"en\":\"<p class=\\\"mb-4 text-base\\\"><strong>Bace Panel</strong> exterior cladding is a modern architectural solution made of high-strength fiber cement for outdoor applications. Engineered with advanced autoclave curing technology, it resists warping, rotting, and cracking even under extreme weather, storms, and high humidity.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/exterior_wood_wall.png\\\" alt=\\\"Bace Panel\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Weather-resistant Bace Panel Fiber Cement Exterior Cladding</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Core Performance</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>All-Weather Durability:</strong> UV resistant, maintains its integrity and look without cracking or fading under direct sunlight.</li><li><strong>Fire & Water Barrier:</strong> Class A fire rating with excellent rain-proofing qualities to shield inner structures.</li><li><strong>Modern Aesthetics:</strong> Features a clean, smooth texture that supports custom paints, enabling sleek modern building styles.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Applications</h4><p class=\\\"text-sm\\\">Ideal for villa exterior facades, commercial building fronts, resort siding, and external structural sheets for pre-engineered buildings.</p>\",\"ko\":\"<p class=\\\"mb-4 text-base\\\">외장용 <strong>Bace Panel</strong>(베이스 패널)은 가혹한 기후 변화에 대응할 수 있도록 고압 성형 및 오토클레이브 양생 공법으로 제작된 프리미엄 고강도 섬유 시멘트 외벽 패널입니다. 습기와 온도 변화에 따른 변형이나 뒤틀림, 부식이 전혀 없어 오랫동안 깨끗한 외관을 유지해 줍니다.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/exterior_wood_wall.png\\\" alt=\\\"Bace Panel\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">기후 변화에 강한 외장 베이스 패널</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">기술적 우위</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>독보적인 전천후 내구성:</strong> 강력한 자외선 차단 능력으로 햇빛 노출 시에도 탈색이나 미세 균열이 일어나지 않습니다.</li><li><strong>방화 및 수분 차단:</strong> 비가연성(Class A) 인증을 받았으며 빗물이 내부 철골이나 콘크리트 벽으로 스며드는 것을 원천 예방합니다.</li><li><strong>고품격 마감 스타일:</strong> 모던하고 미려한 표면 마감을 자랑하며, 건축가의 콘셉트에 맞는 자유로운 도장이 가능합니다.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">설계 권장 대상</h4><p class=\\\"text-sm\\\">단독 주택 및 타운하우스 건물 외벽 마감, 상업용 고층 빌딩 로비 및 파사드, 조립식 모듈러 하우스 주 구조체 외벽 마감.</p>\"}', NULL, NULL, NULL, 'https://abc-oasis.com/wp-content/uploads/2025/11/Anh-bace-panel-1.png', NULL, 680000.00, NULL, NULL, 200, 1, 1, 1, 0, NULL, '2026-07-17 07:58:20', '2026-07-17 07:58:20', '2026-07-22 09:59:08'),
(7, 2, 1, '{\"vi\":\"GREEN BACE PANEL\",\"en\":\"GREEN BACE PANEL\",\"ko\":\"GREEN BACE PANEL\"}', 'green-bace-panel', 'AO-GBP', '{\"vi\":\"Tấm ốp sinh thái ngoài trời thân thiện với môi trường.\",\"en\":\"Eco-friendly green exterior cladding panel.\",\"ko\":\"친환경 그린 외장 클래딩 패널.\"}', '{\"vi\":\"<p class=\\\"mb-4 text-base\\\">Tấm ốp sinh thái <strong>Green Bace Panel</strong> là bước đi tiên phong trong kỷ nguyên vật liệu xây dựng xanh. Sản phẩm thừa hưởng toàn bộ ưu điểm chịu lực và bền bỉ của tấm xi măng sợi cao cấp, đồng thời được tối ưu hóa quy trình sản xuất bằng việc sử dụng 100% nguyên liệu thô tự nhiên không chứa amiăng độc hại và bổ sung các thành phần tái chế xanh bảo vệ môi trường.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"https://abc-oasis.com/wp-content/uploads/2025/11/anh-1-BIA.png\\\" alt=\\\"Green Bace Panel\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Tấm ốp ngoại thất sinh thái Green Bace Panel</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Đặc tính nổi bật</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Đạt chứng chỉ xanh:</strong> Góp phần tích lũy điểm thưởng cho các dự án xin cấp chứng nhận LEED hoặc LOTUS.</li><li><strong>Kháng ẩm, kháng mốc:</strong> Khả năng ngăn nước ngấm vượt trội, không phát triển nấm mốc gây ảnh hưởng chất lượng không khí xung quanh.</li><li><strong>Hiệu quả kinh tế lâu dài:</strong> Tuổi thọ vật liệu trên 30 năm, giảm chi phí bảo trì định kỳ cho công trình.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Ứng dụng phổ biến</h4><p class=\\\"text-sm\\\">Làm vách bao ngoài trang trí mặt đứng tòa nhà, ốp hành lang ngoài trời cho trường học, bệnh viện, khu sinh thái nghỉ dưỡng xanh.</p>\",\"en\":\"<p class=\\\"mb-4 text-base\\\"><strong>Green Bace Panel</strong> is a pioneering eco-friendly cladding solution designed for sustainable green architecture. Combining the exceptional structural strength of premium fiber cement panels with green production practices, it utilizes asbestos-free raw materials and recycled composites to minimize environmental footprints.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"https://abc-oasis.com/wp-content/uploads/2025/11/anh-1-BIA.png\\\" alt=\\\"Green Bace Panel\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Eco-friendly Green Bace Panel Cladding</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Eco-Performance Highlights</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Green Certified:</strong> Helps acquire LEED/LOTUS points for sustainable green construction projects.</li><li><strong>Anti-Mold & Moisture Proof:</strong> High water resistance prevents dampness and harmful micro-organism growth on exterior surfaces.</li><li><strong>Cost-Effective Lifetime:</strong> Exceeds 30 years of material lifespan, drastically lowering lifetime maintenance costs.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Applications</h4><p class=\\\"text-sm\\\">Ideal for external walls of schools, hospitals, eco-resorts, and facades of public buildings advocating environmental sustainability.</p>\",\"ko\":\"<p class=\\\"mb-4 text-base\\\">친환경 <strong>Green Bace Panel</strong>(그린 베이스 패널)은 친환경 저탄소 녹색 건축을 위한 혁신적인 외장재입니다. 프리미엄 섬유 시멘트 패널 고유의 뛰어난 내구성을 보장함과 동시에 100% 무석면 친환경 천연 원료와 재활용 녹색 바인더 소재를 융합하여 제조함으로써 환경에 미치는 영향을 최소화하였습니다.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"https://abc-oasis.com/wp-content/uploads/2025/11/anh-1-BIA.png\\\" alt=\\\"Green Bace Panel\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">저탄소 녹색 건축 외장용 그린 베이스 패널</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">에코 제품 강점</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>친환경 건축 인증 획득:</strong> LEED 및 다양한 국내외 친환경 건축물 등급 심사 시 점수 획득에 크게 기여합니다.</li><li><strong>뛰어난 방습/항곰팡이 성능:</strong> 외부 수분 침투를 차단하여 유해 곰팡이나 조류의 번식을 사전에 차단합니다.</li><li><strong>경제적이고 지속 가능한 소재:</strong> 30년 이상의 반평생 수명을 제공하여 건축물 리모델링 및 유지 관리 비용을 절감합니다.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">추천 적용 설계</h4><p class=\\\"text-sm\\\">에코 빌리지 리조트 파사드, 친환경 학교 및 병원 외벽, 녹색 도시 계획 프로젝트 건물 외장 옹벽 데코레이션.</p>\"}', NULL, NULL, NULL, 'https://abc-oasis.com/wp-content/uploads/2025/11/anh-1-BIA.png', NULL, 750000.00, NULL, NULL, 150, 1, 1, 1, 0, NULL, '2026-07-17 07:58:20', '2026-07-17 07:58:20', '2026-07-22 09:59:08'),
(8, 3, 1, '{\"vi\":\"VENTWALL\",\"en\":\"VENTWALL\",\"ko\":\"VENTWALL\"}', 'ventwall', 'AO-VW', '{\"vi\":\"Hệ thống vách thông gió nội thất độc đáo.\",\"en\":\"Unique interior ventilated partition wall system.\",\"ko\":\"독특한 실내 환기형 칸막이벽 시스템.\"}', '{\"vi\":\"<p class=\\\"mb-4 text-base\\\">Hệ vách thông gió và cách âm nội thất <strong>Ventwall</strong> mang lại giải pháp không gian thông minh, mang tính đột phá cho các văn phòng và chung cư cao cấp. Thiết kế độc đáo cho phép luồng không khí lưu thông tự nhiên giữa các phòng nhưng vẫn duy trì khả năng tán âm, giảm thiểu tiếng ồn và tạo sự riêng tư cần thiết.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/acoustic_panel.png\\\" alt=\\\"Ventwall\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Hệ vách ngăn tiêu âm thông gió Ventwall trong nhà</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Ưu điểm thiết kế</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Lưu thông không khí tự nhiên:</strong> Cấu tạo rãnh khí động học độc đáo tạo sự đối lưu gió mát, giảm nóng bức trong các không gian khép kín.</li><li><strong>Cách âm & Tiêu âm nhẹ:</strong> Giảm vang âm hiệu quả, kiến tạo môi trường làm việc yên tĩnh, tập trung.</li><li><strong>Thiết kế thẩm mỹ vượt trội:</strong> Kiểu dáng hiện đại, mang phong cách tối giản Bắc Âu sang trọng, nâng tầm không gian sống.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Ý tưởng thiết kế</h4><p class=\\\"text-sm\\\">Làm vách ngăn phân chia khu vực làm việc trong văn phòng, vách trang trí sau kệ Tivi phòng khách, vách ngăn phòng ngủ và phòng làm việc tại nhà.</p>\",\"en\":\"<p class=\\\"mb-4 text-base\\\">The <strong>Ventwall</strong> ventilated and acoustic partition system provides an innovative spatial solution for modern offices and upscale residential apartments. Its unique aerodynamic layout allows natural air circulation between sections while delivering quality sound dispersion to enhance acoustic privacy.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/acoustic_panel.png\\\" alt=\\\"Ventwall\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">Ventwall Interior Acoustic & Ventilated Partition Wall</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Design Merits</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>Natural Airflow:</strong> Specialized ventilation slots maintain natural fresh air circulation, reducing heating in closed zones.</li><li><strong>Sound Control:</strong> Efficiently absorbs high-frequency noise, fostering a quiet and highly focused workspace.</li><li><strong>Premium Minimalist Design:</strong> Sleek aesthetic inspired by Scandinavian minimalism, bringing luxury and elegance.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">Applications</h4><p class=\\\"text-sm\\\">Ideal for dividing zones in open offices, feature walls behind home theater systems, and elegant partitions between bedrooms and study rooms.</p>\",\"ko\":\"<p class=\\\"mb-4 text-base\\\">실내 환기 및 방음 벽체 시스템인 <strong>Ventwall</strong>(벤트월)은 현대식 스마트 오피스와 최고급 주거용 아파트 공간을 위한 소통적 차단막 솔루션입니다. 고유의 공기역학적 슬릿 설계를 통해 실내 공기 순환을 원활히 돕는 한편, 반사되는 회절 소음을 효과적으로 분산 차단하여 업무 몰입도를 향상해 줍니다.</p><div class=\\\"my-6 text-center\\\"><img src=\\\"/images/products/acoustic_panel.png\\\" alt=\\\"Ventwall\\\" class=\\\"rounded-xl shadow-lg max-w-full h-auto mx-auto border border-gray-100\\\" style=\\\"max-height: 380px; object-fit: cover;\\\" /><span class=\\\"text-xs text-gray-500 mt-2 block font-medium\\\">실내 흡음 환기 가벽 시스템 벤트월</span></div><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">설계 장점</h4><ul class=\\\"list-disc pl-6 space-y-2 mb-6\\\"><li><strong>자연 대류 순환 통로:</strong> 독독한 내장 통로 디자인이 실내 공기가 정체되지 않고 시원하게 흐르도록 대류 현상을 유도합니다.</li><li><strong>실내 차음 및 난반사 방지:</strong> 잡음 주파수를 여과 흡수하여 소란스럽지 않고 프라이빗한 개인 및 미팅 영역을 보장합니다.</li><li><strong>최상급 북유럽 인테리어 감성:</strong> 미니멀리즘과 모던 스타일링을 극대화한 세련된 격자 디자인으로 공간의 품격을 한 단계 높여줍니다.</li></ul><h4 class=\\\"text-lg font-bold text-primary-navy mt-6 mb-3\\\">추천 적용 사례</h4><p class=\\\"text-sm\\\">개방형 사무실의 개인 워크스테이션 파티션, 아파트 거실의 홈 시어터 미디어월 장식 가벽, 침실과 실내 공부방 사이의 분리막 시공.</p>\"}', NULL, NULL, NULL, '/images/products/acoustic_panel.png', NULL, 890000.00, NULL, NULL, 180, 1, 1, 1, 0, NULL, '2026-07-17 07:58:20', '2026-07-17 07:58:20', '2026-07-22 09:59:08'),
(20, 16, NULL, '{\"vi\":\"Dữ liệu SKU legacy chưa ghép sản phẩm #20\",\"en\":\"Unmatched legacy SKU data #20\"}', 'legacy-orphan-skus-20', 'LEGACY-ORPHAN-20', '{\"vi\":\"Dữ liệu mẫu gồm màu sắc, kích thước và chất liệu để kiểm tra tổ hợp SKU.\",\"en\":\"Sample data with color, size and material SKU combinations.\"}', '{\"vi\":\"<p>Sản phẩm demo cho Variant V2. Mỗi SKU là một tổ hợp duy nhất của <strong>Màu sắc</strong>, <strong>Kích thước</strong> và <strong>Chất liệu</strong>.</p>\",\"en\":\"<p>Variant V2 demo product. Every SKU is a unique combination of <strong>Color</strong>, <strong>Size</strong> and <strong>Material</strong>.</p>\"}', NULL, NULL, NULL, 'https://placehold.co/1200x1200/172033/ffffff?text=Outdoor+Jacket+V2', NULL, 890000.00, 1090000.00, 460000.00, 0, 1, 1, 0, 0, NULL, NULL, '2026-07-18 06:53:00', '2026-07-22 09:59:08'),
(79, 16, NULL, '{\"vi\":\"Áo khoác Outdoor 4 mùa — Demo Variant V2\",\"en\":\"Four-season Outdoor Jacket — Variant V2 Demo\"}', 'ao-khoac-outdoor-variant-v2-demo', 'JACKET-V2-DEMO', '{\"vi\":\"Dữ liệu mẫu gồm màu sắc, kích thước và chất liệu để kiểm tra tổ hợp SKU.\",\"en\":\"Sample data with color, size and material SKU combinations.\"}', '{\"vi\":\"<p>Sản phẩm demo cho Variant V2. Mỗi SKU là một tổ hợp duy nhất của <strong>Màu sắc</strong>, <strong>Kích thước</strong> và <strong>Chất liệu</strong>.</p>\",\"en\":\"<p>Variant V2 demo product. Every SKU is a unique combination of <strong>Color</strong>, <strong>Size</strong> and <strong>Material</strong>.</p>\"}', NULL, NULL, NULL, 'https://placehold.co/1200x1200/172033/ffffff?text=Outdoor+Jacket+V2', NULL, 890000.00, 1090000.00, 460000.00, 0, 1, 1, 1, 0, NULL, '2026-07-18 06:55:06', '2026-07-18 06:55:06', '2026-07-22 09:59:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_option_groups`
--

CREATE TABLE `product_option_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `code` varchar(100) NOT NULL,
  `display_type` varchar(20) NOT NULL DEFAULT 'select',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_option_groups`
--

INSERT INTO `product_option_groups` (`id`, `product_id`, `name`, `code`, `display_type`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"vi\":\"image\",\"en\":\"image\"}', 'image', 'select', 0, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(2, 2, '{\"vi\":\"image\",\"en\":\"image\"}', 'image', 'select', 0, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(3, 3, '{\"vi\":\"image\",\"en\":\"image\"}', 'image', 'select', 0, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(4, 4, '{\"vi\":\"image\",\"en\":\"image\"}', 'image', 'select', 0, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(5, 5, '{\"vi\":\"image\",\"en\":\"image\"}', 'image', 'select', 0, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(6, 6, '{\"vi\":\"image\",\"en\":\"image\"}', 'image', 'select', 0, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(7, 7, '{\"vi\":\"image\",\"en\":\"image\"}', 'image', 'select', 0, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(8, 8, '{\"vi\":\"image\",\"en\":\"image\"}', 'image', 'select', 0, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(10, 79, '{\"vi\":\"Màu sắc\",\"en\":\"Màu sắc\"}', 'mau-sac', 'color', 0, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(11, 79, '{\"vi\":\"Kích thước\",\"en\":\"Kích thước\"}', 'kich-thuoc', 'select', 1, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(12, 79, '{\"vi\":\"Chất liệu\",\"en\":\"Chất liệu\"}', 'chat-lieu', 'select', 2, '2026-07-18 06:53:00', '2026-07-18 06:55:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_option_values`
--

CREATE TABLE `product_option_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_option_group_id` bigint(20) UNSIGNED NOT NULL,
  `label` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`label`)),
  `code` varchar(100) NOT NULL,
  `color_hex` varchar(20) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_option_values`
--

INSERT INTO `product_option_values` (`id`, `product_option_group_id`, `label`, `code`, `color_hex`, `image_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"vi\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqc3om74kjm2e\",\"en\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqc3om74kjm2e\"}', 'httpscfshopeevnfilevn-11134207-820l4-mhqc3om74kjm2e', NULL, NULL, 0, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(2, 2, '{\"vi\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"en\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\"}', 'httpscfshopeevnfilesg-11134201-8261f-mj6luqquisqrdb', NULL, NULL, 0, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(3, 3, '{\"vi\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\",\"en\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\"}', 'httpscfshopeevnfilevn-11134207-820l4-mf1amtm7sd1o21', NULL, NULL, 0, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(4, 4, '{\"vi\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mazrkz3hzeks7b\",\"en\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mazrkz3hzeks7b\"}', 'httpscfshopeevnfilevn-11134207-7ras8-mazrkz3hzeks7b', NULL, NULL, 0, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(5, 5, '{\"vi\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmoaupsqymf6ea\",\"en\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmoaupsqymf6ea\"}', 'httpscfshopeevnfilevn-11134207-81ztc-mmoaupsqymf6ea', NULL, NULL, 0, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(6, 6, '{\"vi\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\",\"en\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\"}', 'httpscfshopeevnfilevn-11134207-820l4-memibo9xle6fad', NULL, NULL, 0, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(7, 7, '{\"vi\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\",\"en\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\"}', 'httpscfshopeevnfilevn-11134207-820l4-miisalvzej9dc6', NULL, NULL, 0, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(8, 8, '{\"vi\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"en\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\"}', 'httpscfshopeevnfilevn-11134207-7ra0g-m8w2p45wse2sf8', NULL, NULL, 0, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(9, 10, '{\"vi\":\"Đen than\",\"en\":\"Đen than\"}', 'den-than', '#1f2937', NULL, 0, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(10, 10, '{\"vi\":\"Xanh rêu\",\"en\":\"Xanh rêu\"}', 'xanh-reu', '#53624d', NULL, 1, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(11, 10, '{\"vi\":\"Be cát\",\"en\":\"Be cát\"}', 'be-cat', '#d4c5a9', NULL, 2, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(12, 10, '{\"vi\":\"Cam đất\",\"en\":\"Cam đất\"}', 'cam-dat', '#c95f3a', NULL, 3, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(13, 11, '{\"vi\":\"S\",\"en\":\"S\"}', 's', NULL, NULL, 0, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(14, 11, '{\"vi\":\"M\",\"en\":\"M\"}', 'm', NULL, NULL, 1, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(15, 11, '{\"vi\":\"L\",\"en\":\"L\"}', 'l', NULL, NULL, 2, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(16, 11, '{\"vi\":\"XL\",\"en\":\"XL\"}', 'xl', NULL, NULL, 3, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(17, 12, '{\"vi\":\"Nylon chống nước\",\"en\":\"Nylon chống nước\"}', 'nylon-chong-nuoc', NULL, NULL, 0, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(18, 12, '{\"vi\":\"Canvas dày\",\"en\":\"Canvas dày\"}', 'canvas-day', NULL, NULL, 1, 1, '2026-07-18 06:53:00', '2026-07-18 06:53:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`name`)),
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `option_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`option_values`)),
  `option_signature` varchar(64) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `compare_at_price` decimal(15,2) DEFAULT NULL,
  `cost_price` decimal(15,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `weight_grams` int(10) UNSIGNED DEFAULT NULL,
  `stock_quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `name`, `sku`, `barcode`, `option_values`, `option_signature`, `price`, `compare_at_price`, `cost_price`, `image_url`, `weight_grams`, `stock_quantity`, `is_active`, `is_default`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"vi\":\"Bản I5/4/128 - Xanh cobalt Fullbox\",\"en\":\"Bản I5/4/128 - Xanh cobalt Fullbox\"}', '57552402417-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqc3om74kjm2e\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n I5\\/4\\/128\",\"M\\u00e0u S\\u1eafc\":\"Xanh cobalt Fullbox\"}}', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 5500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(2, 1, '{\"vi\":\"Bản I5/8/256 - Xanh cobalt Fullbox\",\"en\":\"Bản I5/8/256 - Xanh cobalt Fullbox\"}', '57552402417-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqc3om74kjm2e\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n I5\\/8\\/256\",\"M\\u00e0u S\\u1eafc\":\"Xanh cobalt Fullbox\"}}', '20e209ae66c885e8eaf64130875bd35c8ee1e291eff6d312b5b92042d9de1bc0', 5990000.00, NULL, NULL, NULL, NULL, 50, 1, 1, 2, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(3, 1, '{\"vi\":\"Bản I5/4/128 - Bạc Platinum\",\"en\":\"Bản I5/4/128 - Bạc Platinum\"}', '57552402417-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqc3om74kjm2e\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n I5\\/4\\/128\",\"M\\u00e0u S\\u1eafc\":\"B\\u1ea1c Platinum\"}}', '3298dcc8956d0e22e2f439fe21254d6e098248d53884e08c21a398d954304cbd', 4800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(4, 1, '{\"vi\":\"Bản I5/4/128 - Đỏ Hungary\",\"en\":\"Bản I5/4/128 - Đỏ Hungary\"}', '57552402417-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqc3om74kjm2e\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n I5\\/4\\/128\",\"M\\u00e0u S\\u1eafc\":\"\\u0110\\u1ecf Hungary\"}}', '85ecf561f64389d057d0e8b8823a3394f4b0e9823942feb18239f28d34841bf6', 4800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(5, 1, '{\"vi\":\"Bản I5/8/256 - Bạc Platinum\",\"en\":\"Bản I5/8/256 - Bạc Platinum\"}', '57552402417-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqc3om74kjm2e\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n I5\\/8\\/256\",\"M\\u00e0u S\\u1eafc\":\"B\\u1ea1c Platinum\"}}', '1724184efc12d0f0a0ce03acd1a3703bda9b154821854a03f331b45b4d25a1c5', 5800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(6, 1, '{\"vi\":\"Bản I5/8/256 - Đỏ Hungary\",\"en\":\"Bản I5/8/256 - Đỏ Hungary\"}', '57552402417-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqc3om74kjm2e\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n I5\\/8\\/256\",\"M\\u00e0u S\\u1eafc\":\"\\u0110\\u1ecf Hungary\"}}', '2c787b9c44ea869406b86e08caac54de9d29275ee23f44d3f02e3b20c5fd14bb', 5700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(7, 2, '{\"vi\":\"Bản i5/8/256 LTE - Máy+Sạc+Phím Hãng\",\"en\":\"Bản i5/8/256 LTE - Máy+Sạc+Phím Hãng\"}', '50654261968-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/8\\/256 LTE\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm H\\u00e3ng\"}}', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 6300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(8, 2, '{\"vi\":\"Bản i5/8/256 - Máy+Sạc+Phím Hãng\",\"en\":\"Bản i5/8/256 - Máy+Sạc+Phím Hãng\"}', '50654261968-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/8\\/256\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm H\\u00e3ng\"}}', '58fdf45e18580cb62d3700505590fb08212b55b44b3d4a73b9fccd1d17ac9c8d', 5990000.00, NULL, NULL, NULL, NULL, 50, 1, 1, 2, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(9, 2, '{\"vi\":\"Bản i5/8/128 - Máy + Sạc Hãng\",\"en\":\"Bản i5/8/128 - Máy + Sạc Hãng\"}', '50654261968-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/8\\/128\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y + S\\u1ea1c H\\u00e3ng\"}}', 'acb502da6688c05b98193906719a24b14c2936f63d9a63ab5c863507e673e228', 4550000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(10, 2, '{\"vi\":\"Bản i5/8/128 - Máy+Sạc+Phím Hãng\",\"en\":\"Bản i5/8/128 - Máy+Sạc+Phím Hãng\"}', '50654261968-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/8\\/128\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm H\\u00e3ng\"}}', '933089ce0350fdad99614a31e4034a6b012fdc438aefe1766c21c82d6d9ad148', 5300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(11, 2, '{\"vi\":\"Bản i7/16/512 - Máy+Sạc+Phím Hãng\",\"en\":\"Bản i7/16/512 - Máy+Sạc+Phím Hãng\"}', '50654261968-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/16\\/512\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm H\\u00e3ng\"}}', '1d987dc55c92d64ff0b4ccb98b57b774e7a2bfd619cb671fc3380b3289c846ad', 8400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(12, 2, '{\"vi\":\"Bản i7/8/256 - Máy + Sạc Hãng\",\"en\":\"Bản i7/8/256 - Máy + Sạc Hãng\"}', '50654261968-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/8\\/256\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y + S\\u1ea1c H\\u00e3ng\"}}', 'db7498621ea3db5f558ce907bc80eab10066dd50324123591be8c000c3bc790f', 6050000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(13, 2, '{\"vi\":\"Bản i7/8/256 - Máy+Sạc+Phím Hãng\",\"en\":\"Bản i7/8/256 - Máy+Sạc+Phím Hãng\"}', '50654261968-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/8\\/256\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm H\\u00e3ng\"}}', 'd9e451b4a48f26b8d4a9fc1b6c0f562cc25d1af10d42463319b5f871ceb7e7c7', 6800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(14, 2, '{\"vi\":\"Bản i5/8/256 - Máy + Sạc Hãng\",\"en\":\"Bản i5/8/256 - Máy + Sạc Hãng\"}', '50654261968-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/8\\/256\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y + S\\u1ea1c H\\u00e3ng\"}}', 'f0cd6f873a07c687cfb10346a65098dd590c28ab2a6394ceeffcd0d12eb35c3e', 5250000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(15, 2, '{\"vi\":\"Bản i5/8/256 LTE - Máy + Sạc Hãng\",\"en\":\"Bản i5/8/256 LTE - Máy + Sạc Hãng\"}', '50654261968-8', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/8\\/256 LTE\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y + S\\u1ea1c H\\u00e3ng\"}}', '943d960ce515e81a2a0ec4439570e2145e3044dc4717851d75361c207de1d628', 5550000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 9, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(16, 2, '{\"vi\":\"Bản i7/16/512 - Máy + Sạc Hãng\",\"en\":\"Bản i7/16/512 - Máy + Sạc Hãng\"}', '50654261968-9', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-8261f-mj6luqquisqrdb\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/16\\/512\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y + S\\u1ea1c H\\u00e3ng\"}}', 'f0b60f7f9877410388929db7f7685b85a47c758f291c6fb3529fcb24e1bd05f5', 7650000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 10, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(17, 3, '{\"vi\":\"i7 Ram 8 SSD 256 - Máy Sạc\",\"en\":\"i7 Ram 8 SSD 256 - Máy Sạc\"}', '29610450950-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\",\"options\":{\"Option\":\"i7 Ram 8 SSD 256\",\"Kh\\u00f4ng k\\u00e8m ph\\u00edm\":\"M\\u00e1y S\\u1ea1c\"}}', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 7700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(18, 3, '{\"vi\":\"i7 Ram 8 SSD 256 - Máy Sạc Phím\",\"en\":\"i7 Ram 8 SSD 256 - Máy Sạc Phím\"}', '29610450950-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\",\"options\":{\"Option\":\"i7 Ram 8 SSD 256\",\"Kh\\u00f4ng k\\u00e8m ph\\u00edm\":\"M\\u00e1y S\\u1ea1c Ph\\u00edm\"}}', 'f564ba9570b18acc66cddbb7b3f95c6b0a8b6e9fc869d2f5c7eb25ed2954a488', 8450000.00, NULL, NULL, NULL, NULL, 50, 1, 1, 2, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(19, 3, '{\"vi\":\"i7 Ram 16 SSD 512 - Máy Sạc\",\"en\":\"i7 Ram 16 SSD 512 - Máy Sạc\"}', '29610450950-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\",\"options\":{\"Option\":\"i7 Ram 16 SSD 512\",\"Kh\\u00f4ng k\\u00e8m ph\\u00edm\":\"M\\u00e1y S\\u1ea1c\"}}', '312be913071baf74c78574824ffcfe4fc1a0524c28e30d8f3c829f931562de11', 9050000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(20, 3, '{\"vi\":\"i7 Ram 16 SSD 512 - Máy Sạc Phím\",\"en\":\"i7 Ram 16 SSD 512 - Máy Sạc Phím\"}', '29610450950-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\",\"options\":{\"Option\":\"i7 Ram 16 SSD 512\",\"Kh\\u00f4ng k\\u00e8m ph\\u00edm\":\"M\\u00e1y S\\u1ea1c Ph\\u00edm\"}}', '407d396d94956633347d0a1af45b5599efab1572184f47e26268963756a28354', 9800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(21, 3, '{\"vi\":\"i5 Ram 8 SSD 128 - Máy Sạc\",\"en\":\"i5 Ram 8 SSD 128 - Máy Sạc\"}', '29610450950-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\",\"options\":{\"Option\":\"i5 Ram 8 SSD 128\",\"Kh\\u00f4ng k\\u00e8m ph\\u00edm\":\"M\\u00e1y S\\u1ea1c\"}}', '6010214a104a513d93024e5e2ed2af936afa3ee4260e6e3fcdf4324891860d2b', 6200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(22, 3, '{\"vi\":\"i5 Ram 8 SSD 128 - Máy Sạc Phím\",\"en\":\"i5 Ram 8 SSD 128 - Máy Sạc Phím\"}', '29610450950-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\",\"options\":{\"Option\":\"i5 Ram 8 SSD 128\",\"Kh\\u00f4ng k\\u00e8m ph\\u00edm\":\"M\\u00e1y S\\u1ea1c Ph\\u00edm\"}}', '577e2a6dd4066786e3e170519bc3100eb8776e48fbdde8687fdc20ac749f9c58', 6950000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(23, 3, '{\"vi\":\"i5 Ram 8 SSD 256 - Máy Sạc\",\"en\":\"i5 Ram 8 SSD 256 - Máy Sạc\"}', '29610450950-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\",\"options\":{\"Option\":\"i5 Ram 8 SSD 256\",\"Kh\\u00f4ng k\\u00e8m ph\\u00edm\":\"M\\u00e1y S\\u1ea1c\"}}', 'c671bdfae3015735bd9e7fb24cac15df7eb5e35c5c411e91aea79d2d7d1d4b35', 6900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(24, 3, '{\"vi\":\"i5 Ram 8 SSD 256 - Máy Sạc Phím\",\"en\":\"i5 Ram 8 SSD 256 - Máy Sạc Phím\"}', '29610450950-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1amtm7sd1o21\",\"options\":{\"Option\":\"i5 Ram 8 SSD 256\",\"Kh\\u00f4ng k\\u00e8m ph\\u00edm\":\"M\\u00e1y S\\u1ea1c Ph\\u00edm\"}}', 'df95aae816ed6e43c901fa53b9976f2f6b9b442d9b85007a6239fa93333bda4d', 7650000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(25, 4, '{\"vi\":\"85%-90%\",\"en\":\"85%-90%\"}', '29817786016-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mazrkz3hzeks7b\",\"options\":{\"Ch\\u00e2t L\\u01b0\\u1ee3ng\":\"85%-90%\"}}', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 790000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(26, 4, '{\"vi\":\"75%-80%\",\"en\":\"75%-80%\"}', '29817786016-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mazrkz3hzeks7b\",\"options\":{\"Ch\\u00e2t L\\u01b0\\u1ee3ng\":\"75%-80%\"}}', '36956d476ea3ad377c7a6ba5df1befe829039f22ce5f688c867a0852dfc693e0', 590000.00, NULL, NULL, NULL, NULL, 50, 1, 1, 2, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(27, 4, '{\"vi\":\"Phím Vân Tay\",\"en\":\"Phím Vân Tay\"}', '29817786016-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mazrkz3hzeks7b\",\"options\":{\"Ch\\u00e2t L\\u01b0\\u1ee3ng\":\"Ph\\u00edm V\\u00e2n Tay\"}}', '5779c967343ed8ad155ddda3f55392a7f773cd46aa155189f6d74c77d80dc743', 1100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(28, 4, '{\"vi\":\"70%-75%\",\"en\":\"70%-75%\"}', '29817786016-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mazrkz3hzeks7b\",\"options\":{\"Ch\\u00e2t L\\u01b0\\u1ee3ng\":\"70%-75%\"}}', '3139e32006db090444ce3f359745679c05afae124609c13bc44a23fa44e06c8a', 520000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(29, 4, '{\"vi\":\"80%-85%\",\"en\":\"80%-85%\"}', '29817786016-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mazrkz3hzeks7b\",\"options\":{\"Ch\\u00e2t L\\u01b0\\u1ee3ng\":\"80%-85%\"}}', 'd513a93e84a1294c3cf252749bbb2bf6bf452127ec72eb2f5fd6b5117c141208', 690000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(30, 5, '{\"vi\":\"BOOK 1 I5/8/128\",\"en\":\"BOOK 1 I5/8/128\"}', '47158280979-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmoaupsqymf6ea\",\"options\":{\"PH\\u00c2N LO\\u1ea0I\":\"BOOK 1 I5\\/8\\/128\"}}', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 3500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(31, 5, '{\"vi\":\"BOOK1 I7/16/1T K Cảm\",\"en\":\"BOOK1 I7/16/1T K Cảm\"}', '47158280979-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmoaupsqymf6ea\",\"options\":{\"PH\\u00c2N LO\\u1ea0I\":\"BOOK1 I7\\/16\\/1T K C\\u1ea3m\"}}', 'e67e3539deff82933539a6ea96ef17a7f6a772ef903e31528516efd69f8ac587', 5400000.00, NULL, NULL, NULL, NULL, 50, 1, 1, 2, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(32, 6, '{\"vi\":\"Bản i7 Ram 8/256 - Máy+Sạc\",\"en\":\"Bản i7 Ram 8/256 - Máy+Sạc\"}', '28665698299-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\",\"options\":{\"Option\":\"B\\u1ea3n i7 Ram 8\\/256\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c\"}}', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 4100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(33, 6, '{\"vi\":\"Bản i7 Ram 8/256 - Máy+Sạc+Phím\",\"en\":\"Bản i7 Ram 8/256 - Máy+Sạc+Phím\"}', '28665698299-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\",\"options\":{\"Option\":\"B\\u1ea3n i7 Ram 8\\/256\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm\"}}', '986c1c4be9f2ceb5b390067cbe0f3d977a7bf0607903c850de2315c6b3b4e13c', 4700000.00, NULL, NULL, NULL, NULL, 50, 1, 1, 2, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(34, 6, '{\"vi\":\"Bản i5 Ram 4/128 - Máy+Sạc\",\"en\":\"Bản i5 Ram 4/128 - Máy+Sạc\"}', '28665698299-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\",\"options\":{\"Option\":\"B\\u1ea3n i5 Ram 4\\/128\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c\"}}', '506673e3e8d1823706e1bdd2edf489f6fceb85e0da866789e4570e6aabed49f7', 2800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(35, 6, '{\"vi\":\"Bản i5 Ram 4/128 - Máy+Sạc+Phím\",\"en\":\"Bản i5 Ram 4/128 - Máy+Sạc+Phím\"}', '28665698299-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\",\"options\":{\"Option\":\"B\\u1ea3n i5 Ram 4\\/128\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm\"}}', '69bde60d74cf266fa2fb0b0199dc1b49e6b7ee08bd34c1ebe081f98c92b9d434', 3400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(36, 6, '{\"vi\":\"Bản i7 Ram 8/512 - Máy+Sạc\",\"en\":\"Bản i7 Ram 8/512 - Máy+Sạc\"}', '28665698299-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\",\"options\":{\"Option\":\"B\\u1ea3n i7 Ram 8\\/512\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c\"}}', '77ac493160902a8f6758d2a9242f549ebcef4d0d5c520b39a6a7051153d282a3', 5100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(37, 6, '{\"vi\":\"Bản i7 Ram 8/512 - Máy+Sạc+Phím\",\"en\":\"Bản i7 Ram 8/512 - Máy+Sạc+Phím\"}', '28665698299-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\",\"options\":{\"Option\":\"B\\u1ea3n i7 Ram 8\\/512\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm\"}}', '9b019f8ddcf820496debc74b1cb77fe2ba86f9665653c5f92ba6085f5ac21ff4', 5700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(38, 6, '{\"vi\":\"Bản i5 Ram 8/256 - Máy+Sạc\",\"en\":\"Bản i5 Ram 8/256 - Máy+Sạc\"}', '28665698299-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\",\"options\":{\"Option\":\"B\\u1ea3n i5 Ram 8\\/256\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c\"}}', '23400a2d23b33a17d9bfdf70fe7cc72cd8a42d0648fc356964d5f73e40822f83', 3600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(39, 6, '{\"vi\":\"Bản i5 Ram 8/256 - Máy+Sạc+Phím\",\"en\":\"Bản i5 Ram 8/256 - Máy+Sạc+Phím\"}', '28665698299-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-memibo9xle6fad\",\"options\":{\"Option\":\"B\\u1ea3n i5 Ram 8\\/256\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm\"}}', 'aa5452dd674f8418dae0ce3557490c19a280ffaf5dcb7897d824d51c0d7050ff', 4200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(40, 7, '{\"vi\":\"Máy+sạc+phím hãng - I5 Ram 16 SSD 256\",\"en\":\"Máy+sạc+phím hãng - I5 Ram 16 SSD 256\"}', '28613436958-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\",\"options\":{\"Opion\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\",\"Ram v\\u00e0 SSD\":\"I5 Ram 16 SSD 256\"}}', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', 10100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(41, 7, '{\"vi\":\"Máy sạc - I5 Ram 8 SSD 128\",\"en\":\"Máy sạc - I5 Ram 8 SSD 128\"}', '28613436958-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\",\"options\":{\"Opion\":\"M\\u00e1y s\\u1ea1c\",\"Ram v\\u00e0 SSD\":\"I5 Ram 8 SSD 128\"}}', '9698ec417cbd81c4ad9e2cb34f0b98b93c1492016407c5ef5dcab9617924b366', 7990000.00, NULL, NULL, NULL, NULL, 50, 1, 1, 2, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(42, 7, '{\"vi\":\"Máy+sạc+phím hãng - I5 Ram 8 SSD 128\",\"en\":\"Máy+sạc+phím hãng - I5 Ram 8 SSD 128\"}', '28613436958-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\",\"options\":{\"Opion\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\",\"Ram v\\u00e0 SSD\":\"I5 Ram 8 SSD 128\"}}', '9464208fd5478467199e0efde8620337c8ef541687bb75892ef1d69031fd7dc3', 8800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(43, 7, '{\"vi\":\"Máy sạc - I5 Ram 8 SSD 256\",\"en\":\"Máy sạc - I5 Ram 8 SSD 256\"}', '28613436958-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\",\"options\":{\"Opion\":\"M\\u00e1y s\\u1ea1c\",\"Ram v\\u00e0 SSD\":\"I5 Ram 8 SSD 256\"}}', '4dfcac828b9aa9e27cedd9188d079fb6ad444b3233cb3bc37206df7dd07dc6e5', 8700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(44, 7, '{\"vi\":\"Máy+sạc+phím hãng - I5 Ram 8 SSD 256\",\"en\":\"Máy+sạc+phím hãng - I5 Ram 8 SSD 256\"}', '28613436958-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\",\"options\":{\"Opion\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\",\"Ram v\\u00e0 SSD\":\"I5 Ram 8 SSD 256\"}}', '19cc012e2e9e8dc76c97886fa0b39757d72004f46986b67eb16b5775cd11dbc9', 9500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(45, 7, '{\"vi\":\"Máy sạc - I7 Ram 16 SSD 512\",\"en\":\"Máy sạc - I7 Ram 16 SSD 512\"}', '28613436958-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\",\"options\":{\"Opion\":\"M\\u00e1y s\\u1ea1c\",\"Ram v\\u00e0 SSD\":\"I7 Ram 16 SSD 512\"}}', '055dc8f5bb5df78a1ffca310119278cf3deea0f4ff6ca38f5fdd322d3b4eb0ec', 11500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(46, 7, '{\"vi\":\"Máy+sạc+phím hãng - I7 Ram 16 SSD 512\",\"en\":\"Máy+sạc+phím hãng - I7 Ram 16 SSD 512\"}', '28613436958-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\",\"options\":{\"Opion\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\",\"Ram v\\u00e0 SSD\":\"I7 Ram 16 SSD 512\"}}', '4311054adb9191c1da668903914b6fd6226e7beffabbb0f7d88ad10b7302b683', 12300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(47, 7, '{\"vi\":\"Máy sạc - I5 Ram 16 SSD 256\",\"en\":\"Máy sạc - I5 Ram 16 SSD 256\"}', '28613436958-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miisalvzej9dc6\",\"options\":{\"Opion\":\"M\\u00e1y s\\u1ea1c\",\"Ram v\\u00e0 SSD\":\"I5 Ram 16 SSD 256\"}}', '7aedd209077490146be270155bd3b17e704c128b6f7541579c05fe9e2fdfafff', 9300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(48, 8, '{\"vi\":\"Surface Pen GEN 4 - Không box 95%\",\"en\":\"Surface Pen GEN 4 - Không box 95%\"}', '29913523969-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface Pen GEN 4\",\"T\\u00ecnh tr\\u1ea1ng\":\"Kh\\u00f4ng box 95%\"}}', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3', 999000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(49, 8, '{\"vi\":\"Sạc Surface Pen+2 - Không box 95%\",\"en\":\"Sạc Surface Pen+2 - Không box 95%\"}', '29913523969-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"S\\u1ea1c Surface Pen+2\",\"T\\u00ecnh tr\\u1ea1ng\":\"Kh\\u00f4ng box 95%\"}}', '878551a0c724e101d4569d00bbb0ac88b42142654291634e99868f5911da6f20', 1000000.00, NULL, NULL, NULL, NULL, 50, 1, 1, 2, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(50, 8, '{\"vi\":\"Surface SlimPen 2 - Không box 95%\",\"en\":\"Surface SlimPen 2 - Không box 95%\"}', '29913523969-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface SlimPen 2\",\"T\\u00ecnh tr\\u1ea1ng\":\"Kh\\u00f4ng box 95%\"}}', '920f9a8c350f462e448c1b648b70ff3b08ef16e48dfe605e2228b50797bd431a', 1900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(51, 8, '{\"vi\":\"Surface SlimPen 1 - Không box 95%\",\"en\":\"Surface SlimPen 1 - Không box 95%\"}', '29913523969-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface SlimPen 1\",\"T\\u00ecnh tr\\u1ea1ng\":\"Kh\\u00f4ng box 95%\"}}', '9c86d229d80ed08cbc79c8a8b2dc3be727ea2e3dfe15f64ffe0b19de24a8d680', 1500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(52, 8, '{\"vi\":\"SlimPen1+Sạc fullbox - Fullbox 95%\",\"en\":\"SlimPen1+Sạc fullbox - Fullbox 95%\"}', '29913523969-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"SlimPen1+S\\u1ea1c fullbox\",\"T\\u00ecnh tr\\u1ea1ng\":\"Fullbox 95%\"}}', '62569b513d3ceb4e524906fe9af3bef0f71565ccd32a65badd13e087316d8f45', 1800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(53, 8, '{\"vi\":\"SlimPen1+Sạc fullbox - Không box 95%\",\"en\":\"SlimPen1+Sạc fullbox - Không box 95%\"}', '29913523969-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"SlimPen1+S\\u1ea1c fullbox\",\"T\\u00ecnh tr\\u1ea1ng\":\"Kh\\u00f4ng box 95%\"}}', 'eb6c5516d68b42518dfdd90c1bffa241f095977c65bf5e40188d1b435ec11294', 1300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(54, 8, '{\"vi\":\"Surface SlimPen 1 - Fullbox 95%\",\"en\":\"Surface SlimPen 1 - Fullbox 95%\"}', '29913523969-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface SlimPen 1\",\"T\\u00ecnh tr\\u1ea1ng\":\"Fullbox 95%\"}}', '84ef90298a40c35a184be16da5b7b5f0276bc03e2002597c96659b64c5199ceb', 1700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(55, 8, '{\"vi\":\"Surface Pen GEN 3 - Fullbox 95%\",\"en\":\"Surface Pen GEN 3 - Fullbox 95%\"}', '29913523969-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface Pen GEN 3\",\"T\\u00ecnh tr\\u1ea1ng\":\"Fullbox 95%\"}}', '1f92dc4e547e0869de8340dc0289e090ab71650a248058930b19966f36ebf448', 850000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(56, 8, '{\"vi\":\"Sạc Surface Pen+2 - Fullbox 95%\",\"en\":\"Sạc Surface Pen+2 - Fullbox 95%\"}', '29913523969-8', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"S\\u1ea1c Surface Pen+2\",\"T\\u00ecnh tr\\u1ea1ng\":\"Fullbox 95%\"}}', 'c0502eb204666672a95293e97f1c978db02ef51c70533ea083ff27008f0c5109', 1300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 9, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(57, 8, '{\"vi\":\"Surface Pen GEN 2 - Không box 95%\",\"en\":\"Surface Pen GEN 2 - Không box 95%\"}', '29913523969-9', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface Pen GEN 2\",\"T\\u00ecnh tr\\u1ea1ng\":\"Kh\\u00f4ng box 95%\"}}', 'a9e4e9a612c0e29ba7fff2e55d0ad28c45e16f3f3e5686ef2a5987a93657ebb4', 490000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 10, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(58, 8, '{\"vi\":\"Surface SlimPen 2 - Fullbox 95%\",\"en\":\"Surface SlimPen 2 - Fullbox 95%\"}', '29913523969-10', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface SlimPen 2\",\"T\\u00ecnh tr\\u1ea1ng\":\"Fullbox 95%\"}}', '9653f10edee3036bfcc3fd378265dccbada01e74bd611e4b289ef1ae52612802', 2100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 11, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(59, 8, '{\"vi\":\"Surface Pen GEN 2 - Fullbox 95%\",\"en\":\"Surface Pen GEN 2 - Fullbox 95%\"}', '29913523969-11', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface Pen GEN 2\",\"T\\u00ecnh tr\\u1ea1ng\":\"Fullbox 95%\"}}', 'eafbda6a3f4907ee5eea47c42dfd7ea07f2009fc7c03795af5cee051bba59302', 590000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 12, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(60, 8, '{\"vi\":\"Surface Pen GEN 3 - Không box 95%\",\"en\":\"Surface Pen GEN 3 - Không box 95%\"}', '29913523969-12', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface Pen GEN 3\",\"T\\u00ecnh tr\\u1ea1ng\":\"Kh\\u00f4ng box 95%\"}}', '84969b3ac806c237b5f0986349b08208febee4bb9d2fa944fd78b2177120cafd', 700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 13, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(61, 8, '{\"vi\":\"Surface Pen GEN 4 - Fullbox 95%\",\"en\":\"Surface Pen GEN 4 - Fullbox 95%\"}', '29913523969-13', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8w2p45wse2sf8\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"Surface Pen GEN 4\",\"T\\u00ecnh tr\\u1ea1ng\":\"Fullbox 95%\"}}', 'd520d170619313010e0e477353ba6b07414cfb1a7b39695a5c141b0992e6a8b7', 1200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 14, '2026-07-08 00:02:48', '2026-07-18 06:43:50'),
(62, 9, '{\"vi\":\"Máy+sạc+phím zin - Không LTE\",\"en\":\"Máy+sạc+phím zin - Không LTE\"}', '28709848155-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1ao01z3aq75c\",\"options\":{\"Option\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm zin\",\"Option 2\":\"Kh\\u00f4ng LTE\"}}', NULL, 3800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(63, 9, '{\"vi\":\"Máy trần - Không LTE\",\"en\":\"Máy trần - Không LTE\"}', '28709848155-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1ao01z3aq75c\",\"options\":{\"Option\":\"M\\u00e1y tr\\u1ea7n\",\"Option 2\":\"Kh\\u00f4ng LTE\"}}', NULL, 2850000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(64, 9, '{\"vi\":\"Máy trần - Bản LTE\",\"en\":\"Máy trần - Bản LTE\"}', '28709848155-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1ao01z3aq75c\",\"options\":{\"Option\":\"M\\u00e1y tr\\u1ea7n\",\"Option 2\":\"B\\u1ea3n LTE\"}}', NULL, 3150000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(65, 9, '{\"vi\":\"Máy+sạc - Bản LTE\",\"en\":\"Máy+sạc - Bản LTE\"}', '28709848155-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1ao01z3aq75c\",\"options\":{\"Option\":\"M\\u00e1y+s\\u1ea1c\",\"Option 2\":\"B\\u1ea3n LTE\"}}', NULL, 3400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(66, 9, '{\"vi\":\"Máy+sạc - Không LTE\",\"en\":\"Máy+sạc - Không LTE\"}', '28709848155-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1ao01z3aq75c\",\"options\":{\"Option\":\"M\\u00e1y+s\\u1ea1c\",\"Option 2\":\"Kh\\u00f4ng LTE\"}}', NULL, 3100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(67, 9, '{\"vi\":\"Máy+sạc+phím zin - Bản LTE\",\"en\":\"Máy+sạc+phím zin - Bản LTE\"}', '28709848155-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mf1ao01z3aq75c\",\"options\":{\"Option\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm zin\",\"Option 2\":\"B\\u1ea3n LTE\"}}', NULL, 4100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(68, 11, '{\"vi\":\"HUB Chia 8 USB 3.0\",\"en\":\"HUB Chia 8 USB 3.0\"}', '29712717942-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m467z4pvizs085\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"HUB Chia 8 USB 3.0\"}}', NULL, 129000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(69, 11, '{\"vi\":\"HUB Chia 8 4K\",\"en\":\"HUB Chia 8 4K\"}', '29712717942-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m467z4pvizs085\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"HUB Chia 8 4K\"}}', NULL, 239000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(70, 11, '{\"vi\":\"HUB Chia 5 4K\",\"en\":\"HUB Chia 5 4K\"}', '29712717942-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m467z4pvizs085\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"HUB Chia 5 4K\"}}', NULL, 129000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(71, 11, '{\"vi\":\"HUB USB 3.0  ra 4\",\"en\":\"HUB USB 3.0  ra 4\"}', '29712717942-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m467z4pvizs085\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"HUB USB 3.0  ra 4\"}}', NULL, 59000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(72, 11, '{\"vi\":\"HUB Type C  ra 4 USB\",\"en\":\"HUB Type C  ra 4 USB\"}', '29712717942-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m467z4pvizs085\",\"options\":{\"Ph\\u00e2n Lo\\u1ea1i\":\"HUB Type C  ra 4 USB\"}}', NULL, 59000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(73, 12, '{\"vi\":\"M3/8/128 WIFI - MÁY SẠC\",\"en\":\"M3/8/128 WIFI - MÁY SẠC\"}', '29065677489-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"M3\\/8\\/128 WIFI\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 5300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(74, 12, '{\"vi\":\"M3/8/128 WIFI - MÁY+SẠC+PHÍM\",\"en\":\"M3/8/128 WIFI - MÁY+SẠC+PHÍM\"}', '29065677489-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"M3\\/8\\/128 WIFI\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 5990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(75, 12, '{\"vi\":\"M3/8/128 WIFI - MÁY TRẦN\",\"en\":\"M3/8/128 WIFI - MÁY TRẦN\"}', '29065677489-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"M3\\/8\\/128 WIFI\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y TR\\u1ea6N\"}}', NULL, 5050000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(76, 12, '{\"vi\":\"M3/8/128 WIFI+LTE - MÁY TRẦN\",\"en\":\"M3/8/128 WIFI+LTE - MÁY TRẦN\"}', '29065677489-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"M3\\/8\\/128 WIFI+LTE\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y TR\\u1ea6N\"}}', NULL, 5400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(77, 12, '{\"vi\":\"Pen/4/64 - MÁY TRẦN\",\"en\":\"Pen/4/64 - MÁY TRẦN\"}', '29065677489-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"Pen\\/4\\/64\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y TR\\u1ea6N\"}}', NULL, 2750000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(78, 12, '{\"vi\":\"M3/8/128 WIFI+LTE - MÁY SẠC\",\"en\":\"M3/8/128 WIFI+LTE - MÁY SẠC\"}', '29065677489-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"M3\\/8\\/128 WIFI+LTE\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 5650000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(79, 12, '{\"vi\":\"Pen/4/64 - MÁY SẠC\",\"en\":\"Pen/4/64 - MÁY SẠC\"}', '29065677489-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"Pen\\/4\\/64\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 2990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(80, 12, '{\"vi\":\"M3/8/128 WIFI+LTE - MÁY+SẠC+PHÍM\",\"en\":\"M3/8/128 WIFI+LTE - MÁY+SẠC+PHÍM\"}', '29065677489-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"M3\\/8\\/128 WIFI+LTE\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 6350000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(81, 12, '{\"vi\":\"PEN/8/128 WIFI - MÁY+SẠC+PHÍM\",\"en\":\"PEN/8/128 WIFI - MÁY+SẠC+PHÍM\"}', '29065677489-8', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"PEN\\/8\\/128 WIFI\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 4990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 9, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(82, 12, '{\"vi\":\"PEN/8/128 WIFI - MÁY SẠC\",\"en\":\"PEN/8/128 WIFI - MÁY SẠC\"}', '29065677489-9', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"PEN\\/8\\/128 WIFI\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 4300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 10, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(83, 12, '{\"vi\":\"Pen/4/64 - MÁY+SẠC+PHÍM\",\"en\":\"Pen/4/64 - MÁY+SẠC+PHÍM\"}', '29065677489-10', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"Pen\\/4\\/64\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 3700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 11, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(84, 12, '{\"vi\":\"PEN/8/128 WIFI - MÁY TRẦN\",\"en\":\"PEN/8/128 WIFI - MÁY TRẦN\"}', '29065677489-11', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjusnz5tj6djc5\",\"options\":{\"Wifi\\/LTE\":\"PEN\\/8\\/128 WIFI\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y TR\\u1ea6N\"}}', NULL, 4050000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 12, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(85, 13, '{\"vi\":\"Dock Surface\",\"en\":\"Dock Surface\"}', '25486055477-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m0gupt48odf146\",\"options\":{\"Option\":\"Dock Surface\"}}', NULL, 419000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(86, 13, '{\"vi\":\"Sạc 6A +Dây nguồn\",\"en\":\"Sạc 6A +Dây nguồn\"}', '25486055477-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m0gupt48odf146\",\"options\":{\"Option\":\"S\\u1ea1c 6A +D\\u00e2y ngu\\u1ed3n\"}}', NULL, 327000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(87, 13, '{\"vi\":\"Combo Dock+Sạc\",\"en\":\"Combo Dock+Sạc\"}', '25486055477-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m0gupt48odf146\",\"options\":{\"Option\":\"Combo Dock+S\\u1ea1c\"}}', NULL, 715000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(88, 14, '{\"vi\":\"I5/8/512 Xanh Blue\",\"en\":\"I5/8/512 Xanh Blue\"}', '51802416463-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqclv1wbchyb2\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"I5\\/8\\/512 Xanh Blue\"}}', NULL, 9900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(89, 14, '{\"vi\":\"Hồng Sandstone 96%\",\"en\":\"Hồng Sandstone 96%\"}', '51802416463-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqclv1wbchyb2\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"H\\u1ed3ng Sandstone 96%\"}}', NULL, 9200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(90, 14, '{\"vi\":\"Xanh Ice Blue 97%\",\"en\":\"Xanh Ice Blue 97%\"}', '51802416463-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqclv1wbchyb2\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Xanh Ice Blue 97%\"}}', NULL, 8700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(91, 14, '{\"vi\":\"Bạc Platinum 96%\",\"en\":\"Bạc Platinum 96%\"}', '51802416463-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqclv1wbchyb2\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"B\\u1ea1c Platinum 96%\"}}', NULL, 8600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(92, 17, '{\"vi\":\"Hồng Sandstone\",\"en\":\"Hồng Sandstone\"}', '43561819257-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-meqk9o8sderqf4\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"H\\u1ed3ng Sandstone\"}}', NULL, 8400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(93, 17, '{\"vi\":\"Xanh Ice Blue\",\"en\":\"Xanh Ice Blue\"}', '43561819257-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-meqk9o8sderqf4\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Xanh Ice Blue\"}}', NULL, 7900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(94, 17, '{\"vi\":\"Bạc Platinum\",\"en\":\"Bạc Platinum\"}', '43561819257-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-meqk9o8sderqf4\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"B\\u1ea1c Platinum\"}}', NULL, 7800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(95, 18, '{\"vi\":\"MÁY SẠC PHÍM ZIN\",\"en\":\"MÁY SẠC PHÍM ZIN\"}', '26419152170-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mig2nt4unw1y00\",\"options\":{\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM ZIN\"}}', NULL, 3150000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(96, 18, '{\"vi\":\"MÁY + PHÍM BLUETOOTH\",\"en\":\"MÁY + PHÍM BLUETOOTH\"}', '26419152170-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mig2nt4unw1y00\",\"options\":{\"OPTION\":\"M\\u00c1Y + PH\\u00cdM BLUETOOTH\"}}', NULL, 2550000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(97, 18, '{\"vi\":\"MÁY SẠC\",\"en\":\"MÁY SẠC\"}', '26419152170-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mig2nt4unw1y00\",\"options\":{\"OPTION\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 2450000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(98, 19, '{\"vi\":\"Bản i5/8/256 - Máy Sạc\",\"en\":\"Bản i5/8/256 - Máy Sạc\"}', '27418244924-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfdtvt2mmb43\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/8\\/256\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y S\\u1ea1c\"}}', NULL, 6900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(99, 19, '{\"vi\":\"Bản i5/8/256 - Máy Sạc Phím Hãng\",\"en\":\"Bản i5/8/256 - Máy Sạc Phím Hãng\"}', '27418244924-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfdtvt2mmb43\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/8\\/256\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y S\\u1ea1c Ph\\u00edm H\\u00e3ng\"}}', NULL, 7650000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(100, 19, '{\"vi\":\"Bản i7/16/512 - Máy Sạc\",\"en\":\"Bản i7/16/512 - Máy Sạc\"}', '27418244924-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfdtvt2mmb43\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/16\\/512\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y S\\u1ea1c\"}}', NULL, 8900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(101, 19, '{\"vi\":\"Bản i7/16/512 - Máy Sạc Phím Hãng\",\"en\":\"Bản i7/16/512 - Máy Sạc Phím Hãng\"}', '27418244924-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfdtvt2mmb43\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/16\\/512\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y S\\u1ea1c Ph\\u00edm H\\u00e3ng\"}}', NULL, 9650000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(102, 19, '{\"vi\":\"Bản i7/8/256 - Máy Sạc\",\"en\":\"Bản i7/8/256 - Máy Sạc\"}', '27418244924-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfdtvt2mmb43\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/8\\/256\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y S\\u1ea1c\"}}', NULL, 7700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(103, 19, '{\"vi\":\"Bản i7/8/256 - Máy Sạc Phím Hãng\",\"en\":\"Bản i7/8/256 - Máy Sạc Phím Hãng\"}', '27418244924-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfdtvt2mmb43\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/8\\/256\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y S\\u1ea1c Ph\\u00edm H\\u00e3ng\"}}', NULL, 8450000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(104, 20, '{\"vi\":\"Cáp 45W C to Surface\",\"en\":\"Cáp 45W C to Surface\"}', '42129757784-0', '8930000000104', '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmmrowtl4ikm46\",\"options\":{\"OPTION\":\"C\\u00e1p 45W C to Surface\"}}', NULL, 890000.00, 1040000.00, 460000.00, NULL, 780, 4, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-18 06:53:00'),
(105, 20, '{\"vi\":\"Chuyển C to Surface\",\"en\":\"Chuyển C to Surface\"}', '42129757784-1', '8930000000105', '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmmrowtl4ikm46\",\"options\":{\"OPTION\":\"Chuy\\u1ec3n C to Surface\"}}', NULL, 890000.00, 1040000.00, 460000.00, NULL, 780, 4, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-18 06:53:00'),
(106, 21, '{\"vi\":\"Máy+Sạc+Phím - Ram 8 SSD 128 LTE\",\"en\":\"Máy+Sạc+Phím - Ram 8 SSD 128 LTE\"}', '28119890936-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mek8wwxmnwuea8\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm\",\"Ram V\\u00e0 SSD\":\"Ram 8 SSD 128 LTE\"}}', NULL, 10300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(107, 21, '{\"vi\":\"Máy+Sạc+Phím+Bút - Ram 8 SSD 128 LTE\",\"en\":\"Máy+Sạc+Phím+Bút - Ram 8 SSD 128 LTE\"}', '28119890936-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mek8wwxmnwuea8\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm+B\\u00fat\",\"Ram V\\u00e0 SSD\":\"Ram 8 SSD 128 LTE\"}}', NULL, 10900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(108, 21, '{\"vi\":\"Máy+Sạc - Ram 8 SSD 256 LTE\",\"en\":\"Máy+Sạc - Ram 8 SSD 256 LTE\"}', '28119890936-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mek8wwxmnwuea8\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c\",\"Ram V\\u00e0 SSD\":\"Ram 8 SSD 256 LTE\"}}', NULL, 10400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(109, 21, '{\"vi\":\"Máy+Sạc - Ram 8 SSD 128 LTE\",\"en\":\"Máy+Sạc - Ram 8 SSD 128 LTE\"}', '28119890936-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mek8wwxmnwuea8\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c\",\"Ram V\\u00e0 SSD\":\"Ram 8 SSD 128 LTE\"}}', NULL, 9500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(110, 21, '{\"vi\":\"Máy+Sạc+Phím - Ram 8 SSD 256 LTE\",\"en\":\"Máy+Sạc+Phím - Ram 8 SSD 256 LTE\"}', '28119890936-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mek8wwxmnwuea8\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm\",\"Ram V\\u00e0 SSD\":\"Ram 8 SSD 256 LTE\"}}', NULL, 11200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(111, 21, '{\"vi\":\"Máy+Sạc+Phím+Bút - Ram 8 SSD 256 LTE\",\"en\":\"Máy+Sạc+Phím+Bút - Ram 8 SSD 256 LTE\"}', '28119890936-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mek8wwxmnwuea8\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm+B\\u00fat\",\"Ram V\\u00e0 SSD\":\"Ram 8 SSD 256 LTE\"}}', NULL, 11800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(112, 22, '{\"vi\":\"Bạc Platinum 96% - NVMe 128GB\",\"en\":\"Bạc Platinum 96% - NVMe 128GB\"}', '40168075268-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqbfe6142rsba\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"B\\u1ea1c Platinum 96%\",\"B\\u1ed8 NH\\u1eda\":\"NVMe 128GB\"}}', NULL, 9800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(113, 22, '{\"vi\":\"Xanh Sage 97% - NVMe 128GB\",\"en\":\"Xanh Sage 97% - NVMe 128GB\"}', '40168075268-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqbfe6142rsba\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Xanh Sage 97%\",\"B\\u1ed8 NH\\u1eda\":\"NVMe 128GB\"}}', NULL, 10300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(114, 22, '{\"vi\":\"Bạc Platinum 96% - NVMe 256GB\",\"en\":\"Bạc Platinum 96% - NVMe 256GB\"}', '40168075268-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqbfe6142rsba\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"B\\u1ea1c Platinum 96%\",\"B\\u1ed8 NH\\u1eda\":\"NVMe 256GB\"}}', NULL, 10700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(115, 22, '{\"vi\":\"Xanh Sage 97% - NVMe 256GB\",\"en\":\"Xanh Sage 97% - NVMe 256GB\"}', '40168075268-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqbfe6142rsba\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Xanh Sage 97%\",\"B\\u1ed8 NH\\u1eda\":\"NVMe 256GB\"}}', NULL, 11200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(116, 22, '{\"vi\":\"Hồng Sandtone 96% - NVMe 128GB\",\"en\":\"Hồng Sandtone 96% - NVMe 128GB\"}', '40168075268-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqbfe6142rsba\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"H\\u1ed3ng Sandtone 96%\",\"B\\u1ed8 NH\\u1eda\":\"NVMe 128GB\"}}', NULL, 10500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48');
INSERT INTO `product_variants` (`id`, `product_id`, `name`, `sku`, `barcode`, `option_values`, `option_signature`, `price`, `compare_at_price`, `cost_price`, `image_url`, `weight_grams`, `stock_quantity`, `is_active`, `is_default`, `sort_order`, `created_at`, `updated_at`) VALUES
(117, 22, '{\"vi\":\"Hồng Sandtone 96% - NVMe 256GB\",\"en\":\"Hồng Sandtone 96% - NVMe 256GB\"}', '40168075268-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqbfe6142rsba\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"H\\u1ed3ng Sandtone 96%\",\"B\\u1ed8 NH\\u1eda\":\"NVMe 256GB\"}}', NULL, 11400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(118, 22, '{\"vi\":\"Xanh Ice Blue 98% - NVMe 128GB\",\"en\":\"Xanh Ice Blue 98% - NVMe 128GB\"}', '40168075268-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqbfe6142rsba\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Xanh Ice Blue 98%\",\"B\\u1ed8 NH\\u1eda\":\"NVMe 128GB\"}}', NULL, 10400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(119, 22, '{\"vi\":\"Xanh Ice Blue 98% - NVMe 256GB\",\"en\":\"Xanh Ice Blue 98% - NVMe 256GB\"}', '40168075268-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhqbfe6142rsba\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Xanh Ice Blue 98%\",\"B\\u1ed8 NH\\u1eda\":\"NVMe 256GB\"}}', NULL, 11300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(120, 24, '{\"vi\":\"Hồng Sandtone - i5 Ram 16 SSD 256\",\"en\":\"Hồng Sandtone - i5 Ram 16 SSD 256\"}', '27324942106-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"H\\u1ed3ng Sandtone\",\"C\\u1ea5u H\\u00ecnh\":\"i5 Ram 16 SSD 256\"}}', NULL, 11000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(121, 24, '{\"vi\":\"Đen Matte - i5 Ram 16 SSD 256\",\"en\":\"Đen Matte - i5 Ram 16 SSD 256\"}', '27324942106-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"\\u0110en Matte\",\"C\\u1ea5u H\\u00ecnh\":\"i5 Ram 16 SSD 256\"}}', NULL, 9700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(122, 24, '{\"vi\":\"Bạc Platinum - i7 Ram 16 SSD 256\",\"en\":\"Bạc Platinum - i7 Ram 16 SSD 256\"}', '27324942106-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"B\\u1ea1c Platinum\",\"C\\u1ea5u H\\u00ecnh\":\"i7 Ram 16 SSD 256\"}}', NULL, 10400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(123, 24, '{\"vi\":\"Bạc Platinum - i7 Ram 16 SSD 512\",\"en\":\"Bạc Platinum - i7 Ram 16 SSD 512\"}', '27324942106-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"B\\u1ea1c Platinum\",\"C\\u1ea5u H\\u00ecnh\":\"i7 Ram 16 SSD 512\"}}', NULL, 11000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(124, 24, '{\"vi\":\"Đen Matte - i7 Ram 16 SSD 512\",\"en\":\"Đen Matte - i7 Ram 16 SSD 512\"}', '27324942106-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"\\u0110en Matte\",\"C\\u1ea5u H\\u00ecnh\":\"i7 Ram 16 SSD 512\"}}', NULL, 11000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(125, 24, '{\"vi\":\"Hồng Sandtone - i7 Ram 16 SSD 256\",\"en\":\"Hồng Sandtone - i7 Ram 16 SSD 256\"}', '27324942106-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"H\\u1ed3ng Sandtone\",\"C\\u1ea5u H\\u00ecnh\":\"i7 Ram 16 SSD 256\"}}', NULL, 11200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(126, 24, '{\"vi\":\"Hồng Sandtone - i7 Ram 16 SSD 512\",\"en\":\"Hồng Sandtone - i7 Ram 16 SSD 512\"}', '27324942106-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"H\\u1ed3ng Sandtone\",\"C\\u1ea5u H\\u00ecnh\":\"i7 Ram 16 SSD 512\"}}', NULL, 12200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(127, 24, '{\"vi\":\"Đen Matte - i7 Ram 16 SSD 256\",\"en\":\"Đen Matte - i7 Ram 16 SSD 256\"}', '27324942106-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"\\u0110en Matte\",\"C\\u1ea5u H\\u00ecnh\":\"i7 Ram 16 SSD 256\"}}', NULL, 10400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(128, 24, '{\"vi\":\"Xanh Cobalt - i5 Ram 16 SSD 256\",\"en\":\"Xanh Cobalt - i5 Ram 16 SSD 256\"}', '27324942106-8', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"Xanh Cobalt\",\"C\\u1ea5u H\\u00ecnh\":\"i5 Ram 16 SSD 256\"}}', NULL, 11000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 9, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(129, 24, '{\"vi\":\"Xanh Cobalt - i7 Ram 16 SSD 512\",\"en\":\"Xanh Cobalt - i7 Ram 16 SSD 512\"}', '27324942106-9', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"Xanh Cobalt\",\"C\\u1ea5u H\\u00ecnh\":\"i7 Ram 16 SSD 512\"}}', NULL, 11400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 10, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(130, 24, '{\"vi\":\"Xanh Cobalt - i7 Ram 16 SSD 256\",\"en\":\"Xanh Cobalt - i7 Ram 16 SSD 256\"}', '27324942106-10', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"Xanh Cobalt\",\"C\\u1ea5u H\\u00ecnh\":\"i7 Ram 16 SSD 256\"}}', NULL, 10400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 11, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(131, 24, '{\"vi\":\"Bạc Platinum - i5 Ram 16 SSD 256\",\"en\":\"Bạc Platinum - i5 Ram 16 SSD 256\"}', '27324942106-11', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mj22uz10aryf73\",\"options\":{\"M\\u00e0u S\\u1eafc\":\"B\\u1ea1c Platinum\",\"C\\u1ea5u H\\u00ecnh\":\"i5 Ram 16 SSD 256\"}}', NULL, 11000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 12, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(132, 25, '{\"vi\":\"RAM16GB SSD 576\",\"en\":\"RAM16GB SSD 576\"}', '28789796805-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mq0b1xnu76rm70\",\"options\":{\"PH\\u00c2N LO\\u1ea0I\":\"RAM16GB SSD 576\"}}', NULL, 7000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(133, 25, '{\"vi\":\"RAM 8GB\",\"en\":\"RAM 8GB\"}', '28789796805-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mq0b1xnu76rm70\",\"options\":{\"PH\\u00c2N LO\\u1ea0I\":\"RAM 8GB\"}}', NULL, 5200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(134, 25, '{\"vi\":\"RAM16GB SSD 256\",\"en\":\"RAM16GB SSD 256\"}', '28789796805-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mq0b1xnu76rm70\",\"options\":{\"PH\\u00c2N LO\\u1ea0I\":\"RAM16GB SSD 256\"}}', NULL, 6600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(135, 26, '{\"vi\":\"Bản i5/8/128 - Hồng Sandstone\",\"en\":\"Bản i5/8/128 - Hồng Sandstone\"}', '53052290537-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn7a1tsmbif656\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/128\",\"M\\u00c0U S\\u1eaeC\":\"H\\u1ed3ng Sandstone\"}}', NULL, 7900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(136, 26, '{\"vi\":\"Bản i7/8/256 - Xanh Cobalt\",\"en\":\"Bản i7/8/256 - Xanh Cobalt\"}', '53052290537-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn7a1tsmbif656\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i7\\/8\\/256\",\"M\\u00c0U S\\u1eaeC\":\"Xanh Cobalt\"}}', NULL, 8700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(137, 26, '{\"vi\":\"Bản i5/8/256 - Hồng Sandstone\",\"en\":\"Bản i5/8/256 - Hồng Sandstone\"}', '53052290537-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn7a1tsmbif656\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/256\",\"M\\u00c0U S\\u1eaeC\":\"H\\u1ed3ng Sandstone\"}}', NULL, 9500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(138, 26, '{\"vi\":\"Bản i7/8/256 - Hồng Sandstone\",\"en\":\"Bản i7/8/256 - Hồng Sandstone\"}', '53052290537-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn7a1tsmbif656\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i7\\/8\\/256\",\"M\\u00c0U S\\u1eaeC\":\"H\\u1ed3ng Sandstone\"}}', NULL, 8700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(139, 26, '{\"vi\":\"Bản i5/8/256 - Xanh Cobalt\",\"en\":\"Bản i5/8/256 - Xanh Cobalt\"}', '53052290537-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn7a1tsmbif656\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/256\",\"M\\u00c0U S\\u1eaeC\":\"Xanh Cobalt\"}}', NULL, 8900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(140, 26, '{\"vi\":\"Bản i7/8/256 - Bạc Platium\",\"en\":\"Bản i7/8/256 - Bạc Platium\"}', '53052290537-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn7a1tsmbif656\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i7\\/8\\/256\",\"M\\u00c0U S\\u1eaeC\":\"B\\u1ea1c Platium\"}}', NULL, 9700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(141, 26, '{\"vi\":\"Bản i5/8/256 - Bạc Platium\",\"en\":\"Bản i5/8/256 - Bạc Platium\"}', '53052290537-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn7a1tsmbif656\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/256\",\"M\\u00c0U S\\u1eaeC\":\"B\\u1ea1c Platium\"}}', NULL, 8700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(142, 26, '{\"vi\":\"Bản i5/8/128 - Xanh Cobalt\",\"en\":\"Bản i5/8/128 - Xanh Cobalt\"}', '53052290537-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn7a1tsmbif656\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/128\",\"M\\u00c0U S\\u1eaeC\":\"Xanh Cobalt\"}}', NULL, 7900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(143, 26, '{\"vi\":\"Bản i5/8/128 - Bạc Platium\",\"en\":\"Bản i5/8/128 - Bạc Platium\"}', '53052290537-8', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn7a1tsmbif656\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/128\",\"M\\u00c0U S\\u1eaeC\":\"B\\u1ea1c Platium\"}}', NULL, 7900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 9, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(144, 27, '{\"vi\":\"XANH NAVI\",\"en\":\"XANH NAVI\"}', '47459041232-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn5uufdt1edi05\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"XANH NAVI\"}}', NULL, 5200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(145, 27, '{\"vi\":\"ĐEN\",\"en\":\"ĐEN\"}', '47459041232-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn5uufdt1edi05\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"\\u0110EN\"}}', NULL, 5200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(146, 28, '{\"vi\":\"Máy Sạc - Pen/8/128 Trầy Xước\",\"en\":\"Máy Sạc - Pen/8/128 Trầy Xước\"}', '26935291889-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mil6m9zl38qs93\",\"options\":{\"Optione\":\"M\\u00e1y S\\u1ea1c\",\"Ph\\u00e2n Lo\\u1ea1i Chip\":\"Pen\\/8\\/128 Tr\\u1ea7y X\\u01b0\\u1edbc\"}}', NULL, 5400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(147, 28, '{\"vi\":\"Máy Sạc - I3/8/128\",\"en\":\"Máy Sạc - I3/8/128\"}', '26935291889-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mil6m9zl38qs93\",\"options\":{\"Optione\":\"M\\u00e1y S\\u1ea1c\",\"Ph\\u00e2n Lo\\u1ea1i Chip\":\"I3\\/8\\/128\"}}', NULL, 7990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(148, 28, '{\"vi\":\"Máy+Sạc+Phím Hãng - Pen/8/128 Trầy Xước\",\"en\":\"Máy+Sạc+Phím Hãng - Pen/8/128 Trầy Xước\"}', '26935291889-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mil6m9zl38qs93\",\"options\":{\"Optione\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm H\\u00e3ng\",\"Ph\\u00e2n Lo\\u1ea1i Chip\":\"Pen\\/8\\/128 Tr\\u1ea7y X\\u01b0\\u1edbc\"}}', NULL, 6100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(149, 28, '{\"vi\":\"Máy+Sạc+Phím Hãng - I3/8/128\",\"en\":\"Máy+Sạc+Phím Hãng - I3/8/128\"}', '26935291889-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mil6m9zl38qs93\",\"options\":{\"Optione\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm H\\u00e3ng\",\"Ph\\u00e2n Lo\\u1ea1i Chip\":\"I3\\/8\\/128\"}}', NULL, 8700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(150, 28, '{\"vi\":\"Máy Sạc - I3/4/64\",\"en\":\"Máy Sạc - I3/4/64\"}', '26935291889-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mil6m9zl38qs93\",\"options\":{\"Optione\":\"M\\u00e1y S\\u1ea1c\",\"Ph\\u00e2n Lo\\u1ea1i Chip\":\"I3\\/4\\/64\"}}', NULL, 4900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(151, 28, '{\"vi\":\"Máy+Sạc+Phím Hãng - I3/4/64\",\"en\":\"Máy+Sạc+Phím Hãng - I3/4/64\"}', '26935291889-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mil6m9zl38qs93\",\"options\":{\"Optione\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm H\\u00e3ng\",\"Ph\\u00e2n Lo\\u1ea1i Chip\":\"I3\\/4\\/64\"}}', NULL, 5600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(152, 29, '{\"vi\":\"Bản i5/8/256\",\"en\":\"Bản i5/8/256\"}', '26789235774-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mongv9p7r402a4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/256\"}}', NULL, 12200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(153, 29, '{\"vi\":\"Bản i5/16/512\",\"en\":\"Bản i5/16/512\"}', '26789235774-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mongv9p7r402a4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/16\\/512\"}}', NULL, 14400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(154, 30, '{\"vi\":\"i5 Ram 16 SSD 256 - MÁY+SẠC+PHÍM\",\"en\":\"i5 Ram 16 SSD 256 - MÁY+SẠC+PHÍM\"}', '26232048843-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mg63q0sqpkwb17\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 16 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 16990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(155, 30, '{\"vi\":\"i7 Ram 16 SSD 512 - MÁY+SẠC\",\"en\":\"i7 Ram 16 SSD 512 - MÁY+SẠC\"}', '26232048843-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mg63q0sqpkwb17\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i7 Ram 16 SSD 512\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C\"}}', NULL, 18100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(156, 30, '{\"vi\":\"i7 Ram 16 SSD 512 - MÁY+SẠC+PHÍM\",\"en\":\"i7 Ram 16 SSD 512 - MÁY+SẠC+PHÍM\"}', '26232048843-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mg63q0sqpkwb17\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i7 Ram 16 SSD 512\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 19800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(157, 30, '{\"vi\":\"i7 Ram 16 SSD 256 - MÁY+SẠC\",\"en\":\"i7 Ram 16 SSD 256 - MÁY+SẠC\"}', '26232048843-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mg63q0sqpkwb17\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i7 Ram 16 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C\"}}', NULL, 16800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(158, 30, '{\"vi\":\"i7 Ram 16 SSD 256 - MÁY+SẠC+PHÍM\",\"en\":\"i7 Ram 16 SSD 256 - MÁY+SẠC+PHÍM\"}', '26232048843-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mg63q0sqpkwb17\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i7 Ram 16 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 18500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(159, 30, '{\"vi\":\"i5 Ram 16 SSD 512 - MÁY+SẠC\",\"en\":\"i5 Ram 16 SSD 512 - MÁY+SẠC\"}', '26232048843-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mg63q0sqpkwb17\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 16 SSD 512\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C\"}}', NULL, 16800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(160, 30, '{\"vi\":\"i5 Ram 16 SSD 256 - MÁY+SẠC\",\"en\":\"i5 Ram 16 SSD 256 - MÁY+SẠC\"}', '26232048843-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mg63q0sqpkwb17\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 16 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C\"}}', NULL, 15300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(161, 30, '{\"vi\":\"i5 Ram 16 SSD 512 - MÁY+SẠC+PHÍM\",\"en\":\"i5 Ram 16 SSD 512 - MÁY+SẠC+PHÍM\"}', '26232048843-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mg63q0sqpkwb17\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 16 SSD 512\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 18500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(162, 31, '{\"vi\":\"Platinum (Bạch kim) - NVME 512GB\",\"en\":\"Platinum (Bạch kim) - NVME 512GB\"}', '45703410147-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfzac2dlhkc5\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Platinum (B\\u1ea1ch kim)\",\"B\\u1ed8 NH\\u1eda\":\"NVME 512GB\"}}', NULL, 10990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(163, 31, '{\"vi\":\"Sandtone (Hồng) - NVME 256GB\",\"en\":\"Sandtone (Hồng) - NVME 256GB\"}', '45703410147-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfzac2dlhkc5\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Sandtone (H\\u1ed3ng)\",\"B\\u1ed8 NH\\u1eda\":\"NVME 256GB\"}}', NULL, 10400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(164, 31, '{\"vi\":\"Sandtone (Hồng) - NVME 512GB\",\"en\":\"Sandtone (Hồng) - NVME 512GB\"}', '45703410147-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfzac2dlhkc5\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Sandtone (H\\u1ed3ng)\",\"B\\u1ed8 NH\\u1eda\":\"NVME 512GB\"}}', NULL, 11400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(165, 31, '{\"vi\":\"Ice Blue (Xanh băng) - NVME 256GB\",\"en\":\"Ice Blue (Xanh băng) - NVME 256GB\"}', '45703410147-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfzac2dlhkc5\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Ice Blue (Xanh b\\u0103ng)\",\"B\\u1ed8 NH\\u1eda\":\"NVME 256GB\"}}', NULL, 11000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(166, 31, '{\"vi\":\"Ice Blue (Xanh băng) - NVME 512GB\",\"en\":\"Ice Blue (Xanh băng) - NVME 512GB\"}', '45703410147-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfzac2dlhkc5\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Ice Blue (Xanh b\\u0103ng)\",\"B\\u1ed8 NH\\u1eda\":\"NVME 512GB\"}}', NULL, 10990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(167, 31, '{\"vi\":\"Matte Black (Đen mờ) - NVME 256GB\",\"en\":\"Matte Black (Đen mờ) - NVME 256GB\"}', '45703410147-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfzac2dlhkc5\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Matte Black (\\u0110en m\\u1edd)\",\"B\\u1ed8 NH\\u1eda\":\"NVME 256GB\"}}', NULL, 9990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(168, 31, '{\"vi\":\"Matte Black (Đen mờ) - NVME 512GB\",\"en\":\"Matte Black (Đen mờ) - NVME 512GB\"}', '45703410147-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfzac2dlhkc5\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Matte Black (\\u0110en m\\u1edd)\",\"B\\u1ed8 NH\\u1eda\":\"NVME 512GB\"}}', NULL, 10990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(169, 31, '{\"vi\":\"Platinum (Bạch kim) - NVME 256GB\",\"en\":\"Platinum (Bạch kim) - NVME 256GB\"}', '45703410147-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mihfzac2dlhkc5\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Platinum (B\\u1ea1ch kim)\",\"B\\u1ed8 NH\\u1eda\":\"NVME 256GB\"}}', NULL, 9990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(170, 33, '{\"vi\":\"Bản i5/8/256 - BẠC PLATINUM 99%\",\"en\":\"Bản i5/8/256 - BẠC PLATINUM 99%\"}', '27994031488-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmtru9ghe1hk9b\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/256\",\"M\\u00c0U S\\u1eaeC\":\"B\\u1ea0C PLATINUM 99%\"}}', NULL, 14900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(171, 33, '{\"vi\":\"Bản i5/16/512 - BẠC PLATINUM 99%\",\"en\":\"Bản i5/16/512 - BẠC PLATINUM 99%\"}', '27994031488-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmtru9ghe1hk9b\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/16\\/512\",\"M\\u00c0U S\\u1eaeC\":\"B\\u1ea0C PLATINUM 99%\"}}', NULL, 16000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(172, 33, '{\"vi\":\"Bản i5/8/256 - HỒNG SANDSTONE 97%\",\"en\":\"Bản i5/8/256 - HỒNG SANDSTONE 97%\"}', '27994031488-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmtru9ghe1hk9b\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/256\",\"M\\u00c0U S\\u1eaeC\":\"H\\u1ed2NG SANDSTONE 97%\"}}', NULL, 13900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(173, 33, '{\"vi\":\"Bản i5/16/512 - HỒNG SANDSTONE 97%\",\"en\":\"Bản i5/16/512 - HỒNG SANDSTONE 97%\"}', '27994031488-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmtru9ghe1hk9b\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/16\\/512\",\"M\\u00c0U S\\u1eaeC\":\"H\\u1ed2NG SANDSTONE 97%\"}}', NULL, 16600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(174, 33, '{\"vi\":\"Bản i5/8/256 - XANH ICE BLUE 99%\",\"en\":\"Bản i5/8/256 - XANH ICE BLUE 99%\"}', '27994031488-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmtru9ghe1hk9b\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/8\\/256\",\"M\\u00c0U S\\u1eaeC\":\"XANH ICE BLUE 99%\"}}', NULL, 13000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(175, 33, '{\"vi\":\"Bản i5/16/512 - XANH ICE BLUE 99%\",\"en\":\"Bản i5/16/512 - XANH ICE BLUE 99%\"}', '27994031488-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmtru9ghe1hk9b\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"B\\u1ea3n i5\\/16\\/512\",\"M\\u00c0U S\\u1eaeC\":\"XANH ICE BLUE 99%\"}}', NULL, 16900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(176, 34, '{\"vi\":\"RAM 16GB SSD 256\",\"en\":\"RAM 16GB SSD 256\"}', '58059026276-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn5ycl3zqdxi3d\",\"options\":{\"RAM\":\"RAM 16GB SSD 256\"}}', NULL, 8300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(177, 34, '{\"vi\":\"RAM 16GB P600/SSD576\",\"en\":\"RAM 16GB P600/SSD576\"}', '58059026276-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn5ycl3zqdxi3d\",\"options\":{\"RAM\":\"RAM 16GB P600\\/SSD576\"}}', NULL, 8700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(178, 34, '{\"vi\":\"RAM16 KO SSD\",\"en\":\"RAM16 KO SSD\"}', '58059026276-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mn5ycl3zqdxi3d\",\"options\":{\"RAM\":\"RAM16 KO SSD\"}}', NULL, 7700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(179, 36, '{\"vi\":\"NVME M2 256GB GEN4\",\"en\":\"NVME M2 256GB GEN4\"}', '48353365608-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mig0uujsqih2f5\",\"options\":{\"DUNG L\\u01af\\u1ee2NG\":\"NVME M2 256GB GEN4\"}}', NULL, 1100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(180, 36, '{\"vi\":\"NVME M2 512GB GEN4\",\"en\":\"NVME M2 512GB GEN4\"}', '48353365608-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mig0uujsqih2f5\",\"options\":{\"DUNG L\\u01af\\u1ee2NG\":\"NVME M2 512GB GEN4\"}}', NULL, 2100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(181, 36, '{\"vi\":\"NVME M2 1024GB GEN4\",\"en\":\"NVME M2 1024GB GEN4\"}', '48353365608-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mig0uujsqih2f5\",\"options\":{\"DUNG L\\u01af\\u1ee2NG\":\"NVME M2 1024GB GEN4\"}}', NULL, 4300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(182, 41, '{\"vi\":\"i5 Ram 8 SSD 256 LTE - MÁY+SẠC+PHÍM\",\"en\":\"i5 Ram 8 SSD 256 LTE - MÁY+SẠC+PHÍM\"}', '50603126853-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 256 LTE\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 16700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(183, 41, '{\"vi\":\"i5 Ram 8 SSD 128 - MÁY+SẠC+PHÍM\",\"en\":\"i5 Ram 8 SSD 128 - MÁY+SẠC+PHÍM\"}', '50603126853-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 128\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 15500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(184, 41, '{\"vi\":\"i5 Ram 8 SSD 256 - MÁY+SẠC+PHÍM\",\"en\":\"i5 Ram 8 SSD 256 - MÁY+SẠC+PHÍM\"}', '50603126853-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 16300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(185, 41, '{\"vi\":\"i5 Ram 8 SSD 512 - MÁY+SẠC\",\"en\":\"i5 Ram 8 SSD 512 - MÁY+SẠC\"}', '50603126853-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 512\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C\"}}', NULL, 15600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(186, 41, '{\"vi\":\"i5 Ram 8 SSD 512 - MÁY+SẠC+PHÍM\",\"en\":\"i5 Ram 8 SSD 512 - MÁY+SẠC+PHÍM\"}', '50603126853-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 512\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM\"}}', NULL, 17300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(187, 41, '{\"vi\":\"i5 Ram 8 SSD 512 - MÁY+SẠC+PHÍM+S PEN\",\"en\":\"i5 Ram 8 SSD 512 - MÁY+SẠC+PHÍM+S PEN\"}', '50603126853-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 512\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM+S PEN\"}}', NULL, 18800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(188, 41, '{\"vi\":\"i5 Ram 8 SSD 128 - MÁY+SẠC+PHÍM+S PEN\",\"en\":\"i5 Ram 8 SSD 128 - MÁY+SẠC+PHÍM+S PEN\"}', '50603126853-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 128\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM+S PEN\"}}', NULL, 16990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(189, 41, '{\"vi\":\"i5 Ram 8 SSD 256 LTE - MÁY+SẠC\",\"en\":\"i5 Ram 8 SSD 256 LTE - MÁY+SẠC\"}', '50603126853-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 256 LTE\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C\"}}', NULL, 14990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(190, 41, '{\"vi\":\"i5 Ram 8 SSD 256 - MÁY+SẠC+PHÍM+S PEN\",\"en\":\"i5 Ram 8 SSD 256 - MÁY+SẠC+PHÍM+S PEN\"}', '50603126853-8', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM+S PEN\"}}', NULL, 17800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 9, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(191, 41, '{\"vi\":\"i5 Ram 8 SSD 128 - MÁY+SẠC\",\"en\":\"i5 Ram 8 SSD 128 - MÁY+SẠC\"}', '50603126853-9', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 128\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C\"}}', NULL, 13800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 10, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(192, 41, '{\"vi\":\"i5 Ram 8 SSD 256 LTE - MÁY+SẠC+PHÍM+S PEN\",\"en\":\"i5 Ram 8 SSD 256 LTE - MÁY+SẠC+PHÍM+S PEN\"}', '50603126853-10', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 256 LTE\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM+S PEN\"}}', NULL, 18200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 11, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(193, 41, '{\"vi\":\"i5 Ram 8 SSD 256 - MÁY+SẠC\",\"en\":\"i5 Ram 8 SSD 256 - MÁY+SẠC\"}', '50603126853-11', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miabepjm1b0oa4\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"i5 Ram 8 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C\"}}', NULL, 14600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 12, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(194, 42, '{\"vi\":\"Máy+Sạc+Phím+Bút - Sapphire-Xanh dương\",\"en\":\"Máy+Sạc+Phím+Bút - Sapphire-Xanh dương\"}', '26586614156-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mir4oni6lh53d9\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm+B\\u00fat\",\"M\\u00e0u s\\u1eafc\":\"Sapphire-Xanh d\\u01b0\\u01a1ng\"}}', NULL, 22200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(195, 42, '{\"vi\":\"Máy+Sạc+Phím - Forest -Xanh rêu\",\"en\":\"Máy+Sạc+Phím - Forest -Xanh rêu\"}', '26586614156-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mir4oni6lh53d9\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm\",\"M\\u00e0u s\\u1eafc\":\"Forest -Xanh r\\u00eau\"}}', NULL, 20800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(196, 42, '{\"vi\":\"Máy+Sạc - Platinum-Bạc\",\"en\":\"Máy+Sạc - Platinum-Bạc\"}', '26586614156-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mir4oni6lh53d9\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c\",\"M\\u00e0u s\\u1eafc\":\"Platinum-B\\u1ea1c\"}}', NULL, 18200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(197, 42, '{\"vi\":\"Máy+Sạc+Phím - Sapphire-Xanh dương\",\"en\":\"Máy+Sạc+Phím - Sapphire-Xanh dương\"}', '26586614156-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mir4oni6lh53d9\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm\",\"M\\u00e0u s\\u1eafc\":\"Sapphire-Xanh d\\u01b0\\u01a1ng\"}}', NULL, 20990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(198, 42, '{\"vi\":\"Máy+Sạc+Phím+Bút - Forest -Xanh rêu\",\"en\":\"Máy+Sạc+Phím+Bút - Forest -Xanh rêu\"}', '26586614156-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mir4oni6lh53d9\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm+B\\u00fat\",\"M\\u00e0u s\\u1eafc\":\"Forest -Xanh r\\u00eau\"}}', NULL, 21990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(199, 42, '{\"vi\":\"Máy+Sạc+Phím+Bút - Platinum-Bạc\",\"en\":\"Máy+Sạc+Phím+Bút - Platinum-Bạc\"}', '26586614156-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mir4oni6lh53d9\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm+B\\u00fat\",\"M\\u00e0u s\\u1eafc\":\"Platinum-B\\u1ea1c\"}}', NULL, 21500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(200, 42, '{\"vi\":\"Máy+Sạc - Sapphire-Xanh dương\",\"en\":\"Máy+Sạc - Sapphire-Xanh dương\"}', '26586614156-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mir4oni6lh53d9\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c\",\"M\\u00e0u s\\u1eafc\":\"Sapphire-Xanh d\\u01b0\\u01a1ng\"}}', NULL, 19000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(201, 42, '{\"vi\":\"Máy+Sạc+Phím - Platinum-Bạc\",\"en\":\"Máy+Sạc+Phím - Platinum-Bạc\"}', '26586614156-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mir4oni6lh53d9\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c+Ph\\u00edm\",\"M\\u00e0u s\\u1eafc\":\"Platinum-B\\u1ea1c\"}}', NULL, 20300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(202, 42, '{\"vi\":\"Máy+Sạc - Forest -Xanh rêu\",\"en\":\"Máy+Sạc - Forest -Xanh rêu\"}', '26586614156-8', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mir4oni6lh53d9\",\"options\":{\"Option\":\"M\\u00e1y+S\\u1ea1c\",\"M\\u00e0u s\\u1eafc\":\"Forest -Xanh r\\u00eau\"}}', NULL, 18400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 9, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(203, 43, '{\"vi\":\"Bản i5/16/256 - Máy+sạc\",\"en\":\"Bản i5/16/256 - Máy+sạc\"}', '44159093910-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mcd9kvdctt2b06\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/16\\/256\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c\"}}', NULL, 11800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(204, 43, '{\"vi\":\"Bản i5/16/256 - Máy+sạc+phím hãng\",\"en\":\"Bản i5/16/256 - Máy+sạc+phím hãng\"}', '44159093910-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mcd9kvdctt2b06\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/16\\/256\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\"}}', NULL, 12600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(205, 43, '{\"vi\":\"Bản i7/16/256 - Máy+sạc\",\"en\":\"Bản i7/16/256 - Máy+sạc\"}', '44159093910-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mcd9kvdctt2b06\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/16\\/256\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c\"}}', NULL, 13600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(206, 43, '{\"vi\":\"Bản i7/16/256 - Máy+sạc+phím hãng\",\"en\":\"Bản i7/16/256 - Máy+sạc+phím hãng\"}', '44159093910-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mcd9kvdctt2b06\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/16\\/256\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\"}}', NULL, 14400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(207, 43, '{\"vi\":\"Bản i5/16/256 LTE - Máy+sạc\",\"en\":\"Bản i5/16/256 LTE - Máy+sạc\"}', '44159093910-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mcd9kvdctt2b06\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/16\\/256 LTE\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c\"}}', NULL, 12200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(208, 43, '{\"vi\":\"Bản i5/16/256 LTE - Máy+sạc+phím hãng\",\"en\":\"Bản i5/16/256 LTE - Máy+sạc+phím hãng\"}', '44159093910-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mcd9kvdctt2b06\",\"options\":{\"Option\":\"B\\u1ea3n i5\\/16\\/256 LTE\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\"}}', NULL, 12990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(209, 43, '{\"vi\":\"Bản i7/16/512 - Máy+sạc\",\"en\":\"Bản i7/16/512 - Máy+sạc\"}', '44159093910-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mcd9kvdctt2b06\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/16\\/512\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c\"}}', NULL, 14800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(210, 43, '{\"vi\":\"Bản i7/16/512 - Máy+sạc+phím hãng\",\"en\":\"Bản i7/16/512 - Máy+sạc+phím hãng\"}', '44159093910-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-mcd9kvdctt2b06\",\"options\":{\"Option\":\"B\\u1ea3n i7\\/16\\/512\",\"Ph\\u1ee5 ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\"}}', NULL, 15600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(211, 44, '{\"vi\":\"Ngoại hình 95-97%\",\"en\":\"Ngoại hình 95-97%\"}', '54508223924-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmn0z2y6euir7e\",\"options\":{\"NGO\\u1ea0I H\\u00ccNH\":\"Ngo\\u1ea1i h\\u00ecnh 95-97%\"}}', NULL, 2200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(212, 44, '{\"vi\":\"Ngoại hình 90-92%\",\"en\":\"Ngoại hình 90-92%\"}', '54508223924-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmn0z2y6euir7e\",\"options\":{\"NGO\\u1ea0I H\\u00ccNH\":\"Ngo\\u1ea1i h\\u00ecnh 90-92%\"}}', NULL, 1900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(213, 44, '{\"vi\":\"Ngoại hình 85-87%\",\"en\":\"Ngoại hình 85-87%\"}', '54508223924-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmn0z2y6euir7e\",\"options\":{\"NGO\\u1ea0I H\\u00ccNH\":\"Ngo\\u1ea1i h\\u00ecnh 85-87%\"}}', NULL, 1600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(214, 45, '{\"vi\":\"XÁM 2022 FULLBOX\",\"en\":\"XÁM 2022 FULLBOX\"}', '49608243740-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmmy7hqyv5lb27\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"X\\u00c1M 2022 FULLBOX\"}}', NULL, 800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(215, 45, '{\"vi\":\"XÁM 95%\",\"en\":\"XÁM 95%\"}', '49608243740-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmmy7hqyv5lb27\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"X\\u00c1M 95%\"}}', NULL, 450000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(216, 45, '{\"vi\":\"ĐEN 95%\",\"en\":\"ĐEN 95%\"}', '49608243740-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmmy7hqyv5lb27\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"\\u0110EN 95%\"}}', NULL, 450000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(217, 46, '{\"vi\":\"FULLBOX+Sạc ELECOM\",\"en\":\"FULLBOX+Sạc ELECOM\"}', '56604107774-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mo196rqn9fy878\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N\":\"FULLBOX+S\\u1ea1c ELECOM\"}}', NULL, 26900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(218, 46, '{\"vi\":\"MÁY+SẠC+PHÍM HÃNG\",\"en\":\"MÁY+SẠC+PHÍM HÃNG\"}', '56604107774-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mo196rqn9fy878\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y+S\\u1ea0C+PH\\u00cdM H\\u00c3NG\"}}', NULL, 28900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(219, 47, '{\"vi\":\"BỘ FULLBOX\",\"en\":\"BỘ FULLBOX\"}', '49401838892-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhaj9cawbxu560\",\"options\":{\"OPTION\":\"B\\u1ed8 FULLBOX\"}}', NULL, 4599000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(220, 47, '{\"vi\":\"Slim Pen 2 ko Box\",\"en\":\"Slim Pen 2 ko Box\"}', '49401838892-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhaj9cawbxu560\",\"options\":{\"OPTION\":\"Slim Pen 2 ko Box\"}}', NULL, 2290000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(221, 47, '{\"vi\":\"Phím Pro Sig ko Box\",\"en\":\"Phím Pro Sig ko Box\"}', '49401838892-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mhaj9cawbxu560\",\"options\":{\"OPTION\":\"Ph\\u00edm Pro Sig ko Box\"}}', NULL, 2399000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(222, 49, '{\"vi\":\"ÁM NỀN ĐEN - Máy+sạc\",\"en\":\"ÁM NỀN ĐEN - Máy+sạc\"}', '47154306494-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-825zx-mj6lskani4u9df\",\"options\":{\"Option\":\"\\u00c1M N\\u1ec0N \\u0110EN\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c\"}}', NULL, 3200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(223, 49, '{\"vi\":\"ÁM NỀN ĐEN - Máy+sạc+phím hãng\",\"en\":\"ÁM NỀN ĐEN - Máy+sạc+phím hãng\"}', '47154306494-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-825zx-mj6lskani4u9df\",\"options\":{\"Option\":\"\\u00c1M N\\u1ec0N \\u0110EN\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\"}}', NULL, 3900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(224, 49, '{\"vi\":\"Bản tiêu chuẩn - Máy+sạc\",\"en\":\"Bản tiêu chuẩn - Máy+sạc\"}', '47154306494-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-825zx-mj6lskani4u9df\",\"options\":{\"Option\":\"B\\u1ea3n ti\\u00eau chu\\u1ea9n\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c\"}}', NULL, 4050000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(225, 49, '{\"vi\":\"Bản tiêu chuẩn - Máy+sạc+phím hãng\",\"en\":\"Bản tiêu chuẩn - Máy+sạc+phím hãng\"}', '47154306494-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-825zx-mj6lskani4u9df\",\"options\":{\"Option\":\"B\\u1ea3n ti\\u00eau chu\\u1ea9n\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\"}}', NULL, 4800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(226, 49, '{\"vi\":\"Bản LTE - Máy+sạc\",\"en\":\"Bản LTE - Máy+sạc\"}', '47154306494-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-825zx-mj6lskani4u9df\",\"options\":{\"Option\":\"B\\u1ea3n LTE\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c\"}}', NULL, 4350000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(227, 49, '{\"vi\":\"Bản LTE - Máy+sạc+phím hãng\",\"en\":\"Bản LTE - Máy+sạc+phím hãng\"}', '47154306494-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/sg-11134201-825zx-mj6lskani4u9df\",\"options\":{\"Option\":\"B\\u1ea3n LTE\",\"Ph\\u1ee5 Ki\\u1ec7n\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm h\\u00e3ng\"}}', NULL, 5100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(228, 50, '{\"vi\":\"MÁY SẠC\",\"en\":\"MÁY SẠC\"}', '43527460903-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-milqycigscug5c\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 3550000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(229, 50, '{\"vi\":\"MÁY SẠC PHÍM HÃNG\",\"en\":\"MÁY SẠC PHÍM HÃNG\"}', '43527460903-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-milqycigscug5c\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM H\\u00c3NG\"}}', NULL, 4300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(230, 52, '{\"vi\":\"Ram 8 SSD 256 - MÁY SẠC PHÍM BÚT\",\"en\":\"Ram 8 SSD 256 - MÁY SẠC PHÍM BÚT\"}', '25044921022-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miiskn803gue31\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 8 SSD 256\",\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM B\\u00daT\"}}', NULL, 12700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(231, 52, '{\"vi\":\"Ram 16 SSD 256 - MÁY SẠC PHÍM\",\"en\":\"Ram 16 SSD 256 - MÁY SẠC PHÍM\"}', '25044921022-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miiskn803gue31\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 16 SSD 256\",\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM\"}}', NULL, 12700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(232, 52, '{\"vi\":\"Ram 8 SSD 512 - MÁY SẠC PHÍM\",\"en\":\"Ram 8 SSD 512 - MÁY SẠC PHÍM\"}', '25044921022-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miiskn803gue31\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 8 SSD 512\",\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM\"}}', NULL, 12900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(233, 52, '{\"vi\":\"Ram 8 SSD 512 - MÁY SẠC PHÍM BÚT\",\"en\":\"Ram 8 SSD 512 - MÁY SẠC PHÍM BÚT\"}', '25044921022-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miiskn803gue31\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 8 SSD 512\",\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM B\\u00daT\"}}', NULL, 14100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(234, 52, '{\"vi\":\"Ram 8 SSD 256 - MÁY SẠC PHÍM\",\"en\":\"Ram 8 SSD 256 - MÁY SẠC PHÍM\"}', '25044921022-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miiskn803gue31\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 8 SSD 256\",\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM\"}}', NULL, 11500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(235, 52, '{\"vi\":\"Ram 16 SSD 256 - MÁY SẠC\",\"en\":\"Ram 16 SSD 256 - MÁY SẠC\"}', '25044921022-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miiskn803gue31\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 16 SSD 256\",\"OPTION\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 10900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(236, 52, '{\"vi\":\"Ram 16 SSD 256 - MÁY SẠC PHÍM BÚT\",\"en\":\"Ram 16 SSD 256 - MÁY SẠC PHÍM BÚT\"}', '25044921022-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miiskn803gue31\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 16 SSD 256\",\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM B\\u00daT\"}}', NULL, 13900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(237, 52, '{\"vi\":\"Ram 8 SSD 512 - MÁY SẠC\",\"en\":\"Ram 8 SSD 512 - MÁY SẠC\"}', '25044921022-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miiskn803gue31\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 8 SSD 512\",\"OPTION\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 11100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(238, 52, '{\"vi\":\"Ram 8 SSD 256 - MÁY SẠC\",\"en\":\"Ram 8 SSD 256 - MÁY SẠC\"}', '25044921022-8', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-miiskn803gue31\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 8 SSD 256\",\"OPTION\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 9700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 9, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(239, 55, '{\"vi\":\"MÁY SẠC PHÍM\",\"en\":\"MÁY SẠC PHÍM\"}', '49503086372-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mi8h056jgr2ced\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM\"}}', NULL, 7200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48');
INSERT INTO `product_variants` (`id`, `product_id`, `name`, `sku`, `barcode`, `option_values`, `option_signature`, `price`, `compare_at_price`, `cost_price`, `image_url`, `weight_grams`, `stock_quantity`, `is_active`, `is_default`, `sort_order`, `created_at`, `updated_at`) VALUES
(240, 55, '{\"vi\":\"MÁY SẠC\",\"en\":\"MÁY SẠC\"}', '49503086372-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mi8h056jgr2ced\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 6500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(241, 56, '{\"vi\":\"SQ2 Ram 8 SSD 256 - MÁY SẠC\",\"en\":\"SQ2 Ram 8 SSD 256 - MÁY SẠC\"}', '44467077276-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me5dgv9rod8m59\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"SQ2 Ram 8 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 11600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(242, 56, '{\"vi\":\"SQ2 Ram 16 SSD 256 - MÁY SẠC PHÍM\",\"en\":\"SQ2 Ram 16 SSD 256 - MÁY SẠC PHÍM\"}', '44467077276-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me5dgv9rod8m59\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"SQ2 Ram 16 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM\"}}', NULL, 14100000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(243, 56, '{\"vi\":\"SQ2 Ram 16 SSD 256 - MÁY SẠC\",\"en\":\"SQ2 Ram 16 SSD 256 - MÁY SẠC\"}', '44467077276-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me5dgv9rod8m59\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"SQ2 Ram 16 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 12400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(244, 56, '{\"vi\":\"SQ2 Ram 8 SSD 256 - MÁY SẠC PHÍM\",\"en\":\"SQ2 Ram 8 SSD 256 - MÁY SẠC PHÍM\"}', '44467077276-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me5dgv9rod8m59\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"SQ2 Ram 8 SSD 256\",\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM\"}}', NULL, 13400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(245, 57, '{\"vi\":\"MÁY  SẠC PHÍM\",\"en\":\"MÁY  SẠC PHÍM\"}', '57102068122-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjmt7t327fgm3b\",\"options\":{\"OPTION\":\"M\\u00c1Y  S\\u1ea0C PH\\u00cdM\"}}', NULL, 23300000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(246, 57, '{\"vi\":\"MÁY SẠC PHÍM BÚT\",\"en\":\"MÁY SẠC PHÍM BÚT\"}', '57102068122-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjmt7t327fgm3b\",\"options\":{\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM B\\u00daT\"}}', NULL, 24500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(247, 57, '{\"vi\":\"MÁY SẠC\",\"en\":\"MÁY SẠC\"}', '57102068122-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjmt7t327fgm3b\",\"options\":{\"OPTION\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 21500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(248, 60, '{\"vi\":\"MÁY SẠC\",\"en\":\"MÁY SẠC\"}', '54704832872-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjlbrb7im4ud81\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 21500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(249, 60, '{\"vi\":\"MÁY SẠC PHÍM\",\"en\":\"MÁY SẠC PHÍM\"}', '54704832872-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjlbrb7im4ud81\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM\"}}', NULL, 23200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(250, 60, '{\"vi\":\"MÁY SẠC PHÍM BÚT\",\"en\":\"MÁY SẠC PHÍM BÚT\"}', '54704832872-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjlbrb7im4ud81\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM B\\u00daT\"}}', NULL, 24700000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(251, 61, '{\"vi\":\"MÁY SẠC PHÍM\",\"en\":\"MÁY SẠC PHÍM\"}', '54108251420-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmj1t63a8pan31\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N H\\u00c3NG\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM\"}}', NULL, 27900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(252, 61, '{\"vi\":\"MÁY SẠC PHÍM BÚT\",\"en\":\"MÁY SẠC PHÍM BÚT\"}', '54108251420-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmj1t63a8pan31\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N H\\u00c3NG\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM B\\u00daT\"}}', NULL, 28900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(253, 61, '{\"vi\":\"MÁY SẠC\",\"en\":\"MÁY SẠC\"}', '54108251420-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmj1t63a8pan31\",\"options\":{\"PH\\u1ee4 KI\\u1ec6N H\\u00c3NG\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 26400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(254, 62, '{\"vi\":\"Cobalt Blue (Xanh)\",\"en\":\"Cobalt Blue (Xanh)\"}', '52654837473-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjlb29if47wi66\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Cobalt Blue (Xanh)\"}}', NULL, 8900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(255, 62, '{\"vi\":\"Burgundy (Đỏ Rượu)\",\"en\":\"Burgundy (Đỏ Rượu)\"}', '52654837473-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-mjlb29if47wi66\",\"options\":{\"M\\u00c0U S\\u1eaeC\":\"Burgundy (\\u0110\\u1ecf R\\u01b0\\u1ee3u)\"}}', NULL, 8900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(256, 69, '{\"vi\":\"MÁY SẠC\",\"en\":\"MÁY SẠC\"}', '41729688005-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmj1t63a8pan31\",\"options\":{\"OPTION\":\"M\\u00c1Y S\\u1ea0C\"}}', NULL, 21400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(257, 69, '{\"vi\":\"MÁY SẠC PHÍM\",\"en\":\"MÁY SẠC PHÍM\"}', '41729688005-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmj1t63a8pan31\",\"options\":{\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM\"}}', NULL, 22900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(258, 69, '{\"vi\":\"MÁY SẠC PHÍM BÚT\",\"en\":\"MÁY SẠC PHÍM BÚT\"}', '41729688005-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-81ztc-mmj1t63a8pan31\",\"options\":{\"OPTION\":\"M\\u00c1Y S\\u1ea0C PH\\u00cdM B\\u00daT\"}}', NULL, 23900000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(259, 71, '{\"vi\":\"PRO 5 I5/8/256 - MẤT 1 ĐƯỜNG CẢM ỨNG\",\"en\":\"PRO 5 I5/8/256 - MẤT 1 ĐƯỜNG CẢM ỨNG\"}', '40516826403-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me432jez1wxz08\",\"options\":{\"LO\\u1ea0I M\\u00c1Y\":\"PRO 5 I5\\/8\\/256\",\"L\\u00dd DO\":\"M\\u1ea4T 1 \\u0110\\u01af\\u1edcNG C\\u1ea2M \\u1ee8NG\"}}', NULL, 3000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(260, 71, '{\"vi\":\"PRO 5 I5/4/128 - MẤT 1 ĐƯỜNG CẢM ỨNG\",\"en\":\"PRO 5 I5/4/128 - MẤT 1 ĐƯỜNG CẢM ỨNG\"}', '40516826403-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me432jez1wxz08\",\"options\":{\"LO\\u1ea0I M\\u00c1Y\":\"PRO 5 I5\\/4\\/128\",\"L\\u00dd DO\":\"M\\u1ea4T 1 \\u0110\\u01af\\u1edcNG C\\u1ea2M \\u1ee8NG\"}}', NULL, 3000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(261, 71, '{\"vi\":\"PRO 5 I5/8/256 - Giật Màn Hình\",\"en\":\"PRO 5 I5/8/256 - Giật Màn Hình\"}', '40516826403-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me432jez1wxz08\",\"options\":{\"LO\\u1ea0I M\\u00c1Y\":\"PRO 5 I5\\/8\\/256\",\"L\\u00dd DO\":\"Gi\\u1eadt M\\u00e0n H\\u00ecnh\"}}', NULL, 3200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(262, 71, '{\"vi\":\"PRO 5 I5/8/256 - ÁM NỀN ĐEN\",\"en\":\"PRO 5 I5/8/256 - ÁM NỀN ĐEN\"}', '40516826403-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me432jez1wxz08\",\"options\":{\"LO\\u1ea0I M\\u00c1Y\":\"PRO 5 I5\\/8\\/256\",\"L\\u00dd DO\":\"\\u00c1M N\\u1ec0N \\u0110EN\"}}', NULL, 2990000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(263, 71, '{\"vi\":\"PRO 5 I5/4/128 - Giật Màn Hình\",\"en\":\"PRO 5 I5/4/128 - Giật Màn Hình\"}', '40516826403-4', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me432jez1wxz08\",\"options\":{\"LO\\u1ea0I M\\u00c1Y\":\"PRO 5 I5\\/4\\/128\",\"L\\u00dd DO\":\"Gi\\u1eadt M\\u00e0n H\\u00ecnh\"}}', NULL, 3000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 5, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(264, 71, '{\"vi\":\"PRO 7 PLUS I5/8/256 - Giật Màn Hình\",\"en\":\"PRO 7 PLUS I5/8/256 - Giật Màn Hình\"}', '40516826403-5', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me432jez1wxz08\",\"options\":{\"LO\\u1ea0I M\\u00c1Y\":\"PRO 7 PLUS I5\\/8\\/256\",\"L\\u00dd DO\":\"Gi\\u1eadt M\\u00e0n H\\u00ecnh\"}}', NULL, 3000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 6, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(265, 71, '{\"vi\":\"PRO 7 PLUS I5/8/256 - MẤT 1 ĐƯỜNG CẢM ỨNG\",\"en\":\"PRO 7 PLUS I5/8/256 - MẤT 1 ĐƯỜNG CẢM ỨNG\"}', '40516826403-6', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me432jez1wxz08\",\"options\":{\"LO\\u1ea0I M\\u00c1Y\":\"PRO 7 PLUS I5\\/8\\/256\",\"L\\u00dd DO\":\"M\\u1ea4T 1 \\u0110\\u01af\\u1edcNG C\\u1ea2M \\u1ee8NG\"}}', NULL, 6500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 7, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(266, 71, '{\"vi\":\"PRO 5 I5/4/128 - ÁM NỀN ĐEN\",\"en\":\"PRO 5 I5/4/128 - ÁM NỀN ĐEN\"}', '40516826403-7', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me432jez1wxz08\",\"options\":{\"LO\\u1ea0I M\\u00c1Y\":\"PRO 5 I5\\/4\\/128\",\"L\\u00dd DO\":\"\\u00c1M N\\u1ec0N \\u0110EN\"}}', NULL, 3400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 8, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(267, 71, '{\"vi\":\"PRO 7 PLUS I5/8/256 - ÁM NỀN ĐEN\",\"en\":\"PRO 7 PLUS I5/8/256 - ÁM NỀN ĐEN\"}', '40516826403-8', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-me432jez1wxz08\",\"options\":{\"LO\\u1ea0I M\\u00c1Y\":\"PRO 7 PLUS I5\\/8\\/256\",\"L\\u00dd DO\":\"\\u00c1M N\\u1ec0N \\u0110EN\"}}', NULL, 3000000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 9, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(268, 72, '{\"vi\":\"Tingbox 2 Màn LED\",\"en\":\"Tingbox 2 Màn LED\"}', '40254230821-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-maw9foa1585o9e\",\"options\":{\"T\\u00f9y ch\\u1ecdn\":\"Tingbox 2 M\\u00e0n LED\"}}', NULL, 699000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(269, 72, '{\"vi\":\"Tingbox 2 Không LED\",\"en\":\"Tingbox 2 Không LED\"}', '40254230821-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-maw9foa1585o9e\",\"options\":{\"T\\u00f9y ch\\u1ecdn\":\"Tingbox 2 Kh\\u00f4ng LED\"}}', NULL, 499000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(270, 73, '{\"vi\":\"Phím BT Cho Surface\",\"en\":\"Phím BT Cho Surface\"}', '29761317154-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8pvu5ijm4jm1a\",\"options\":{\"Combo\":\"Ph\\u00edm BT Cho Surface\"}}', NULL, 500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(271, 73, '{\"vi\":\"Combo Phím+Chuột\",\"en\":\"Combo Phím+Chuột\"}', '29761317154-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8pvu5ijm4jm1a\",\"options\":{\"Combo\":\"Combo Ph\\u00edm+Chu\\u1ed9t\"}}', NULL, 145000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(272, 73, '{\"vi\":\"Phím lẻ\",\"en\":\"Phím lẻ\"}', '29761317154-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m8pvu5ijm4jm1a\",\"options\":{\"Combo\":\"Ph\\u00edm l\\u1ebb\"}}', NULL, 109000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(273, 75, '{\"vi\":\"90-95%\",\"en\":\"90-95%\"}', '29323933351-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m85pkqyqeg7616\",\"options\":{\"Ch\\u1ea5t L\\u01b0\\u1ee3ng\":\"90-95%\"}}', NULL, 820000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(274, 75, '{\"vi\":\"80-85%\",\"en\":\"80-85%\"}', '29323933351-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m85pkqyqeg7616\",\"options\":{\"Ch\\u1ea5t L\\u01b0\\u1ee3ng\":\"80-85%\"}}', NULL, 590000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(275, 76, '{\"vi\":\"Ram 2 SSD 32\",\"en\":\"Ram 2 SSD 32\"}', '29112822413-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m9b9fll78k9399\",\"options\":{\"Option\":\"Ram 2 SSD 32\"}}', NULL, 1500000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(276, 76, '{\"vi\":\"Ram 2 SSD 64\",\"en\":\"Ram 2 SSD 64\"}', '29112822413-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ra0g-m9b9fll78k9399\",\"options\":{\"Option\":\"Ram 2 SSD 64\"}}', NULL, 1800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(277, 77, '{\"vi\":\"Ram 4 SSD 128 - Máy+sạc+phím\",\"en\":\"Ram 4 SSD 128 - Máy+sạc+phím\"}', '27963482090-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-meqivot7qepze3\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 4 SSD 128\",\"Option\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm\"}}', NULL, 3200000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(278, 77, '{\"vi\":\"Ram 2 SSD 64 - Máy+sạc\",\"en\":\"Ram 2 SSD 64 - Máy+sạc\"}', '27963482090-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-meqivot7qepze3\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 2 SSD 64\",\"Option\":\"M\\u00e1y+s\\u1ea1c\"}}', NULL, 1800000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(279, 77, '{\"vi\":\"Ram 4 SSD 128 - Máy+sạc\",\"en\":\"Ram 4 SSD 128 - Máy+sạc\"}', '27963482090-2', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-meqivot7qepze3\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 4 SSD 128\",\"Option\":\"M\\u00e1y+s\\u1ea1c\"}}', NULL, 2600000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 3, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(280, 77, '{\"vi\":\"Ram 2 SSD 64 - Máy+sạc+phím\",\"en\":\"Ram 2 SSD 64 - Máy+sạc+phím\"}', '27963482090-3', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-820l4-meqivot7qepze3\",\"options\":{\"C\\u1ea4U H\\u00ccNH\":\"Ram 2 SSD 64\",\"Option\":\"M\\u00e1y+s\\u1ea1c+ph\\u00edm\"}}', NULL, 2400000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 4, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(281, 78, '{\"vi\":\"DÁN PRO 8,9\",\"en\":\"DÁN PRO 8,9\"}', '27912717376-0', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m0r3b78xck4t1a\",\"options\":{\"Otion\":\"D\\u00c1N PRO 8,9\"}}', NULL, 109000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 1, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(282, 78, '{\"vi\":\"DÁN PRO 3,4,5,6,7\",\"en\":\"DÁN PRO 3,4,5,6,7\"}', '27912717376-1', NULL, '{\"image\":\"https:\\/\\/cf.shopee.vn\\/file\\/vn-11134207-7ras8-m0r3b78xck4t1a\",\"options\":{\"Otion\":\"D\\u00c1N PRO 3,4,5,6,7\"}}', NULL, 109000.00, NULL, NULL, NULL, NULL, 50, 1, 0, 2, '2026-07-08 00:02:48', '2026-07-08 00:02:48'),
(294, 79, '{\"vi\":\"Đen than / S / Nylon chống nước\"}', 'JACKET-V2-DEMO-DEN-THAN-S-NYLON-CHONG-NUOC', '8930000000294', NULL, 'b5acc9d5879023ca8c61f61c5686d18832ed1d7faa881ff2147159421f12dbbf', 890000.00, 1040000.00, 460000.00, NULL, 780, 12, 1, 1, 3, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(295, 79, '{\"vi\":\"Đen than / S / Canvas dày\"}', 'JACKET-V2-DEMO-DEN-THAN-S-CANVAS-DAY', '8930000000295', NULL, 'd3e37af0765bf7244b8f6aeec3d4a84f31b243d638e2304112fa286d8e9307ab', 1010000.00, 1160000.00, 540000.00, NULL, 920, 14, 1, 0, 4, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(296, 79, '{\"vi\":\"Đen than / M / Nylon chống nước\"}', 'JACKET-V2-DEMO-DEN-THAN-M-NYLON-CHONG-NUOC', '8930000000296', NULL, '1c628a1ce5c878ebee8d322d299de7b1a7a952408b2b97688b37e7b00b64f1c8', 920000.00, 1070000.00, 460000.00, NULL, 780, 13, 1, 0, 5, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(297, 79, '{\"vi\":\"Đen than / M / Canvas dày\"}', 'JACKET-V2-DEMO-DEN-THAN-M-CANVAS-DAY', '8930000000297', NULL, '617588b64e9c4c5e08e2725732886a14e803a86473b03fbcbbea3af36106301c', 1040000.00, 1190000.00, 540000.00, NULL, 920, 15, 1, 0, 6, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(298, 79, '{\"vi\":\"Đen than / L / Nylon chống nước\"}', 'JACKET-V2-DEMO-DEN-THAN-L-NYLON-CHONG-NUOC', '8930000000298', NULL, 'a92b689bd18bea15b6f7f1b5abf28112b61ed89ac0f90a5b315eb86af7255ea1', 950000.00, 1100000.00, 460000.00, NULL, 780, 14, 1, 0, 7, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(299, 79, '{\"vi\":\"Đen than / L / Canvas dày\"}', 'JACKET-V2-DEMO-DEN-THAN-L-CANVAS-DAY', '8930000000299', NULL, '6b3f3bbc63d2fc6c6659e24b58bcfdd2937c4abc01f6818456ea54d3d53a2994', 1070000.00, 1220000.00, 540000.00, NULL, 920, 16, 1, 0, 8, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(300, 79, '{\"vi\":\"Đen than / XL / Nylon chống nước\"}', 'JACKET-V2-DEMO-DEN-THAN-XL-NYLON-CHONG-NUOC', '8930000000300', NULL, 'bb9793a9f9d9e7638d18633b73a56dcae1b613a07fc639c4f600b665171440c0', 980000.00, 1130000.00, 460000.00, NULL, 780, 15, 1, 0, 9, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(301, 79, '{\"vi\":\"Đen than / XL / Canvas dày\"}', 'JACKET-V2-DEMO-DEN-THAN-XL-CANVAS-DAY', '8930000000301', NULL, 'db83065791f1e0cc0b6842ad2f1c31e48c2bdc23edde4fc475881e505d29737e', 1100000.00, 1250000.00, 540000.00, NULL, 920, 17, 1, 0, 10, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(302, 79, '{\"vi\":\"Xanh rêu / S / Nylon chống nước\"}', 'JACKET-V2-DEMO-XANH-REU-S-NYLON-CHONG-NUOC', '8930000000302', NULL, 'c3eec5269f8290cbc5fd2b35656f888c1a074e5e5d5ca92c581487e48d0cdb81', 890000.00, 1040000.00, 460000.00, NULL, 780, 9, 1, 0, 11, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(303, 79, '{\"vi\":\"Xanh rêu / S / Canvas dày\"}', 'JACKET-V2-DEMO-XANH-REU-S-CANVAS-DAY', '8930000000303', NULL, 'f3ac470097f665394c8fc2e5c8a83e1e4322d901ffa9a9b17e269e35e317af43', 1010000.00, 1160000.00, 540000.00, NULL, 920, 11, 1, 0, 12, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(304, 79, '{\"vi\":\"Xanh rêu / M / Nylon chống nước\"}', 'JACKET-V2-DEMO-XANH-REU-M-NYLON-CHONG-NUOC', '8930000000304', NULL, 'fc7470bd924e92bc81e11694b5d0ab566e80ef9f2fac2ef3f0bfc4fb84457acc', 920000.00, 1070000.00, 460000.00, NULL, 780, 10, 1, 0, 13, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(305, 79, '{\"vi\":\"Xanh rêu / M / Canvas dày\"}', 'JACKET-V2-DEMO-XANH-REU-M-CANVAS-DAY', '8930000000305', NULL, '395224ad1b80945346d6317135d01958981a4edaafe3cb9cc001f7900dc08a85', 1040000.00, 1190000.00, 540000.00, NULL, 920, 12, 1, 0, 14, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(306, 79, '{\"vi\":\"Xanh rêu / L / Nylon chống nước\"}', 'JACKET-V2-DEMO-XANH-REU-L-NYLON-CHONG-NUOC', '8930000000306', NULL, '7d4e4a16efa0a8063bab1d5a4f4b56e565187f586e424270aefec393cf75c94b', 950000.00, 1100000.00, 460000.00, NULL, 780, 11, 1, 0, 15, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(307, 79, '{\"vi\":\"Xanh rêu / L / Canvas dày\"}', 'JACKET-V2-DEMO-XANH-REU-L-CANVAS-DAY', '8930000000307', NULL, '03e686ee7906775b2b8d8d443654a76b1fcea7962bc5ea335cf0db2fa6367886', 1070000.00, 1220000.00, 540000.00, NULL, 920, 13, 1, 0, 16, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(308, 79, '{\"vi\":\"Xanh rêu / XL / Nylon chống nước\"}', 'JACKET-V2-DEMO-XANH-REU-XL-NYLON-CHONG-NUOC', '8930000000308', NULL, 'd992b95f816f7da08c6434192e496f00f022dadbb6cb03efb518678163e2c218', 980000.00, 1130000.00, 460000.00, NULL, 780, 12, 1, 0, 17, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(309, 79, '{\"vi\":\"Xanh rêu / XL / Canvas dày\"}', 'JACKET-V2-DEMO-XANH-REU-XL-CANVAS-DAY', '8930000000309', NULL, 'b274381d40e687fcd46c1276f9d4531116c5e006d3f2e32e11f9baaea3a60492', 1100000.00, 1250000.00, 540000.00, NULL, 920, 14, 1, 0, 18, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(310, 79, '{\"vi\":\"Be cát / S / Nylon chống nước\"}', 'JACKET-V2-DEMO-BE-CAT-S-NYLON-CHONG-NUOC', '8930000000310', NULL, 'b868f611889ed2d4e072aa800aa6c0ff2c0d83aac4c4cb1e0bdd5f5799afee68', 890000.00, 1040000.00, 460000.00, NULL, 780, 7, 1, 0, 19, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(311, 79, '{\"vi\":\"Be cát / S / Canvas dày\"}', 'JACKET-V2-DEMO-BE-CAT-S-CANVAS-DAY', '8930000000311', NULL, 'ff321febe2fd0fd3877df21ecad1642d0fbf9199aa304f647ef869204ede3af1', 1010000.00, 1160000.00, 540000.00, NULL, 920, 9, 1, 0, 20, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(312, 79, '{\"vi\":\"Be cát / M / Nylon chống nước\"}', 'JACKET-V2-DEMO-BE-CAT-M-NYLON-CHONG-NUOC', '8930000000312', NULL, '90f81bee54b61f263bcff1afe652faffc2728632e98c01ca02d270bf5dc422d8', 920000.00, 1070000.00, 460000.00, NULL, 780, 8, 1, 0, 21, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(313, 79, '{\"vi\":\"Be cát / M / Canvas dày\"}', 'JACKET-V2-DEMO-BE-CAT-M-CANVAS-DAY', '8930000000313', NULL, 'f289eb5d19a85bd590f83aa6e038c5262a6a559fdcf23d8ca7f6060eb7571c2a', 1040000.00, 1190000.00, 540000.00, NULL, 920, 10, 1, 0, 22, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(314, 79, '{\"vi\":\"Be cát / L / Nylon chống nước\"}', 'JACKET-V2-DEMO-BE-CAT-L-NYLON-CHONG-NUOC', '8930000000314', NULL, 'b0845852c2ce26477403ae5dac9d6adc15b86a38ce8da18935168cd216a73226', 950000.00, 1100000.00, 460000.00, NULL, 780, 9, 1, 0, 23, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(315, 79, '{\"vi\":\"Be cát / L / Canvas dày\"}', 'JACKET-V2-DEMO-BE-CAT-L-CANVAS-DAY', '8930000000315', NULL, 'c693aa781225cc87bc231a4cb3520db4a5243e2f34ecf08b04b32ae53e3fefe1', 1070000.00, 1220000.00, 540000.00, NULL, 920, 11, 1, 0, 24, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(316, 79, '{\"vi\":\"Be cát / XL / Nylon chống nước\"}', 'JACKET-V2-DEMO-BE-CAT-XL-NYLON-CHONG-NUOC', '8930000000316', NULL, '58997db75ce6f7351e38da7a2e89ac050ee53eb2ad5ce17ee357d8876c24de75', 980000.00, 1130000.00, 460000.00, NULL, 780, 10, 1, 0, 25, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(317, 79, '{\"vi\":\"Be cát / XL / Canvas dày\"}', 'JACKET-V2-DEMO-BE-CAT-XL-CANVAS-DAY', '8930000000317', NULL, '2192c4db11c440b5a7d2f67c24c1cb0d530c2a3c167cd6ca5946f7a28fe6130c', 1100000.00, 1250000.00, 540000.00, NULL, 920, 12, 1, 0, 26, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(318, 79, '{\"vi\":\"Cam đất / S / Nylon chống nước\"}', 'JACKET-V2-DEMO-CAM-DAT-S-NYLON-CHONG-NUOC', '8930000000318', NULL, '7d62c38ae3d2344bf65033fa97edb9375c95c10c3db8d5c4454bdf9a9d520fed', 890000.00, 1040000.00, 460000.00, NULL, 780, 5, 1, 0, 27, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(319, 79, '{\"vi\":\"Cam đất / S / Canvas dày\"}', 'JACKET-V2-DEMO-CAM-DAT-S-CANVAS-DAY', '8930000000319', NULL, '30a47631a03b6ca21bba1ef4ae569259248f0d82967337958f2da35f718eae03', 1010000.00, 1160000.00, 540000.00, NULL, 920, 7, 1, 0, 28, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(320, 79, '{\"vi\":\"Cam đất / M / Nylon chống nước\"}', 'JACKET-V2-DEMO-CAM-DAT-M-NYLON-CHONG-NUOC', '8930000000320', NULL, '6a5aa45bbb739abd7cbc04ddbab4d26ae44eee444e8777bfa7b59ec705cd46f6', 920000.00, 1070000.00, 460000.00, NULL, 780, 6, 1, 0, 29, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(321, 79, '{\"vi\":\"Cam đất / M / Canvas dày\"}', 'JACKET-V2-DEMO-CAM-DAT-M-CANVAS-DAY', '8930000000321', NULL, '92974066e1c3b3de83179bc1d5febf60d32eba7dcc7053ba3b33a8d9f2c5d036', 1040000.00, 1190000.00, 540000.00, NULL, 920, 8, 1, 0, 30, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(322, 79, '{\"vi\":\"Cam đất / L / Nylon chống nước\"}', 'JACKET-V2-DEMO-CAM-DAT-L-NYLON-CHONG-NUOC', '8930000000322', NULL, '2297da479941bcd857af15d6c1744813c3a62a6f5f2dc935ff8d7899767b9163', 950000.00, 1100000.00, 460000.00, NULL, 780, 7, 1, 0, 31, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(323, 79, '{\"vi\":\"Cam đất / L / Canvas dày\"}', 'JACKET-V2-DEMO-CAM-DAT-L-CANVAS-DAY', '8930000000323', NULL, '6e6101ce3759a71cf9ffc36bcc52d8563fc94e5df5142a9c1f8678a7c6f197b5', 1070000.00, 1220000.00, 540000.00, NULL, 920, 9, 1, 0, 32, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(324, 79, '{\"vi\":\"Cam đất / XL / Nylon chống nước\"}', 'JACKET-V2-DEMO-CAM-DAT-XL-NYLON-CHONG-NUOC', '8930000000324', NULL, '8065ac4bf995960554399865f270bcee3813548527f1c336f822ac1960de8afc', 980000.00, 1130000.00, 460000.00, NULL, 780, 8, 1, 0, 33, '2026-07-18 06:53:00', '2026-07-18 06:55:06'),
(325, 79, '{\"vi\":\"Cam đất / XL / Canvas dày\"}', 'JACKET-V2-DEMO-CAM-DAT-XL-CANVAS-DAY', '8930000000325', NULL, 'df3f33ecc07a7e56c5af719e61ce78d744a65a101b684aab405f73101c1bd10a', 1100000.00, 1250000.00, 540000.00, NULL, 920, 10, 1, 0, 34, '2026-07-18 06:53:00', '2026-07-18 06:55:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variant_option_values`
--

CREATE TABLE `product_variant_option_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED NOT NULL,
  `product_option_value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variant_option_values`
--

INSERT INTO `product_variant_option_values` (`id`, `product_variant_id`, `product_option_value_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(2, 2, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(3, 3, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(4, 4, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(5, 5, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(6, 6, 1, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(7, 7, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(8, 8, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(9, 9, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(10, 10, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(11, 11, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(12, 12, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(13, 13, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(14, 14, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(15, 15, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(16, 16, 2, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(17, 17, 3, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(18, 18, 3, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(19, 19, 3, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(20, 20, 3, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(21, 21, 3, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(22, 22, 3, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(23, 23, 3, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(24, 24, 3, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(25, 25, 4, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(26, 26, 4, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(27, 27, 4, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(28, 28, 4, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(29, 29, 4, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(30, 30, 5, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(31, 31, 5, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(32, 32, 6, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(33, 33, 6, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(34, 34, 6, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(35, 35, 6, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(36, 36, 6, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(37, 37, 6, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(38, 38, 6, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(39, 39, 6, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(40, 40, 7, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(41, 41, 7, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(42, 42, 7, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(43, 43, 7, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(44, 44, 7, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(45, 45, 7, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(46, 46, 7, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(47, 47, 7, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(48, 48, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(49, 49, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(50, 50, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(51, 51, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(52, 52, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(53, 53, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(54, 54, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(55, 55, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(56, 56, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(57, 57, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(58, 58, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(59, 59, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(60, 60, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(61, 61, 8, '2026-07-18 06:42:32', '2026-07-18 06:42:32'),
(123, 294, 9, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(124, 294, 13, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(125, 294, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(126, 295, 9, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(127, 295, 13, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(128, 295, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(129, 296, 9, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(130, 296, 14, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(131, 296, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(132, 297, 9, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(133, 297, 14, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(134, 297, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(135, 298, 9, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(136, 298, 15, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(137, 298, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(138, 299, 9, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(139, 299, 15, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(140, 299, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(141, 300, 9, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(142, 300, 16, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(143, 300, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(144, 301, 9, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(145, 301, 16, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(146, 301, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(147, 302, 10, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(148, 302, 13, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(149, 302, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(150, 303, 10, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(151, 303, 13, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(152, 303, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(153, 304, 10, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(154, 304, 14, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(155, 304, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(156, 305, 10, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(157, 305, 14, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(158, 305, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(159, 306, 10, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(160, 306, 15, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(161, 306, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(162, 307, 10, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(163, 307, 15, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(164, 307, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(165, 308, 10, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(166, 308, 16, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(167, 308, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(168, 309, 10, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(169, 309, 16, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(170, 309, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(171, 310, 11, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(172, 310, 13, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(173, 310, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(174, 311, 11, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(175, 311, 13, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(176, 311, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(177, 312, 11, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(178, 312, 14, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(179, 312, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(180, 313, 11, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(181, 313, 14, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(182, 313, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(183, 314, 11, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(184, 314, 15, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(185, 314, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(186, 315, 11, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(187, 315, 15, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(188, 315, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(189, 316, 11, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(190, 316, 16, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(191, 316, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(192, 317, 11, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(193, 317, 16, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(194, 317, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(195, 318, 12, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(196, 318, 13, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(197, 318, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(198, 319, 12, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(199, 319, 13, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(200, 319, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(201, 320, 12, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(202, 320, 14, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(203, 320, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(204, 321, 12, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(205, 321, 14, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(206, 321, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(207, 322, 12, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(208, 322, 15, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(209, 322, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(210, 323, 12, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(211, 323, 15, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(212, 323, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(213, 324, 12, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(214, 324, 16, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(215, 324, 17, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(216, 325, 12, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(217, 325, 16, '2026-07-18 06:53:00', '2026-07-18 06:53:00'),
(218, 325, 18, '2026-07-18 06:53:00', '2026-07-18 06:53:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_voucher`
--

CREATE TABLE `product_voucher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project_settings`
--

CREATE TABLE `project_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`setting_value`)),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `project_settings`
--

INSERT INTO `project_settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'shop_name', '\"MatBaoWS\"', '2026-07-17 07:58:20'),
(2, 'logo_url', NULL, '2026-07-17 07:58:20'),
(3, 'favicon_url', '\"http:\\/\\/localhost:8000\\/storage\\/settings\\/L91J7t9mHY70fVhB8GZtU5sm4DOKGlHjapxCaUig.png\"', '2026-07-17 07:58:20'),
(4, 'contact', '{\"phone\":null,\"email\":null,\"address\":null,\"google_map_url\":null}', '2026-07-17 07:58:20'),
(5, 'theme', '{\"primary_color\":\"#0d6efd\",\"layout\":\"default\"}', '2026-07-17 07:58:20'),
(6, 'seo', '{\"title\":\"Laravel Ecommerce Core\",\"description\":null}', '2026-07-17 07:58:20'),
(7, 'social_links', '{\"facebook\":null,\"youtube\":null,\"instagram\":null,\"tiktok\":null}', '2026-07-17 07:58:20'),
(8, 'notification_settings', '\"eyJpdiI6IkNqMXFWd1lMSjNMdk9ZMEtBOVZvaWc9PSIsInZhbHVlIjoiVEtnWU5Wd1gzWFZQRWh5bml1bGgrUUpBVFIwcG5MMEJTU3R4SnBaQkIraEk0elNIakdRaXIxT1o0MGV6bG9MMzlTUWNOVk4xdjNFZkZSZFdTOHRFbWhqdjh4YVBXaTZkMUJjRmp4dWJzcTVvUDYrczl6cnpUT240SHJiMU8zVytjNjh2MTVOUUkwYjRyd1p2SkdaUzJDN3JvcC9WWWRpSmg3aG5CazQxREEvaXZVWXg1ZzZOZlV2dzJuMCtRbHIyRHdwOFljdEhXM2p6L0l2NlFnQk5vUlFaQWJUMGo5TkEwNGtWVHVpQytzZ3RpYTV0VEhRa251dmRBNm82M0hBNkwzSFZTSVJrNkVDekZmZ3NKRGkxVEtteWFJU1VoRExqaHBURjFNcGw4dVBJZ0ZnUjdocjNFMjVwdFZtd2RFMHozbXphMm9jN1J3aXg4UEFlZDl0Q1hsSCt1TW1nRTdjMkdReGxQeUpRUzJXRFc3MFhZb1BqQnlHSUo5d204OU9QZjdIK0ZMNVBGU2Z5L0RYUlo1R3RWeXAvL0lrWFNDMmttTnZBYjFwc1Q2QW83WnpRS0RId3FtVEIrSHRPN3c0YXVUY3hFRDBkU0ZXdDkxd29TdmRrL2hMTUM5R2ViUVlFaWlxb1R0bWQwYUN1NGhGK1F0VmdkeC9KVHJKaE5ibkd4RVBEQ0NJQkdDSXBrelFoWFAvMVdPQktmWGx3ZmEzRkNzQTZwVzdFZ0NJcEd6c2NLZG5ERGxZNDBiaEVZL0NlR1Z6cGp1TGV6SXl2ZXhqRk1wdTFCQT09IiwibWFjIjoiM2JlMTZlMTZhZjNmOTlmYjNkODc2MzhlNzZjNmQxZjliNmFmNjk3ZmY1NzNiMWNhMmE3NmVmY2FkZjI5ZTA4YyIsInRhZyI6IiJ9\"', NULL),
(9, 'flash_sale_end_time', '\"2026-07-15T04:00\"', NULL),
(10, 'embed_header', '\"\"', NULL),
(11, 'embed_footer', '\"\"', NULL),
(12, 'multilingual', '{\"enabled\":false,\"mode\":\"manual\",\"gtranslate\":{\"target_locales\":[],\"widget_look\":\"float\",\"position\":\"bottom_right\",\"detect_browser_language\":true,\"native_language_names\":true}}', '2026-07-22 10:06:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project_subscription`
--

CREATE TABLE `project_subscription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `started_at` date DEFAULT NULL,
  `expired_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `project_subscription`
--

INSERT INTO `project_subscription` (`id`, `package_id`, `status`, `started_at`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'active', '2026-07-17', NULL, '2026-06-25 23:28:01', '2026-07-17 07:32:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `kind` varchar(30) NOT NULL DEFAULT 'automatic',
  `applies_to` varchar(30) NOT NULL DEFAULT 'selected',
  `discount_type` varchar(30) NOT NULL,
  `value` decimal(15,2) NOT NULL,
  `min_quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `quantity_limit` int(10) UNSIGNED DEFAULT NULL,
  `used_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `priority` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_stackable` tinyint(1) NOT NULL DEFAULT 0,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotion_targets`
--

CREATE TABLE `promotion_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promotion_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity_limit` int(10) UNSIGNED DEFAULT NULL,
  `used_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `customer_name`, `customer_email`, `rating`, `comment`, `is_visible`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Trần Hữu Kiên', 'kien.tran@example.com', 5, 'Sản phẩm rất đẹp, đóng gói cẩn thận. Shop phục vụ rất nhiệt tình!', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(2, 1, 1, 'Nguyễn Văn Nam', 'nam.nguyen@example.com', 3, 'Sản phẩm tạm ổn, hơi xước nhẹ nhưng dùng vẫn tốt.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(3, 2, NULL, 'Trần Hữu Kiên', 'kien.tran@example.com', 4, 'Chất lượng tuyệt hảo, giá cả phải chăng.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(4, 2, 1, 'Hoàng Văn Bách', 'bach.hoang@example.com', 5, 'Hàng rất xịn sò, đóng gói chắc chắn cực kỳ.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(5, 2, NULL, 'Nguyễn Văn Nam', 'nam.nguyen@example.com', 5, 'Sản phẩm tạm ổn, hơi xước nhẹ nhưng dùng vẫn tốt.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(6, 2, 1, 'Nguyễn Văn Nam', 'nam.nguyen@example.com', 3, 'Giao hàng nhanh, chất lượng đúng như mô tả. Sẽ tiếp tục ủng hộ.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(7, 3, NULL, 'Vũ Thị Dung', 'dung.vu@example.com', 5, 'Sản phẩm tạm ổn, hơi xước nhẹ nhưng dùng vẫn tốt.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(8, 3, 1, 'Trần Hữu Kiên', 'kien.tran@example.com', 5, 'Mới nhận hàng chưa dùng thử nhưng nhìn chung thiết kế đẹp, sang trọng.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(9, 3, NULL, 'Hoàng Văn Bách', 'bach.hoang@example.com', 3, 'Sản phẩm rất đẹp, đóng gói cẩn thận. Shop phục vụ rất nhiệt tình!', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(10, 3, 1, 'Vũ Thị Dung', 'dung.vu@example.com', 4, 'Chất lượng tuyệt hảo, giá cả phải chăng.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(11, 4, NULL, 'Nguyễn Văn Nam', 'nam.nguyen@example.com', 3, 'Mới nhận hàng chưa dùng thử nhưng nhìn chung thiết kế đẹp, sang trọng.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(12, 4, 1, 'Bùi Văn Lâm', 'lam.bui@example.com', 4, 'Sử dụng rất tốt, bền đẹp. Đáng đồng tiền bát gạo.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(13, 5, NULL, 'Hoàng Văn Bách', 'bach.hoang@example.com', 3, 'Tuyệt vời ông mặt trời! Đánh giá 5 sao cho shop.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(14, 5, 1, 'Bùi Văn Lâm', 'lam.bui@example.com', 3, 'Chất lượng tuyệt hảo, giá cả phải chăng.', 1, '2026-07-17 07:58:20', '2026-07-18 00:48:00'),
(15, 5, NULL, 'Nguyễn Văn Nam', 'nam.nguyen@example.com', 5, 'Sử dụng rất tốt, bền đẹp. Đáng đồng tiền bát gạo.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(16, 6, NULL, 'Lê Thị Thu', 'thu.le@example.com', 5, 'Sử dụng rất tốt, bền đẹp. Đáng đồng tiền bát gạo.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(17, 6, 1, 'Trần Hữu Kiên', 'kien.tran@example.com', 5, 'Tuyệt vời ông mặt trời! Đánh giá 5 sao cho shop.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(18, 6, NULL, 'Hoàng Văn Bách', 'bach.hoang@example.com', 5, 'Mới nhận hàng chưa dùng thử nhưng nhìn chung thiết kế đẹp, sang trọng.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(19, 7, NULL, 'Hoàng Văn Bách', 'bach.hoang@example.com', 4, 'Chất lượng tuyệt hảo, giá cả phải chăng.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(20, 7, 1, 'Đỗ Thị Thảo', 'thao.do@example.com', 3, 'Tuyệt vời ông mặt trời! Đánh giá 5 sao cho shop.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(21, 8, NULL, 'Bùi Văn Lâm', 'lam.bui@example.com', 4, 'Sử dụng rất tốt, bền đẹp. Đáng đồng tiền bát gạo.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(22, 8, 1, 'Đỗ Thị Thảo', 'thao.do@example.com', 3, 'Hàng rất xịn sò, đóng gói chắc chắn cực kỳ.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(23, 8, NULL, 'Đỗ Thị Thảo', 'thao.do@example.com', 3, 'Chất lượng tuyệt hảo, giá cả phải chăng.', 1, '2026-07-17 07:58:20', '2026-07-17 07:58:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `revoked_tokens`
--

CREATE TABLE `revoked_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jti` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `revoked_tokens`
--

INSERT INTO `revoked_tokens` (`id`, `jti`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'caabbbbc-f3bb-4677-830b-053c5b199ff5', '2026-07-11 00:10:16', '2026-07-10 00:16:01', '2026-07-10 00:16:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT 0,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_system`, `permissions`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 0, '[\"manage_banners\",\"manage_media\",\"manage_orders\",\"manage_posts\",\"manage_products\",\"manage_reviews\",\"manage_settings\",\"manage_users\",\"manage_vouchers\",\"view_audit_log\",\"view_customers\",\"translate_content\"]', '2026-06-25 23:28:01', '2026-07-22 00:42:51'),
(3, 'Superadmin', 1, '[\"*\"]', '2026-07-17 07:32:11', '2026-07-17 07:32:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6Iskue25R1LpBG5WorbPechca67QcraOhVOC7G6U', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'ZXlKcGRpSTZJalJtTVVsdFJXUXdVVTg1ZVZSU05uZHhkbU15UTFFOVBTSXNJblpoYkhWbElqb2lWRGsxTUZCdmMxRXdUWFZhTDFwTUx6SXhkV0V4TVhSU1UxUkRVbmg2WTJwNFlVeHplVTVSVGs1cWFVRlRkMFUxUjBwalkyVmtRV1I1ZUhOWVRHSldOV0ZvWWxoaU1HdGtWbVpJT0dKRGF6ZFJRa05XUjFGNllWZDNkREZsTTBoak5EVkVWRGx6VTBKWFQyTXpNMkZaYURSWGVXTmFSelV3ZDAxek5rcEpTRzVNVm1kbk1YZEJXblpoVkU5c2NISmtTMkpGUWpCRWRsQkZWV3RyVWtwb05WQjBSV0ZOUW5aWGVFVnZVVVl2UWtWS0wwNUxSa05LTmt4VUwwNXlNa3BvWjB0UGFFTklhamd6V0RWeFVGUnNaMWhOUzFjM1oxVnBUelU0VTA0d1pqRTBPRWRuWkVkb1dFSkthbWxWWnk5cFkzRmhUR0ZJVnpob01rVm9jelU1U0RSVlNFcHNWWHBpWTA1bldXRjRlbTk0Y1M5UVMwRTJTbTFYZG05dlpHOWpMMVJ5TVVVNVZYZEdMMXB0TDBFcll6RlZTbGRZUlhSWFFYTkpWMGxJVTJFeWVsbE1URVp0VkVscVFqVkJRa05OYTBzMWMycDBlbFpTT0VsMFFVOWlZMkY1VjFCRWJIZGlWemxuTm10bFZtNXNiVXMyUVZORFJGaHFPVWQzZFZvMmJqRnVRWGx4UW01TWNrMUhTR2wzUVZaM1NWVlFZa1l5YUZFclNITlNRaXRTUTNWR01VcFZaQzl0UVVWSWRYbEdSVTlZWldSa00wWmtUa1JVVUdwMmRHRk9UblowYlRoUVdqQktXbVZPTUd4VGFtMXJabEU5UFNJc0ltMWhZeUk2SWpjNE9XUXpNelkwT1RaaE9UY3pObVF5T0RBeE56Qm1OR1ExWWpReFpHUXhPR00wTlRBMVpURmhPVGxoTVRrd1l6TmtZV1k1WldSaVlUQXpaRFZoTm1VaUxDSjBZV2NpT2lJaWZRPT0=', 1785212912),
('aRbS9P9mIhnPKBCHQAnSvjJpLR9afMpifpdQ5fEH', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.127.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'ZXlKcGRpSTZJalJRVFdaTWRWVTRWSE5wUlZoVWVtRm9SWGs0YTNjOVBTSXNJblpoYkhWbElqb2lMMUoyTkdsSmEzY3JjMnRCTjFSb2IxWlBWM05UY1hSVk1WaDNVaXR5VFVKcVZsUTBRVTltUW5BM1RFeEdSbVp0V2xKMFdFaDJabU1yVUZCbGJsTmFkMlZ1U0hOek9YcDNlSGhuVFZOemNURTRkbU00VTJoeFV5ODNObWxIYjFNd05pOU1MeXQxVTA4ek9USnljV0ZGVUhORVpraHZhMDlHVUZJNVNqbEtaSGxpUldSeFR6WkZjRlptVUdoWmRFcERNV1pDYzJWbmFsRjNSVU0yUjBSc0wyaGxkWE5PWm1kNE5ERmhTVVZMVUdwNFYwcG9ZbGMxY0hKeWFrdExhVVpzZWs0dlIzQnZhMFJ1Y0N0QlNscHVSbEp2TkU0ME5UZGlWemxPUldFd04wMTFXV3hOWWpsYWNtUkZWakp4YW1oSlltTkJkekZSWWxwemFsTnljbnB6WVVod1lVRXJWMGgzYmxSTFF6aEVabE5hUTJodWN6aGlObVI2WlZSRlVrRkxWbEZuVEVGdlluY3hRbGRsVmsxNUswSTRRMk5OYmsxbUwyZDZja1JrUms5VGNFUkJVVzFMU0VwU1RFOUJTbkUyTWxBM1VHd3paRkZ1Y204eU5tVmlkVTlNWjBGbU0yRjBUVlpwU1VKbmMxaFZLMjB6UTJGalFVMDNUbmRMY0dob1pWRnplSGxMYUhoYVdrRnBka00xV21aU1UyVlZiMll6VVZsVWJUUjFhbWcxUmtwcmRIbFdZVlJIT0hWMVVVTm1aVVpUUjBoVVdqSnFjalpSTTBvMVVTSXNJbTFoWXlJNklqZzRZamN3WmpBd1pHUmxaR1EyWWpRMVpqZ3pOek5rWm1Sa1pEY3paRFkyWmpWalptTmxObVZoWXpOa01HUTVOekF5TURNeFptWmtZV1U0TUdJd1lUWWlMQ0owWVdjaU9pSWlmUT09', 1785212210),
('rDh4oXlq4y0UBj96Xd5T9JE9FN742VdZkzn73q6S', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'ZXlKcGRpSTZJbVJ6YlZKdE1XUm9RVzFLWlVSSlJITmFWRGt3YW1jOVBTSXNJblpoYkhWbElqb2lhMkpvY3pGRFowcHNkM1ZNV20wMVZGaDNNREJJT0VsS2IzZElZV3hxSzJsbUsxZGlhbVZWWkdacVpHOVJRbUY1U1hCRFQyVTVMMHBDUTJvck0xUnBSbGhRZFZjd2RXVnhPVlEzZW1SSlpYQklUeXQxVGtOWlVsSk5hMFZhVmtKcGRITlhPVVp0VmxSdWRXOHpRelV5YjJGNGF5OU9SbUpRVFRSdWRTOU9UakI1TjFCeU1rNVlOa2xtTkdKd2JFdGxRVWhOY0hVMWNYZzNLMGRRWVhkMmRsTm1abXRQTmpSblRpOTZlREJOUkhOdGVWZGllVzUzVVZSclZXTjBlalpITWs5WVFUQjVUa2dyVkRoWmRIQmlZM2x2TVZGVlRGUnpkVVl2THpKdFVYZEdORlphZDB4S2MwNXZSM2hhTm5OSFEwaGxTSGhXU25kT2NGVnROSEZDYVU5dFpVUnVjbFZKZWxWSFQzWm1XRloyT1RkeWJEVndNRTVpYlZwdU5uZ3hOM2RwUzBKWVRrSlpiWFV4T1dzM2VrSXdjM2RvUjNSdWJrdFRMMEZNTTNaQldYSkpSWEpITmpKdFRsUm9SMFpaVjNOMVltRjRRVE12ZUU1UVNERjVObEpsTTI5aWJqbHphVlZNVEVWNmEyZzBVek5JVm1ka2JtNUdVMEZtY0Zwc1UyWlBZak5rZFRKREwyUlJkVWR2TTNJeGQxVndZbWxoZG5aM1NXNVZhazFrWlhkMGJWcElWR3BNTkdwM1dIaEZlWGRuV1hWNGRWQllSR2RMYUM5allpSXNJbTFoWXlJNkltUmhaV05oTm1FellUVmpOalV3TUdWbU9HVXpZelZsWkdNME5tRmtOek14TVdJNFpHVXpPR05oTkRCallUSTVabVJtTnpKbU16SXlZekEwT0dJNE5tUWlMQ0owWVdjaU9pSWlmUT09', 1785212592);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping_partners`
--

CREATE TABLE `shipping_partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `partner_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'custom',
  `status` varchar(255) NOT NULL DEFAULT 'inactive',
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`settings`)),
  `logo_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping_partners`
--

INSERT INTO `shipping_partners` (`id`, `partner_code`, `name`, `account_name`, `phone`, `type`, `status`, `settings`, `logo_url`, `created_at`, `updated_at`) VALUES
(1, 'DTGH000012', 'Giao Hàng Tiết Kiệm (GHTK)', NULL, NULL, 'connected', 'inactive', '\"eyJpdiI6Imh6YWtGS2NMRGNlYU5jUHJzakdnWEE9PSIsInZhbHVlIjoidEFDQmxPei9LTk1ZQVF1TW1NZWRyUTllMURqemNmdDRtU05VcDcvWUFwNlR6bklseXRvb296aVNidGJPM3h6R05RZHdtMWExZS9OZ1h0ZjhKRTdKcXhocWpyd3J2cnlsbWhaMTRaWFY5andHbHRlejQ3Z1laNENleUc3bWVZeDNwVnNyNVBTTGZxNlRNcDJZOFVPeitzdU01VHFXTnp2cERwUlhLYWJoTEl3PSIsIm1hYyI6IjNiM2E5MThkNmRjODFjOTNiN2U4N2JkNzAxMjlmYjIyNGM1ZjM0OWMwODg3OTBhNjMyZDBmM2UyMDY1YmRiYTkiLCJ0YWciOiIifQ==\"', 'Logo-GHTK.webp', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(2, 'DTGH000013', 'Giao Hàng Nhanh (GHN)', NULL, NULL, 'connected', 'inactive', '\"eyJpdiI6IjNpL240SVB2TVlra0t3RXUwUE83UGc9PSIsInZhbHVlIjoiUTRwdUpYOVhvdnpYZHFYVGVBRnlxdnRFdCt6TVNNL2dsRDlkbHRaSVI4QlZHOGhldHI2TnFZRmRSSGlXMSt1aDJ2WjVyTUM5ck9OelQ5c0h0TFJIN0liR21wUUlxVmRvQkRYWEZjY1Q5RGZ3T3dWSXo4Um1JTCtGb1B1cER4d3kiLCJtYWMiOiJhMWUzNDZmN2ZkYjMyNTkzZDU3OWMyMGEzZmI4MTgwMmE2NjZjZTk3OTk3YTFmZjM4ZjE2NTRlZDZlOGE5NWZiIiwidGFnIjoiIn0=\"', 'logo-giao-hang-nhanh.jpg', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(3, 'DTGH000014', 'J&T Express', NULL, NULL, 'connected', 'inactive', '\"eyJpdiI6IjcwRHFiR2xIQXFZcEdPOWhpRUlNbFE9PSIsInZhbHVlIjoiMjh5ZDgxK3ZKM2dWQ20ra0NGeEpvTnlMcUZ2ZWx2d0RMaTN3VStTNU55MXI5Y0I0NXNWbDhGY3Vpem4yU1dLVCIsIm1hYyI6IjZmZGNiM2VjMGMxNjlkNWNlODRiYTBjYzJiZjAzZmMyZTg2MzY5YjVhZDdiMDc2YzBhN2M2ZWM0MWI2ZjEyNjQiLCJ0YWciOiIifQ==\"', 'J&TExpress.png', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(4, 'DTGH000015', 'SPX Express', NULL, NULL, 'connected', 'inactive', '\"eyJpdiI6IlN3ZzNiZ2VVbnhRYjBDRWltQXlhMWc9PSIsInZhbHVlIjoiWkQvVkI4c2FZS0R4RVlvTENuSHY3dUVXZ3BleEF1c3BzNEs2ZnZCYmQwVnJWaTZqWXZQT1NndGhrOC9XZHFtbjRnemVNcTcxUTlPQ3J2L2NmNGNHVWdCRWl3M2UxeElKRFRlWE9EL2V0ekE9IiwibWFjIjoiMzhmN2E2NmQ0Mzc0OTJhOTk0OTdlYjkzN2FkZTk4OWM1MTQzZDhjZmZmODU5NTFhZWM4NGEzZGY0MGUyNWUzZiIsInRhZyI6IiJ9\"', 'SPXEXPRESS.png', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(5, 'DTGH000016', 'Viettel Post', NULL, NULL, 'connected', 'inactive', '\"eyJpdiI6InZjUmVhMWI3WVhqU2FqekdNNnNvc1E9PSIsInZhbHVlIjoicmFNbzhkeVQrTnp5bk9MMDRpbzlYZHp6K0FOdHJYTEt1MUVmQ2VlUjJ2czZ2WjFqaVhOdEpnd25Kazg5aDBsb2szSnpNb090WEh5UFJPOVFpNlZlc2FCSE9DSTBjMkFwVXhCYXZRS1VVRXM9IiwibWFjIjoiNWE4YmIxYzkwZDExNmM5ZDc4MDM0Y2VmZjBhMTMxNWY4YTBkNzhiNjBhYTMxNmEzOWEzNzM1NDYwMWJlZTMxNyIsInRhZyI6IiJ9\"', 'Viettel_Post_logo.svg', '2026-06-25 23:28:01', '2026-06-25 23:28:01'),
(6, 'DTGHTUGIAO', 'Giao hàng nhanh đồng giá', NULL, NULL, 'custom', 'active', '\"eyJpdiI6Ikk0SnNLUjJsbWRRcUEycDBvVlBzUmc9PSIsInZhbHVlIjoiTHJURWl2MFhKYTFFSEYrRUxtcjExdz09IiwibWFjIjoiMDQzMzVkN2VkMmMzN2Y3YzZlZjU5ZmY3YmY5YTlmMzFhZmNkMTk1Yzk3YjhlOWJkMzk2MzZiZTk5ZWMwMmViOSIsInRhZyI6IiJ9\"', 'self_delivery.png', '2026-06-25 23:28:01', '2026-06-28 19:16:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping_webhook_events`
--

CREATE TABLE `shipping_webhook_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(32) NOT NULL,
  `fingerprint` varchar(64) NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`payload`)),
  `received_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `translation_requests`
--

CREATE TABLE `translation_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider` varchar(32) NOT NULL,
  `source_locale` varchar(16) NOT NULL,
  `target_locale` varchar(16) NOT NULL,
  `character_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `source_hash` varchar(64) NOT NULL,
  `status` varchar(24) NOT NULL,
  `error_code` varchar(80) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `preferred_locale` varchar(16) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `preferred_locale`, `phone`, `avatar_url`, `email_verified_at`, `password`, `is_active`, `last_login_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, 'Phan Đức Toàn', 'pductoandev@gmail.com', 'vi', NULL, 'http://localhost:8000/storage/avatars/gh9TpCdOnnYHWrh6bn6j4yC63NyLiw1Am55ZtZ8O.png', NULL, '$2y$12$p9XJixlib9vxptFPq5safeGVyzaPw6lAD9V70MUn11R0CNhqRlxXi', 1, '2026-07-27 21:28:19', '6bPac3MZmS7kEMbWjmDx6ul7dljl9EeTcj1GYwR5IPZtjPKqKBDTur7G3R9T', '2026-06-25 23:28:02', '2026-07-27 21:28:19'),
(6, NULL, 'Phan Đức Toàn', 'toanphan01vip@gmail.com', 'en', NULL, NULL, NULL, '$2y$12$rWoalRnPOck1SltTH6Cb9uzNFfMtxMVCvvr9WCjhEUFHM0zkOCqL6', 1, '2026-07-08 01:28:17', NULL, '2026-07-08 01:20:53', '2026-07-22 10:29:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `customer_name`, `customer_phone`, `address`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 8, 'Phan Đức Toàn', '0916110241', 'THôn thanh sơn eapo cuwjjut dak nong', 1, '2026-07-09 20:27:13', '2026-07-09 20:27:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `applicable_scope` varchar(255) NOT NULL DEFAULT 'order',
  `type` varchar(255) NOT NULL,
  `value` decimal(15,2) NOT NULL,
  `min_order_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `max_discount_amount` decimal(15,2) DEFAULT NULL,
  `bundle_price` decimal(15,2) DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `usage_limit_per_customer` int(10) UNSIGNED DEFAULT NULL,
  `buy_quantity` int(10) UNSIGNED DEFAULT NULL,
  `get_quantity` int(10) UNSIGNED DEFAULT NULL,
  `gift_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `used_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_stackable` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `name`, `description`, `applicable_scope`, `type`, `value`, `min_order_amount`, `max_discount_amount`, `bundle_price`, `quantity`, `usage_limit_per_customer`, `buy_quantity`, `get_quantity`, `gift_product_id`, `used_count`, `start_date`, `end_date`, `is_active`, `is_stackable`, `created_at`, `updated_at`) VALUES
(1, 'WINTER10', '{\"vi\":\"Khuyến mãi mùa đông 10%\",\"en\":\"Winter Promotion 10%\"}', '{\"vi\":\"Giảm 10% cho tất cả đơn hàng từ 200k\",\"en\":\"10% discount for orders from 200k\"}', 'order', 'percentage', 10.00, 200000.00, 50000.00, NULL, 100, NULL, NULL, NULL, NULL, 0, '2026-07-16 14:58:20', '2026-08-17 14:58:20', 1, 0, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(2, 'FREESHIP', '{\"vi\":\"Miễn phí vận chuyển\",\"en\":\"Free Shipping\"}', '{\"vi\":\"Miễn phí vận chuyển tối đa 30k\",\"en\":\"Free shipping up to 30k\"}', 'order', 'fixed', 30000.00, 150000.00, NULL, NULL, 500, NULL, NULL, NULL, NULL, 0, '2026-07-16 14:58:20', '2026-08-17 14:58:20', 1, 0, '2026-07-17 07:58:20', '2026-07-17 07:58:20'),
(3, 'FIXED50', '{\"vi\":\"Giảm giá 50k\",\"en\":\"50k Fixed Discount\"}', '{\"vi\":\"Giảm ngay 50k cho đơn hàng từ 500k\",\"en\":\"Get 50k off for orders from 500k\"}', 'order', 'fixed', 50000.00, 500000.00, NULL, NULL, 50, NULL, NULL, NULL, NULL, 0, '2026-07-16 14:58:20', '2026-08-17 14:58:20', 1, 0, '2026-07-17 07:58:20', '2026-07-17 07:58:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher_usages`
--

CREATE TABLE `voucher_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `voucher_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `addons_code_unique` (`code`);

--
-- Chỉ mục cho bảng `admin_activity_logs`
--
ALTER TABLE `admin_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_activity_logs_user_id_foreign` (`user_id`),
  ADD KEY `admin_activity_logs_subject_type_subject_id_index` (`subject_type`,`subject_id`),
  ADD KEY `admin_activity_logs_action_created_at_index` (`action`,`created_at`);

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`),
  ADD KEY `brands_is_active_index` (`is_active`),
  ADD KEY `brands_sort_order_index` (`sort_order`);

--
-- Chỉ mục cho bảng `brand_voucher`
--
ALTER TABLE `brand_voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_voucher_voucher_id_brand_id_unique` (`voucher_id`,`brand_id`),
  ADD KEY `brand_voucher_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_sort_order_index` (`parent_id`,`sort_order`),
  ADD KEY `categories_is_active_index` (`is_active`);

--
-- Chỉ mục cho bảng `category_voucher`
--
ALTER TABLE `category_voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_voucher_voucher_id_category_id_unique` (`voucher_id`,`category_id`),
  ADD KEY `category_voucher_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `features_code_unique` (`code`);

--
-- Chỉ mục cho bảng `feature_settings`
--
ALTER TABLE `feature_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `feature_settings_feature_code_unique` (`feature_code`);

--
-- Chỉ mục cho bảng `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_movements_idempotency_key_unique` (`idempotency_key`),
  ADD KEY `inventory_movements_created_by_foreign` (`created_by`),
  ADD KEY `inventory_movements_product_id_created_at_index` (`product_id`,`created_at`),
  ADD KEY `inventory_movements_product_variant_id_created_at_index` (`product_variant_id`,`created_at`),
  ADD KEY `inventory_movements_order_id_created_at_index` (`order_id`,`created_at`),
  ADD KEY `inventory_movements_order_item_id_direction_index` (`order_item_id`,`direction`);

--
-- Chỉ mục cho bảng `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_code_unique` (`code`),
  ADD KEY `languages_is_active_sort_order_index` (`is_active`,`sort_order`);

--
-- Chỉ mục cho bảng `localized_slugs`
--
ALTER TABLE `localized_slugs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `localized_slugs_lookup_unique` (`sluggable_type`,`locale`,`slug`),
  ADD KEY `localized_slugs_current_index` (`sluggable_type`,`sluggable_id`,`locale`,`is_current`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_status_index` (`status`),
  ADD KEY `orders_payment_status_index` (`payment_status`),
  ADD KEY `orders_locale_index` (`locale`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_product_variant_id_foreign` (`product_variant_id`),
  ADD KEY `order_items_promotion_id_foreign` (`promotion_id`);

--
-- Chỉ mục cho bảng `order_refunds`
--
ALTER TABLE `order_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_refunds_order_id_foreign` (`order_id`),
  ADD KEY `order_refunds_created_by_foreign` (`created_by`);

--
-- Chỉ mục cho bảng `order_refund_items`
--
ALTER TABLE `order_refund_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_refund_items_order_refund_id_foreign` (`order_refund_id`),
  ADD KEY `order_refund_items_order_item_id_foreign` (`order_item_id`);

--
-- Chỉ mục cho bảng `order_status_histories`
--
ALTER TABLE `order_status_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status_histories_order_id_foreign` (`order_id`),
  ADD KEY `order_status_histories_changed_by_foreign` (`changed_by`);

--
-- Chỉ mục cho bảng `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packages_code_unique` (`code`);

--
-- Chỉ mục cho bảng `package_features`
--
ALTER TABLE `package_features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_features_package_id_feature_id_unique` (`package_id`,`feature_id`),
  ADD KEY `package_features_feature_id_foreign` (`feature_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_method_code_unique` (`method_code`);

--
-- Chỉ mục cho bảng `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_transactions_idempotency_key_unique` (`idempotency_key`),
  ADD KEY `payment_transactions_order_id_created_at_index` (`order_id`,`created_at`),
  ADD KEY `payment_transactions_gateway_gateway_transaction_id_index` (`gateway`,`gateway_transaction_id`),
  ADD KEY `payment_transactions_gateway_transaction_reference_index` (`gateway`,`transaction_reference`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_code_unique` (`code`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_category_id_is_active_index` (`category_id`,`is_active`);

--
-- Chỉ mục cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_categories_slug_unique` (`slug`),
  ADD KEY `post_categories_parent_id_sort_order_index` (`parent_id`,`sort_order`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_is_active_index` (`category_id`,`is_active`),
  ADD KEY `products_is_featured_index` (`is_featured`),
  ADD KEY `products_brand_id_is_active_index` (`brand_id`,`is_active`);

--
-- Chỉ mục cho bảng `product_option_groups`
--
ALTER TABLE `product_option_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_option_groups_product_id_code_unique` (`product_id`,`code`),
  ADD KEY `product_option_groups_product_id_sort_order_index` (`product_id`,`sort_order`);

--
-- Chỉ mục cho bảng `product_option_values`
--
ALTER TABLE `product_option_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_option_values_product_option_group_id_code_unique` (`product_option_group_id`,`code`),
  ADD KEY `product_option_values_product_option_group_id_sort_order_index` (`product_option_group_id`,`sort_order`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variants_sku_unique` (`sku`),
  ADD UNIQUE KEY `product_variant_signature_unique` (`product_id`,`option_signature`),
  ADD KEY `product_variants_product_id_sort_order_index` (`product_id`,`sort_order`),
  ADD KEY `product_variants_is_active_index` (`is_active`),
  ADD KEY `product_variants_barcode_index` (`barcode`);

--
-- Chỉ mục cho bảng `product_variant_option_values`
--
ALTER TABLE `product_variant_option_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variant_option_value_unique` (`product_variant_id`,`product_option_value_id`),
  ADD KEY `product_variant_option_values_product_option_value_id_index` (`product_option_value_id`);

--
-- Chỉ mục cho bảng `product_voucher`
--
ALTER TABLE `product_voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_voucher_voucher_id_product_id_unique` (`voucher_id`,`product_id`),
  ADD KEY `product_voucher_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `project_settings`
--
ALTER TABLE `project_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_settings_setting_key_unique` (`setting_key`);

--
-- Chỉ mục cho bảng `project_subscription`
--
ALTER TABLE `project_subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_subscription_package_id_foreign` (`package_id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotions_is_active_start_at_end_at_index` (`is_active`,`start_at`,`end_at`),
  ADD KEY `promotions_kind_priority_index` (`kind`,`priority`);

--
-- Chỉ mục cho bảng `promotion_targets`
--
ALTER TABLE `promotion_targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotion_targets_product_id_foreign` (`product_id`),
  ADD KEY `promotion_targets_promotion_id_product_id_index` (`promotion_id`,`product_id`),
  ADD KEY `promotion_targets_product_variant_id_index` (`product_variant_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_index` (`product_id`),
  ADD KEY `reviews_user_id_index` (`user_id`),
  ADD KEY `reviews_is_visible_index` (`is_visible`);

--
-- Chỉ mục cho bảng `revoked_tokens`
--
ALTER TABLE `revoked_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `revoked_tokens_jti_unique` (`jti`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `shipping_partners`
--
ALTER TABLE `shipping_partners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipping_partners_partner_code_unique` (`partner_code`);

--
-- Chỉ mục cho bảng `shipping_webhook_events`
--
ALTER TABLE `shipping_webhook_events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipping_webhook_events_fingerprint_unique` (`fingerprint`),
  ADD KEY `shipping_webhook_events_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `translation_requests`
--
ALTER TABLE `translation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translation_requests_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `translation_requests_provider_status_index` (`provider`,`status`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vouchers_code_unique` (`code`),
  ADD KEY `vouchers_code_index` (`code`),
  ADD KEY `vouchers_is_active_index` (`is_active`),
  ADD KEY `vouchers_applicable_scope_index` (`applicable_scope`),
  ADD KEY `vouchers_gift_product_id_foreign` (`gift_product_id`);

--
-- Chỉ mục cho bảng `voucher_usages`
--
ALTER TABLE `voucher_usages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_usages_order_id_foreign` (`order_id`),
  ADD KEY `voucher_usages_user_id_foreign` (`user_id`),
  ADD KEY `voucher_usages_voucher_id_user_id_index` (`voucher_id`,`user_id`),
  ADD KEY `voucher_usages_voucher_id_customer_email_index` (`voucher_id`,`customer_email`),
  ADD KEY `voucher_usages_voucher_id_customer_phone_index` (`voucher_id`,`customer_phone`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addons`
--
ALTER TABLE `addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `admin_activity_logs`
--
ALTER TABLE `admin_activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `brand_voucher`
--
ALTER TABLE `brand_voucher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `category_voucher`
--
ALTER TABLE `category_voucher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `feature_settings`
--
ALTER TABLE `feature_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `inventory_movements`
--
ALTER TABLE `inventory_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `localized_slugs`
--
ALTER TABLE `localized_slugs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `order_refunds`
--
ALTER TABLE `order_refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `order_refund_items`
--
ALTER TABLE `order_refund_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order_status_histories`
--
ALTER TABLE `order_status_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `package_features`
--
ALTER TABLE `package_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `payment_transactions`
--
ALTER TABLE `payment_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `product_option_groups`
--
ALTER TABLE `product_option_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product_option_values`
--
ALTER TABLE `product_option_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT cho bảng `product_variant_option_values`
--
ALTER TABLE `product_variant_option_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT cho bảng `product_voucher`
--
ALTER TABLE `product_voucher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `project_settings`
--
ALTER TABLE `project_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `project_subscription`
--
ALTER TABLE `project_subscription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `promotion_targets`
--
ALTER TABLE `promotion_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `revoked_tokens`
--
ALTER TABLE `revoked_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `shipping_partners`
--
ALTER TABLE `shipping_partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `shipping_webhook_events`
--
ALTER TABLE `shipping_webhook_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `translation_requests`
--
ALTER TABLE `translation_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `voucher_usages`
--
ALTER TABLE `voucher_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin_activity_logs`
--
ALTER TABLE `admin_activity_logs`
  ADD CONSTRAINT `admin_activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `brand_voucher`
--
ALTER TABLE `brand_voucher`
  ADD CONSTRAINT `brand_voucher_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brand_voucher_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `category_voucher`
--
ALTER TABLE `category_voucher`
  ADD CONSTRAINT `category_voucher_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_voucher_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD CONSTRAINT `inventory_movements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inventory_movements_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inventory_movements_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inventory_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `inventory_movements_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_refunds`
--
ALTER TABLE `order_refunds`
  ADD CONSTRAINT `order_refunds_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_refunds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_refund_items`
--
ALTER TABLE `order_refund_items`
  ADD CONSTRAINT `order_refund_items_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_refund_items_order_refund_id_foreign` FOREIGN KEY (`order_refund_id`) REFERENCES `order_refunds` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_status_histories`
--
ALTER TABLE `order_status_histories`
  ADD CONSTRAINT `order_status_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_status_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `package_features`
--
ALTER TABLE `package_features`
  ADD CONSTRAINT `package_features_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_features_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payment_transactions`
--
ALTER TABLE `payment_transactions`
  ADD CONSTRAINT `payment_transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_option_groups`
--
ALTER TABLE `product_option_groups`
  ADD CONSTRAINT `product_option_groups_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_option_values`
--
ALTER TABLE `product_option_values`
  ADD CONSTRAINT `product_option_values_product_option_group_id_foreign` FOREIGN KEY (`product_option_group_id`) REFERENCES `product_option_groups` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_variant_option_values`
--
ALTER TABLE `product_variant_option_values`
  ADD CONSTRAINT `product_variant_option_values_product_option_value_id_foreign` FOREIGN KEY (`product_option_value_id`) REFERENCES `product_option_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variant_option_values_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_voucher`
--
ALTER TABLE `product_voucher`
  ADD CONSTRAINT `product_voucher_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_voucher_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `promotion_targets`
--
ALTER TABLE `promotion_targets`
  ADD CONSTRAINT `promotion_targets_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promotion_targets_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `promotion_targets_promotion_id_foreign` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `shipping_webhook_events`
--
ALTER TABLE `shipping_webhook_events`
  ADD CONSTRAINT `shipping_webhook_events_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `translation_requests`
--
ALTER TABLE `translation_requests`
  ADD CONSTRAINT `translation_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_gift_product_id_foreign` FOREIGN KEY (`gift_product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `voucher_usages`
--
ALTER TABLE `voucher_usages`
  ADD CONSTRAINT `voucher_usages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `voucher_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `voucher_usages_voucher_id_foreign` FOREIGN KEY (`voucher_id`) REFERENCES `vouchers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
