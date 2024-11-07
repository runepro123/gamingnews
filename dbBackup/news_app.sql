-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 07:20 AM
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
-- Database: `news_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'editor',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Motaleb', 'abumotaleb1111@gmail.com', 'editor', NULL, '$2y$12$im7X/Wzqhmy6cGjEVg/BgezsmWqYmo1G.JvKZSEibJVN4LT554QXO', 0, 'BrE5vLHXqABDkfcI2mlGUpPCYx2sO6', '2023-12-04 00:10:41', '2023-12-25 03:35:49'),
(4, 'Test1', 'test@gmail.com', 'editor', NULL, '$2y$12$racGPna4hmu0HnAMeyCcM.Fr1gr1uqtxEYFunL8PARklseWALHWmG', 1, NULL, '2023-12-04 00:11:55', '2023-12-04 00:43:02'),
(5, 'Admin', 'admin@gmail.com', 'admin', NULL, '$2y$10$4lKGCawJzL0c58x5ib6zn.WOM3fUsRcPIU/z6YhlpDGubuhcmY1Nq', 0, 'ygVfrjTjcSvEM5MysjfDTqQa4vn81DWXQmvqm2rq9u13AIqPj90H9pbTVO0T', '2023-12-04 06:24:16', '2023-12-25 03:35:16'),
(6, 'Jesan', 'jesan@gmail.com', 'editor', NULL, '$2y$12$uaiUP56OawDx//AM98Un/.huUxAxeZTuEkZjOyQgAy51YcrBnlX7G', 0, 'VUdU2ESVc99IrCeYXxQlvG5drnmab8HZXaTPexL2NplJNEzmdkUunMyaqv97', '2023-12-05 05:48:14', '2023-12-05 05:48:14'),
(7, 'Mridul Sarkar', 'mridul@gmail.com', 'editor', NULL, '$2y$12$B2f4imzdykR/A195hZZ1O.atLfxDlejgunfKPPcifdNuDrtsuQWx.', 1, NULL, '2023-12-25 04:43:20', '2023-12-25 04:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_ad_img` text NOT NULL,
  `header_ad_link` varchar(255) NOT NULL,
  `banner_ad_img` text NOT NULL,
  `banner_ad_link` varchar(255) NOT NULL,
  `card_ad_img` text NOT NULL,
  `card_ad_link` varchar(255) NOT NULL,
  `sidebar_ad_img` text NOT NULL,
  `sidebar_ad_link` varchar(255) NOT NULL,
  `footer_top_ad_img` text NOT NULL,
  `footer_top_ad_link` varchar(255) NOT NULL,
  `footer_ad_img` text NOT NULL,
  `footer_ad_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `header_ad_img`, `header_ad_link`, `banner_ad_img`, `banner_ad_link`, `card_ad_img`, `card_ad_link`, `sidebar_ad_img`, `sidebar_ad_link`, `footer_top_ad_img`, `footer_top_ad_link`, `footer_ad_img`, `footer_ad_link`, `created_at`, `updated_at`) VALUES
(1, 'backend/uploads/ads/1706003220_ad1.png', 'https://dbugstation.com', 'backend/uploads/ads/1706003246_ad1.png', 'https://dbugstation.com', 'backend/uploads/ads/1706001370_Capture.jpg', 'https://dbugstation.com', 'backend/uploads/ads/1706002945_banner.PNG', 'https://dbugstation.com', 'backend/uploads/ads/1706003491_ad2.png', 'https://dbugstation.com', 'backend/uploads/ads/1706001341_Capture.jpg', 'https://dbugstation.com', '2024-01-17 12:43:15', '2024-01-23 03:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admob_inter` varchar(255) DEFAULT NULL,
  `admob_banner` varchar(255) DEFAULT NULL,
  `admob_native` varchar(255) DEFAULT NULL,
  `admob_reward` varchar(255) DEFAULT NULL,
  `admob_open_ads` varchar(255) DEFAULT NULL,
  `ios_inter` varchar(255) DEFAULT NULL,
  `ios_banner` varchar(255) DEFAULT NULL,
  `ios_native` varchar(255) DEFAULT NULL,
  `ios_reward` varchar(255) DEFAULT NULL,
  `ios_open_ads` varchar(255) DEFAULT NULL,
  `facebook_inter` varchar(255) DEFAULT NULL,
  `facebook_banner` varchar(255) DEFAULT NULL,
  `facebook_native` varchar(255) DEFAULT NULL,
  `facebook_reward` varchar(255) DEFAULT NULL,
  `unity_appId_gameId` varchar(255) DEFAULT NULL,
  `iron_appKey` varchar(255) DEFAULT NULL,
  `appnext_placementId` varchar(255) DEFAULT NULL,
  `startapp_appId` varchar(255) DEFAULT NULL,
  `industrial_interval` varchar(255) DEFAULT NULL,
  `native_ads` varchar(255) DEFAULT NULL,
  `ads_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `admob_inter`, `admob_banner`, `admob_native`, `admob_reward`, `admob_open_ads`, `ios_inter`, `ios_banner`, `ios_native`, `ios_reward`, `ios_open_ads`, `facebook_inter`, `facebook_banner`, `facebook_native`, `facebook_reward`, `unity_appId_gameId`, `iron_appKey`, `appnext_placementId`, `startapp_appId`, `industrial_interval`, `native_ads`, `ads_type`, `created_at`, `updated_at`) VALUES
(1, 'ca-app-pub-3940256099942544/4411468910', 'ca-app-pub-3940256099942544/2934735716', 'ca-app-pub-3940256099942544/3986624511', 'ca-app-pub-3940256099942544/1712485313', NULL, NULL, NULL, NULL, NULL, NULL, 'IMG_16_9_APP_INSTALL#YOUR_PLACEMENT_ID', 'IMG_16_9_APP_INSTALL#YOUR_PLACEMENT_ID', 'IMG_16_9_APP_INSTALL#YOUR_PLACEMENT_ID', 'VID_HD_16_9_15S_APP_INSTALL#YOUR_PLACEMENT_ID', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '2023-12-25 04:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `breaking_news`
--

CREATE TABLE `breaking_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `breaking_news`
--

INSERT INTO `breaking_news` (`id`, `news_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 1, '2024-02-01 07:03:18', '2024-02-01 07:19:09'),
(2, 12, 1, '2024-02-01 07:08:15', '2024-02-01 07:19:18'),
(3, 12, 1, '2024-02-01 07:19:51', '2024-02-01 07:21:21'),
(4, 11, 1, '2024-02-01 07:21:51', '2024-02-01 07:23:05'),
(5, 11, 1, '2024-02-01 07:23:30', '2024-02-01 07:23:38'),
(10, 11, 0, '2024-02-01 07:26:07', '2024-02-01 07:26:07'),
(11, 12, 0, '2024-02-01 07:26:11', '2024-02-01 07:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `language_id`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Travel', 'backend/uploads/category-images/1705996115_pexels-pawan-yadav-2577274.jpg', 8, 0, '2023-11-27 03:42:26', '2024-01-23 01:48:35'),
(12, 'Sports', 'backend/uploads/category-images/1705996108_pexels-pixabay-46798.jpg', 8, 0, '2023-11-27 03:54:53', '2024-01-23 01:48:28'),
(13, 'Foods', 'backend/uploads/category-images/1705996098_pexels-malidate-van-769289.jpg', 8, 0, '2023-11-27 04:13:48', '2024-01-23 01:48:18'),
(14, 'রাজনীতি', 'backend/uploads/category-images/1701080601_rajniti.jpg', 9, 0, '2023-11-27 04:23:21', '2023-12-25 05:22:45'),
(15, 'খেলাধুলা', 'backend/uploads/category-images/1701080675_sports.jpg', 9, 0, '2023-11-27 04:24:35', '2023-11-27 04:24:35'),
(16, 'Politics', 'backend/uploads/category-images/1707116301_pexels-element-digital-1550337.jpg', 8, 0, '2023-11-27 04:42:06', '2024-02-05 00:58:21'),
(17, 'Business', 'backend/uploads/category-images/1707119193_pexels-sam-j-1764956.jpg', 8, 0, '2024-01-23 01:48:59', '2024-02-05 01:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `slider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `news_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `slider_id`, `news_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, 4, 'Sleek lines and innovative design! This modern building is a testament to architectural prowess, seamlessly blending form and function. A captivating addition to the urban landscape', '2024-01-23 01:51:26', '2024-01-23 01:51:26'),
(2, 8, NULL, 4, 'Bold and iconic!', '2024-01-23 01:51:41', '2024-01-23 01:51:41'),
(3, 12, NULL, 4, 'Beautiful Building', '2024-01-23 03:56:03', '2024-01-23 03:56:03'),
(4, 10, NULL, 8, 'Nice Iceland', '2024-01-23 04:44:40', '2024-01-23 04:44:40'),
(5, 9, NULL, 9, 'Bangladesh Jindabad', '2024-01-28 04:27:02', '2024-01-28 04:27:02'),
(12, 9, NULL, 7, '6', '2024-01-30 06:27:58', '2024-01-30 06:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `contact_configurations`
--

CREATE TABLE `contact_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `contact_schedule` varchar(255) NOT NULL,
  `support_email` varchar(255) NOT NULL,
  `support_message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_configurations`
--

INSERT INTO `contact_configurations` (`id`, `address`, `house_no`, `contact_number`, `contact_schedule`, `support_email`, `support_message`, `created_at`, `updated_at`) VALUES
(1, 'Buttonwood, California.', 'Rosemead, CA 91770', '+1 000 000 0000', 'Mon to Fri 9am to 6pm', 'support@gmail.com', 'Send us your query anytime!', '2024-01-17 08:27:57', '2024-01-17 02:38:10');

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_tokens`
--

INSERT INTO `device_tokens` (`id`, `device_token`, `created_at`, `updated_at`) VALUES
(1, 'cshF29--RsS54t1DVJ4Kjd:APA91bHrbEmJRZy2Pac2OvI2C450YqQ6wQGrWZ7dEUF4pG6D880ZzpUPhH5DN8UotjQu3tUjiDDUlLzUUSMGVho6Gxz3gsrWwWPg0RMziHP6W7t-pdpfLf_V8pHralGZ4bNeMqC4ON5p', '2023-12-10 03:22:54', '2023-12-10 03:22:54'),
(4, '6oobMN5aZUr29rMW7JRMBhbmFwCfDwQYxN9EkpjoQ0EoKa0GgJcHTk8wvhO2b1G_GUiwbX4HY8p2Nu2cIswZyF0ao3jHfhsuVVt', '2023-12-10 03:39:23', '2023-12-10 03:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(3, 'Sakura', 'sakura@gmail.com', 'Demo Follow-Up and Next Steps', 'Hi [Recipient\'s Name],\r\n\r\nI hope this message finds you well. I am reaching out to inquire about Sakura flowers for an upcoming event. Could you please provide information on availability, pricing, and any other relevant details?\r\n\r\nThank you for your time, and I look forward to hearing from you soon.\r\n\r\nBest regards,\r\n\r\n[Your Name]\r\n[Your Contact Information]', '2024-01-17 03:10:02', '2024-01-17 03:10:02'),
(4, 'Abu Motaleb', 'abumotaleb1111@gmail.com', 'Inquiry Regarding Student Visa Application', 'Dear Chairman Thompson,\r\n\r\nI trust this email finds you well. My name is Motaleb, and I am writing to express my sincere interest in applying for a student visa to pursue my education at Stanford University. Having extensively researched the academic programs and esteemed faculty at your university, I am confident that it is the ideal institution for my higher education goals.\r\n\r\nAllow me to provide you with a brief overview of my academic background and aspirations:\r\n\r\nName: Motaleb\r\nEmail: abumotaleb111@gmail.com\r\nI have completed my Bachelor\'s degree in Computer Science from the University of [Your Current University], and I am eager to further my studies in Computer Science at Stanford University. The reputation of Stanford University for providing a world-class education and fostering a diverse and innovative learning environment aligns perfectly with my academic and career objectives.\r\n\r\nI kindly request guidance on the application process, required documentation, and any specific criteria I need to fulfill to ensure a successful application for a student visa. Additionally, if there are any upcoming information sessions, webinars, or events related to international student admissions, I would greatly appreciate being informed.\r\n\r\nThank you for considering my inquiry. I am enthusiastic about the prospect of joining Stanford University and contributing to its vibrant academic community. I am eager to comply with all necessary procedures and requirements promptly.\r\n\r\nI look forward to your guidance and appreciate your time and attention to my inquiry. Please let me know if there is any additional information or documentation needed from my end.\r\n\r\nThank you once again for your assistance.\r\n\r\nBest regards,\r\n\r\nMotaleb\r\n[Your Contact Information]\r\n[Your Current Location]', '2024-01-17 04:17:33', '2024-01-17 04:17:33'),
(6, 'Facebook', 'admin@gmail.com', 'dddd', 'Message', '2024-01-17 04:23:49', '2024-01-17 04:23:49'),
(7, 'Abu Motaleb', 'admin@gmail.com', 'This is a test subject', 'Hello', '2024-01-21 03:18:17', '2024-01-21 03:18:17'),
(8, 'Mridul Sarkar', 'mridulsarkar@gmail.com', 'Test subject', 'I\'m Mridul Sarkar.', '2024-01-24 02:22:24', '2024-01-24 02:22:24');

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
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_version` varchar(255) DEFAULT NULL,
  `zoom_control` int(11) DEFAULT NULL,
  `about_us_url` varchar(255) DEFAULT NULL,
  `contact_us_url` varchar(255) DEFAULT NULL,
  `privacy_policy_url` varchar(255) DEFAULT NULL,
  `terms_and_condition_url` varchar(255) DEFAULT NULL,
  `rate_us_url` varchar(255) DEFAULT NULL,
  `one_single` varchar(255) DEFAULT NULL,
  `privacy_policy` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `app_version`, `zoom_control`, `about_us_url`, `contact_us_url`, `privacy_policy_url`, `terms_and_condition_url`, `rate_us_url`, `one_single`, `privacy_policy`, `created_at`, `updated_at`) VALUES
(1, '1.1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p><strong>News Paper</strong> website is an online platform that provides news and information about various topics, including current events, entertainment, politics, sports, technology, and more.</p>', '2023-12-06 22:53:49', '2023-12-24 23:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `flag` text NOT NULL,
  `is_rtl` tinyint(4) DEFAULT NULL COMMENT '0: No (LTR), 1: Yes (RTL)',
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `display_name`, `code`, `flag`, `is_rtl`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Arabic', 'عربي', 'ar', 'backend/uploads/images/1700461691_ar.jpg', NULL, 0, '2023-11-19 18:28:11', '2023-11-21 05:06:41'),
(7, 'Hindi', 'हिंदी', 'hi', 'backend/uploads/images/1700461712_hi.jpg', 1, 0, '2023-11-19 18:28:32', '2023-11-19 18:28:32'),
(8, 'English', 'English', 'en', 'backend/uploads/images/1700461732_en.jpg', 1, 0, '2023-11-19 18:28:52', '2023-11-21 23:36:36'),
(9, 'Bengali', 'বাংলা', 'bn', 'backend/uploads/images/1700633963_NationalFlag.jpg', 1, 0, '2023-11-22 00:19:23', '2023-11-22 00:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `live_streams`
--

CREATE TABLE `live_streams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content_type` int(11) NOT NULL COMMENT '2: video (youtube), 3: video (other url)',
  `url` text NOT NULL,
  `image` text NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(3, 'Dhaka', 23.810331, 90.412521, '2023-11-26 23:27:51', '2023-11-26 23:27:51'),
(4, 'Thailand', 15.87, 100.9925, '2023-11-27 03:44:13', '2023-11-27 03:44:13'),
(5, 'Dubail', 25.2048, 55.2708, '2023-11-27 03:57:15', '2023-11-27 03:57:15'),
(6, 'America', 37.0902, 95.7129, '2023-11-27 03:59:55', '2023-11-27 03:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `mail_configurations`
--

CREATE TABLE `mail_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_host` varchar(255) NOT NULL,
  `mail_port` int(11) NOT NULL,
  `mail_username` varchar(255) NOT NULL,
  `mail_password` varchar(255) NOT NULL,
  `mail_encryption` varchar(255) NOT NULL,
  `mail_from_address` varchar(255) NOT NULL,
  `support_email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_configurations`
--

INSERT INTO `mail_configurations` (`id`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from_address`, `support_email`, `created_at`, `updated_at`) VALUES
(1, 'smtp.gmail.com', 465, 'dbugst.office02@gmail.com', 'asqfnmjovlbrenvt', 'ssl', 'dbugst.office02@gmail.com', 'support.me@gmail.com', '2024-01-23 12:18:46', '2024-01-23 23:48:37');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_19_091235_create_languages_table', 1),
(8, '2023_11_21_065201_create_live_streams_table', 1),
(9, '2023_11_21_100936_create_categories_table', 2),
(10, '2023_11_21_112604_create_tags_table', 3),
(12, '2023_11_22_103336_create_locations_table', 4),
(23, '2023_11_19_063643_create_admins_table', 8),
(26, '2023_12_07_081422_create_notification_settings_table', 10),
(29, '2023_12_10_084228_create_device_tokens_table', 13),
(30, '2023_12_10_095532_create_notifications_table', 14),
(32, '2014_10_12_000000_create_users_table', 15),
(36, '2023_12_13_103424_create_news_favorites_table', 16),
(38, '2023_12_13_112238_create_slider_favorites_table', 17),
(42, '2023_12_07_091914_create_advertisements_table', 19),
(45, '2024_01_17_051421_create_social_configurations_table', 21),
(46, '2024_01_17_080621_create_contact_configurations_table', 22),
(47, '2024_01_17_084345_create_emails_table', 23),
(48, '2024_01_17_113106_create_ads_table', 24),
(51, '2024_01_21_052101_create_pages_table', 25),
(54, '2024_01_22_054212_create_comments_table', 27),
(58, '2024_01_23_115738_create_mail_configurations_table', 29),
(59, '2024_01_23_052244_create_reels_table', 30),
(62, '2024_01_25_074332_create_surveys_table', 31),
(63, '2024_01_25_074347_create_options_table', 31),
(65, '2023_11_20_080516_create_breaking_news_table', 32),
(66, '2024_01_16_101442_create_web_configurations_table', 32),
(67, '2023_11_22_111915_create_news_table', 33),
(68, '2023_12_06_061318_create_sliders_table', 33),
(69, '2023_12_07_104228_create_general_settings_table', 33);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `content_type` int(11) NOT NULL COMMENT '1: standard post, 2: video (youtube), 3: video (other url), 4: video (upload)',
  `youtube_url` text DEFAULT NULL,
  `other_url` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `featured_image` text NOT NULL,
  `gallery_images` text NOT NULL,
  `description` longtext NOT NULL,
  `show_till` text NOT NULL,
  `notify_users` int(11) DEFAULT 0 COMMENT '0: false, 1: true',
  `favorite_count` int(11) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `language_id`, `category_id`, `title`, `tags`, `location_id`, `content_type`, `youtube_url`, `other_url`, `video`, `featured_image`, `gallery_images`, `description`, `show_till`, `notify_users`, `favorite_count`, `total_views`, `status`, `created_at`, `updated_at`) VALUES
(4, 8, 11, 'Modern building in an aerial shot at dusk', '[\"Travel\",\"Building\",\"Apartment\",\"Hotel\"]', 4, 2, 'https://youtu.be/uijFo32c0zM', 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4', NULL, 'backend/uploads/news-images/1701078514_ThaiBuilding.jpg', '[\"backend\\/uploads\\/news-images\\/1701078514_656465f241868_ThaiBuilding.jpg\",\"backend\\/uploads\\/news-images\\/1701078514_656465f241dc0_ThaiBuilding2.jpg\"]', '<p>Big city of modern and big skyscrapers in a panoramic view from high in the air, during the dusk, with a lot of movement in its streets.</p>', '2023-11-30', 0, 79, 2, 0, '2024-01-21 09:48:34', '2024-02-05 06:15:43'),
(5, 8, 12, 'Basketball player dribbling ball', '[\"Sports\",\"Volleyball\",\"Volley\"]', 6, 1, NULL, NULL, NULL, 'backend/uploads/news-images/1701079494_volleyball2.jpg', '[\"backend\\/uploads\\/news-images\\/1701079494_656469c67c7f7_volleyball.jpg\",\"backend\\/uploads\\/news-images\\/1701079494_656469c67ceaf_volleyball2.jpg\"]', '<p>A person wearing black basketball sneakers and black and white basketball shorts dribbles a basketball in between his widespread legs.</p>', '2023-11-30', 1, 4, 3, 0, '2023-11-26 10:04:54', '2024-01-28 21:56:42'),
(6, 8, 12, 'Close shot of a soccer player shooting a penalty', '[\"Football\",\"Sports\",\"Soccer\",\"Messi\",\"Nike\"]', 5, 1, NULL, NULL, NULL, 'backend/uploads/news-images/1701079899_football.jpg', '[\"backend\\/uploads\\/news-images\\/1701079899_65646b5bafb10_football.jpg\",\"backend\\/uploads\\/news-images\\/1701079899_65646b5bb053b_football2.jpg\",\"backend\\/uploads\\/news-images\\/1701079899_65646b5bb117d_football3.jpg\",\"backend\\/uploads\\/news-images\\/1701079899_65646b5bb1a82_football4.jpg\"]', '<p>Close up shot of a soccer ball as a player kicks a penalty kick hard, during a semi-professional match at night. Close up shot of a soccer ball as a player kicks a penalty kick hard, during a semi-professional match at night.</p>', '2023-12-31', 0, 0, 0, 0, '2023-11-26 10:11:39', '2023-11-26 10:11:39'),
(7, 8, 13, 'Donuts with various types of icing in a close up shot', '[\"Taste\"]', 3, 2, 'https://youtu.be/7kMzofW7TH4', NULL, NULL, 'backend/uploads/news-images/1701080407_d2.jpg', '[\"backend\\/uploads\\/news-images\\/1701080407_65646d57382aa_d1.jpg\",\"backend\\/uploads\\/news-images\\/1701080407_65646d573871a_d2.jpg\"]', '<p>Donuts with various types of icing, chocolate, walnut and colored sprinkles, in a close up shot, placed on a small rack, on a pink background.</p>', '2023-12-19', 0, 2, 7, 0, '2024-01-03 10:20:07', '2024-02-06 23:46:31'),
(8, 8, 11, 'Paradise port on an island', '[\"Travel\",\"Hotel\"]', 6, 1, NULL, NULL, NULL, 'backend/uploads/news-images/1701081661_travel1.jpg', '[\"backend\\/uploads\\/news-images\\/1701081661_6564723d53097_travel1.jpg\",\"backend\\/uploads\\/news-images\\/1701081661_6564723d53762_travel2.jpg\"]', '<p>A port with a water plane arriving, boats anchored on a small island of white sand and turquoise blue sea. A port with a water plane arriving, boats anchored on a small island of white sand and turquoise blue sea.</p>', '2023-11-30', 1, 15, 0, 0, '2023-11-26 10:41:01', '2024-01-17 23:28:04'),
(9, 8, 16, '12th parliamentary polls: IGP’s brother Chowdhury Abdullah Al Mahmud gets AL nomination', '[\"Elections\",\"PoliticalParties\"]', 3, 1, NULL, NULL, NULL, 'backend/uploads/news-images/1701082047_mahmub.jpg', '[\"backend\\/uploads\\/news-images\\/1701082047_656473bf3f19f_Awami_League.jpg\",\"backend\\/uploads\\/news-images\\/1701082047_656473bf3f6f5_mahmub.jpg\"]', '<p>Inspector General of Police (IGP) Chowdhury Abdullah Al-Mamun’s younger brother Chowdhury Abdullah Al Mahmud has got nominated as governing Awami League candidate for Sunamganj-2 (Derai-Shalla) constituency for the upcoming general election.</p><p>AL general secretary Obaidul Quader unveiled the names of the candidates at the party’s central office on Sunday afternoon.</p><p>Late Suranjit Sen Gupta was an a member of parliament from Sunamganj-2. Following his death, Suranjit’s wife Jaya Sengupta became MP from this seat.</p><p>Now Abdullah Al Mahmud has got the ruling party\'s ticket from this constituency. He earlier left Shalla upazila chairman post to get the party nomination. Since then, his name created a buzz in the district’s political arena.</p>', '2023-11-25', 0, 34, 5, 0, '2023-11-26 10:47:27', '2024-01-30 23:49:37'),
(10, 8, 11, 'Chicago City at late afternoon', '[\"Travel\",\"Chicago\"]', 6, 2, 'https://youtu.be/tCVIahSgsi8', NULL, NULL, 'backend/uploads/news-images/1701082471_Chicago.jpg', '[\"backend\\/uploads\\/news-images\\/1701082471_65647567bae68_Chicago.jpg\",\"backend\\/uploads\\/news-images\\/1701082471_65647567bb33e_Chicago2.jpg\"]', '<p>A port with a water plane arriving, boats anchored on a small island of white sand and turquoise blue sea. A port with a water plane arriving, boats anchored on a small island of white sand and turquoise blue sea. A port with a water plane arriving, boats anchored on a small island of white sand and turquoise blue sea.<br />\r\nA port with a water plane arriving, boats anchored on a small island of white sand and turquoise blue sea.</p>', '2023-11-30', 1, 75, 3, 0, '2023-11-26 10:54:31', '2024-02-06 23:40:39'),
(11, 8, 12, 'Liverpool maintained their lead at the top of the Premier League with', '[\"Building\"]', 3, 2, 'https://youtu.be/307HgUmFvHQ', NULL, NULL, 'backend/uploads/news-images/1706792192_pexels-element-digital-1550337.jpg', '[\"backend\\/uploads\\/news-images\\/1706792192_65bb95004290d_pexels-pawan-yadav-2577274.jpg\"]', '<p>The two teams meet again at Wembley on 25 February and Pochettino admitted <a href=\"https://www.theguardian.com/football/chelsea\">Chelsea</a> will suffer unless there is a vast improvement in their attitude and performance level. &ldquo;The performance wasn&rsquo;t good from us,&rdquo; said the Chelsea manager, who has presided over six Premier League away defeats this season.</p>\r\n\r\n<p>&ldquo;If we want to match them and compete with them in the final then we have to compete in a different way. They were more aggressive than us. They were better than us in all areas.</p>', '2024-02-01', 0, 0, 0, 0, '2024-02-01 00:56:32', '2024-02-06 23:42:03'),
(12, 8, 13, 'EU Commission asked to clarify scope of Strategic', '[\"Taste\"]', 4, 3, 'https://youtu.be/uefbPWAu1Wc', 'https://storage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4', NULL, 'backend/uploads/news-images/1706792888_pexels-malidate-van-769289.jpg', '[\"backend\\/uploads\\/news-images\\/1706792888_65bb97b86a0dd_pexels-malidate-van-769289.jpg\"]', '<p>The local agriculture office, however, currently does not have sufficient data about the potential market for the fruit.</p>\r\n\r\n<p>In addition to red guava, farmers have been cultivating several other fruits such as white guava and mango in more than 300 gardens in the hills of Barabkunda for years. The gardens are visible from both sides of the winding hilly road that goes east of Barbakunda Bazar from the Dhaka-Chattogram highway.</p>', '2024-02-01', 0, 0, 0, 0, '2024-02-01 01:08:08', '2024-02-06 23:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `news_favorites`
--

CREATE TABLE `news_favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_favorites`
--

INSERT INTO `news_favorites` (`id`, `user_id`, `news_id`, `created_at`, `updated_at`) VALUES
(2, 8, 7, '2023-12-13 05:14:18', '2023-12-13 05:14:18'),
(5, 12, 4, '2023-12-13 05:19:44', '2023-12-13 05:19:44'),
(6, 12, 7, '2023-12-13 05:20:04', '2023-12-13 05:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `url`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'This is test notification title', '<p>This is test notification message</p>', '', '', '2023-12-10 04:09:13', '2023-12-10 04:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fcm_server_key` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_settings`
--

INSERT INTO `notification_settings` (`id`, `fcm_server_key`, `created_at`, `updated_at`) VALUES
(1, 'AAAA_Nk07a0:APA91bHzME8bylwrhQ8YfTq3KN_WieLXPNMIzdgcObB0kKGUofxVcY9xsitoKT9Z_oxEUIs0ZoV0zI7h8NsCn9EiA5yJrdzuTCceK0SMQhTa8a5IVhjG4unnUhwhgcyT9QjfEjKRzWea', '2023-12-07 08:35:36', '2023-12-07 03:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_id` bigint(20) UNSIGNED NOT NULL,
  `option` varchar(255) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `survey_id`, `option`, `counter`, `created_at`, `updated_at`) VALUES
(2, 2, 'Black', 5, '2024-01-27 23:42:41', '2024-01-29 04:37:54'),
(3, 2, 'Red', 0, '2024-01-27 23:42:41', '2024-01-27 23:42:41'),
(4, 2, 'Blue', 10, '2024-01-27 23:42:41', '2024-01-28 00:19:27'),
(5, 2, 'Yellow', 1, '2024-01-27 23:43:03', '2024-01-27 23:44:10'),
(7, 3, 'Pizza', 0, '2024-01-31 03:31:15', '2024-01-31 03:33:02'),
(8, 3, 'Burger', 0, '2024-01-31 03:31:15', '2024-01-31 03:31:15'),
(9, 3, 'Ice Cream', 0, '2024-01-31 03:31:15', '2024-01-31 03:31:15'),
(10, 3, 'Chicken', 0, '2024-01-31 03:33:11', '2024-01-31 03:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `icon` text NOT NULL,
  `page_content` text NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `meta_description`, `meta_keywords`, `icon`, `page_content`, `language_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Privacy Policy', 'privacy-policy', 'Privacy Policy', 'policy', 'backend/uploads/page-icons/1705818402_1672121367.4083.png', '<p><strong>NEWS APP PRIVACY AND POLICY</strong></p><p>This page is used to inform visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service.</p><p>If you choose to use our Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that we collect is used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</p><p>The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at Infinity news app unless otherwise defined in this Privacy Policy.</p><p><strong>Information Collection and Use</strong></p><p>For a better experience, while using our Service, we may require you to provide us with certain personally identifiable information. The information that we request will be retained by us and used as described in this privacy policy.</p><p>The app does use third party services that may collect information used to identify you.</p>', 8, 0, '2024-01-21 00:26:42', '2024-01-21 00:26:59'),
(3, 'Terms & Conditions', 'terms-conditions', 'Terms & Conditions', 'terms', 'backend/uploads/page-icons/1705818504_1672122059.9894.png', '<p><strong>Terms &amp; Conditions</strong></p><p>Don\'t misuse our Services. You may use our Services only as permitted by law, including applicable export and re-export control laws and regulations. We may suspend or stop providing our Services to you if you do not comply with our terms or policies or if we are investigating suspected misconduct.</p>', 8, 0, '2024-01-21 00:28:24', '2024-01-21 00:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(119, 'App\\Models\\User', 15, 'user_token', '9184f1b697b994bd038bcbc0b9f46c952c84dfa01f438d1086ae85f9b1b73f8b', '[\"*\"]', '2024-01-21 03:13:55', NULL, '2024-01-21 02:50:00', '2024-01-21 03:13:55'),
(126, 'App\\Models\\User', 13, 'user_token', '968a143dbf3fbea69ba2264dc2b341435c0836828db34ed215f0b2e0e524586f', '[\"*\"]', NULL, NULL, '2024-01-28 04:50:46', '2024-01-28 04:50:46'),
(127, 'App\\Models\\User', 13, 'user_token', '200a95f6e56520aee8ff41666409054a0c8874394f9114f930877ae81d207651', '[\"*\"]', '2024-01-28 05:17:56', NULL, '2024-01-28 04:50:50', '2024-01-28 05:17:56'),
(128, 'App\\Models\\User', 16, 'user_token', '5880d2c05d27b07912be735f3270e880179c0ab1b3c08aa6f261dc2e0bdb74cc', '[\"*\"]', '2024-01-28 05:17:04', NULL, '2024-01-28 05:16:17', '2024-01-28 05:17:04'),
(129, 'App\\Models\\User', 17, 'user_token', '867f7520699695f08ad9a8f8d782245a3dead0d39b10cf7b8ddd0e99aa325b60', '[\"*\"]', NULL, NULL, '2024-01-28 05:37:23', '2024-01-28 05:37:23'),
(130, 'App\\Models\\User', 17, 'user_token', '4fc6e57d0976fb5c6cb1ea63b277d3cbd8886385fee3ae0582e73a3a69f76863', '[\"*\"]', '2024-01-28 05:57:17', NULL, '2024-01-28 05:37:47', '2024-01-28 05:57:17'),
(131, 'App\\Models\\User', 18, 'user_token', '0c123ee29cb33e5f6dccac222c43a6a8660b97c68eba7f557c359a013df8d6e6', '[\"*\"]', '2024-01-28 05:59:15', NULL, '2024-01-28 05:59:10', '2024-01-28 05:59:15'),
(132, 'App\\Models\\User', 19, 'user_token', '62ddccc89c33e0851c2664e0ae1e0a308b72cf90f4075d8ecf705b79c4744459', '[\"*\"]', '2024-01-28 06:03:58', NULL, '2024-01-28 06:00:15', '2024-01-28 06:03:58'),
(133, 'App\\Models\\User', 20, 'user_token', '4426af66b6d03bf78e2daa0ab36166d57435a0be45bb8bb4df588c478631566b', '[\"*\"]', '2024-01-28 06:05:41', NULL, '2024-01-28 06:04:39', '2024-01-28 06:05:41'),
(136, 'App\\Models\\User', 13, 'user_token', 'b84fe19ba54d960c27cf64987f79713795f4025b6af590dcbf6a41beabc0fb91', '[\"*\"]', NULL, NULL, '2024-02-05 02:22:30', '2024-02-05 02:22:30'),
(137, 'App\\Models\\User', 21, 'user_token', 'bb8e6f770a87c3b6125a1536ec056bc5fd61139dcb4caa21e8d420fa25aa7955', '[\"*\"]', NULL, NULL, '2024-02-05 02:42:38', '2024-02-05 02:42:38'),
(138, 'App\\Models\\User', 9, 'user_token', '249c606929a69dde25ff882c78473ed9dbf826ac7276e1cde0b9a6ff13ae45e3', '[\"*\"]', '2024-02-06 23:10:41', NULL, '2024-02-06 22:58:32', '2024-02-06 23:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `reels`
--

CREATE TABLE `reels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content_type` int(11) NOT NULL COMMENT '2: video (youtube), 3: video (other url), 4: video (upload)',
  `youtube_url` text DEFAULT NULL,
  `other_url` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `favorite_count` int(11) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reels`
--

INSERT INTO `reels` (`id`, `title`, `content_type`, `youtube_url`, `other_url`, `video`, `language_id`, `image`, `description`, `favorite_count`, `total_views`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Literary Odyssey: Pages Unbound', 4, NULL, NULL, 'backend/uploads/reels-videos/1705995581_video_inside_a_library (360p).mp4', 8, 'backend/uploads/reels-images/1705995581_pexels-pixabay-159711.jpg', '<p>Embark on a diverse literary adventure, where words weave tales, emotions unfold, and books become windows to endless worlds.</p>', 0, 0, 0, '2024-01-22 19:39:41', '2024-01-22 19:39:41'),
(14, 'Read and Thrive: A Bookish Journey', 4, NULL, NULL, 'backend/uploads/reels-videos/1705995612_pexels-tima-miroshnichenko-6550654 (360p).mp4', 8, 'backend/uploads/reels-images/1705995612_pexels-thought-catalog-904616.jpg', '<p>Explore the transformative power of reading, where each book becomes a passport to new worlds, ideas, and personal growth.</p>', 0, 0, 0, '2024-01-22 19:40:12', '2024-01-22 19:40:12'),
(15, 'Peach Open', 3, NULL, 'https://storage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4', NULL, 8, 'backend/uploads/reels-images/1707285860_peachOpen.JPG', '<p>The first Blender Open Movie from 2006</p>', 0, 0, 0, '2024-02-07 00:04:20', '2024-02-07 00:04:20'),
(16, 'For Bigger Meltdowns', 3, NULL, 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4', NULL, 8, 'backend/uploads/reels-images/1707286043_Capture.JPG', '<p>Introducing Chromecast. The easiest way to enjoy online video and music on your TV—for when you want to make Buster\'s big meltdowns even bigger. For $35. Learn how to use Chromecast with Netflix and more at google.com/chromecast.</p>', 0, 0, 0, '2024-02-07 00:07:23', '2024-02-07 00:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content_type` int(11) NOT NULL COMMENT '1: standard post, 2: video (youtube), 3: video (other url), 4: video (upload)',
  `youtube_url` text DEFAULT NULL,
  `other_url` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `image` text NOT NULL,
  `description` longtext NOT NULL,
  `favorite_count` int(11) NOT NULL DEFAULT 0,
  `total_views` int(11) NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `language_id`, `category_id`, `title`, `content_type`, `youtube_url`, `other_url`, `video`, `image`, `description`, `favorite_count`, `total_views`, `status`, `created_at`, `updated_at`) VALUES
(3, 8, 16, 'Biden administration poised to allow Israeli citizens to travel to the US without a US visa', 1, NULL, NULL, NULL, 'backend/uploads/slider-images/1701846010_prothomalo-english_2023-09_cdf3c17c-9130-4d03-b6eb-c2abec3cbdbb_1695612985_unb_newswire.jpg', '<p>The Biden administration is poised to admit Israel this week into an exclusive club that will allow its citizens to travel to the United States without a US visa despite Washington\'s ongoing concerns about the Israeli government’s treatment of Palestinian Americans.&nbsp;</p><p>US officials say an announcement of Israel’s entry into the Visa Waiver Program is planned for late in the week, just before the end of the federal budget year on Saturday, which is the deadline for Israel’s admission without having to requalify for eligibility next year.&nbsp;</p><p>The Department of Homeland Security administers the program, which currently allows citizens of 40 mostly European and Asian countries to travel to the US for three months without visas.&nbsp;</p><p>Homeland Security Secretary Alejandro Mayorkas is set to make the announcement Thursday, shortly after receiving a recommendation from Secretary of State Antony Blinken that Israel be admitted, according to five officials familiar with the matter who spoke Sunday on condition of anonymity because the decision has not yet been publicly announced.&nbsp;</p>', 0, 0, 0, '2023-12-05 13:00:10', '2023-12-05 13:00:10'),
(4, 8, 11, 'Travelling far from home good for health', 1, NULL, NULL, NULL, 'backend/uploads/slider-images/1701846105_prothomalo-english_2023-08_c962503f-9750-433d-9c2e-0598209a527c_man_1850181_1280.jpg', '<p>The frequency with which people travel and the variety of places visited are important factors, with those who travel more than 15 miles away from home more likely to report being in general good health.</p>\r\n\r\n<p>Those who visit a wider range of locations are more likely to see friends and family. This increase in social participation is then associated with improved health.</p>\r\n\r\n<p>According to a study led by UCL researchers, people who travel beyond the region of their localities feel healthier than those who remain closer to their homes.</p>\r\n\r\n<p>Researchers say the results provide strong evidence of the need for investment in medium and long-distance transport options, such as better-serviced roads and access to trains and buses.</p>', 0, 0, 0, '2023-12-05 13:01:45', '2024-02-06 23:15:21'),
(7, 8, 12, 'Bangladesh 80-4 at lunch after New Zealand spinners strike early', 1, NULL, NULL, NULL, 'backend/uploads/slider-images/1701846337_prothomalo-english_2023-12_9ce5e0de-c799-432b-a3c3-497ba279e636_074942_01_02.jpg', '<p>New Zealand spinners Mitchell Santner and Ajaz Patel took two wickets each to reduce&nbsp;Bangladesh&nbsp;to 80-4 at lunch on the first day of the second and final Test in Dhaka on Wednesday.</p>\r\n\r\n<p>Mushfiqur Rahim (18) and Shahadat Hossain (14) were at the crease at Sher-e-Bangla National Stadium as the hosts attempted to rebuild from a poor start.</p>\r\n\r\n<p>Bangladesh, who are chasing a first-ever Test series win over the Black Caps and lead 1-0, won the toss and elected to bat.</p>\r\n\r\n<p>Zakir Hasan and Mahmudul Hasan put on 29 runs in the opening stand before&nbsp;Bangladesh&nbsp;lost four wickets for 18 runs to be reduced to a dismal 47-4.</p>', 0, 0, 0, '2023-12-05 13:05:37', '2024-02-06 23:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `slider_favorites`
--

CREATE TABLE `slider_favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `slider_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_configurations`
--

CREATE TABLE `social_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_configurations`
--

INSERT INTO `social_configurations` (`id`, `name`, `icon`, `link`, `created_at`, `updated_at`) VALUES
(3, 'Facebook', 'backend/uploads/social-configuration/1705997565_icon-fb.png', 'facebook.com', '2024-01-17 01:45:22', '2024-01-23 02:12:45'),
(4, 'Twitter', 'backend/uploads/social-configuration/1705997572_icon-tw.png', 'twitter.com', '2024-01-17 01:45:47', '2024-01-23 02:12:52'),
(5, 'Github', 'backend/uploads/social-configuration/1705997595_icon-ins.png', 'instagram.com', '2024-01-17 01:46:12', '2024-01-23 02:13:15'),
(6, 'Youtube', 'backend/uploads/social-configuration/1705997613_icon-yo.png', 'https://github.com/abumotaleb99', '2024-01-23 02:13:33', '2024-01-23 02:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `language_id`, `question`, `status`, `created_at`, `updated_at`) VALUES
(2, 8, 'What is your favourite color?', 0, '2024-01-27 23:42:41', '2024-01-27 23:42:41'),
(3, 8, 'What is your favourite food?', 0, '2024-01-31 03:31:15', '2024-01-31 03:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `language_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Travel', 8, 0, '2023-11-21 05:42:28', '2023-11-21 05:42:28'),
(17, 'Building', 8, 0, '2023-11-27 03:37:37', '2023-11-27 03:37:37'),
(18, 'Apartment', 8, 0, '2023-11-27 03:38:02', '2023-11-27 03:38:02'),
(19, 'Hotel', 8, 0, '2023-11-27 03:38:11', '2023-11-27 03:38:11'),
(20, 'Football', 8, 0, '2023-11-27 03:55:16', '2023-11-27 03:55:16'),
(21, 'Sports', 8, 0, '2023-11-27 03:55:25', '2023-11-27 03:55:25'),
(22, 'Soccer', 8, 0, '2023-11-27 03:55:56', '2023-11-27 03:55:56'),
(23, 'Messi', 8, 0, '2023-11-27 03:56:27', '2023-11-27 03:56:27'),
(24, 'Nike', 8, 0, '2023-11-27 03:56:35', '2023-11-27 03:56:35'),
(25, 'Dubai', 8, 0, '2023-11-27 03:57:25', '2023-11-27 03:57:25'),
(26, 'Word Cup', 8, 0, '2023-11-27 03:57:36', '2023-11-27 03:57:36'),
(27, 'Volleyball', 8, 0, '2023-11-27 03:58:26', '2023-11-27 03:58:26'),
(28, 'Volley', 8, 0, '2023-11-27 03:58:49', '2023-11-27 03:58:49'),
(29, 'Spicy', 8, 0, '2023-11-27 04:14:05', '2023-11-27 04:14:05'),
(30, 'Taste', 8, 0, '2023-11-27 04:14:16', '2023-11-27 04:14:16'),
(31, 'রাজনীতি', 9, 0, '2023-11-27 04:29:07', '2023-11-27 04:29:07'),
(32, 'বাংলাদেশ', 9, 0, '2023-11-27 04:30:15', '2023-11-27 04:30:15'),
(33, 'নির্বাচন', 9, 0, '2023-11-27 04:30:31', '2023-11-27 04:30:31'),
(34, 'সরকার', 9, 0, '2023-11-27 04:30:44', '2023-11-27 04:30:44'),
(35, 'আইন', 9, 0, '2023-11-27 04:30:56', '2023-11-27 04:30:56'),
(36, 'সংঘবদ্ধ', 9, 0, '2023-11-27 04:31:06', '2023-11-27 04:31:06'),
(37, 'খেলা', 9, 0, '2023-11-27 04:32:02', '2023-11-27 04:32:02'),
(38, 'ফুটবল', 9, 0, '2023-11-27 04:32:12', '2023-11-27 04:32:12'),
(39, 'স্পোর্টস', 9, 0, '2023-11-27 04:32:22', '2023-11-27 04:32:22'),
(40, 'খেলাযোগ', 9, 0, '2023-11-27 04:32:34', '2023-11-27 04:32:34'),
(41, 'Island', 8, 0, '2023-11-27 04:40:01', '2023-11-27 04:40:01'),
(42, 'Government', 8, 0, '2023-11-27 04:42:37', '2023-11-27 04:42:37'),
(43, 'Elections', 8, 0, '2023-11-27 04:42:47', '2023-11-27 04:42:47'),
(44, 'PoliticalParties', 8, 0, '2023-11-27 04:43:04', '2023-11-27 04:43:04'),
(45, 'Chicago', 8, 0, '2023-11-27 04:52:09', '2023-11-27 04:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp_secret` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `profile_image` text DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `otp_secret`, `bio`, `country`, `profile_image`, `status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'motaleb', 'Abu Motaleb', 'abumotaleb1111@gmail.com', '$2y$12$Q5m2h2cJdXVCfn9J3CWi9u2/o4DkhgsuG6asGnKYVUl6QD/QEVIAu', '$2y$12$MZ9VbkJ3ZwBzPjhZsRgKEOG.lY2RTKi7tAYNmSZmds0JON.GzNi0a', 'This is motaleb bio', 'America', 'backend/uploads/user-images/1705813943_logo.png', 0, NULL, NULL, '2023-12-02 18:08:03', '2024-01-23 23:50:18'),
(9, 'bokul', 'Bokul Khan', 'bokul@gmail.com', '$2y$12$423ErFYzjYCtlU7b8J6zQu4W8jUgNC/ktGT6T0Y90cA2ZWyS.rmqy', '$2y$12$xMohmvuyi4AceH9lghr7L.WejI9kBP1pJHdEeytXJuI4pOEyh.Jhm', 'This is Bokul\'s bio', 'Bangladesh', 'backend/uploads/user-images/1707119037_remaining-token.png', 0, NULL, NULL, '2023-12-02 18:12:53', '2024-02-05 01:43:57'),
(10, 'Jesan', 'Dadu', 'stationdbug@gmail.com', '$2y$12$oMEfA.KIgZyZWphggvXdGOty6uR0XFJGx.AgCs.HAV6WsLKogB7kC', '$2y$12$Osu5qllLF9mxH8ZbNVx3dO8hPViCoLTojzauG96Oe7uaZtfxyW432', 'This is dadu\'s bio', 'Bangladesh', 'backend/uploads/user-images/1702372614_default-150x150.png', 0, NULL, NULL, '2023-12-09 23:38:04', '2024-01-23 23:49:39'),
(11, 'a', 'b', 'aa@gmail.com', '$2y$12$Mqrp27exPn.hFdZV2hj27.9RyWBtK0rjl.5JepoDdZR2hhNY2UsEi', NULL, 'd', 'c', NULL, 0, NULL, 'RbeULDhLNKv0501oVDkJNog9z209NZ3NSvswNznU5T3hg8OUnRorNSpeUEyZ', '2023-12-09 23:20:44', '2024-01-20 23:03:47'),
(12, 'mridul', 'Mridul', 'dbugsta.store003@gmail.com', '$2y$12$Xs7GhAEkgH47PbuzGHhd3.aS79mkhp/uZ8lPsUQ6wv79.KO.aX4fO', '', 'This is mridul\'s bio', 'Bangladesh', NULL, 0, NULL, NULL, '2023-12-11 01:29:52', '2023-12-11 01:41:50');

-- --------------------------------------------------------

--
-- Table structure for table `web_configurations`
--

CREATE TABLE `web_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `frontend_api_base_url` varchar(255) NOT NULL,
  `web_app_name` varchar(255) NOT NULL,
  `nav_text_color` varchar(255) NOT NULL,
  `web_color` varchar(255) NOT NULL,
  `header_logo` text NOT NULL,
  `footer_logo` text NOT NULL,
  `header_contact` varchar(255) NOT NULL,
  `footer_contact` varchar(255) NOT NULL,
  `google_play_app_logo` text NOT NULL,
  `google_play_app_link` varchar(255) NOT NULL,
  `app_store_logo` text NOT NULL,
  `app_store_link` varchar(255) NOT NULL,
  `footer_description` text NOT NULL,
  `footer_address` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_configurations`
--

INSERT INTO `web_configurations` (`id`, `frontend_api_base_url`, `web_app_name`, `nav_text_color`, `web_color`, `header_logo`, `footer_logo`, `header_contact`, `footer_contact`, `google_play_app_logo`, `google_play_app_link`, `app_store_logo`, `app_store_link`, `footer_description`, `footer_address`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 'http://localhost/newsappflutteradminpanel', 'News App', '#0c0c0e', '#ffffff', 'backend/uploads/web-configuration/1706076863_logo.png', 'backend/uploads/web-configuration/1706076863_logo.png', '+880100 000 000', '+95 (0) 123 456 789 Cell: +95 (0) 123 456 789', 'backend/uploads/web-configuration/1706006057_google-play.png', 'https://github.com/abumotaleb99', 'backend/uploads/web-configuration/1706006065_app-store.png', 'https://github.com/abumotaleb99', 'The newspaper app delivers concise and personalized news updates, ensuring users stay informed with ease and efficiency.', '198 West 21th Street, Suite 721 New York,NY 10010', 'Copyright © 2024 All rights reserved | D-bug Station Limited', '2024-01-14 11:09:48', '2024-02-04 23:28:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breaking_news`
--
ALTER TABLE `breaking_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `breaking_news_news_id_foreign` (`news_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_language_id_foreign` (`language_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_slider_id_foreign` (`slider_id`),
  ADD KEY `comments_news_id_foreign` (`news_id`);

--
-- Indexes for table `contact_configurations`
--
ALTER TABLE `contact_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_streams`
--
ALTER TABLE `live_streams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `live_streams_language_id_foreign` (`language_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_configurations`
--
ALTER TABLE `mail_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_language_id_foreign` (`language_id`),
  ADD KEY `news_category_id_foreign` (`category_id`),
  ADD KEY `news_location_id_foreign` (`location_id`);

--
-- Indexes for table `news_favorites`
--
ALTER TABLE `news_favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_favorites_user_id_foreign` (`user_id`),
  ADD KEY `news_favorites_news_id_foreign` (`news_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_survey_id_foreign` (`survey_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_language_id_foreign` (`language_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reels`
--
ALTER TABLE `reels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reels_language_id_foreign` (`language_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_language_id_foreign` (`language_id`),
  ADD KEY `sliders_category_id_foreign` (`category_id`);

--
-- Indexes for table `slider_favorites`
--
ALTER TABLE `slider_favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slider_favorites_user_id_foreign` (`user_id`),
  ADD KEY `slider_favorites_slider_id_foreign` (`slider_id`);

--
-- Indexes for table `social_configurations`
--
ALTER TABLE `social_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surveys_language_id_foreign` (`language_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_language_id_foreign` (`language_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_name_unique` (`name`);

--
-- Indexes for table `web_configurations`
--
ALTER TABLE `web_configurations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `breaking_news`
--
ALTER TABLE `breaking_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_configurations`
--
ALTER TABLE `contact_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `live_streams`
--
ALTER TABLE `live_streams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mail_configurations`
--
ALTER TABLE `mail_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news_favorites`
--
ALTER TABLE `news_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `reels`
--
ALTER TABLE `reels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slider_favorites`
--
ALTER TABLE `slider_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_configurations`
--
ALTER TABLE `social_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `web_configurations`
--
ALTER TABLE `web_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `breaking_news`
--
ALTER TABLE `breaking_news`
  ADD CONSTRAINT `breaking_news_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `comments_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `live_streams`
--
ALTER TABLE `live_streams`
  ADD CONSTRAINT `live_streams_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `news_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `news_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `news_favorites`
--
ALTER TABLE `news_favorites`
  ADD CONSTRAINT `news_favorites_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `news_favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `reels`
--
ALTER TABLE `reels`
  ADD CONSTRAINT `reels_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `sliders_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `slider_favorites`
--
ALTER TABLE `slider_favorites`
  ADD CONSTRAINT `slider_favorites_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`),
  ADD CONSTRAINT `slider_favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
