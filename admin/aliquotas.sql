-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.8-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-02-10 00:46:34
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table bvcontabilidade.aliquotas
CREATE TABLE IF NOT EXISTS `aliquotas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aliquota8` double DEFAULT NULL,
  `aliquota9` varchar(255) DEFAULT NULL,
  `aliquota11` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table bvcontabilidade.aliquotas: ~1 rows (approximately)
/*!40000 ALTER TABLE `aliquotas` DISABLE KEYS */;
INSERT INTO `aliquotas` (`id`, `aliquota8`, `aliquota9`, `aliquota11`) VALUES
	(1, 1399.12, '1399.13|2331.88', '2331.89|4663.75');
/*!40000 ALTER TABLE `aliquotas` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
