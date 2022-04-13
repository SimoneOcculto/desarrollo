-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 13, 2022 alle 11:46
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE 'db_desarrollo';

--
-- Database: `db_desarrollo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipazione`
--

CREATE TABLE `partecipazione` (
  `Invitante` varchar(60) NOT NULL,
  `Invitato` varchar(60) NOT NULL,
  `Progetto` int(11) UNSIGNED NOT NULL,
  `Stato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `DataCreazioneP` date NOT NULL,
  `Privacy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `progetto`
--

INSERT INTO `progetto` (`ID_Progetto`, `Leader`, `NomeP`, `DescrizioneP`, `DataScadenzaP`, `DataCreazioneP`, `Privacy`) VALUES
(73, 'utente1@gmail.com', 'CIAO', 'ciao', '2022-04-23', '2022-04-13', 2),
(74, 'utente1@gmail.com', 'CIAO', 'fasdsa', '2022-04-22', '2022-04-13', 1);

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
  `Password` varchar(32) NOT NULL,
  `Ruolo` varchar(1) NOT NULL,
  `Nome` varchar(32) NOT NULL,
  `Cognome` varchar(32) NOT NULL,
  `Nascita` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`Mail`, `Password`, `Ruolo`, `Nome`, `Cognome`, `Nascita`) VALUES
('simone@jj.it', 'Ciao2000.', 'A', 'Simone', 'Occulto', ''),
('utente1@gmail.com', 'Ciao2000.', 'U', 'Utente', 'Du', ''),
('utente2@gmail.com', 'Ciao2000.', 'U', 'Utente', 'Uno', '');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD PRIMARY KEY (`Invitante`,`Progetto`,`Invitato`),
  ADD KEY `FK_Invitato` (`Invitato`),
  ADD KEY `FK_Progetto` (`Progetto`);

--
-- Indici per le tabelle `progetto`
--
ALTER TABLE `progetto`
  ADD PRIMARY KEY (`ID_Progetto`),
  ADD KEY `FK_Mail` (`Leader`);

--
-- Indici per le tabelle `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`ID_Task`),
  ADD KEY `FK_ID_Progetto` (`Progetto`);

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
  MODIFY `ID_Progetto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT per la tabella `task`
--
ALTER TABLE `task`
  MODIFY `ID_Task` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD CONSTRAINT `FK_Invitante` FOREIGN KEY (`Invitante`) REFERENCES `utente` (`Mail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Invitato` FOREIGN KEY (`Invitato`) REFERENCES `utente` (`Mail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Progetto` FOREIGN KEY (`Progetto`) REFERENCES `progetto` (`ID_Progetto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `progetto`
--
ALTER TABLE `progetto`
  ADD CONSTRAINT `FK_Mail` FOREIGN KEY (`Leader`) REFERENCES `utente` (`Mail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_ID_Progetto` FOREIGN KEY (`Progetto`) REFERENCES `progetto` (`ID_Progetto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
