-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Ago 01, 2025 alle 17:11
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finanza`
--
CREATE DATABASE IF NOT EXISTS `finanza` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `finanza`;

-- --------------------------------------------------------

--
-- Struttura della tabella `bollette`
--

DROP TABLE IF EXISTS `bollette`;
CREATE TABLE `bollette` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `referral_period` text DEFAULT NULL,
  `consumption` text DEFAULT NULL,
  `unit_cost` float GENERATED ALWAYS AS (case when `consumption` regexp '^[0-9]+(\\.[0-9]+)?$' and `consumption` is not null and `consumption` <> '0' then `amount` / cast(`consumption` as decimal(15,6)) else NULL end) STORED,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `bollette_acqua`
--

DROP TABLE IF EXISTS `bollette_acqua`;
CREATE TABLE `bollette_acqua` (
  `id` int(11) NOT NULL,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` int(11) DEFAULT NULL,
  `cons_amount` float DEFAULT NULL,
  `tot_consumption` int(11) DEFAULT NULL,
  `unit_amount` float GENERATED ALWAYS AS (case when `tot_consumption` is not null and `tot_consumption` <> 0 then `cons_amount` / `tot_consumption` else NULL end) STORED,
  `tot_amount` float DEFAULT NULL,
  `common_amount` float GENERATED ALWAYS AS (`tot_amount` - `cons_amount`) STORED,
  `unit_common_amount` float GENERATED ALWAYS AS (case when `common_amount` is not null then `common_amount` / 3 else NULL end) STORED,
  `payment_date` date DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `read_month` text DEFAULT NULL,
  `read_consumption` int(11) DEFAULT NULL,
  `difference_consumption` int(11) DEFAULT NULL,
  `unit_cons_amount` float DEFAULT NULL,
  `unit_tot_amount` float DEFAULT NULL,
  `referral_period` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `contocorrente`
--

DROP TABLE IF EXISTS `contocorrente`;
CREATE TABLE `contocorrente` (
  `id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


--
-- Table structure for table `loggedusers`
--

DROP TABLE IF EXISTS `loggedusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `loggedusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Struttura della tabella `mutuo`
--

DROP TABLE IF EXISTS `mutuo`;
CREATE TABLE `mutuo` (
  `id` int(11) NOT NULL,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` float DEFAULT 0,
  `interests` float DEFAULT 0,
  `capital` float DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `overview`
--

DROP TABLE IF EXISTS `overview`;
CREATE TABLE `overview` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ref_year` varchar(255) NOT NULL,
  `ref_month` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `stipendio`
--

DROP TABLE IF EXISTS `stipendio`;
CREATE TABLE `stipendio` (
  `id` int(11) NOT NULL,
  `lordo` float DEFAULT NULL,
  `netto` float DEFAULT NULL,
  `ticket_value` float DEFAULT NULL,
  `ticket_n` int(11) DEFAULT NULL,
  `ref_year` int(11) DEFAULT NULL,
  `ref_month` varchar(255) NOT NULL,
  `data_bonifico` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bollette`
--
ALTER TABLE `bollette`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `bollette_acqua`
--
ALTER TABLE `bollette_acqua`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `contocorrente`
--
ALTER TABLE `contocorrente`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `mutuo`
--
ALTER TABLE `mutuo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `overview`
--
ALTER TABLE `overview`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `stipendio`
--
ALTER TABLE `stipendio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bollette`
--
ALTER TABLE `bollette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT per la tabella `bollette_acqua`
--
ALTER TABLE `bollette_acqua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `contocorrente`
--
ALTER TABLE `contocorrente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `mutuo`
--
ALTER TABLE `mutuo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT per la tabella `overview`
--
ALTER TABLE `overview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `stipendio`
--
ALTER TABLE `stipendio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
