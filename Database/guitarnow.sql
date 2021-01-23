-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 22, 2021 alle 18:32
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
(3, 'acero', 'acero', 'Elettrica'),
(7, 'abete', 'acero', 'Semiacustica'),
(8, 'ontano', 'acero', 'Elettrica'),
(9, 'ontano', 'palissandro', 'Elettrica'),
(10, 'mogano', 'abete', 'Acustica'),
(12, 'acero', 'palissandro', 'Elettrica'),
(13, 'mogano', 'abete', 'Classica'),
(14, 'ontano', 'acero', 'Elettrica'),
(15, 'abete', 'acero', 'Elettrica');


-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `id_commento` int(11) NOT NULL,
  `descrizione` text NOT NULL,
  `voto` int(1) NOT NULL,
  `data` date NOT NULL ,
  `codice_prodotto` int(11) NOT NULL,
  `user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id_commento`, `descrizione`, `voto`, `data`, `codice_prodotto`, `user`) VALUES
(1, 'Ne ho comprata una circa 2 mesi fa. Ottimo prodotto per un chitarrista che vuole upgradare la propria strumentazione. ', 4, '2020-12-01', 1, 'Mark'),
(2, 'Prima volta che acquisto presso GuitarNow  e sono veramente soddisfatto del servizio ricevuto. Ottimi commessi disponibili e preparati. Per quanto riguarda il prodotto che dire assolutamente soddisfatto dell\'acquisto. ', 5, '2019-06-12', 11, 'Mark'),
(3, 'Buon rapporto qualità prezzo. Consiglio l\'acquisto.', 3, '2020-12-07', 6, 'Marco90'),
(4, 'Deluso dall\'acquisto. Mi aspettavo di meglio.', 1, '2021-01-01', 1, 'Marco90');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getaccessori`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getaccessori` (
`codice_prodotto` int(11)
,`modello` varchar(50)
,`path` tinytext
,`produttore` varchar(30)
,`descrizione` text
,`prezzo` float(6,2)
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
,`descrizione` text
,`prezzo` float(6,2)
,`legno_manico` varchar(30)
,`legno_corpo` varchar(30)
,`tipologia` varchar(20)
,`produttore` varchar(30)
,`path` tinytext
,`long_desc` text
,`alt` tinytext
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getcommenti`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getcommenti` (
`id_commento` int(11)
,`username` varchar(10)
,`descrizione` text
,`voto` int(1)
,`data` date
,`codice_prodotto` int(11)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getspecificheaccesssorii`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getspecificheaccesssorii` (
`codice_accessorio` int(11)
,`categoria` varchar(15)
,`path` tinytext
,`long_desc` text
,`short_desc` tinytext
,`codice_prodotto` int(11)
,`modello` varchar(50)
,`produttore` varchar(30)
,`descrizione` text
,`prezzo` float(6,2)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getspecifichechitarre`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `getspecifichechitarre` (
`cod_chitarra` int(11)
,`legno_manico` varchar(30)
,`legno_corpo` varchar(30)
,`tipo_chitarra` varchar(20)
,`path` tinytext
,`long_desc` text
,`short_desc` tinytext
,`codice_prodotto` int(11)
,`modello` varchar(50)
,`produttore` varchar(30)
,`descrizione` text
,`prezzo` float(6,2)
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

--
-- Dump dei dati per la tabella `immagine`
--

INSERT INTO `immagine` (`id_immagine`, `path`, `short_desc`, `codice_prodotto`) VALUES
(1, 'Images/Les_paul_studio.jpg', 'anteprima Epiphone Les Paul Studio in vendita ', 1),
(2, 'Images/Les_paul_standard_hp_2018.jpg',  'anteprima Gibson Les Paul Standard HP 2018 in vendita ', 2),
(3, 'Images/Stratocaster_MN_black.jpg', 'anteprima Fender Stratocaster MN Black in vendita', 3),
(4, 'Images/Daddario_Ej4_light.jpg',  'anteprima Daddario Ej4 Light in vendita', 4),
(5, 'Images/Fender_champion_40.jpg', 'anteprima Fender Champion40 in vendita', 5),
(6, 'Images/RC3.jpg', 'anteprima Boss RC-3 in vendita', 6),
(7, 'Images/AF75_BS.jpg', 'anteprima Ibanez AF75 BS in vendita', 7),
(8, 'Images/S300_vintage_sunburst.jpg', 'anteprima Eko S300 Vintage Sunburst in vendita', 8),
(9, 'Images/Pacifica_212_vfm.jpg', 'anteprima Yamaha Pacifica 212 VFM in vendita', 9),
(10, 'Images/Marco_polo_so.jpg', 'anteprima Eko Marco Polo SO in vendita', 10),
(11, 'Images/Axis_capo_gold.jpg', 'anteprima ErnieBall Axis Gold in vendita', 11),
(12, 'Images/Roadcore_premium.jpg', 'anteprima Ibanez Roadcore Premium da inserire', 12),
(13, 'Images/Cort_AC100.jpg', 'anteprima Cort AC100 in vendita', 13),
(14, 'Images/Telecaster.jpg', 'anteprima Fender Telecaster MN in vendita', 14),
(15, 'Images/Ibanez_RG.jpg', 'anteprima Ibanez RG in vendita', 15);

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
(1, 'Les Paul Studio', 'Epiphone', 'La chitarra elettrica <span xml:lang=\"en\" >Epiphone Les Paul Studio</span>, appartenente alla <span xml:lang=\"en\" >\"Inspired by Gibson Collection\"</span>, offre agli appassionati del marchio il modello progettato da <span xml:lang=\"en\" >Gibson</span> negli anni 80 per offrire ad un prezzo contenuto una vera <span xml:lang=\"en\" >Les Paul</span> semplice ma completa. Il suono di questa chitarra elettrica &egrave; generato da una coppia di <span xml:lang=\"en\" >pickup Alnico Classic</span> ed <span xml:lang=\"en\" >Alnico Classic Plus</span>, dal suono caldo e corposo, ottimi sia sui suoni puliti che sui distorti.', 450.00),
(2, 'Les Paul Standard HP 2018', 'Gibson', 'La <span xml:lang=\"en\" >Les Paul Standard HP</span> conserva molte caratteristiche delle <span xml:lang=\"en\" >Gibson</span> popolari, tra cui il profilo asimmetrico del manico <span xml:lang=\"en\" >Slim Taper</span>. Il modello <span xml:lang=\"en\" >HP</span> offre innovazioni all\'avanguardia per i chitarristi che guardano oltre, tra le quali un accesso veloce alla parte bassa della tastiera, larghezza del manico da solista e sellette regolabili in titanio. La chitarra garantisce una variet&agrave; timbrica eccezionale.\r\n', 2599.00),
(3, 'Stratocaster MN Black', 'Fender', 'Il suono ispiratore di una <span xml:lang=\"en\" >Stratocaster</span> &egrave; uno dei fondamenti <span xml:lang=\"en\" >Fender</span>. &Egrave; caratterizzata da un suono classico, medi potenti ed una fascia bassa robusta. Lo strumento inoltre &egrave; abbastanza versatile e permette di gestire qualsiasi stile. Rompendo con la tradizione, Fender ha aggiunto un controllo del tono dedicato per il <span xml:lang=\"en\" >pickup</span> al ponte, dando un maggiore controllo sul suono nelle posizioni del <span xml:lang=\"en\" >pickup</span> 1 e 2.\r\n', 639.00),
(4, 'EJ41 Light', 'Daddario', 'Le corde Daddario EJ41 in <span xml:lang=\"en\" >nylon</span> per chitarra classica sono perfette per i principianti, gli studenti e i professionisti. Questo set di corde a tensione normale contiene 3 cant&igrave;ni in <span xml:lang=\"en\" >nylon</span> e 3 bassi <span xml:lang=\"en\" >Silver-plated</span> <span xml:lang=\"en\" >Copper-wound</span> per garantire un ottimo bilanciamento tra timbri caldi e timbri nitidi.', 12.00),
(5, 'Champion 40', 'Fender', 'Compatto, facile da usare e versatile per qualsiasi tipo di chitarra. Il <span xml:lang=\"en\" >Champion</span> da 40 <span xml:lang=\"en\" >watt</span> &egrave; la scelta ideale come tuo primo amplificatore. Controlli intuitivi, effetti fantastici facilitano la creazione dei suoni giusti per <span xml:lang=\"en\" >rock</span>, <span xml:lang=\"en\" >blues</span>, <span xml:lang=\"en\" >metal</span> e altro. Gli amplificatori <span xml:lang=\"en\" >Fender</span> sono dotati di effetti che offrono una ricchezza di colori, atmosfere e trame sonore. Include riverbero, <span xml:lang=\"en\" >delay</span>, <span xml:lang=\"en\" >chorus</span>, tremolo e molto altro.', 199.00),
(6, 'RC-3', 'BOSS', 'RC-3 garantisce tre ore di registrazione stereo direttamente nella sua memoria interna. Ora potrete registrare senza dovervi preoccupare del limite di tempo ed avrete a disposizione 99 locazioni di memoria per salvare e richiamare immediatamente le vostre creazioni. Una volta create le vostre <span xml:lang=\"en\" >performance</span> potrete comodamente trasferirle su un PC grazie alla porta USB 2.0.', 149.99),
(7, 'AF75 BS', 'Ibanez', 'Ibanez ha introdotto la serie <span xml:lang=\"en\" >Artcore</span> nel 2002 ed &egrave; stata la chitarra <span xml:lang=\"en\" >hollow-body</span> preferita dai musicisti degli ultimi 10 anni. La combinazione tra qualit&agrave; di lavorazione e convenienza ha creato schiere di fan da diversi generi come <span xml:lang=\"en\" >blues</span>, <span xml:lang=\"en\" >country</span>, <span xml:lang=\"en\" >rock</span> e <span xml:lang=\"en\" >jazz</span>. <span xml:lang=\"en\" >Artcore</span> &egrave; molto rispettata per il suo suono, il <span xml:lang=\"en\" >sustain</span> e il modo in cui tiene l\'accordatura.', 421.00),
(8, 'S300V Vintage Sunburst', 'Eko', 'Dopo la ricerca e le sperimentazioni del nostro laboratorio di liuteria abbiamo trovato interessante proporre strumenti dallo stile <span xml:lang=\"en\" >vintage</span>, stile che non perde mai il suo fascino. Grazie a particolari colorazioni e finiture potrai vivere l\'esperienza di suonare uno strumento dallo stile intramontabile ad un prezzo contenuto.', 119.99),
(9, 'Pacifica 212 VFM', 'Yamaha', 'Si presenta con accattivanti figure in acero sulla parte superiore del corpo e sulla paletta, la Pacifica 212VFM &egrave; una variante della Pacifica 112V sviluppato appositamente. Questo modello offre <span xml:lang=\"en\" >pickup</span> in Alnico e la funzione <span xml:lang=\"en\" >coil-tap</span>, mentre il suo bellissimo corpo in acero fiammato offre una presenza senza precedenti con il suo <span xml:lang=\"en\" >look</span> di alta classe. Questo modello ha anche figure in acero sulla sua paletta con una finitura corrispondente. Sono disponibili tre colori trasparenti per mettere in evidenza i disegni di alta classe.', 330.00),
(10, 'Marco Polo SO', 'Eko', 'Marco Polo SO &egrave; la chitarra di <span xml:lang=\"en\" >Eko Guitars</span> costruita con corpo in Abete Italiano, fasce e fondo in palissandro e manico in Mogano. Grazie alle sue dimensioni ridotte, scala da 610 millimetri e larghezza al capotasto da 43 millimetri, la Marco Polo SO &egrave; la chitarra da viaggio ideale per il musicista sempre in movimento.', 689.99),
(11, 'Axis Capo Gold', 'ErnieBall', 'Le caratteristiche ergonomiche di <span xml:lang=\"en\" >ErnieBall</span> <span xml:lang=\"en\" >Axis</span> Capo consentono cambi di chiavi con una sola mano veloci e precisi. Il <span xml:lang=\"en\" >design</span> a doppio raggio &egrave; conforme alle tastiere piatte o curve, assicurando un funzionamento senza ronzio su chitarre elettriche e acustiche a 6 o 7 corde.\r\nAdatto a tutti i tipi di chitarra', 12.00),
(12, 'Roadcore Premium', 'Ibanez', 'L\'<span xml:lang=\"en\" >Ibanez</span> <span xml:lang=\"en\" >Roadcore</span> <span xml:lang=\"en\" >Premium</span> dispone di un corpo in palissandro e un manico in acero con una tastiera in palissandro. Il suono  caldo di questo strumento &egrave; generato dai <span xml:lang=\"en\" >pickup</span> cromati. Dispone inoltre di un custodia rigida inclusa.', 799.99),
(13, 'AC100', 'Cort ', 'I modelli in stile AC tradizionali sono stati rielaborati per migliorare la risonanza e per ottenere un suono di chitarra classica autentico. La buona combinazione di legni produce un suono tradizionale, profondo e piacevolmente morbido. La serie <span xml:lang=\"en\" >Cort</span> AC &egrave; molto indulgente verso gli errori degli studenti, poich&egrave; richiede meno precisione e nitidezza per avere un buon suono.', 160.00),
(14, 'Telecaster MN', 'Fender', 'La <span xml:lang=\"en\" >Telecaster</span> MN &egrave; progettata per l\'aspirante chitarrista. Caratterizzata dai toni iconici di <span xml:lang=\"en\" >Fender</span> e dallo stile accoppiato con componenti moderni. Il classico corpo <span xml:lang=\"en\" >Telecaster</span> a singola spalla mancante, realizzato in ontano, offre un suono ben bilanciato e dinamico. Sia il manico che la tastiera sono costruiti in acero, che migliora il tono con un sacco di luminosit&agrave; e sostegno.', 699.99),
(15, 'RG Standard', 'Ibanez', 'La chitarra Ibanez RG Standard &egrave; perfetta per tutti quei chitarristi che vogliono acquistare uno strumento semi professionale ad un prezzo accessibile. I legni della chitarra le danno un aspetto esotico e naturale perfetto per tutti gli amanti delle chitarre vintage.  ', 600.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `permessi` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `permessi`) VALUES
('admin', 'admin', 'admini@gmail.com', 1),
('Marco90', '134', 'marco.rossi@yhaoo.com', 0),
('Mark', '123', 'mark@gamil.com', 0),
('user', 'user', 'user@gmail.com', 0);

-- --------------------------------------------------------

--
-- Struttura per vista `getaccessori`
--
DROP TABLE IF EXISTS `getaccessori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getaccessori`  AS  select `prodotto`.`codice_prodotto` AS `codice_prodotto`,`prodotto`.`modello` AS `modello`,`immagine`.`path` AS `path`,`prodotto`.`produttore` AS `produttore`,`prodotto`.`descrizione` AS `descrizione`,`prodotto`.`prezzo_vendita` AS `prezzo`,`accessorio`.`categoria` AS `categoria` from ((`accessorio` join `prodotto` on(`accessorio`.`codice_accessorio` = `prodotto`.`codice_prodotto`)) join `immagine` on(`prodotto`.`codice_prodotto` = `immagine`.`codice_prodotto`)) ;

-- --------------------------------------------------------

--
-- Struttura per vista `getchitarre`
--
DROP TABLE IF EXISTS `getchitarre`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getchitarre`  AS  select `prodotto`.`codice_prodotto` AS `codice_prodotto`,`prodotto`.`modello` AS `modello`,`prodotto`.`descrizione` AS `descrizione`,`prodotto`.`prezzo_vendita` AS `prezzo`,`chitarra`.`legno_manico` AS `legno_manico`,`chitarra`.`legno_corpo` AS `legno_corpo`,`chitarra`.`tipo_chitarra` AS `tipologia`,`prodotto`.`produttore` AS `produttore`,`immagine`.`path` AS `path`,`immagine`.`short_desc` AS `alt` from ((`chitarra` join `prodotto`) join `immagine`) where `prodotto`.`codice_prodotto` = `chitarra`.`cod_chitarra` and `immagine`.`codice_prodotto` = `prodotto`.`codice_prodotto` ;

-- --------------------------------------------------------

--
-- Struttura per vista `getcommenti`
--
DROP TABLE IF EXISTS `getcommenti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getcommenti`  AS  select `c`.`id_commento` AS `id_commento`,`u`.`username` AS `username`,`c`.`descrizione` AS `descrizione`,`c`.`voto` AS `voto`,`c`.`data` AS `data`,`p`.`codice_prodotto` AS `codice_prodotto` from ((`user` `u` join `prodotto` `p`) join `commento` `c`) where `u`.`username` = `c`.`user` and `p`.`codice_prodotto` = `c`.`codice_prodotto` ;

-- --------------------------------------------------------

--
-- Struttura per vista `getspecificheaccesssorii`
--
DROP TABLE IF EXISTS `getspecificheaccesssorii`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getspecificheaccesssorii`  AS  select distinct `a`.`codice_accessorio` AS `codice_accessorio`,`a`.`categoria` AS `categoria`,`i`.`path` AS `path`,`i`.`short_desc` AS `short_desc`,`p1`.`codice_prodotto` AS `codice_prodotto`,`p1`.`modello` AS `modello`,`p1`.`produttore` AS `produttore`,`p1`.`descrizione` AS `descrizione`,`p1`.`prezzo_vendita` AS `prezzo` from ((`accessorio` `a` join `immagine` `i`) join `prodotto` `p1`) where `a`.`codice_accessorio` = `p1`.`codice_prodotto` and `i`.`codice_prodotto` = `p1`.`codice_prodotto` ;

-- --------------------------------------------------------

--
-- Struttura per vista `getspecifichechitarre`
--
DROP TABLE IF EXISTS `getspecifichechitarre`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getspecifichechitarre`  AS  select distinct `c`.`cod_chitarra` AS `cod_chitarra`,`c`.`legno_manico` AS `legno_manico`,`c`.`legno_corpo` AS `legno_corpo`,`c`.`tipo_chitarra` AS `tipo_chitarra`,`i`.`path` AS `path`,`i`.`short_desc` AS `short_desc`,`p1`.`codice_prodotto` AS `codice_prodotto`,`p1`.`modello` AS `modello`,`p1`.`produttore` AS `produttore`,`p1`.`descrizione` AS `descrizione`,`p1`.`prezzo_vendita` AS `prezzo` from ((`chitarra` `c` join `immagine` `i`) join `prodotto` `p1`) where `c`.`cod_chitarra` = `p1`.`codice_prodotto` and `i`.`codice_prodotto` = `p1`.`codice_prodotto` ;

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
  ADD PRIMARY KEY (`codice_prodotto`);

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
  MODIFY `id_commento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `id_immagine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `codice_prodotto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
