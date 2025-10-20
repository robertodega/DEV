-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2025 at 10:17 AM
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
-- Database: `utils`
--
CREATE DATABASE IF NOT EXISTS `utils` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `utils`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `pwd` varchar(250) DEFAULT NULL,
  `note` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pwd`, `note`) VALUES
(1, 'rcaprio711', 'fast', ''),
(2, 'valerio.villani', 'fast', ''),
(3, 'alessio.panari', 'Fast000#', ''),
(4, 'alexandra.mondello', 'Fast000#', 'solo mobile'),
(5, 'valeria.banno', 'Fast000#', ''),
(6, 'micheleantonio.caizzi', 'fast', 'usato per acquisto apparato, va in errore sui change per problema json sulla retriveItems'),
(7, 'melania.stricchiolo', 'fast', ''),
(8, 'ctosato4768', 'fast', ''),
(9, 'giuseppe.vatalaro', 'fast', ''),
(10, 'luciano.zanaga', 'fast', ''),
(11, 'gdimaio527', 'fast', ''),
(12, 'davide.falchi0001', 'fast', ''),
(13, 'salvatore.fruscione0003', 'fast', ''),
(14, 'michelina.signorello', 'fast', ''),
(15, 'gianmarco.trotta', 'fast', 'usato per acquisto apparato'),
(16, 'guido.scarlata', 'fastfast solo mobile ricarica pura', ''),
(17, 'marites.decastro', 'pjs9muxMkZ per modem nexxt', ''),
(18, 'dwa.r.f.ad.am@gmail.com', 'Dcchro!12313SScgf08', 'utente secondario'),
(19, 'giuseppe.campanile0020', 'fastfast', 'cliente fisso + mobile 2P'),
(20, 'ivan.brambilla0006', 'Fast000#', 'cliente 1P INTERNET'),
(21, 'yusung.cho0001', 'Fast000#', 'cliente 1P (JOY) FTTH'),
(22, 'luca.pellegrini0044', 'Fast000#', 'per modem nexxt'),
(23, 'roberto.sigismondi0004', 'Fast000#', ''),
(24, 'vasile.hedesiu0001', 'Fast000# solo fisso', ''),
(25, 'piero.maniaci0002', 'Fast000#', 'fisso + mobile 2 SIM Mobile Giga'),
(26, 'federico.dragone0002', 'ast000#', 'fisso + mobile con 1 Fastweb Mobile + 2 Mobile Light'),
(27, 'carmine.cucciniello0004', 'Fast000#', 'only mobile con due sim Mobile Light'),
(28, 'luigia.bonetti', 'Fast000#', 'only mobile 1 sim Mobile 250/6GB'),
(29, 'aurelio.reho', 'Fast000#', 'solo fisso'),
(30, 'alessandro.ferlito0004', 'Fast000#', 'fisso + mobile (disattivato sul mobile)'),
(31, 'marco.maceratesi0002', 'Fast000#', 'fisso + mobile'),
(32, 'francesco.perego0006', 'Fast000#', ''),
(33, 'lorenzo.crucitti0001', 'Fast000#', 'fisso + mobile superjet'),
(34, 'francesco.baisi0001', 'Fast000#', ''),
(35, 'rosario.grassi0004', 'Fast000#', ''),
(36, 'gaia.giachi0001', 'Fast000#', ''),
(37, 'nicolo.menga', 'Fast000#', 'cliente non cpq'),
(38, 'pool.orsiparedes0001', 'Fast000#', 'cliente con partnership ENI'),
(39, 'antonio.nardella0030', 'Fast000#', 'cliente  FWA'),
(40, 'sergio.esposito0056', 'Fast000#', 'cliente con fastgate'),
(41, 'roberto.bargna0002', 'Fast000#', 'cliente solo mobile'),
(42, 'alessandro.mizzoni0003', 'Fast0000#', ''),
(43, 'andrea.gallitto0001', 'Fast000#', ''),
(44, 'giovanni.dipietro0026', 'Fast000#', ''),
(45, 'osvaldo.tristani', 'Fast000#', 'solo mobile quixa pet'),
(46, 'angelolorenzogi.nardoianni', 'Fast000#', ''),
(47, 'individua.buzzancaantonino0001', 'fastfast', ''),
(48, 'sas.taxi', 'fastfast', ''),
(49, 'banfifausto.individuale', 'fast', ''),
(50, 'exponetdiespositoaless.snc', 'fast', ''),
(51, 'individu.mircogeomgriguoli', 'kfhu3qWsdz', ''),
(52, 'i.acconciaturetizianadibia', 'fast', ''),
(53, 'sgabriel9188', 'fast', ''),
(54, 'gruppolaruffaluppino.srl', 'fast', ''),
(55, 'edilcar.srl0001', 'Fast000#', 'per dismissione booster'),
(56, 'savoiaroomsrom.individuale0001', 'Fast000#', 'solo fisso'),
(57, 'sas.taxi', 'fastfast', ''),
(58, 'banfifausto.individuale', 'fast', ''),
(59, 'liberoprofessio.dalila6321', '', ''),
(60, 'attanasiogianc.individuale', 'fast', 'in dunning'),
(61, 'ielettro8627', 'fast', 'in dunning'),
(62, 'agipdicavasoda.individuale', 'fast', ''),
(63, 'languageplusdi.individuale', 'fast', ''),
(64, 'petroncinifabi.individuale0001', 'fastfast', 'cliente solo internet'),
(65, 'mgconfdifulign.individuale0001', 'fastfast', 'cliente fisso + mobile 2P'),
(66, 'pinkcherry.srl', 'Fast000#', 'cliente fisso + mobile, Fisso 1P (solo internet)'),
(67, 'artextextilear.individuale', 'Fast000#', 'cliente fisso + mobile, Fisso 2P (internet e voce)'),
(68, 'edilcar.srl0001', 'Fast000#', 'per dismissione booster');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
