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
-- Struttura della tabella `user100`
--

DROP TABLE IF EXISTS `user100`;
CREATE TABLE IF NOT EXISTS `user100` (
  `id_utente` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `disabilita` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `user100`
--

INSERT INTO `user100` (`id_utente`, `nome`, `disabilita`) VALUES
(1, 'Geri Keeri', 2),
(2, 'Hunt Gimeno', 2),
(3, 'Arlina Scothron', 1),
(4, 'Nyssa Hellis', 1),
(5, 'Hewett Chesman', 1),
(6, 'Amberly Powrie', 2),
(7, 'Kennie Rigardeau', 2),
(8, 'Rahel Benedek', 1),
(9, 'Flin Khrishtafovich', 1),
(10, 'Philly Dickins', 2),
(11, 'Jourdain Wynes', 1),
(12, 'Mame Ruperti', 1),
(13, 'Malcolm Kelemen', 2),
(14, 'Celestina Gisbourn', 1),
(15, 'Val Brazear', 2),
(16, 'Drud Burchett', 1),
(17, 'Rutherford Parmeter', 1),
(18, 'Anita Strephan', 1),
(19, 'Ebony Coast', 2),
(20, 'Gearalt Gleder', 2),
(21, 'Georges Lashbrook', 1),
(22, 'Stanley Digges', 1),
(23, 'Feodor Napolione', 1),
(24, 'Holt Swannick', 1),
(25, 'Wang Janatka', 1),
(26, 'Susann Velti', 2),
(27, 'Pier Leddy', 1),
(28, 'Rutherford Caskie', 2),
(29, 'Fanni Deave', 1),
(30, 'Del Petasch', 1),
(31, 'Aindrea Sheere', 2),
(32, 'Devonna Parades', 1),
(33, 'Phylis MacMenamy', 2),
(34, 'Teena Cubuzzi', 1),
(35, 'Ami Duchenne', 1),
(36, 'Lincoln Chatten', 1),
(37, 'Misty Normanvill', 2),
(38, 'Erin Laffan', 2),
(39, 'Elias Stillmann', 2),
(40, 'Deny Lockhead', 2),
(41, 'Cyndia MacNeil', 1),
(42, 'Lolly Lissandrini', 2),
(43, 'Boony De Robertis', 2),
(44, 'Forest Voaden', 1),
(45, 'Skipton Winchester', 2),
(46, 'Arturo Chace', 2),
(47, 'Hervey Grundy', 1),
(48, 'Pasquale Domnin', 2),
(49, 'Camille Mansford', 1),
(50, 'Teddi Bulmer', 1),
(51, 'Rubetta Everill', 2),
(52, 'Rossy Coatman', 2),
(53, 'Veradis Langlands', 1),
(54, 'Carroll Ficken', 1),
(55, 'Donni Matheson', 2),
(56, 'Ferne Trundler', 2),
(57, 'Hastings Drayson', 2),
(58, 'Shaun Dugan', 2),
(59, 'Minnaminnie Collecott', 1),
(60, 'Mildrid Guyonnet', 1),
(61, 'Derek Kingzeth', 2),
(62, 'Terrill Tidey', 2),
(63, 'Roseanna Bisatt', 2),
(64, 'Nadya Asple', 2),
(65, 'Felipe Stileman', 1),
(66, 'Bertha Huddle', 1),
(67, 'Victoria Peskett', 1),
(68, 'Maryjane Arthur', 1),
(69, 'Ive Joffe', 2),
(70, 'Britt Jankiewicz', 1),
(71, 'Hilde Stronough', 2),
(72, 'Bunnie McShee', 1),
(73, 'Serene Darley', 2),
(74, 'Mirabel Entwisle', 2),
(75, 'Claudian Milsted', 1),
(76, 'Franz Carwithan', 1),
(77, 'Filberto Milverton', 1),
(78, 'Hardy Bool', 2),
(79, 'Janek Bruckshaw', 1),
(80, 'Tiff Skerman', 2),
(81, 'Michale Andress', 2),
(82, 'Amalea Leband', 1),
(83, 'Rebeka Sasser', 2),
(84, 'Brigg Cases', 1),
(85, 'Fanchette Dimmock', 1),
(86, 'Murry Frisel', 2),
(87, 'Boote Degue', 1),
(88, 'Alfons Leatherland', 2),
(89, 'Dimitri Stitwell', 2),
(90, 'Tanner McGlade', 2),
(91, 'Emmerich Castana', 2),
(92, 'Ingra Skarr', 2),
(93, 'Valida Rackam', 1),
(94, 'Ruby Cowlin', 1),
(95, 'Katha Dwine', 1),
(96, 'Pauly Whetnell', 1),
(97, 'Erin Anderbrugge', 1),
(98, 'Sashenka Godby', 2),
(99, 'Standford Dimitru', 1),
(100, 'Carly Loughlin', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
