-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 23, 2025 at 04:42 PM
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
-- Database: `jadipintar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`user_id`, `playlist_id`) VALUES
('6857128f237bf', 'frhuOoqYizs1cbyVzgFs'),
('68570d9a8ae37', 'rzwaUoWKnXqi28m0olPW'),
('68570d9a8ae37', 'frhuOoqYizs1cbyVzgFs');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(50) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content_id`, `user_id`, `tutor_id`, `comment`, `date`) VALUES
('yGa2OnT1G6F8cgFcWsM5', '2kMr3Ta5VzNe9o9Zes4E', '6857128f237bf', '6837428bb39b1', 'sangat membantu, terimakasih kak hihihiii\r\n', '2025-06-22'),
('jzpcMtjV9nhxG8rDf5Nz', 'KsEth1AVezE5Hk5ULhrq', '6857128f237bf', '6837428bb39b1', 'woww keren\r\n', '2025-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(13) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descriptions` varchar(1000) NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `tutor_id`, `playlist_id`, `title`, `descriptions`, `video`, `thumb`, `date`, `status`) VALUES
('DnhfiAJld6oBngEMOh9U', '6837428bb39b1', 'rzwaUoWKnXqi28m0olPW', 'UI/UX - bagian satu', 'Halooo semuanya sekarang kira mulai dengan dasar-dasar desain yuuk,  dimulai dari fundamental.', 'lYcUntcH0aKgqzLGlw7Y.mp4', 'WTttk2qTRPQ2pjtxC4lc.jpg', '2025-06-22', 'active'),
('7IYG3U5N8222zCNtheeX', '6837428bb39b1', 'rzwaUoWKnXqi28m0olPW', 'UI/UX -bagian dua', 'Setelah bagian satu belajar fundamental sekarang mari kenalan dengan Figma, tools yang sangat ngebantu para designer khusunya web designer.', 'pW1E9WtRp33ecsIehpJx.mp4', 'jtLCQvyhI9taRXE6Yf4p.jpg', '2025-06-22', 'active'),
('KsEth1AVezE5Hk5ULhrq', '6837428bb39b1', 'frhuOoqYizs1cbyVzgFs', 'Web Development - bagian satu', 'hai haiiii yuk belajar mengenal web development, kita akan belajar dasar-dasar HTML terlebih dahulu', 'bnec3elHY5gW9e8qaNug.mp4', 'nVvgDDLinHLLfzs9nqgl.jpg', '2025-06-22', 'active'),
('2kMr3Ta5VzNe9o9Zes4E', '6837428bb39b1', 'frhuOoqYizs1cbyVzgFs', 'Web Development - bagian dua', 'Setelah di video sebelumnya kita belajar dasar HTML, sekarang kita belajar mengenal CSS.', 'es5aI5rJVo3s28lGx8zA.mp4', 'H2UK7O7FpN5R0hlwFZLs.png', '2025-06-22', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `tutor_id`, `content_id`) VALUES
('6857128f237bf', '6837428bb39b1', '2kMr3Ta5VzNe9o9Zes4E'),
('6857128f237bf', '6837428bb39b1', 'KsEth1AVezE5Hk5ULhrq'),
('68570d9a8ae37', '6837428bb39b1', 'KsEth1AVezE5Hk5ULhrq'),
('68570d9a8ae37', '6837428bb39b1', 'DnhfiAJld6oBngEMOh9U'),
('68570d9a8ae37', '6837428bb39b1', '7IYG3U5N8222zCNtheeX');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `descriptions` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `tutor_id`, `title`, `descriptions`, `thumb`, `date`, `status`) VALUES
('rzwaUoWKnXqi28m0olPW', '6837428bb39b1', 'Design UI/UX', 'Belajar merancang interface design UI/UX menggunakan sigma', 'SDl8JkQaqmOKCvjKOMKx.jpg', '2025-06-17', 'active'),
('frhuOoqYizs1cbyVzgFs', '6837428bb39b1', 'Web Development', 'Di sini kita akan belajar mengembangkan website mulai dari dasar. Dengan mengedepankan fundamental, ', '8uWaLBOJBEOg5PivY8W4.jpg', '2025-06-19', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `name`, `profession`, `email`, `password`, `image`) VALUES
('68373f4d9edd4', 'Lulu Andriani', 'accountant', 'lulu@gmail.com', 'andriani15', '68373f4d9edea.jpg'),
('6837420acf3c4', 'andriani', 'lawyer', 'luluandriani980@gmail.com', 'Andriani15', '6837420ae45e3.jpg'),
('6837428bb39b1', 'doryy', 'designer', 'kimkai3560@gmail.com', 'andrianiexo', '9WXRVJrfQ1BDnpBiim9O.jpg'),
('685802fd9b6b2', 'Sandhika Galih', 'software developer', 'luluandriani257@gmail.com', 'sandhikagalih', '685802fd9b6c7.jpg'),
('685803f0d4b34', 'Alex Freberg', 'musician', 'kjongdae65@gmail.com', 'alexfreberg', '685803f0d4b48.jpg'),
('6858045b358dd', 'Candra', 'designer', 'andrianilulu10@gmail.com', 'candra', '6858045b358f0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('68570d9a8ae37', 'Yaya', 'andrianilulu10@gmail.com', 'luludanexo', '68570d9a8ae48.jpg'),
('6857128f237bf', 'Off Jumpol', 'kjongdae65@gmail.com', 'kimjongdae', '5sNW2cciyzhMSWE3Dr88.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
