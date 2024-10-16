-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2024 at 07:40 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `category`) VALUES
(71, 'fettuccine with lobster and prawn ', '3450', 'spicy seafood laksa.jpg', 'Meals'),
(70, 'fettuccine with smoked salmon', '5750', 'fettuccine with smoked salmon.jpeg', 'Meals'),
(69, 'beef smore', '2750', 'beef smore.webp', 'special foods'),
(68, 'tamarind beef curry', '2500', 'tamarind beef curry.jpg', 'special foods'),
(67, 'chocolate nemesis', '995', 'chocolate nemesis.jpg', 'Sweet'),
(65, 'veuve clicquot - france 750m', '72000', 'veuve clicquot - france 750m.jpg', 'Wines'),
(66, 'paradise road chocolate cake', '1100', 'paradise road chocolate cake.avif', 'Sweet'),
(61, 'pernod', '1500', 'pernod.jpg', 'Beverages'),
(63, 'cinzano rosso/bianco', '1100', 'cinzano rosso - bianco.jpg', 'Beverages'),
(64, 'taittinger prestige rosé - france 750ml', '46400', 'taittinger prestige rosé - france 750ml.jpg', 'Wines'),
(72, 'beef patties', '1095', 'beef patties.webp', 'Snacks'),
(73, 'mini beef slider', '1600', 'mini beef slider.png', 'Snacks');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
