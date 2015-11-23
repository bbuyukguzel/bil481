-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 23 Kas 2015, 09:43:45
-- Sunucu sürümü: 5.5.46-0ubuntu0.14.04.2
-- PHP Sürümü: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `bil481`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Birim`
--

CREATE TABLE IF NOT EXISTS `Birim` (
  `BirimID` int(11) NOT NULL AUTO_INCREMENT,
  `BirimAdi` varchar(255) NOT NULL,
  PRIMARY KEY (`BirimID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Tablo döküm verisi `Birim`
--

INSERT INTO `Birim` (`BirimID`, `BirimAdi`) VALUES
(1, 'Genel Cerrahi'),
(2, 'Ortopedi ve Travmatoloji'),
(3, 'Nöroloji');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Doktor`
--

CREATE TABLE IF NOT EXISTS `Doktor` (
  `TC` varchar(11) NOT NULL,
  `Ad` varchar(255) NOT NULL,
  `Soyad` varchar(255) NOT NULL,
  `EPosta` varchar(255) NOT NULL,
  `Sifre` varchar(255) NOT NULL,
  `BirimID` int(11) NOT NULL,
  PRIMARY KEY (`TC`),
  KEY `BirimID` (`BirimID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Doktor`
--

INSERT INTO `Doktor` (`TC`, `Ad`, `Soyad`, `EPosta`, `Sifre`, `BirimID`) VALUES
('12345', 'hasan', 'tok', 'deneme@d.com', 'bla', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Hasta`
--

CREATE TABLE IF NOT EXISTS `Hasta` (
  `TC` varchar(11) NOT NULL,
  `Ad` varchar(255) NOT NULL,
  `Soyad` varchar(255) NOT NULL,
  `Cinsiyet` varchar(10) NOT NULL,
  `DTarih` date NOT NULL,
  `EPosta` varchar(255) NOT NULL,
  `Telefon` varchar(255) NOT NULL,
  `Adres` varchar(255) NOT NULL,
  `Sifre` varchar(255) NOT NULL,
  PRIMARY KEY (`TC`),
  UNIQUE KEY `EPosta` (`EPosta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Hasta`
--

INSERT INTO `Hasta` (`TC`, `Ad`, `Soyad`, `Cinsiyet`, `DTarih`, `EPosta`, `Telefon`, `Adres`, `Sifre`) VALUES
('asd', 'asd', 'asda', 'sdas', '0000-00-00', 'sdasdasd@asd.com', 'asd', 'ddd', 'dd'),
('bb', 'bb', 'bb', 'bb', '0000-00-00', 'bb@aa.com', 'ss', 'ss', 'ss'),
('qq', 'qqqq', 'qq', 'qqq', '0000-00-00', 'qqq@hotm.com', 'qqqq', 'qq', 'qqqqq');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Yonetici`
--

CREATE TABLE IF NOT EXISTS `Yonetici` (
  `TC` varchar(11) NOT NULL,
  `Sifre` varchar(255) NOT NULL,
  PRIMARY KEY (`TC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Yonetici`
--

INSERT INTO `Yonetici` (`TC`, `Sifre`) VALUES
('batuhan', 'bb');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `Doktor`
--
ALTER TABLE `Doktor`
  ADD CONSTRAINT `Doktor_ibfk_1` FOREIGN KEY (`BirimID`) REFERENCES `Birim` (`BirimID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
