-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2020 at 11:58 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `title` mediumtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `post_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `description`, `image`, `post_status`, `created_at`) VALUES
(8, 4, 'কুয়েতে আটক সাংসদ পাপুলের বিরুদ্ধে ১১ জন সাক্ষ্য দিয়েছেন', 'মানব পাচার ও অবৈধ মুদ্রা পাচারের অভিযোগে আটক বাংলাদেশের সাংসদ কাজী শহিদ ইসলাম ওরফে পাপুলকে রোববার পর্যন্ত রিমান্ডে রাখার নির্দেশ দিয়েছে কুয়েতের পাবলিক প্রসিকিউটর। গত শনিবার কুয়েতের মাশরিফ এলাকায় বাংলাদেশের সাংসদকে নিজের বাসা থেকে আটক করে দেশটির সিআইডি (ক্রিমিনাল ইনভেষ্টিগেশন ডিপার্টমেন্ট)।\r\n\r\nআজ শুক্রবার কুয়েতের গণমাধ্যম ও কূটনৈতিক সূত্রে জানা গেছে, লক্ষীপুর-২ আসনের স্বতন্ত্র ওই সাংসদের অভিযোগের ব্যাপারে ১১ জনের সাক্ষ্য নেওয়া হয়েছে। ওই ১১ জনের সবাই সাংসদের বিরুদ্ধে মানব পাচারের অভিযোগ আনার পাশাপাশি প্রতি বছর ভিসা নবায়নের জন্য বাড়তি টাকা নেওয়ার অভিযোগ এনেছেন। কুয়েতের পাবলিক প্রসিকিউটর মানব ও অবৈধ মুদ্রা পাচারের অভিযোগের তদন্ত শেষ না হওয়া পর্যন্ত তাকে রোববার পর্যন্ত রিমান্ডে রাখার নির্দেশ দিয়েছে।', '96836117b918368b11abac81eff1e0b9-5ee3a65fb69d2.webp', 'Approved', '2020-06-12 17:23:14'),
(9, 4, 'কুয়েতে আটক সাংসদ পাপুলের বিরুদ্ধে ১১ জন সাক্ষ্য দিয়েছেন', 'মানব পাচার ও অবৈধ মুদ্রা পাচারের অভিযোগে আটক বাংলাদেশের সাংসদ কাজী শহিদ ইসলাম ওরফে পাপুলকে রোববার পর্যন্ত রিমান্ডে রাখার নির্দেশ দিয়েছে কুয়েতের পাবলিক প্রসিকিউটর। গত শনিবার কুয়েতের মাশরিফ এলাকায় বাংলাদেশের সাংসদকে নিজের বাসা থেকে আটক করে দেশটির সিআইডি (ক্রিমিনাল ইনভেষ্টিগেশন ডিপার্টমেন্ট)। আজ শুক্রবার কুয়েতের গণমাধ্যম ও কূটনৈতিক সূত্রে জানা গেছে, লক্ষীপুর-২ আসনের স্বতন্ত্র ওই সাংসদের অভিযোগের ব্যাপারে ১১ জনের সাক্ষ্য নেওয়া হয়েছে। ওই ১১ জনের সবাই সাংসদের বিরুদ্ধে মানব পাচারের অভিযোগ আনার পাশাপাশি প্রতি বছর ভিসা নবায়নের জন্য বাড়তি টাকা নেওয়ার অভিযোগ এনেছেন। কুয়েতের পাবলিক প্রসিকিউটর মানব ও অবৈধ মুদ্রা পাচারের অভিযোগের তদন্ত শেষ না হওয়া পর্যন্ত তাকে রোববার পর্যন্ত রিমান্ডে রাখার নির্দেশ দিয়েছে।', '9d0494481a8ed9e3b3c01a22f717bb05-5c976da81681b.webp', 'Approved', '2020-06-12 20:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `ps_status`
--

CREATE TABLE `ps_status` (
  `ps_id` int(100) NOT NULL,
  `ps` varchar(255) DEFAULT NULL,
  `ps_value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ps_status`
--

INSERT INTO `ps_status` (`ps_id`, `ps`, `ps_value`) VALUES
(1, 'post_success', 'Your psot submitted successfully.'),
(2, 'post_edit_success', 'You have been updated your post successfully.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `about` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `user_position` varchar(255) NOT NULL,
  `user_team` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `address`, `about`, `profile_img`, `user_position`, `user_team`, `password`, `registered_at`) VALUES
(1, 'Jefry Ventura', 'jeffrey.ventura@go.sfcollege.edu', '5555548787', 'Kerela', '', 'Screenshot_20.jpg', 'Pending User', '', 'bc1404a595db8c5bb7f3b502be84285e', '2020-06-14 09:28:04'),
(2, 'Habibullah Bahar', 'habibullahbahar.piash@gmail.com', '01857489911', 'Narayanganj, Dhaka', 'I am very decent and I always try to do something new.', 'profile.jpg', 'Contributor', 'Tech Team', '21232f297a57a5a743894a0e4a801fc3', '2020-06-14 09:48:57'),
(3, 'S.M. Al Amin', 'smalameen0@gmail.com', '01966002392', 'Gazipur', '', 'Screenshot_119.jpg', 'Contributor', 'Content Management Team', 'e10adc3949ba59abbe56e057f20f883e', '2020-06-14 09:49:07'),
(4, 'Imranul Islam', 'imranul.islam67@gmail.com', '01521564742', 'Dhaka', '', 'Screenshot_120.jpg', 'Contributor', 'Digital Marketing Team', 'e10adc3949ba59abbe56e057f20f883e', '2020-06-14 09:49:32'),
(5, 'Tahsina Islam Tajnur', 'tm.tajnur@gmail.com', '01633554400', 'Dhaka', '', 'Screenshot_121.jpg', 'Ambassdor', 'Digital Marketing Team', 'e10adc3949ba59abbe56e057f20f883e', '2020-06-14 09:49:37'),
(6, 'Md Abubokor Siddique', 'siddiq9520@gmail.com', '01925520060', 'Jhenidah', '', 'Screenshot_122.jpg', 'Contributor', 'Digital Marketing Team', 'e10adc3949ba59abbe56e057f20f883e', '2020-06-14 09:49:17'),
(7, 'Fahim Raihan', 'fahimraihan772@gmail.com', '01310338301', 'Dhaka', '', 'Screenshot_123.jpg', 'Contributor', 'Digital Marketing Team', 'e10adc3949ba59abbe56e057f20f883e', '2020-06-14 09:53:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ps_status`
--
ALTER TABLE `ps_status`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ps_status`
--
ALTER TABLE `ps_status`
  MODIFY `ps_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
