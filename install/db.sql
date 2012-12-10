-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.27 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-11-01 15:12:43
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for wenku-demo
DROP DATABASE IF EXISTS `wenku-demo`;
CREATE DATABASE IF NOT EXISTS `wenku-demo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `wenku-demo`;


-- Dumping structure for table wenku-demo.docs
DROP TABLE IF EXISTS `docs`;
CREATE TABLE IF NOT EXISTS `docs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `size` float unsigned DEFAULT NULL,
  `origin_path` varchar(200) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `status` enum('pending','success','fail') DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table wenku-demo.docs: ~0 rows (approximately)
DELETE FROM `docs`;
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
