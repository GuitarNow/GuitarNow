-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Dic 29, 2020 alle 22:06
-- Versione del server: 10.1.19-MariaDB
-- Versione PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

--
-- Dump dei dati per la tabella `accessorio`
--

INSERT INTO `accessorio` (`codice_accessorio`, `categoria`) VALUES
(4, 'Corde'),
(5, 'Amplificatori'),
(6, 'Effetti'),
(11, 'Gadget');

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
(1, 'palissandro', 'palissandro', 'Elettrica'),
(2, 'mogano', 'palissandro', 'Elettrica'),
(3, 'acero', 'acero', 'Classica'),
(7, 'abete', 'acero', 'Semiacustica'),
(8, 'otano', 'acero', 'Elettrica'),
(9, 'otano', 'palissandro', 'Elettrica'),
(10, 'mogano', 'abete', 'Acustica');

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
(1, 'Les Paul Studio', 'Epiphone', 'La chitarra elettrica Epiphone Les Paul Studio, appartenente alla "Inspired by Gibson Collection", offre agli appassionati del marchio di Nashville il modello progettato da Gibson negli anni ''80 per offrire ad un prezzo contenuto una vera Les Paul semplice ma completa Il suono di questa chitarra elettrica è generato da una coppia di pickup Alnico Classic ed Alnico Classic Plus, dal suono caldo e corposo, ottimi sia sui suoni puliti che sui distorti. A completare lo strumento troviamo potenziometri CTS e meccaniche Grover Rotomatic.', 3000.00),
(2, 'Les Paul Standard HP 2018', 'Gibson', 'La Les Paul Standard HP conserva molte caratteristiche Gibson popolari, tra cui il profilo asimmetrico del manico Slim Taper, migliorando l''uso con un aggiornamento dei venerati pick-up humbucker PAF ed un top in acero figurato AAA+ con abbellimenti di alto livello. Il modello HP offre innovazioni all''avanguardia per i chitarristi che guardano oltre, tra le quali un accesso veloce alla parte bassa della tastiera, larghezza del manico da solista, capotasto zero-fret e sellette regolabili in titanio. Una varietà timbrica eccezionale fornita da 4 potenziometri push-pull con DIP switch per oltre 150 possibilità di rewiring istantanei reversibili.\n', 2599.00),
(3, 'Stratocaster MN Black', 'Fender', 'Il suono ispiratore di una Stratocaster è uno dei fondamenti Fender. Caratterizzato da un suono classico, high-end squillanti, medi potenti ed una fascia bassa robusta, abbinato ad una articolazione cristallina, la Player Stratocaster è dotata dello stile e del feel Fender autentico. E'' pronta a servire la tua visione musicale, è abbastanza versatile da gestire qualsiasi stile ed è la piattaforma perfetta per creare il tuo suono. Rompendo con la tradizione, Fender ha aggiunto un controllo del tono dedicato per il pickup al ponte, dandoti un maggiore controllo sul suono nelle posizioni del pickup 1 e 2.\n', 639.00),
(4, 'EJ41 Light', 'Daddario', 'Le corde Daddario EJ41 in nylon per chitarra classica sono perfette per i principianti, gli studenti e i professionisti. Questo set di corde a tensione normale contiene 3 cantini in nylon e 3 bassi Silver-plated Copper wound per garantire un ottimo bilanciamento tra timbri caldi e timbri nitidi e duraturi.', 12.00),
(5, 'Champion 40', 'Fender', 'Compatto, facile da usare e abbastanza versatile per qualsiasi tipo di chitarra, il Champion 40 da 40 watt è la scelta ideale come tuo primo amplificatore da stage. Controlli intuitivi, effetti fantastici e suoni versatili facilitano la creazione dei suoni giusti per rock, blues, metal, country, jazz e altro. Oltre al fantastico suono incolore, gli amplificatori Fender sono dotati di effetti che offrono una ricchezza di colori, atmosfere e trame sonore. Include riverbero, delay, chorus, tremolo e molto altro.', 199.00),
(6, 'RC-3', 'BOSS', 'RC-3 garantisce tre ore di registrazione stereo direttamente nella sua memoria interna. Ora potrete registrare senza dovervi preoccupare del limite di tempo ed avrete a disposizione 99 locazioni di memoria per salvare e richiamare immediatamente le vostre creazioni. Per tutti coloro che utilizzano strumenti stereofonici RC-3 dispone di I/O stereo. Una volta create le vostre performance potrete comodamente trasferirle su un PC grazie alla porta USB 2.0.', 149.99),
(7, 'AF75 BS', 'Ibanez', 'Ibanez ha introdotto la serie Artcore nel 2002 ed è stata la chitarra hollow-body preferita dai musicisti degli ultimi 10 anni. La combinazione Artcore di qualità di lavorazione e convenienza ha creato schiere di fan da diversi generi come blues, country, rock e jazz. Artcore è molto rispettata per il suo suono, il sustain e il modo in cui tiene l''accordatura.', 421.00),
(8, 'S300V Vintage Sunburst', 'Eko', 'Dopo la ricerca e le sperimentazioni del nostro laboratorio di liuteria abbiamo trovato interessante proporre strumenti dallo stile vintage, stile che non perde mai il suo fascino. Grazie a particolari colorazioni e finiture potrai vivere l''esperienza di suonare uno strumento dallo stile vintage intramontabile ad un prezzo contenuto.', 119.99),
(9, 'Pacifica 212 VFM', 'Yamaha', 'Si presenta con accattivanti figure in acero sulla parte superiore del body e sulla paletta, la Pacifica212VFM è una variante della Pacifica 112V sviluppato appositamente, e che è stato molto apprezzato con la Pacifica112J. Questo modello offre le stesse caratteristiche della Pacifica112V, come i pickup in Alnico e la funzione coil tap, mentre il suo bellissimo top acero fiammato offre una presenza senza precedenti con il suo look di alta classe. Questo modello ha anche figure in acero sulla sua paletta con una finitura corrispondente. Sono disponibili tre colori trasparenti per mettere in evidenza i disegni dell''acero con un look di alta classe.', 330.00),
(10, 'Marco Polo SO', 'Eko', 'Marco Polo SO è la chitarra di Eko Guitars costruita con top in Abete Italiano, fasce e fondo in Ovangkol e manico in Mogano, tastiera e ponte in South American Roupanà. Grazie alle sue dimensioni ridotte, scala da 610 mm e larghezza al capotasto da 43 mm, la Marco Polo SO è la traveler guitar ideale per il musicista sempre in movimento.', 689.99),
(11, 'Axis Capo Gold', 'ErnieBall', 'Le caratteristiche ergonomiche di Ernie Ball Axis Capo consentono cambi di chiavi con una sola mano veloci e precisi. Il design a doppio raggio è conforme alle tastiere piatte o curve, assicurando un funzionamento senza ronzio su chitarre elettriche e acustiche a 6 o 7 corde.\r\nAdatto a tutti i tipi di chitarra', 12.00);

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
('BOSS', 'info@boss.it', '345018212', 'Verona', 'via Verdi, 109', '32421'),
('Cort ', 'info@cort.it', '345902392', 'Padova', 'via Paolotti, 120', '35010'),
('Daddario', 'info@daddario.it', '348765920', 'Roma', 'via Verdi 22', '20101'),
('Eko', 'info@eko.com', '002689312', 'Milano', 'via Garibaldi, 33', '56021'),
('Epiphone', 'epiphone@gibson.com', '0265931541', 'Milano', 'via Milano 110', '20019'),
('ErnieBall', 'info@ernieball.it', '001560332', 'Firenza', 'via Rossi, 65', '42739'),
('Esp', 'info@esp.com', '00291023', 'Padova', 'via Garibaldi, 67', '35010'),
('Fender', 'info@fender.com', '0265931546', 'Roma', 'via roma 120', '0020'),
('Gibson', 'info@gibson.com', '0265931542', 'Milano', 'via roma 100', '20019'),
('Ibanez', 'info@ibanez.com', '0265931544', 'Roma', 'via roma 121', '0020'),
('Marshall', 'info@marshall.com', '006271311', 'Roma', 'via Verdi, 113', '0030'),
('Yamaha', 'info@yamaha.it', '34269540', 'Milano', 'via Verdi, 120', '20012');

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
-- Struttura per la vista `getaccessori`
--
DROP TABLE IF EXISTS `getaccessori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getaccessori`  AS  select `prodotto`.`codice_prodotto` AS `codice_prodotto`,`prodotto`.`modello` AS `modello`,`prodotto`.`produttore` AS `produttore`,`prodotto`.`descrizione` AS `descrizione`,`prodotto`.`prezzo_vendita` AS `prezzo_vendita`,`accessorio`.`categoria` AS `categoria` from ((`accessorio` join `prodotto` on((`accessorio`.`codice_accessorio` = `prodotto`.`codice_prodotto`))) join `produttore` on((`prodotto`.`produttore` = `produttore`.`ragione_sociale`))) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `getchitarre`
--
DROP TABLE IF EXISTS `getchitarre`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getchitarre`  AS  select `prodotto`.`codice_prodotto` AS `codice_prodotto`,`prodotto`.`modello` AS `modello`,`prodotto`.`produttore` AS `produttore`,`prodotto`.`descrizione` AS `descrizione`,`prodotto`.`prezzo_vendita` AS `prezzo_vendita`,`chitarra`.`legno_manico` AS `legno_manico`,`chitarra`.`legno_corpo` AS `legno_corpo`,`chitarra`.`tipo_chitarra` AS `tipo_chitarra` from ((`chitarra` join `prodotto` on((`chitarra`.`cod_chitarra` = `prodotto`.`codice_prodotto`))) join `produttore` on((`prodotto`.`produttore` = `produttore`.`ragione_sociale`))) ;

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
  MODIFY `codice_prodotto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
