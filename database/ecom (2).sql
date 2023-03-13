-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 11:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `created_at`, `updated_at`, `username`) VALUES
(1, 'progitha58@gmail.com', '$2y$10$is7qFEPq/VWfjxe72I6lS.AxO2laMN3KYOvUZ62ZjoA6VWIapW802', '2023-01-23 00:35:58', '2023-01-23 00:35:58', 'pappu'),
(2, 'kushwaha@gmail.com', '$2y$10$vm0cGHbMvwtVhBtQ1Cfywec04kqnLOyfRYE6Q8/tMyC0XYyEVs9vm', '2023-01-24 00:06:58', '2023-01-24 00:06:58', 'kushwaha@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) NOT NULL,
  `brand_img` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`, `brand_img`, `status`, `created_at`, `updated_at`) VALUES
(3, 'HHKE', '1677739711.jpg', 1, '2023-03-02 01:18:31', '2023-03-02 01:18:31'),
(4, 'DD', '1677739730.jpg', 1, '2023-03-02 01:18:50', '2023-03-02 01:18:50'),
(5, 'EEE', '1677739739.jpg', 1, '2023-03-02 01:18:59', '2023-03-02 01:18:59'),
(6, 'ESSD', '1677739747.jpg', 1, '2023-03-02 01:19:07', '2023-03-02 01:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `usertype` enum('Reg','Not-Reg') NOT NULL,
  `qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `parent_category` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `parent_category`, `category_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'man', 'manss', '0', '1677739180.png', 1, '2023-03-02 01:09:40', '2023-03-02 01:09:40'),
(2, 'woman', 'womanss', '0', '1677739201.png', 1, '2023-03-02 01:10:01', '2023-03-02 01:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `colores`
--

CREATE TABLE `colores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colores`
--

INSERT INTO `colores` (`id`, `color`, `status`, `created_at`, `updated_at`) VALUES
(1, 'RED', '1', '2023-03-02 01:10:46', '2023-03-02 01:10:46'),
(2, 'GREEN', '1', '2023-03-02 01:10:53', '2023-03-02 01:10:53'),
(3, 'WHITE', '1', '2023-03-02 01:11:02', '2023-03-02 01:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_tittle` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_value` varchar(255) NOT NULL,
  `type` enum('Value','Per') NOT NULL,
  `min_order_amount` int(11) NOT NULL,
  `is_one_time` int(11) NOT NULL,
  `status` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_tittle`, `coupon_code`, `coupon_value`, `type`, `min_order_amount`, `is_one_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hello', 'new200', '200', 'Value', 500, 0, 1, '2023-03-30 12:10:22', '2023-03-31 12:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `is_verify` int(11) NOT NULL,
  `rand_id` varchar(50) NOT NULL,
  `is_forgot` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `password`, `address`, `city`, `state`, `zip`, `company`, `gstin`, `status`, `is_verify`, `rand_id`, `is_forgot`, `created_at`, `updated_at`) VALUES
(2, 'T-SHDIRT', 'kushwaha@gmail.com', '9137640812', 'eyJpdiI6InZvMUtyMVZSTlJHenBtNVNXYlRvSWc9PSIsInZhbHVlIjoiM1lHTk8wWlR0WG9KWityTFBiMEhxNVJncUNBM3NXYlFRT2RMSU5FZk5wRT0iLCJtYWMiOiI4NzkyMzMwN2I5YjJhZTk3OGI5MGI1MDhhZTI5NzYxNWYxM2QwZWFiMzU4ZjM4OTk0MDdmZTRjOThkZWEzODdhIiwidGFnIjoiIn0=', NULL, NULL, NULL, NULL, NULL, NULL, '1', 0, '340663394', 1, '2023-03-03 07:21:54', '2023-03-03 07:21:54'),
(12, 'pappu', 'kushwahapappu730@gmail.com', '9137640812', 'eyJpdiI6InpVMk1kSEw3MmJEMGpVUVVPQkhJN1E9PSIsInZhbHVlIjoiMWRmSy9SRlNFcU1KaHI2S21udTBwdz09IiwibWFjIjoiZGNlNjdkZTljYzE4NjRkZGUzZjg1YmVkMzY3MDg0ODc5OWY5ZDBkZTc0ZDMyNzFjOTUwMzIwZjg0ZmI1YjE4ZCIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, '1', 0, '949062522', 1, '2023-03-09 03:56:08', '2023-03-09 03:56:08'),
(18, 'pappu', 'progitha58@gmail.com', '9137640812', 'eyJpdiI6IkY3b0o4dy94ZXQzLyt5d2FlSGlPWHc9PSIsInZhbHVlIjoidkhGN1hadStPU2djRHhSaW9mSVMzZz09IiwibWFjIjoiMzM1YmYzYWU0MWY2ZGFmMTVhMTU4YzcyNjRhNDQ1NjU4OTE1NWRhN2QxYmVkZTVmYjAxMTQ4ZWM3NTIxMmRkNiIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, '1', 1, '734729773', 1, '2023-03-09 04:54:59', '2023-03-09 04:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `btn_txt` varchar(255) DEFAULT NULL,
  `btn_link` varchar(255) DEFAULT NULL,
  `status` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `image`, `btn_txt`, `btn_link`, `status`, `created_at`, `updated_at`) VALUES
(1, '1677742951.jpg', 'fff', 'ddd', 1, '2023-03-02 02:12:31', '2023-03-02 02:15:07'),
(3, '1677743630.jpg', 'ddxsdd', 'cdxcvsdd', 1, '2023-03-02 02:19:35', '2023-03-02 02:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_01_20_102353_create_admin_table', 1),
(4, '2023_01_20_104447_add_address_to_admin', 2),
(5, '2023_01_20_105126_add_address_to_admin', 3),
(6, '2023_01_21_113627_add_google-id_to_admin', 4),
(7, '2023_01_23_065854_create_categories_table', 5),
(8, '2023_01_23_092351_create__coupon_table', 6),
(9, '2023_01_23_094056_create_coupons_table', 7),
(10, '2023_01_23_102317_create_coupons_table', 8),
(11, '2023_01_23_114502_create_sizes_table', 9),
(12, '2023_01_24_060345_create_colores_table', 10),
(13, '2023_01_24_063734_create_products_table', 11),
(14, '2023_01_28_105314_create_brands_table', 12),
(15, '2023_01_30_093639_create_taxs_table', 13),
(16, '2023_01_31_095031_create_customers_table', 14),
(17, '2023_02_14_061100_create_home_banners_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_value` int(11) DEFAULT NULL,
  `order_status` varchar(100) NOT NULL,
  `payment_type` enum('COD','Gateway') NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `payment_id` varchar(250) DEFAULT NULL,
  `total_amount` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customers_id`, `name`, `email`, `mobile`, `address`, `city`, `state`, `pincode`, `coupon_code`, `coupon_value`, `order_status`, `payment_type`, `payment_status`, `payment_id`, `total_amount`, `added_on`) VALUES
(1, 18, 'pappu', 'progitha58@gmail.com', '9137640812', 'a', 'c', 's', '841437', 'dddd', 0, '1', 'COD', 'Pending', NULL, 1909, '2023-03-11 12:14:23'),
(2, 18, 'pappu', 'progitha58@gmail.com', '9137640812', 'a', 'c', 's', '841437', 'dddd', 0, '1', 'COD', 'Pending', NULL, 1909, '2023-03-11 12:31:34'),
(3, 18, 'pappu', 'progitha58@gmail.com', '9137640812', 'a', 'c', 's', '841437', 'dddd', 0, '1', 'Gateway', 'Pending', NULL, 0, '2023-03-11 12:31:53'),
(4, 18, 'pappu', 'progitha58@gmail.com', '9137640812', 'asd', 'd', 'd', 'd', NULL, 0, '1', 'COD', 'Pending', NULL, 788, '2023-03-11 12:42:10'),
(5, 18, 'pappu', 'progitha58@gmail.com', '9137640812', 'a', 'c', 's', '841437', NULL, 0, '1', 'COD', 'Pending', NULL, 788, '2023-03-11 12:42:47'),
(6, 18, 'pappu', 'progitha58@gmail.com', '9137640812', 'afds', 'sad', 'dsa', '841437', 'new200', 200, '1', 'COD', 'Pending', NULL, 788, '2023-03-11 01:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orders_id`, `product_id`, `product_attr_id`, `price`, `qty`) VALUES
(1, 1, 2, 2, 788, 2),
(2, 1, 1, 1, 333, 1),
(3, 2, 2, 2, 788, 2),
(4, 2, 1, 1, 333, 1),
(5, 4, 2, 2, 788, 1),
(6, 5, 2, 2, 788, 1),
(7, 6, 2, 2, 788, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `order_status`) VALUES
(1, 'Placed'),
(2, 'On The Way'),
(3, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `short_desc` longtext NOT NULL,
  `desc` longtext NOT NULL,
  `keywords` longtext NOT NULL,
  `technical_specification` longtext NOT NULL,
  `uses` longtext NOT NULL,
  `warranty` longtext NOT NULL,
  `leed_time` varchar(255) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `is_promo` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL,
  `is_descounted` int(11) NOT NULL,
  `is_trending` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `image`, `slug`, `brand`, `model`, `short_desc`, `desc`, `keywords`, `technical_specification`, `uses`, `warranty`, `leed_time`, `tax_id`, `is_promo`, `is_featured`, `is_descounted`, `is_trending`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'T-SHDIRT', '1677739585.png', 'SSS', '2', 'NEW MODEL', 'Shop for home office desks at Target. Browse a wide variety of corner desks, computer desks, kids desks and more. Free shipping on orders', 'Shop for home office desks at Target. Browse a wide variety of corner desks, computer desks, kids desks and more. Free shipping on orders', 'Shop for home office desks at Target. Browse a wide variety of corner desks, computer desks, kids desks and more. Free shipping on orders', 'Shop for home office desks at Target. Browse a wide variety of corner desks, computer desks, kids desks and more. Free shipping on orders', 'Shop for home office desks at Target. Browse a wide variety of corner desks, computer desks, kids desks and more. Free shipping on orders', 'Shop for home office desks at Target. Browse a wide variety of corner desks, computer desks, kids desks and more. Free shipping on orders', '4 day faster way', 1, 1, 1, 1, 0, 1, '2023-03-02 01:16:25', '2023-03-02 01:16:25'),
(2, 1, 'tishirt', '1677752370.png', 'hhii', '3', 'NEW MODEL', 'customizing your at-home workspace or adding workstations to your business office, you’ll find everything you need in I', 'customizing your at-home workspace or adding workstations to your business office, you’ll find everything you need in I', 'customizing your at-home workspace or adding workstations to your business office, you’ll find everything you need in I', 'customizing your at-home workspace or adding workstations to your business office, you’ll find everything you need in I', 'customizing your at-home workspace or adding workstations to your business office, you’ll find everything you need in I', 'customizing your at-home workspace or adding workstations to your business office, you’ll find everything you need in I', '4 day faster way', 1, 1, 1, 1, 0, 1, '2023-03-02 04:49:30', '2023-03-02 04:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_attr`
--

CREATE TABLE `product_attr` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `att_image` varchar(255) NOT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_attr`
--

INSERT INTO `product_attr` (`id`, `product_id`, `sku`, `att_image`, `mrp`, `price`, `qty`, `size_id`, `color_id`) VALUES
(1, 1, 'dds', '70321442.png', 443, 333, 6, 2, 2),
(2, 2, 'sseess', '17360044.png', 7000, 788, 6, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_image`) VALUES
(1, 1, '90117427.png'),
(2, 2, '78176072.png');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `status`, `created_at`, `updated_at`) VALUES
(1, 'M', 1, '2023-03-02 01:10:16', '2023-03-02 01:10:16'),
(2, 'L', 1, '2023-03-02 01:10:23', '2023-03-02 01:10:23'),
(3, 'XL', 1, '2023-03-02 01:10:31', '2023-03-02 01:10:31'),
(4, 'XXL', 1, '2023-03-02 01:10:37', '2023-03-02 01:10:37');

-- --------------------------------------------------------

--
-- Table structure for table `taxs`
--

CREATE TABLE `taxs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_desc` varchar(255) NOT NULL,
  `tax_value` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxs`
--

INSERT INTO `taxs` (`id`, `tax_desc`, `tax_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GST', '18', 1, '2023-03-02 01:14:59', '2023-03-02 01:14:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attr`
--
ALTER TABLE `product_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxs`
--
ALTER TABLE `taxs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `colores`
--
ALTER TABLE `colores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attr`
--
ALTER TABLE `product_attr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taxs`
--
ALTER TABLE `taxs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
