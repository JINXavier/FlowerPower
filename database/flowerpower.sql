-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 apr 2021 om 18:14
-- Serverversie: 10.4.18-MariaDB
-- PHP-versie: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowerpower`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE `artikel` (
  `idartikel` int(11) NOT NULL,
  `plaatje` varchar(255) NOT NULL,
  `artikelnaam` varchar(45) NOT NULL,
  `omschrijving` varchar(255) NOT NULL,
  `prijs` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`idartikel`, `plaatje`, `artikelnaam`, `omschrijving`, `prijs`) VALUES
(1, '1619467737_bloemen1.png', 'Bloemen 1', 'Mooie bos bloemen', '34.00'),
(2, '1619466040_bloemen2.jpg', 'Bloemen 2', 'Mooie bos bloemen', '48.00'),
(3, '1619466054_bloemen3.png', 'Bloemen 3', 'Mooie bos bloemen', '67.00'),
(4, '1619466064_bloemen4.jpg', 'Bloemen 4', 'Mooie bos bloemen', '47.00'),
(5, '1619466075_bloemen5.png', 'Bloemen 5', 'Mooie bos bloemen', '75.00'),
(6, '1619531064_bloemen5.png', 'test', 'test', '34.33');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel_has_factuur`
--

CREATE TABLE `artikel_has_factuur` (
  `idartikel_has_factuur` int(11) NOT NULL,
  `idfactuur` int(11) NOT NULL,
  `artikelnaam` varchar(45) NOT NULL,
  `artikelprijs` varchar(45) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `artikel_has_factuur`
--

INSERT INTO `artikel_has_factuur` (`idartikel_has_factuur`, `idfactuur`, `artikelnaam`, `artikelprijs`, `aantal`) VALUES
(7, 3, 'Bloemen 1', '34.00', 1),
(8, 3, 'Bloemen 5', '75.00', 2),
(9, 3, 'Bloemen 3', '67.00', 3),
(10, 4, 'Bloemen 1', '34.00', 1),
(11, 4, 'Bloemen 2', '48.00', 1),
(12, 4, 'Bloemen 3', '67.00', 1),
(13, 4, 'Bloemen 5', '75.00', 12),
(14, 5, 'Bloemen 1', '34.00', 1),
(15, 5, 'Bloemen 3', '67.00', 1),
(16, 6, 'Bloemen 2', '48.00', 1),
(17, 6, 'Bloemen 3', '67.00', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `factuur`
--

CREATE TABLE `factuur` (
  `idfactuur` int(11) NOT NULL,
  `idklant` int(11) NOT NULL,
  `datum` date NOT NULL,
  `factuurnummer` int(11) NOT NULL,
  `afgehaald` varchar(45) NOT NULL,
  `idmedewerker` int(11) NOT NULL,
  `idwinkel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `factuur`
--

INSERT INTO `factuur` (`idfactuur`, `idklant`, `datum`, `factuurnummer`, `afgehaald`, `idmedewerker`, `idwinkel`) VALUES
(3, 1, '2021-04-26', 1619466207, 'Afgehaald', 1, 1),
(4, 1, '2021-04-27', 1619475803, 'Afgehaald', 1, 1),
(5, 1, '2021-04-27', 1619530983, 'Nog niet afgehaald', 1, 1),
(6, 1, '2021-04-27', 1619533615, 'Nog niet afgehaald', 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `idklant` int(11) NOT NULL,
  `voornaam` varchar(45) NOT NULL,
  `tussenvoegsel` varchar(45) NOT NULL,
  `achternaam` varchar(45) NOT NULL,
  `adres` varchar(45) NOT NULL,
  `huisnummer` varchar(45) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `plaats` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefoon` varchar(10) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`idklant`, `voornaam`, `tussenvoegsel`, `achternaam`, `adres`, `huisnummer`, `postcode`, `plaats`, `email`, `telefoon`, `wachtwoord`) VALUES
(1, 'Sander', 'van der', 'Spek', 'Markopoloweg', '34', '3824DE', 'Almere', 'svs@hotmail.com', '1234567891', '$2y$10$B9nxGX624jJhctusH50BvOX/QcFWZA61NVW9bJ1PMKDeVZu4HoZqu');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerker`
--

CREATE TABLE `medewerker` (
  `idmedewerker` int(11) NOT NULL,
  `voornaam` varchar(45) NOT NULL,
  `tussenvoegsel` varchar(45) NOT NULL,
  `achternaam` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `medewerker`
--

INSERT INTO `medewerker` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `email`, `wachtwoord`) VALUES
(1, 'Dirk', 'van der', 'Broek', 'Dvdb@flowerpower.com', '$2y$10$FvYq1WfcB/34JAhMO2O7yecvpQ8ALnF9sS9dTYNYdSVrcTt1RFGye'),
(2, 'rest', '', 'test', 'test@test.test', '$2y$10$Ve6wNIytF0hvdQvnvssdfuik4ylvdqMSOeE.Vq.cpUDqx/F1bGmf.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `winkel`
--

CREATE TABLE `winkel` (
  `idwinkel` int(11) NOT NULL,
  `winkelAdres` varchar(255) NOT NULL,
  `winkelHuisnr` varchar(45) NOT NULL,
  `winkelPostcode` varchar(6) NOT NULL,
  `winkelStad` varchar(45) NOT NULL,
  `winkelTelefoonnummer` varchar(10) NOT NULL,
  `winkelMail` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `winkel`
--

INSERT INTO `winkel` (`idwinkel`, `winkelAdres`, `winkelHuisnr`, `winkelPostcode`, `winkelStad`, `winkelTelefoonnummer`, `winkelMail`) VALUES
(1, '\r\nOudezijds Achterburgwal', '154a', '1012DH', 'Amsterdam', '0624560403', 'amsterdam@flowerpower.nl');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`idartikel`);

--
-- Indexen voor tabel `artikel_has_factuur`
--
ALTER TABLE `artikel_has_factuur`
  ADD PRIMARY KEY (`idartikel_has_factuur`),
  ADD KEY `fk_artikel_has_factuur_factuur1_idx` (`idfactuur`);

--
-- Indexen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD PRIMARY KEY (`idfactuur`),
  ADD UNIQUE KEY `factuurnummer_UNIQUE` (`factuurnummer`),
  ADD KEY `fk_factuur_klant_idx` (`idklant`),
  ADD KEY `fk_factuur_medewerker1_idx` (`idmedewerker`),
  ADD KEY `fk_factuur_winkel1_idx` (`idwinkel`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`idklant`);

--
-- Indexen voor tabel `medewerker`
--
ALTER TABLE `medewerker`
  ADD PRIMARY KEY (`idmedewerker`);

--
-- Indexen voor tabel `winkel`
--
ALTER TABLE `winkel`
  ADD PRIMARY KEY (`idwinkel`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `idartikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `artikel_has_factuur`
--
ALTER TABLE `artikel_has_factuur`
  MODIFY `idartikel_has_factuur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `factuur`
--
ALTER TABLE `factuur`
  MODIFY `idfactuur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `idklant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `medewerker`
--
ALTER TABLE `medewerker`
  MODIFY `idmedewerker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `winkel`
--
ALTER TABLE `winkel`
  MODIFY `idwinkel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `artikel_has_factuur`
--
ALTER TABLE `artikel_has_factuur`
  ADD CONSTRAINT `fk_artikel_has_factuur_factuur1` FOREIGN KEY (`idfactuur`) REFERENCES `factuur` (`idfactuur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD CONSTRAINT `fk_factuur_klant` FOREIGN KEY (`idklant`) REFERENCES `klant` (`idklant`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factuur_medewerker1` FOREIGN KEY (`idmedewerker`) REFERENCES `medewerker` (`idmedewerker`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factuur_winkel1` FOREIGN KEY (`idwinkel`) REFERENCES `winkel` (`idwinkel`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
