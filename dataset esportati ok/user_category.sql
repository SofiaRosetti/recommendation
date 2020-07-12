-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Lug 07, 2020 alle 08:56
-- Versione del server: 5.7.19
-- Versione PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tesi_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `user_category`
--

DROP TABLE IF EXISTS `user_category`;
CREATE TABLE IF NOT EXISTS `user_category` (
  `id_utente` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `user_category`
--

INSERT INTO `user_category` (`id_utente`, `id_categoria`) VALUES
(1, 9),
(2, 9),
(3, 8),
(4, 10),
(5, 8),
(6, 6),
(7, 6),
(8, 6),
(9, 3),
(10, 4),
(11, 10),
(12, 1),
(13, 5),
(14, 8),
(15, 8),
(16, 3),
(17, 4),
(18, 10),
(19, 4),
(20, 5),
(21, 2),
(22, 8),
(23, 2),
(24, 4),
(25, 6),
(26, 9),
(27, 2),
(28, 5),
(29, 8),
(30, 5),
(31, 3),
(32, 6),
(33, 10),
(34, 10),
(35, 1),
(36, 8),
(37, 5),
(38, 9),
(39, 3),
(40, 10),
(41, 9),
(42, 1),
(43, 5),
(44, 4),
(45, 6),
(46, 3),
(47, 6),
(48, 2),
(49, 1),
(50, 9),
(51, 9),
(52, 6),
(53, 5),
(54, 9),
(55, 5),
(56, 3),
(57, 2),
(58, 1),
(59, 5),
(60, 4),
(61, 2),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 9),
(67, 8),
(68, 4),
(69, 9),
(70, 9),
(71, 5),
(72, 1),
(73, 6),
(74, 1),
(75, 5),
(76, 7),
(77, 1),
(78, 8),
(79, 10),
(80, 2),
(81, 7),
(82, 5),
(83, 4),
(84, 7),
(85, 2),
(86, 4),
(87, 9),
(88, 2),
(89, 10),
(90, 5),
(91, 2),
(92, 10),
(93, 7),
(94, 9),
(95, 8),
(96, 8),
(97, 1),
(98, 7),
(99, 3),
(100, 6),
(3, 6),
(90, 3),
(37, 8),
(91, 2),
(26, 9),
(97, 2),
(48, 6),
(54, 10),
(38, 4),
(6, 9),
(74, 10),
(38, 10),
(32, 3),
(77, 8),
(43, 10),
(11, 9),
(85, 2),
(21, 6),
(91, 5),
(94, 9),
(54, 6),
(81, 10),
(37, 3),
(6, 4),
(100, 9),
(65, 10),
(18, 10),
(61, 8),
(63, 6),
(8, 8),
(56, 8),
(73, 6),
(89, 7),
(70, 6),
(12, 1),
(39, 7),
(49, 3),
(72, 7),
(64, 2),
(9, 6),
(81, 2),
(40, 6),
(2, 7),
(41, 9),
(53, 8),
(27, 3),
(25, 4),
(84, 1),
(59, 8),
(9, 9),
(50, 8),
(30, 9),
(97, 4),
(86, 8),
(69, 2),
(19, 7),
(72, 1),
(72, 6),
(36, 2),
(37, 9),
(63, 4),
(75, 6),
(13, 3),
(3, 1),
(73, 1),
(72, 2),
(32, 2),
(45, 6),
(77, 10),
(74, 5),
(92, 4),
(5, 2),
(16, 5),
(64, 4),
(64, 5),
(78, 1),
(18, 5),
(8, 10),
(23, 1),
(65, 10),
(38, 6),
(5, 10),
(33, 2),
(59, 4),
(53, 3),
(77, 3),
(38, 9),
(31, 10),
(51, 1),
(64, 3),
(41, 9),
(50, 5),
(54, 9),
(68, 6),
(43, 5),
(71, 5),
(14, 5),
(58, 8),
(78, 8),
(91, 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;