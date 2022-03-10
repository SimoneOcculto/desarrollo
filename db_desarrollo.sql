-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 10, 2022 alle 09:24
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_desarrollo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `progetto`
--

CREATE TABLE `progetto` (
  `ID_Progetto` int(11) UNSIGNED NOT NULL,
  `Leader` varchar(60) NOT NULL,
  `NomeP` varchar(32) NOT NULL,
  `DescrizioneP` varchar(100) NOT NULL,
  `DataScadenzaP` date NOT NULL,
  `DataCreazioneP` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `progetto`
--

INSERT INTO `progetto` (`ID_Progetto`, `Leader`, `NomeP`, `DescrizioneP`, `DataScadenzaP`, `DataCreazioneP`) VALUES
(19, 's@f.d', 'a', 'a', '2022-03-17', '2022-03-09');

-- --------------------------------------------------------

--
-- Struttura della tabella `task`
--

CREATE TABLE `task` (
  `ID_Task` int(11) UNSIGNED NOT NULL,
  `Progetto` int(11) UNSIGNED NOT NULL,
  `NomeT` varchar(32) NOT NULL,
  `DescrizioneT` varchar(100) NOT NULL,
  `DataScadenzaT` date NOT NULL,
  `DataCreazioneT` date NOT NULL,
  `Priorita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `Mail` varchar(60) NOT NULL,
  `Nome` text NOT NULL,
  `Cognome` text NOT NULL,
  `Nascita` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `progetto`
--
ALTER TABLE `progetto`
  ADD PRIMARY KEY (`ID_Progetto`);

--
-- Indici per le tabelle `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`ID_Task`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`Mail`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `progetto`
--
ALTER TABLE `progetto`
  MODIFY `ID_Progetto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `task`
--
ALTER TABLE `task`
  MODIFY `ID_Task` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
