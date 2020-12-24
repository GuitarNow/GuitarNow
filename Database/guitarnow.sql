-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 24, 2020 alle 13:42
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guitarnow`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `accessorio`
--

CREATE TABLE `accessorio` (
  `codice_accessorio` int(11) NOT NULL,
  `categoria` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `chitarra`
--

CREATE TABLE `chitarra` (
  `cod_chitarra` int(11) NOT NULL,
  `legno_manico` varchar(30) NOT NULL,
  `legno_corpo` varchar(30) NOT NULL,
  `tipo_chitarra` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `chitarra`
--

INSERT INTO `chitarra` (`cod_chitarra`, `legno_manico`, `legno_corpo`, `tipo_chitarra`) VALUES
(2, 'legno3', 'legno4', 'elettrica'),
(3, 'legno1', 'legno 2', 'classica');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `id_commento` int(11) NOT NULL,
  `descrizione` text NOT NULL,
  `voto` int(1) NOT NULL,
  `data` date NOT NULL,
  `codice_prodotto` int(11) NOT NULL,
  `user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getaccessori`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getaccessori` (
`codice_prodotto` int(11)
,`modello` varchar(50)
,`produttore` varchar(30)
,`descrizione` text
,`prezzo_vendita` float(6,2)
,`categoria` varchar(15)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getchitarre`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getchitarre` (
`codice_prodotto` int(11)
,`modello` varchar(50)
,`produttore` varchar(30)
,`descrizione` text
,`prezzo_vendita` float(6,2)
,`legno_manico` varchar(30)
,`legno_corpo` varchar(30)
,`tipo_chitarra` varchar(20)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

CREATE TABLE `immagine` (
  `id_immagine` int(11) NOT NULL,
  `path` tinytext NOT NULL,
  `long_desc` text NOT NULL,
  `short_desc` tinytext NOT NULL,
  `codice_prodotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `codice_prodotto` int(11) NOT NULL,
  `modello` varchar(50) NOT NULL,
  `produttore` varchar(30) NOT NULL,
  `descrizione` text NOT NULL,
  `prezzo_vendita` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`codice_prodotto`, `modello`, `produttore`, `descrizione`, `prezzo_vendita`) VALUES
(1, 'Les Paul Standard HP', 'Gibson', 'La Les Paul Standard HP conserva molte caratteristiche Gibson popolari, tra cui il profilo asimmetrico del manico Slim Taper, migliorando l\'uso con un aggiornamento dei venerati pick-up humbucker PAF ed un top in acero figurato AAA+ con abbellimenti di alto livello. Il modello HP offre innovazioni all\'avanguardia per i chitarristi che guardano oltre, tra le quali un accesso veloce alla parte bassa della tastiera, larghezza del manico da solista, capotasto zero-fret e sellette regolabili in titanio. Una varietà timbrica eccezionale fornita da 4 potenziometri push-pull con DIP switch per oltre 150 possibilità di rewiring istantanei reversibili.\r\n', 2.60),
(2, 'Les Paul Standard HP 2018', 'Gibson', 'La Les Paul Standard HP conserva molte caratteristiche Gibson popolari, tra cui il profilo asimmetrico del manico Slim Taper, migliorando l\'uso con un aggiornamento dei venerati pick-up humbucker PAF ed un top in acero figurato AAA+ con abbellimenti di alto livello. Il modello HP offre innovazioni all\'avanguardia per i chitarristi che guardano oltre, tra le quali un accesso veloce alla parte bassa della tastiera, larghezza del manico da solista, capotasto zero-fret e sellette regolabili in titanio. Una varietà timbrica eccezionale fornita da 4 potenziometri push-pull con DIP switch per oltre 150 possibilità di rewiring istantanei reversibili.\r\n', 2599.00),
(3, 'Player Stratocaster MN Black', 'Fender', 'Il suono ispiratore di una Stratocaster è uno dei fondamenti Fender. Caratterizzato da un suono classico, high-end squillanti, medi potenti ed una fascia bassa robusta, abbinato ad una articolazione cristallina, la Player Stratocaster è dotata dello stile e del feel Fender autentico. E\' pronta a servire la tua visione musicale, è abbastanza versatile da gestire qualsiasi stile ed è la piattaforma perfetta per creare il tuo suono. Rompendo con la tradizione, Fender ha aggiunto un controllo del tono dedicato per il pickup al ponte, dandoti un maggiore controllo sul suono nelle posizioni del pickup 1 e 2.\r\n<br/>\r\nCaratteristiche\r\n<br/>\r\n\r\n<ul>\r\n    <li></li>\r\n</ul> \r\n<li>Body: Ontano</li>\r\n<li>Finitura: Poliestere lucido</li>\r\n<li>Manico: Acero</li>\r\n<li>Finitura: Satinata</li>\r\n<li>Profilo: Modern \"C\"</li>\r\n<li>Scala: 25,5\" (648mm)</li>\r\n<li>Tastiera: Acero</li>\r\n<li>Raggio: 9.5\" (241mm)</li>\r\n<li>Tasti: 22</li>\r\n<li>Dimensione: Jumbo medium</li>\r\n<li>Capotasto: Osso sintetico</li>\r\n<li>Larghezza: 1,650\" (42mm)</li>\r\n<li>Intarsi: Dot neri</li>\r\n<li>Truss Rod: Standard con dado di regolazione esagonale da 3/16\"</li>\r\n<li>Pickup: Player Series Alnico 5 Strat Single-Coil</li>\r\n<li>Controlli: Master Volume, Tone 1 (Neck / Middle), Tone 2 (Bridge), Selettore pick up a 5 posizioni</li>\r\n<li>Ponte: Tremolo sincronizzato a 2 punti con selle in acciaio piegato</li>\r\n<li>Hardware: Nichel / Cromo</li>\r\n<li>Meccaniche: Standard Cast / Sealed</li>\r\n<li>Battipenna: Color pergamena a 3 strati</li>\r\n<li>Manopole: Plastica color pergamena</li>\r\n<li>Piastra: 4 Bulloni con \"F\" stampata</li>\r\n<li>Finitura: Nera</li>\r\n<li>N.B. Custodia NON inclusa</li>', 639.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `produttore`
--

CREATE TABLE `produttore` (
  `ragione_sociale` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `citta` varchar(30) NOT NULL,
  `indirizzo` varchar(40) NOT NULL,
  `cap` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `produttore`
--

INSERT INTO `produttore` (`ragione_sociale`, `email`, `telefono`, `citta`, `indirizzo`, `cap`) VALUES
('Epiphone', 'epiphone@gibson.com', '0265931541', 'Milano', 'via Milano 110', '20019'),
('Fender', 'info@fender.com', '0265931546', 'Roma', 'via roma 120', '0010'),
('Gibson', 'info@gibson.com', '0265931542', 'Milano', 'via roma 100', '20019'),
('Ibanez', 'info@ibanez.com', '0265931544', 'Roma', 'via roma 121', '0020');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura per vista `getaccessori`
--
DROP TABLE IF EXISTS `getaccessori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getaccessori`  AS  select `prodotto`.`codice_prodotto` AS `codice_prodotto`,`prodotto`.`modello` AS `modello`,`prodotto`.`produttore` AS `produttore`,`prodotto`.`descrizione` AS `descrizione`,`prodotto`.`prezzo_vendita` AS `prezzo_vendita`,`accessorio`.`categoria` AS `categoria` from ((`accessorio` join `prodotto` on(`accessorio`.`codice_accessorio` = `prodotto`.`codice_prodotto`)) join `produttore` on(`prodotto`.`produttore` = `produttore`.`ragione_sociale`)) ;

-- --------------------------------------------------------

--
-- Struttura per vista `getchitarre`
--
DROP TABLE IF EXISTS `getchitarre`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getchitarre`  AS  select `prodotto`.`codice_prodotto` AS `codice_prodotto`,`prodotto`.`modello` AS `modello`,`prodotto`.`produttore` AS `produttore`,`prodotto`.`descrizione` AS `descrizione`,`prodotto`.`prezzo_vendita` AS `prezzo_vendita`,`chitarra`.`legno_manico` AS `legno_manico`,`chitarra`.`legno_corpo` AS `legno_corpo`,`chitarra`.`tipo_chitarra` AS `tipo_chitarra` from ((`chitarra` join `prodotto` on(`chitarra`.`cod_chitarra` = `prodotto`.`codice_prodotto`)) join `produttore` on(`prodotto`.`produttore` = `produttore`.`ragione_sociale`)) ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `accessorio`
--
ALTER TABLE `accessorio`
  ADD PRIMARY KEY (`codice_accessorio`),
  ADD KEY `codice_prodotto` (`codice_accessorio`);

--
-- Indici per le tabelle `chitarra`
--
ALTER TABLE `chitarra`
  ADD PRIMARY KEY (`cod_chitarra`),
  ADD KEY `cod_chitarra` (`cod_chitarra`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`id_commento`),
  ADD KEY `codice_prodotto` (`codice_prodotto`),
  ADD KEY `user` (`user`);

--
-- Indici per le tabelle `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`id_immagine`),
  ADD KEY `codice_prodotto` (`codice_prodotto`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`codice_prodotto`),
  ADD KEY `produttore` (`produttore`);

--
-- Indici per le tabelle `produttore`
--
ALTER TABLE `produttore`
  ADD PRIMARY KEY (`ragione_sociale`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `id_commento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `id_immagine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `codice_prodotto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `accessorio`
--
ALTER TABLE `accessorio`
  ADD CONSTRAINT `accessorio_ibfk_1` FOREIGN KEY (`codice_accessorio`) REFERENCES `prodotto` (`codice_prodotto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `chitarra`
--
ALTER TABLE `chitarra`
  ADD CONSTRAINT `chitarra_ibfk_1` FOREIGN KEY (`cod_chitarra`) REFERENCES `prodotto` (`codice_prodotto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`codice_prodotto`) REFERENCES `prodotto` (`codice_prodotto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_ibfk_1` FOREIGN KEY (`codice_prodotto`) REFERENCES `prodotto` (`codice_prodotto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`produttore`) REFERENCES `produttore` (`ragione_sociale`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
