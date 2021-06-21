-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Giu 21, 2021 alle 14:46
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
(3, 'acero', 'acero', 'Elettrica'),
(7, 'abete', 'acero', 'Semiacustica'),
(8, 'ontano', 'acero', 'Elettrica'),
(9, 'ontano', 'palissandro', 'Elettrica'),
(10, 'mogano', 'abete', 'Acustica'),
(12, 'acero', 'palissandro', 'Elettrica'),
(16, 'abete', 'acero', 'Elettrica'),
(42, 'mogano', 'acero', 'Semiacustica');

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

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id_commento`, `descrizione`, `voto`, `data`, `codice_prodotto`, `user`) VALUES
(2, 'Prima volta che acquisto presso GuitarNow  e sono veramente soddisfatto del servizio ricevuto. Ottimi commessi disponibili e preparati. Per quanto riguarda il prodotto che dire assolutamente soddisfatto dell''acquisto. ', 5, '2019-06-12', 11, 'Mark'),
(3, 'Buon rapporto qualità prezzo. Consiglio l''acquisto.', 3, '2020-12-07', 6, 'Marco90'),
(4, 'Buono strumento. Otiimo suono.', 4, '2021-06-17', 3, 'user');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getaccessori`
--
CREATE TABLE `getaccessori` (
`codice_prodotto` int(11)
,`modello` varchar(50)
,`path` tinytext
,`produttore` varchar(30)
,`descrizione` text
,`prezzo` float(6,2)
,`categoria` varchar(15)
,`alt` text
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getchitarre`
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
,`alt` text
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getcommenti`
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
--
CREATE TABLE `getspecificheaccesssorii` (
`codice_accessorio` int(11)
,`categoria` varchar(15)
,`path` tinytext
,`long_desc` text
,`short_desc` text
,`codice_prodotto` int(11)
,`modello` varchar(50)
,`produttore` varchar(30)
,`descrizione` text
,`prezzo` float(6,2)
);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `getspecifichechitarre`
--
CREATE TABLE `getspecifichechitarre` (
`cod_chitarra` int(11)
,`legno_manico` varchar(30)
,`legno_corpo` varchar(30)
,`tipo_chitarra` varchar(20)
,`path` tinytext
,`long_desc` text
,`short_desc` text
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
  `short_desc` text NOT NULL,
  `codice_prodotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `immagine`
--

INSERT INTO `immagine` (`id_immagine`, `path`, `long_desc`, `short_desc`, `codice_prodotto`) VALUES
(3, 'Images/Stratocaster_MN_black.jpg', 'Anteprima Fender Stratocaster nera.Il corpo si presenta di colore nero e il battipenna bianco. Manico da 24 tasti con texture di legno chiaro. Sul corpo ci sono 2 selettori per il volume e uno per il suono. È una chitarra elettrica di fascia medio-alta. Ottima per chitarristi con qualche anno di esperienza. Molto versatile e adatta a qualsiasi genere musicale.', 'Chitarra elettrica dal corpo di colore nero. Manico da 24 e selettori per il volume e per il suono.', 3),
(4, 'Images/Daddario_Ej4_light.jpg', 'Anteprima Daddario Ej4 argentate. Corde per chitarra acustica in nichel. Modello più sottile e morbido rispetto alle corde standard. Ottime per una maggiore velocità e consigliate per i chitarristi solisti.', 'Confezione di 6 corde argentate per acustica morbide e poco spesse. ', 4),
(5, 'Images/Fender_champion_40.jpg', 'Anteprima Fender Champion40 da 40 watt. La cassa presenta una clorazione nera scura ed è alta 40 centimetri e larga 25. Sul davanti presenta inoltre le entrata per il cavo e una serie di selettori per il volume e gli effetti.  Ottimo amplificatore per principianti che cercano una cassa poco ingombrante e facile da trasportare. Possibilità di modificare il suono dello strumento con oltre 30 effetti.', 'Cassa di colore nero alta 40 e larga 25 centimetri. Presenta una serie di selettori per gli effetti. ', 5),
(6, 'Images/RC3.jpg', 'Anteprima Boss RC-3.Pedalina di forma rettangolare e di colore rosso. Sulla parte alta presenta i tasti per far partire la registrazione e un piccolo schermo col numero di traccia. Ottima per registrare e mettere in loop le proprie creazioni. Sia per chitarra acustica che per elettrica.', 'Effetto loop di colore rosso. Sulla parte alta presenta i tasti per registrare e editare la traccia.', 6),
(7, 'Images/AF75_BS.jpg', 'Anteprima Ibanez AF75 BS bianca. La chitarra presenta un corpo di colore bianco con meccaniche e decorazioni di color oro. La paletta e il manico da 24 tasti hanno una colorazione nera. Sul corpo sono presenti tre selettori per il suono e un tremolo. È una semiacustica versatile sia per chi ama il rock sia per chi preferisce sonorità da chitarra classica. Adatta a chi ha già qualche anno di esperienza con lo strumento.', 'Chitarra semiacustica di colore bianco con meccaniche oro. Presenta 3 selettori per il suono.', 7),
(8, 'Images/S300_vintage_sunburst.jpg', 'Anteprima Eko S300. La chitarra presenta una colorazione marrone sfumato col nero. Il battipenna è dii colore bianco mentre il manico da 22 tasti presenta una colorazione di legno più scuro. Sul corpo ci sono tre selettori per il suona e il volume. Buona chitarra elettrica per chi si vuole approcciare per la prima volta al mondo della musica.', 'Chitarra elettrica con colorazione marrone sfumato e battipenna bianco. Manico di 22 tasti. ', 8),
(9, 'Images/Pacifica_212_vfm.jpg', 'Anteprima Yamaha Pacifica 212 VFM. Il corpo e la paletta della chitarra presentano una colorazione nero opaca. Il manico è da 24 tasti e presenta anch''esso un colore scuro. Sul corpo è presente un battipenna bianco e 3 selettori per il suono. Chitarra di fascia medio bassa versatile per suonare un po'' di tutto. Consigliata per chi ha già suonato in passato e vuole fare un upgrade dello strumento. ', 'Chitarra elettrica di colore nero opaco. Il manico è da 24 tasti in legno con colorazione scura.', 9),
(10, 'Images/Marco_polo_so.jpg', 'Anteprima Eko Marco Polo S. Il corpo dello strumento è di un bianco perlaceo e non presenta battipenna. La lunghezza del manico è di 22 tasti e presenta una colorazione più scura in legno. Chitarra classica di fascia alta. Ottimo strumento sia per i concerti live sia per la registrazione in studio.', 'Chitarra acustica color bianco perlaceo con manico di 22 tasti.', 10),
(11, 'Images/Axis_capo_gold.jpg', 'Anteprima capotasto ErnieBall Axis Gold versione argentata. Uno tra i migliori capotasti attualmente sul mercato. Non può mancare tra gli accessori di un chitarrista. Presenta una colorazione metallizzata e due fasce in gomma per evitare di danneggiare il manico quando vengono bloccate le corde.', 'Capotasto color metallo con 2 fasce in gomma per non danneggiare le corde quando vengono bloccate.', 11),
(13, 'Images/Roadcore_premium.jpg', 'Anteprima Ibanez Roadcore Premium. Attualmente fuori produzione è una dei modelli Ibanez più particolari. Consigliata per chi vuole avere tra le mani un gioiellino che si discosta completamente dai marchi più famosi di chitarre.  La chitarra presenta una colorazione completamente effetto legno. Sul corpo sono presenti 3 selettori per il volume e il suono. È inoltre sprovvista di battipenna.', 'Chitarra elettrica effetto legno. Sul corpo sono presenti 3 selettori per il volume e il suono.', 12),
(16, 'Images/Ibanez_RG.jpg', 'Anteprima Ibanez RG colorazione effetto legno. Uno dei modelli più classici delle chitarra elettriche Ibanez. Strumento super versatile di fascia medio alta. La chitarra presenta una colorazione effetto legno sul corpo e il manico. Le meccaniche e la paletta sono invece di colore nero opaco. Sul corpo sono presenti 2 selettori per il volume e uno switch per il suono.', 'Chitarra elettrica con colorazione effetto legno. Le meccaniche sono invece di colore nero opaco. ', 16);

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
(3, 'Stratocaster MN ', 'Fender', 'Il suono ispiratore di una <span lang="en" >Stratocaster</span> &egrave; uno dei fondamenti <span lang="en" >Fender</span>. &Egrave; caratterizzata da un suono classico, medi potenti ed una fascia bassa robusta. Lo strumento inoltre &egrave; abbastanza versatile e permette di gestire qualsiasi stile. Rompendo con la tradizione, Fender ha aggiunto un controllo del tono dedicato per il <span lang="en" >pickup</span> al ponte, dando un maggiore controllo sul suono nelle posizioni del <span lang="en" >pickup</span> 1 e 2.\n', 639.00),
(4, 'EJ41 Light', 'Daddario', 'Le corde Daddario EJ41 in <span lang="en" >nylon</span> per chitarra classica sono perfette per i principianti, gli studenti e i professionisti. Questo set di corde a tensione normale contiene 3 cant&igrave;ni in <span lang="en" >nylon</span> e 3 bassi <span lang="en" >Silver-plated</span> <span lang="en" >Copper-wound</span> per garantire un ottimo bilanciamento tra timbri caldi e timbri nitidi.', 12.00),
(5, 'Champion 40', 'Fender', 'Compatto, facile da usare e versatile per qualsiasi tipo di chitarra. Il <span lang="en" >Champion</span> da 40 <span lang="en" >watt</span> &egrave; la scelta ideale come tuo primo amplificatore. Controlli intuitivi, effetti fantastici facilitano la creazione dei suoni giusti per <span lang="en" >rock</span>, <span lang="en" >blues</span>, <span lang="en" >metal</span> e altro. Gli amplificatori <span lang="en" >Fender</span> sono dotati di effetti che offrono una ricchezza di colori, atmosfere e trame sonore. Include riverbero, <span lang="en" >delay</span>, <span lang="en" >chorus</span>, tremolo e molto altro.', 199.00),
(6, 'RC-3', 'BOSS', 'RC-3 garantisce tre ore di registrazione stereo direttamente nella sua memoria interna. Ora potrete registrare senza dovervi preoccupare del limite di tempo ed avrete a disposizione 99 locazioni di memoria per salvare e richiamare immediatamente le vostre creazioni. Una volta create le vostre <span lang="en" >performance</span> potrete comodamente trasferirle su un PC grazie alla porta USB 2.0.', 149.99),
(7, 'AF75 BS', 'Ibanez', 'Ibanez ha introdotto la serie <span lang="en" >Artcore</span> nel 2002 ed &egrave; stata la chitarra <span lang="en" >hollow-body</span> preferita dai musicisti degli ultimi 10 anni. La combinazione tra qualit&agrave; di lavorazione e convenienza ha creato schiere di fan da diversi generi come <span lang="en" >blues</span>, <span lang="en" >country</span>, <span lang="en" >rock</span> e <span lang="en" >jazz</span>. <span lang="en" >Artcore</span> &egrave; molto rispettata per il suo suono, il <span lang="en" >sustain</span> e il modo in cui tiene l''accordatura.', 421.00),
(8, 'S300V Vintage Sunburst', 'Eko', 'Dopo la ricerca e le sperimentazioni del nostro laboratorio di liuteria abbiamo trovato interessante proporre strumenti dallo stile <span lang="en" >vintage</span>, stile che non perde mai il suo fascino. Grazie a particolari colorazioni e finiture potrai vivere l''esperienza di suonare uno strumento dallo stile intramontabile ad un prezzo contenuto.', 119.99),
(9, 'Pacifica 212 VFM', 'Yamaha', 'Si presenta con accattivanti figure in acero sulla parte superiore del corpo e sulla paletta, la Pacifica 212VFM &egrave; una variante della Pacifica 112V sviluppato appositamente. Questo modello offre <span lang="en" >pickup</span> in Alnico e la funzione <span lang="en" >coil-tap</span>, mentre il suo bellissimo corpo in acero fiammato offre una presenza senza precedenti con il suo <span lang="en" >look</span> di alta classe. Questo modello ha anche figure in acero sulla sua paletta con una finitura corrispondente. Sono disponibili tre colori trasparenti per mettere in evidenza i disegni di alta classe.', 330.00),
(10, 'Marco Polo SO', 'Eko', 'Marco Polo SO &egrave; la chitarra di <span lang="en" >Eko Guitars</span> costruita con corpo in Abete Italiano, fasce e fondo in palissandro e manico in Mogano. Grazie alle sue dimensioni ridotte, scala da 610 millimetri e larghezza al capotasto da 43 millimetri, la Marco Polo SO &egrave; la chitarra da viaggio ideale per il musicista sempre in movimento.', 689.99),
(11, 'Axis Capo Gold', 'ErnieBall', 'Le caratteristiche ergonomiche di <span lang="en" >ErnieBall</span> <span lang="en" >Axis</span> Capo consentono cambi di chiavi con una sola mano veloci e precisi. Il <span lang="en" >design</span> a doppio raggio &egrave; conforme alle tastiere piatte o curve, assicurando un funzionamento senza ronzio su chitarre elettriche e acustiche a 6 o 7 corde.\r\nAdatto a tutti i tipi di chitarra', 12.00),
(12, 'Roadcore Premium', 'Ibanez', 'L''<span lang="en" >Ibanez</span> <span lang="en" >Roadcore</span> <span lang="en" >Premium</span> dispone di un corpo in palissandro e un manico in acero con una tastiera in palissandro. Il suono  caldo di questo strumento &egrave; generato dai <span lang="en" >pickup</span> cromati. Dispone inoltre di un custodia rigida inclusa.', 799.99),
(16, 'RG Standard', 'Ibanez', 'La chitarra Ibanez RG Standard Ã¨ perfetta per tutti quei chitarristi che vogliono acquistare uno strumento semi professionale ad un prezzo accessibile. I legni della chitarra le danno un aspetto esotico e naturale perfetto per tutti gli amanti delle chitarre vintage.  ', 600.00),
(42, '1231', 'Fender', ' 32131', 123.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `permessi` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `permessi`) VALUES
('Admin', 'Admin', 'admini@gmail.com', 1),
('ciaonao63', 'Qwert', 'jonww@re.nm', 0),
('Jon56', '1234Qweo', 'jon@gmail.com', 0),
('Marco90', '134Qw', 'marco.rossi@yhaoo.com', 0),
('Mark', '123Qw', 'mark@gamil.com', 0),
('user', 'User1', 'user@gmail.com', 0);

-- --------------------------------------------------------

--
-- Struttura per la vista `getaccessori`
--
DROP TABLE IF EXISTS `getaccessori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getaccessori`  AS  select `prodotto`.`codice_prodotto` AS `codice_prodotto`,`prodotto`.`modello` AS `modello`,`immagine`.`path` AS `path`,`prodotto`.`produttore` AS `produttore`,`prodotto`.`descrizione` AS `descrizione`,`prodotto`.`prezzo_vendita` AS `prezzo`,`accessorio`.`categoria` AS `categoria`,`immagine`.`short_desc` AS `alt` from ((`accessorio` join `prodotto` on((`accessorio`.`codice_accessorio` = `prodotto`.`codice_prodotto`))) join `immagine` on((`prodotto`.`codice_prodotto` = `immagine`.`codice_prodotto`))) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `getchitarre`
--
DROP TABLE IF EXISTS `getchitarre`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getchitarre`  AS  select `prodotto`.`codice_prodotto` AS `codice_prodotto`,`prodotto`.`modello` AS `modello`,`prodotto`.`descrizione` AS `descrizione`,`prodotto`.`prezzo_vendita` AS `prezzo`,`chitarra`.`legno_manico` AS `legno_manico`,`chitarra`.`legno_corpo` AS `legno_corpo`,`chitarra`.`tipo_chitarra` AS `tipologia`,`prodotto`.`produttore` AS `produttore`,`immagine`.`path` AS `path`,`immagine`.`long_desc` AS `long_desc`,`immagine`.`short_desc` AS `alt` from ((`chitarra` join `prodotto`) join `immagine`) where ((`prodotto`.`codice_prodotto` = `chitarra`.`cod_chitarra`) and (`immagine`.`codice_prodotto` = `prodotto`.`codice_prodotto`)) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `getcommenti`
--
DROP TABLE IF EXISTS `getcommenti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getcommenti`  AS  select `c`.`id_commento` AS `id_commento`,`u`.`username` AS `username`,`c`.`descrizione` AS `descrizione`,`c`.`voto` AS `voto`,`c`.`data` AS `data`,`p`.`codice_prodotto` AS `codice_prodotto` from ((`user` `u` join `prodotto` `p`) join `commento` `c`) where ((`u`.`username` = `c`.`user`) and (`p`.`codice_prodotto` = `c`.`codice_prodotto`)) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `getspecificheaccesssorii`
--
DROP TABLE IF EXISTS `getspecificheaccesssorii`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getspecificheaccesssorii`  AS  select distinct `a`.`codice_accessorio` AS `codice_accessorio`,`a`.`categoria` AS `categoria`,`i`.`path` AS `path`,`i`.`long_desc` AS `long_desc`,`i`.`short_desc` AS `short_desc`,`p1`.`codice_prodotto` AS `codice_prodotto`,`p1`.`modello` AS `modello`,`p1`.`produttore` AS `produttore`,`p1`.`descrizione` AS `descrizione`,`p1`.`prezzo_vendita` AS `prezzo` from ((`accessorio` `a` join `immagine` `i`) join `prodotto` `p1`) where ((`a`.`codice_accessorio` = `p1`.`codice_prodotto`) and (`i`.`codice_prodotto` = `p1`.`codice_prodotto`)) ;

-- --------------------------------------------------------

--
-- Struttura per la vista `getspecifichechitarre`
--
DROP TABLE IF EXISTS `getspecifichechitarre`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getspecifichechitarre`  AS  select distinct `c`.`cod_chitarra` AS `cod_chitarra`,`c`.`legno_manico` AS `legno_manico`,`c`.`legno_corpo` AS `legno_corpo`,`c`.`tipo_chitarra` AS `tipo_chitarra`,`i`.`path` AS `path`,`i`.`long_desc` AS `long_desc`,`i`.`short_desc` AS `short_desc`,`p1`.`codice_prodotto` AS `codice_prodotto`,`p1`.`modello` AS `modello`,`p1`.`produttore` AS `produttore`,`p1`.`descrizione` AS `descrizione`,`p1`.`prezzo_vendita` AS `prezzo` from ((`chitarra` `c` join `immagine` `i`) join `prodotto` `p1`) where ((`c`.`cod_chitarra` = `p1`.`codice_prodotto`) and (`i`.`codice_prodotto` = `p1`.`codice_prodotto`)) ;

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
  MODIFY `id_commento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `id_immagine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `codice_prodotto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
