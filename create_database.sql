-- --------------------------------------------------------
-- Host:                         nitinankeel.ch
-- Server Version:               5.7.22 - MySQL Community Server (GPL)
-- Server Betriebssystem:        Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für iotw910
DROP DATABASE IF EXISTS `iotw910`;
CREATE DATABASE IF NOT EXISTS `iotw910` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `iotw910`;

-- Exportiere Struktur von Tabelle iotw910.tbl_books
DROP TABLE IF EXISTS `tbl_books`;
CREATE TABLE IF NOT EXISTS `tbl_books` (
  `id` char(60) COLLATE utf8_unicode_ci NOT NULL,
  `bookname` text COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `releasedate` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `author` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chapters` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;