-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for logondb
DROP DATABASE IF EXISTS `logondb`;
CREATE DATABASE IF NOT EXISTS `logondb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `logondb`;

-- Dumping structure for table logondb.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` char(6) NOT NULL,
  `adminemail` varchar(45) NOT NULL,
  `adminname` varchar(45) NOT NULL,
  UNIQUE KEY `adminemail` (`adminemail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`idadmin`, `adminemail`, `adminname`) VALUES
	('ADM001', 'admin@admin.com', 'Admin Satu');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table logondb.agent
DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `idagent` char(6) NOT NULL,
  `idinsurer` char(6) NOT NULL,
  `agentname` varchar(45) NOT NULL,
  `agentemail` varchar(45) NOT NULL,
  `agentidentitynumber` varchar(16) NOT NULL,
  `agentphone` varchar(14) NOT NULL,
  `agentaddress` varchar(255) NOT NULL,
  `agentgender` char(1) NOT NULL,
  `agentbirthdate` date NOT NULL,
  `idbranch` char(6) NOT NULL,
  `lat` varchar(15) NOT NULL,
  `lang` varchar(15) NOT NULL,
  `agentstatus` char(1) NOT NULL,
  PRIMARY KEY (`idagent`),
  UNIQUE KEY `agentemail` (`agentemail`),
  KEY `fkbranchtoagent` (`idbranch`),
  KEY `fkinsurertoagent` (`idinsurer`),
  CONSTRAINT `fkbranchtoagent` FOREIGN KEY (`idbranch`) REFERENCES `branch` (`idbranch`),
  CONSTRAINT `fkinsurertoagent` FOREIGN KEY (`idinsurer`) REFERENCES `insurer` (`idinsurer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.agent: ~14 rows (approximately)
/*!40000 ALTER TABLE `agent` DISABLE KEYS */;
INSERT INTO `agent` (`idagent`, `idinsurer`, `agentname`, `agentemail`, `agentidentitynumber`, `agentphone`, `agentaddress`, `agentgender`, `agentbirthdate`, `idbranch`, `lat`, `lang`, `agentstatus`) VALUES
	('AGN001', 'INS001', 'Nanda Dwi Raharjo', 'nanda@logon.com', '3515000001239857', '081591210818', 'Kota Bandung no. 11', 'm', '1992-08-24', 'BDG001', '2', '2', '1'),
	('AGN002', 'INS002', 'Anggi Pramesti', 'anggi@logon.com', '3515000001230912', '081591211211', 'Kota Bandung no. 12', 'f', '1992-08-24', 'BDG002', '2', '2', '1'),
	('AGN003', 'INS003', 'Raditya Dika', 'raditya@logon.com', '3515000001231100', '081585671211', 'Jakarta Pusat no. 11', 'm', '1992-08-24', 'JTP001', '2', '2', '1'),
	('AGN004', 'INS004', 'Donna Agnesia', 'donna@logon.com', '3515000001236271', '081585676541', 'Jakarta Pusat no. 12', 'f', '1992-08-24', 'JTP002', '2', '2', '1'),
	('AGN005', 'INS005', 'Dini Pratiwi', 'dini@logon.com', '3515120001236271', '089885676541', 'Jakarta Utara no. 11', 'f', '1992-08-24', 'JTU001', '2', '2', '1'),
	('AGN006', 'INS006', 'Reta Dimas Sarjono', 'reta@logon.com', '3515120071621627', '089885671623', 'Jakarta Utara no. 12', 'f', '1992-08-24', 'JTU002', '2', '2', '1'),
	('AGN007', 'INS009', 'Sarjono Eka', 'sarjono@logon.com', '3515001200012364', '081285670010', 'Jakarta Barat no. 11', 'm', '1992-08-24', 'JTB001', '2', '2', '1'),
	('AGN008', 'INS010', 'Nurul Rahmi', 'nurul@logon.com', '3515001200010010', '081201210010', 'Jakarta Barat no. 12', 'f', '1992-08-24', 'JTB002', '2', '2', '1'),
	('AGN009', 'INS007', 'Atmaja Tri Risma', 'atmaja@logon.com', '3515664509280010', '085790691283', 'Jakarta Selatan no. 11', 'm', '1992-08-24', 'JTS001', '2', '2', '1'),
	('AGN010', 'INS008', 'Idham Khalid Adi', 'idham@logon.com', '3515664509280000', '085790697366', 'Jakarta Selatan no. 12', 'm', '1992-08-24', 'JTS002', '2', '2', '1'),
	('AGN011', 'INS011', 'Ardy Irham', 'ardy@logon.com', '3515088109280011', '085690697225', 'Jakarta Timur no. 11', 'm', '1992-08-24', 'JTM001', '2', '2', '1'),
	('AGN012', 'INS012', 'Amelia Yusana', 'amelia@logon.com', '3515033109280023', '085690697001', 'Jakarta Timur no. 12', 'f', '1992-08-24', 'JTM002', '2', '2', '1'),
	('AGN013', 'INS013', 'Indri Widiastuti', 'indri@logon.com', '3515033109282300', '085890697001', 'Kota Solo no. 11', 'f', '1992-08-24', 'SOL001', '2', '2', '1'),
	('AGN014', 'INS014', 'Andra Ahmad', 'andra@logon.com', '3515000009282300', '085870019221', 'Kota Solo no. 12', 'm', '1992-08-24', 'SOL002', '2', '2', '1');
/*!40000 ALTER TABLE `agent` ENABLE KEYS */;

-- Dumping structure for table logondb.armada
DROP TABLE IF EXISTS `armada`;
CREATE TABLE IF NOT EXISTS `armada` (
  `idarmada` char(6) NOT NULL,
  `idcourier` char(6) NOT NULL,
  `vehiclenumber` varchar(10) NOT NULL,
  `drivername` varchar(45) NOT NULL,
  `armadaphone` varchar(14) NOT NULL,
  `idvehicletype` char(3) NOT NULL,
  `maxweight` float NOT NULL,
  `maxlengthdimension` float NOT NULL,
  `maxwidthdimension` float NOT NULL,
  `maxheightdimension` float NOT NULL,
  `armadastatus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idarmada`),
  UNIQUE KEY `vehiclenumber` (`vehiclenumber`),
  UNIQUE KEY `armadaphone` (`armadaphone`),
  KEY `fkvehicletypetoarmada` (`idvehicletype`),
  KEY `fkcouriertoarmada` (`idcourier`),
  CONSTRAINT `fkcouriertoarmada` FOREIGN KEY (`idcourier`) REFERENCES `courier` (`idcourier`),
  CONSTRAINT `fkvehicletypetoarmada` FOREIGN KEY (`idvehicletype`) REFERENCES `vehicletype` (`idvehicletype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.armada: ~14 rows (approximately)
/*!40000 ALTER TABLE `armada` DISABLE KEYS */;
INSERT INTO `armada` (`idarmada`, `idcourier`, `vehiclenumber`, `drivername`, `armadaphone`, `idvehicletype`, `maxweight`, `maxlengthdimension`, `maxwidthdimension`, `maxheightdimension`, `armadastatus`) VALUES
	('ARM001', 'COU001', 'D1000BDG', 'Driver Kota Bandung 1', '0220909001', 'BOX', 50, 3, 3, 3, '1'),
	('ARM002', 'COU002', 'D2000BDG', 'Driver Kota Bandung 2', '0220909002', 'CON', 50, 3, 3, 3, '1'),
	('ARM003', 'COU003', 'B1001JTP', 'Driver Jakarta Pusat 1', '0220909003', 'TRK', 50, 3, 3, 3, '1'),
	('ARM004', 'COU004', 'B1002JTP', 'Driver Jakarta Pusat 2', '0220909004', 'SED', 50, 3, 3, 3, '1'),
	('ARM005', 'COU005', 'B2001JTU', 'Driver Jakarta Utara 1', '0220909005', 'BUS', 50, 3, 3, 3, '1'),
	('ARM006', 'COU006', 'B2002JTU', 'Driver Jakarta Utara 2', '0220909006', 'BOX', 50, 3, 3, 3, '1'),
	('ARM007', 'COU007', 'B3001JTS', 'Driver Jakarta Selatan 1', '0220909007', 'CON', 50, 3, 3, 3, '1'),
	('ARM008', 'COU008', 'B3002JTS', 'Driver Jakarta Selatan 2', '0220909008', 'TRK', 50, 3, 3, 3, '1'),
	('ARM009', 'COU009', 'B4001JTB', 'Driver Jakarta Barat 1', '0220909009', 'SED', 50, 3, 3, 3, '1'),
	('ARM010', 'COU010', 'B4002JTB', 'Driver Jakarta Barat 2', '0220909010', 'BUS', 50, 3, 3, 3, '1'),
	('ARM011', 'COU011', 'B5001JTM', 'Driver Jakarta Timur 1', '0220909011', 'BOX', 50, 3, 3, 3, '1'),
	('ARM012', 'COU012', 'B5002JTM', 'Driver Jakarta Timur 2', '0220909012', 'SED', 50, 3, 3, 3, '1'),
	('ARM013', 'COU013', 'AD0001SOL', 'Driver Kota Solo 1', '0220909013', 'CON', 50, 3, 3, 3, '1'),
	('ARM014', 'COU014', 'AD0002SOL', 'Driver Kota Solo 2', '0220909014', 'CON', 50, 3, 3, 3, '1');
/*!40000 ALTER TABLE `armada` ENABLE KEYS */;

-- Dumping structure for table logondb.branch
DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `idbranch` char(6) NOT NULL,
  `branchname` varchar(60) NOT NULL,
  `branchaddress` varchar(150) NOT NULL,
  `branchphone` varchar(14) NOT NULL,
  `branchmanager` varchar(45) NOT NULL,
  `bmemail` varchar(45) NOT NULL,
  `idcity` char(3) NOT NULL,
  `lat` varchar(15) NOT NULL,
  `lang` varchar(15) NOT NULL,
  `branchstatus` char(1) NOT NULL,
  PRIMARY KEY (`idbranch`),
  UNIQUE KEY `bmemail` (`bmemail`),
  KEY `fk_citytobranch` (`idcity`),
  CONSTRAINT `fk_citytobranch` FOREIGN KEY (`idcity`) REFERENCES `city` (`idcity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.branch: ~14 rows (approximately)
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` (`idbranch`, `branchname`, `branchaddress`, `branchphone`, `branchmanager`, `bmemail`, `idcity`, `lat`, `lang`, `branchstatus`) VALUES
	('BDG001', 'LogOn Kota Bandung 1', 'Jalan Kota Bandung no. 1', '089855347756', 'Rhea Meionna', 'bdg001@logon.com', 'BDG', '3', '3', '1'),
	('BDG002', 'LogOn Kota Bandung 2', 'Jalan Kota Bandung no. 2', '089812009300', 'Roisah Maulidiya', 'bdg002@logon.com', 'BDG', '3', '3', '1'),
	('JTB001', 'LogOn Jakarta Barat 1', 'Jalan Jakarta Barat no. 1', '085611424498', 'Rafif Dzulfikar', 'jtb001@logon.com', 'JTB', '3', '3', '1'),
	('JTB002', 'LogOn Jakarta Barat 2', 'Jalan Jakarta Barat no. 2', '085600437721', 'Amri Ahmadi', 'jtb002@logon.com', 'JTB', '3', '3', '1'),
	('JTM001', 'LogOn Jakarta Timur 1', 'Jalan Jakarta Timur no. 1', '081576229844', 'Nia Assegaf', 'jtm001@logon.com', 'JTM', '3', '3', '1'),
	('JTM002', 'LogOn Jakarta Timur 2', 'Jalan Jakarta Timur no. 2', '081513246475', 'Nadya Annisa', 'jtm002@logon.com', 'JTM', '3', '3', '1'),
	('JTP001', 'LogOn Jakarta Pusat 1', 'Jalan Jakarta Pusat no. 1', '081200992211', 'Billy Permana', 'jkp001@logon.com', 'JTP', '3', '3', '1'),
	('JTP002', 'LogOn Jakarta Pusat 2', 'Jalan Jakarta Pusat no. 2', '081200991122', 'Eric Sayoga', 'jkp002@logon.com', 'JTP', '3', '3', '1'),
	('JTS001', 'LogOn Jakarta Selatan 1', 'Jalan Jakarta Selatan no. 1', '085722416654', 'Shafril Ariadi', 'jts001@logon.com', 'JTS', '3', '3', '1'),
	('JTS002', 'LogOn Jakarta Selatan 2', 'Jalan Jakarta Selatan no. 2', '085764558477', 'Fahmi Shahab', 'jts002@logon.com', 'JTS', '3', '3', '1'),
	('JTU001', 'LogOn Jakarta Utara 1', 'Jalan Jakarta Utara no. 1', '085812980293', 'Faizul Azmi', 'jtu001@logon.com', 'JTU', '3', '3', '1'),
	('JTU002', 'LogOn Jakarta Utara 2', 'Jalan Jakarta Utara no. 2', '085888346675', 'Bimo Saputra', 'jtu002@logon.com', 'JTU', '3', '3', '1'),
	('SOL001', 'LogOn Kota Solo', 'Jalan Kota Solo no. 1', '088812773488', 'Awang Putra', 'sol001@logon.com', 'SOL', '3', '3', '1'),
	('SOL002', 'LogOn Kota Solo 2', 'Jalan Kota Solo no. 2', '088845168573', 'Qanita Nabillah', 'sol002@logon.com', 'SOL', '3', '3', '1');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;

-- Dumping structure for table logondb.cargocategory
DROP TABLE IF EXISTS `cargocategory`;
CREATE TABLE IF NOT EXISTS `cargocategory` (
  `idcargocategory` char(3) NOT NULL,
  `category` varchar(25) NOT NULL,
  PRIMARY KEY (`idcargocategory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.cargocategory: ~6 rows (approximately)
/*!40000 ALTER TABLE `cargocategory` DISABLE KEYS */;
INSERT INTO `cargocategory` (`idcargocategory`, `category`) VALUES
	('ELK', 'Elektronik'),
	('KIM', 'Bahan Kimia Padat'),
	('KUL', 'Makanan atau Minuman'),
	('LIM', 'Bahan Kimia Cair'),
	('PBH', 'Pecah Belah'),
	('REG', 'Barang Biasa');
/*!40000 ALTER TABLE `cargocategory` ENABLE KEYS */;

-- Dumping structure for table logondb.cargocategoryofarmada
DROP TABLE IF EXISTS `cargocategoryofarmada`;
CREATE TABLE IF NOT EXISTS `cargocategoryofarmada` (
  `idarmada` char(6) NOT NULL,
  `idcargocategory` char(3) NOT NULL,
  KEY `fkcargocategorytothistable` (`idcargocategory`),
  KEY `fkarmadatothistable` (`idarmada`),
  CONSTRAINT `fkarmadatothistable` FOREIGN KEY (`idarmada`) REFERENCES `armada` (`idarmada`),
  CONSTRAINT `fkcargocategorytothistable` FOREIGN KEY (`idcargocategory`) REFERENCES `cargocategory` (`idcargocategory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.cargocategoryofarmada: ~28 rows (approximately)
/*!40000 ALTER TABLE `cargocategoryofarmada` DISABLE KEYS */;
INSERT INTO `cargocategoryofarmada` (`idarmada`, `idcargocategory`) VALUES
	('ARM001', 'LIM'),
	('ARM001', 'KIM'),
	('ARM002', 'REG'),
	('ARM002', 'ELK'),
	('ARM003', 'KUL'),
	('ARM003', 'PBH'),
	('ARM004', 'LIM'),
	('ARM004', 'KIM'),
	('ARM005', 'REG'),
	('ARM005', 'ELK'),
	('ARM006', 'KUL'),
	('ARM006', 'PBH'),
	('ARM007', 'LIM'),
	('ARM007', 'KIM'),
	('ARM008', 'REG'),
	('ARM008', 'ELK'),
	('ARM009', 'KUL'),
	('ARM009', 'PBH'),
	('ARM010', 'LIM'),
	('ARM010', 'KIM'),
	('ARM011', 'REG'),
	('ARM011', 'ELK'),
	('ARM012', 'PBH'),
	('ARM012', 'KUL'),
	('ARM013', 'LIM'),
	('ARM013', 'KIM'),
	('ARM014', 'REG'),
	('ARM014', 'ELK');
/*!40000 ALTER TABLE `cargocategoryofarmada` ENABLE KEYS */;

-- Dumping structure for table logondb.city
DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `idcity` char(3) NOT NULL,
  `city` varchar(35) NOT NULL,
  `idprovince` char(3) NOT NULL,
  PRIMARY KEY (`idcity`),
  KEY `fkprovincetocity` (`idprovince`),
  CONSTRAINT `fkprovincetocity` FOREIGN KEY (`idprovince`) REFERENCES `province` (`idprovince`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.city: ~7 rows (approximately)
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` (`idcity`, `city`, `idprovince`) VALUES
	('BDG', 'Kota Bandung', 'JBR'),
	('JTB', 'Jakarta Barat', 'DKI'),
	('JTM', 'Jakarta Timur', 'DKI'),
	('JTP', 'Jakarta Pusat', 'DKI'),
	('JTS', 'Jakarta Selatan', 'DKI'),
	('JTU', 'Jakarta Utara', 'DKI'),
	('SOL', 'Solo', 'JTG');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;

-- Dumping structure for table logondb.complaint
DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `receiptnumber` varchar(20) NOT NULL,
  `complaintdate` datetime NOT NULL,
  `complaint` text NOT NULL,
  `complaintstatus` char(1) NOT NULL,
  KEY `fkfixedbookingtocomplaint` (`receiptnumber`),
  CONSTRAINT `fkfixedbookingtocomplaint` FOREIGN KEY (`receiptnumber`) REFERENCES `fixedbooking` (`receiptnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.complaint: ~2 rows (approximately)
/*!40000 ALTER TABLE `complaint` DISABLE KEYS */;
INSERT INTO `complaint` (`receiptnumber`, `complaintdate`, `complaint`, `complaintstatus`) VALUES
	('764119EE0BA765EBFF98', '2016-08-31 11:09:45', 'Wah ga sampe-sampe', '1'),
	('404D4CD176799D4715FC', '2016-09-04 10:38:24', 'Wah mas, belum sampai', '1');
/*!40000 ALTER TABLE `complaint` ENABLE KEYS */;

-- Dumping structure for table logondb.courier
DROP TABLE IF EXISTS `courier`;
CREATE TABLE IF NOT EXISTS `courier` (
  `idcourier` char(6) NOT NULL,
  `idowner` varchar(18) NOT NULL,
  `couriername` varchar(45) NOT NULL,
  `courieraddress` varchar(150) NOT NULL,
  `courierphone` varchar(14) NOT NULL,
  `courieremail` varchar(45) NOT NULL,
  `courierstatus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcourier`),
  UNIQUE KEY `courieremail` (`courieremail`),
  KEY `fkownertocourier` (`idowner`),
  CONSTRAINT `fkownertocourier` FOREIGN KEY (`idowner`) REFERENCES `owner` (`idowner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.courier: ~16 rows (approximately)
/*!40000 ALTER TABLE `courier` DISABLE KEYS */;
INSERT INTO `courier` (`idcourier`, `idowner`, `couriername`, `courieraddress`, `courierphone`, `courieremail`, `courierstatus`) VALUES
	('COU001', '3515000039180001', 'Kurir Bandung 1', 'Jalan Kota Bandung no. 21', '022100301', 'kurirbandung1@mail.com', '1'),
	('COU002', '3515000039180002', 'Kurir Bandung 2', 'Jalan Kota Bandung no. 22', '022100302', 'kurirbandung2@mail.com', '1'),
	('COU003', '3515000039180003', 'Kurir Jakarta Pusat 1', 'Jalan Jakarta Pusat no. 21', '022100303', 'kurirjakpus1@mail.com', '1'),
	('COU004', '3515000039180004', 'Kurir Jakarta Pusat 2', 'Jalan Jakarta Pusat no. 22', '022100304', 'kurirjakpus2@mail.com', '1'),
	('COU005', '3515000039180005', 'Kurir Jakarta Utara 1', 'Jalan Jakarta Utara no. 21', '022100305', 'kurirjakut1@mail.com', '1'),
	('COU006', '3515000039180006', 'Kurir Jakarta Utara 2', 'Jalan Jakarta Utara no. 22', '022100306', 'kurirjakut2@mail.com', '1'),
	('COU007', '3515000039180007', 'Kurir Jakarta Selatan 1', 'Jalan Jakarta Selatan no. 21', '022100307', 'kurirjaksel1@mail.com', '1'),
	('COU008', '3515000039180008', 'Kurir Jakarta Selatan 2', 'Jalan Jakarta Selatan no. 22', '022100308', 'kurirjaksel2@mail.com', '1'),
	('COU009', '3515000039180009', 'Kurir Jakarta Barat 1', 'Jalan Jakarta Barat no. 21', '022100309', 'kurirjakbar1@mail.com', '1'),
	('COU010', '3515000039180010', 'Kurir Jakarta Barat 2', 'Jalan Jakarta Barat no. 22', '022100310', 'kurirjakbar2@mail.com', '1'),
	('COU011', '3515000039180011', 'Kurir Jakarta Timur 1', 'Jalan Jakarta Timur no. 21', '022100311', 'kurirjaktim1@mail.com', '1'),
	('COU012', '3515000039180012', 'Kurir Jakarta Timur 2', 'Jalan Jakarta Timur no. 22', '022100312', 'kurirjaktim2@mail.com', '1'),
	('COU013', '3515000039180013', 'Kurir Solo 1', 'Jalan Solo no. 21', '022100313', 'kurirsolo1@mail.com', '1'),
	('COU014', '3515000039180014', 'Kurir Solo 2', 'Jalan Solo no. 22', '022100314', 'kurirsolo2@mail.com', '1'),
	('COU015', '3515000039180014', 'Kurir Solo 3', 'Jalan Solo no. 23', '022100314', 'kurirsolo3@mail.com', '0'),
	('COU016', '777778901000000190', 'Dimas Prakoso', 'Jakarta', '081235678000', 'dimasprakoso@gmail.com', '1');
/*!40000 ALTER TABLE `courier` ENABLE KEYS */;

-- Dumping structure for table logondb.fixedbooking
DROP TABLE IF EXISTS `fixedbooking`;
CREATE TABLE IF NOT EXISTS `fixedbooking` (
  `receiptnumber` varchar(20) NOT NULL,
  `idagent` char(6) NOT NULL,
  `reservationcode` char(6) NOT NULL,
  `bookingdate` datetime NOT NULL,
  `shipmentstatus` char(1) NOT NULL,
  `goodsvalue` float DEFAULT NULL,
  `insurancevalue` float DEFAULT NULL,
  PRIMARY KEY (`receiptnumber`),
  KEY `fkagenttofixedbooking` (`idagent`),
  KEY `fkreservationtofixedbooking` (`reservationcode`),
  CONSTRAINT `fkagenttofixedbooking` FOREIGN KEY (`idagent`) REFERENCES `agent` (`idagent`),
  CONSTRAINT `fkreservationtofixedbooking` FOREIGN KEY (`reservationcode`) REFERENCES `reservation` (`reservationcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.fixedbooking: ~5 rows (approximately)
/*!40000 ALTER TABLE `fixedbooking` DISABLE KEYS */;
INSERT INTO `fixedbooking` (`receiptnumber`, `idagent`, `reservationcode`, `bookingdate`, `shipmentstatus`, `goodsvalue`, `insurancevalue`) VALUES
	('404D4CD176799D4715FC', 'AGN001', 'RSV006', '2016-09-05 03:29:01', '5', 0, 0),
	('6F83F3D042F32A85EDC5', 'AGN001', 'RSV007', '2016-09-05 09:41:53', '5', 0, 0),
	('764119EE0BA765EBFF98', 'AGN001', 'RSV002', '2016-08-29 17:22:02', '5', 0, 0),
	('A0AE412A26C2469FE594', 'AGN001', 'RSV003', '2016-08-29 17:22:01', '4', 100000, 10000),
	('E10331CA4112C8161FEB', 'AGN001', 'RSV004', '2016-08-30 10:09:57', '2', 200000, 20000);
/*!40000 ALTER TABLE `fixedbooking` ENABLE KEYS */;

-- Dumping structure for table logondb.insurer
DROP TABLE IF EXISTS `insurer`;
CREATE TABLE IF NOT EXISTS `insurer` (
  `idinsurer` char(6) NOT NULL,
  `insurername` varchar(45) NOT NULL,
  `insureraddress` varchar(150) NOT NULL,
  `insurerphone` varchar(14) NOT NULL,
  `insurerstatusagent` char(1) NOT NULL,
  PRIMARY KEY (`idinsurer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.insurer: ~14 rows (approximately)
/*!40000 ALTER TABLE `insurer` DISABLE KEYS */;
INSERT INTO `insurer` (`idinsurer`, `insurername`, `insureraddress`, `insurerphone`, `insurerstatusagent`) VALUES
	('INS001', 'Muhammad Bisri', 'Kota Bandung no. 11', '085790238477', '1'),
	('INS002', 'Andi Hafiz', 'Kota Bandung no. 12', '085715300981', '1'),
	('INS003', 'Indah Dewi', 'Jakarta Pusat  no. 11', '081211036453', '1'),
	('INS004', 'Ahmad Zainuri', 'Jakarta Pusat no. 12', '081277125400', '1'),
	('INS005', 'Ridho Asarday', 'Jakarta Utara no. 11', '081517211451', '1'),
	('INS006', 'Rasyid Ridlo', 'Jakarta Utara no. 11', '081500986455', '1'),
	('INS007', 'Danang Wahyudi', 'Jakarta Selatan  no. 11', '088812337444', '1'),
	('INS008', 'Deni Herdaru', 'Jakarta Selatan no. 12', '088812038122', '1'),
	('INS009', 'Anugerah Aldisa', 'Jakarta Barat no. 11', '085621002188', '1'),
	('INS010', 'Tifan Asrori', 'Jakarta Barat no. 12', '085621883722', '1'),
	('INS011', 'Tifan Alfani', 'Jakarta Timur no. 11', '085818821992', '1'),
	('INS012', 'Anggi Tifani', 'Jakarta Timur no. 12', '085812460021', '1'),
	('INS013', 'Tetuko Aldimas', 'Kota Solo no. 11', '089800987765', '1'),
	('INS014', 'Nurhuda', 'Kota Solo no. 11', '089811873300', '1');
/*!40000 ALTER TABLE `insurer` ENABLE KEYS */;

-- Dumping structure for table logondb.logbooking
DROP TABLE IF EXISTS `logbooking`;
CREATE TABLE IF NOT EXISTS `logbooking` (
  `receiptnumber` varchar(20) NOT NULL,
  `timeevent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lat` varchar(15) NOT NULL,
  `lang` varchar(15) NOT NULL,
  `shipmentstatus` char(1) NOT NULL,
  KEY `fkfixedbookingtologbooking` (`receiptnumber`),
  CONSTRAINT `fkfixedbookingtologbooking` FOREIGN KEY (`receiptnumber`) REFERENCES `fixedbooking` (`receiptnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.logbooking: ~16 rows (approximately)
/*!40000 ALTER TABLE `logbooking` DISABLE KEYS */;
INSERT INTO `logbooking` (`receiptnumber`, `timeevent`, `lat`, `lang`, `shipmentstatus`) VALUES
	('764119EE0BA765EBFF98', '2016-08-29 09:08:39', '2', '2', '1'),
	('A0AE412A26C2469FE594', '2016-08-29 09:09:06', '2', '2', '1'),
	('A0AE412A26C2469FE594', '2016-08-29 05:22:01', '4', '4', '2'),
	('764119EE0BA765EBFF98', '2016-08-29 05:22:02', '4', '4', '2'),
	('E10331CA4112C8161FEB', '2016-08-30 10:09:57', '2', '2', '1'),
	('764119EE0BA765EBFF98', '2016-08-30 11:51:21', '3', '3', '4'),
	('A0AE412A26C2469FE594', '2016-08-30 11:51:21', '3', '3', '4'),
	('764119EE0BA765EBFF98', '2016-08-31 10:07:13', '0', '0', '5'),
	('404D4CD176799D4715FC', '2016-09-05 03:29:01', '2', '2', '1'),
	('404D4CD176799D4715FC', '2016-09-05 03:34:43', '4', '4', '2'),
	('404D4CD176799D4715FC', '2016-09-05 03:35:51', '3', '3', '4'),
	('404D4CD176799D4715FC', '2016-09-05 03:36:37', '0', '0', '5'),
	('6F83F3D042F32A85EDC5', '2016-09-05 09:41:53', '2', '2', '1'),
	('6F83F3D042F32A85EDC5', '2016-09-05 09:42:56', '4', '4', '2'),
	('6F83F3D042F32A85EDC5', '2016-09-05 09:45:37', '3', '3', '4'),
	('6F83F3D042F32A85EDC5', '2016-09-05 09:46:03', '0', '0', '5'),
	('E10331CA4112C8161FEB', '2017-01-09 12:02:29', '4', '4', '2'),
	('E10331CA4112C8161FEB', '2017-01-09 12:03:13', '3', '3', '4'),
	('E10331CA4112C8161FEB', '2017-01-11 05:49:24', '4', '4', '2');
/*!40000 ALTER TABLE `logbooking` ENABLE KEYS */;

-- Dumping structure for table logondb.login
DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `email` varchar(45) NOT NULL,
  `pwd` varchar(16) NOT NULL,
  KEY `fkadmintologin` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.login: ~44 rows (approximately)
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`email`, `pwd`) VALUES
	('admin@admin.com', 'admin'),
	('jkp001@logon.com', 'asdasd'),
	('jkp002@logon.com', 'asdasd'),
	('jtu001@logon.com', 'asdasd'),
	('jtu002@logon.com', 'asdasd'),
	('jts001@logon.com', 'asdasd'),
	('jts002@logon.com', 'asdasd'),
	('jtb001@logon.com', 'asdasd'),
	('jtb002@logon.com', 'asdasd'),
	('jtm001@logon.com', 'asdasd'),
	('jtm002@logon.com', 'asdasd'),
	('bdg001@logon.com', 'asdasd'),
	('bdg002@logon.com', 'asdasd'),
	('sol001@logon.com', 'asdasd'),
	('sol002@logon.com', 'asdasd'),
	('nanda@logon.com', 'asdasd'),
	('anggi@logon.com', 'asdasd'),
	('raditya@logon.com', 'asdasd'),
	('donna@logon.com', 'asdasd'),
	('dini@logon.com', 'asdasd'),
	('reta@logon.com', 'asdasd'),
	('sarjono@logon.com', 'asdasd'),
	('nurul@logon.com', 'asdasd'),
	('atmaja@logon.com', 'asdasd'),
	('idham@logon.com', 'asdasd'),
	('ardy@logon.com', 'asdasd'),
	('amelia@logon.com', 'asdasd'),
	('indri@logon.com', 'asdasd'),
	('andra@logon.com', 'asdasd'),
	('kurirsolo2@mail.com', 'asdasd'),
	('kurirsolo1@mail.com', 'asdasd'),
	('kurirjaktim2@mail.com', 'asdasd'),
	('kurirjaktim1@mail.com', 'asdasd'),
	('kurirjakbar2@mail.com', 'asdasd'),
	('kurirjakbar1@mail.com', 'asdasd'),
	('kurirjaksel2@mail.com', 'asdasd'),
	('kurirjaksel1@mail.com', 'asdasd'),
	('kurirjakut2@mail.com', 'asdasd'),
	('kurirjakut1@mail.com', 'asdasd'),
	('kurirjakpus2@mail.com', 'asdasd'),
	('kurirjakpus1@mail.com', 'asdasd'),
	('kurirbandung2@mail.com', 'asdasd'),
	('kurirbandung1@mail.com', 'asdasd'),
	('dimasprakoso@gmail.com', '111111');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

-- Dumping structure for table logondb.loglogin
DROP TABLE IF EXISTS `loglogin`;
CREATE TABLE IF NOT EXISTS `loglogin` (
  `email` varchar(45) NOT NULL,
  `timeevent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `loginactivity` char(1) NOT NULL,
  KEY `fklogintologlogin` (`email`),
  CONSTRAINT `fklogintologlogin` FOREIGN KEY (`email`) REFERENCES `login` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.loglogin: ~0 rows (approximately)
/*!40000 ALTER TABLE `loglogin` DISABLE KEYS */;
/*!40000 ALTER TABLE `loglogin` ENABLE KEYS */;

-- Dumping structure for table logondb.owner
DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `idowner` varchar(18) NOT NULL,
  `ownername` varchar(50) NOT NULL,
  `owneraddress` varchar(150) NOT NULL,
  `ownerphone` varchar(14) NOT NULL,
  `owneremail` varchar(45) NOT NULL,
  PRIMARY KEY (`idowner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.owner: ~15 rows (approximately)
/*!40000 ALTER TABLE `owner` DISABLE KEYS */;
INSERT INTO `owner` (`idowner`, `ownername`, `owneraddress`, `ownerphone`, `owneremail`) VALUES
	('3515000039180001', 'Budi', 'Surabaya', '031423030', 'budi@mail.com'),
	('3515000039180002', 'Andi', 'Surabaya', '031423030', 'andii@mail.com'),
	('3515000039180003', 'Rudi', 'Surabaya', '031423030', 'rudi@mail.com'),
	('3515000039180004', 'Uli', 'Surabaya', '031423030', 'uli@mail.com'),
	('3515000039180005', 'Radifan', 'Surabaya', '031423030', 'radifan@mail.com'),
	('3515000039180006', 'Eko', 'Surabaya', '031423030', 'eko@mail.com'),
	('3515000039180007', 'Bella', 'Surabaya', '031423030', 'bella@mail.com'),
	('3515000039180008', 'Desti', 'Surabaya', '031423030', 'desti@mail.com'),
	('3515000039180009', 'Hari', 'Surabaya', '031423030', 'hari@mail.com'),
	('3515000039180010', 'Ruli', 'Surabaya', '031423030', 'ruli@mail.com'),
	('3515000039180011', 'Muliawan', 'Surabaya', '031423030', 'muliawan@mail.com'),
	('3515000039180012', 'Bahar', 'Surabaya', '031423030', 'bahar@mail.com'),
	('3515000039180013', 'Akhsan', 'Surabaya', '031423030', 'akhsan@mail.com'),
	('3515000039180014', 'Liliyana', 'Surabaya', '031423030', 'liliyana@mail.com'),
	('777778901000000190', 'Ratih Ayu', 'Jakarta', '081221444112', 'ratihayu@gmail.com');
/*!40000 ALTER TABLE `owner` ENABLE KEYS */;

-- Dumping structure for table logondb.province
DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `idprovince` char(3) NOT NULL,
  `province` varchar(24) NOT NULL,
  PRIMARY KEY (`idprovince`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.province: ~35 rows (approximately)
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` (`idprovince`, `province`) VALUES
	('BAL', 'Bali'),
	('BBL', 'Bangka Belitung'),
	('BKL', 'Bengkulu'),
	('BTN', 'Banten'),
	('DIY', 'DI Yogyakarta'),
	('DKI', 'DKI Jakarta'),
	('GRT', 'Gorontalo'),
	('JBI', 'Jambi'),
	('JBR', 'Jawa Barat'),
	('JTG', 'Jawa Tengah'),
	('JTM', 'Jawa Timur'),
	('KCD', 'Kepulauan Cendrawasih'),
	('KLB', 'Kalimantan Barat'),
	('KLG', 'Kalimantan Tengah'),
	('KLS', 'Kalimantan Selatan'),
	('KLT', 'Kalimantan Timur'),
	('KLU', 'Kalimantan Utara'),
	('KRI', 'Kepulauan Riau'),
	('LPG', 'Lampung'),
	('MLK', 'Maluku'),
	('MLU', 'Maluku Utara'),
	('NAD', 'Nanggroe Aceh Darussalam'),
	('NTB', 'Nusa Tenggara Barat'),
	('NTT', 'Nusa Tenggara Timur'),
	('PAB', 'Papua Barat'),
	('PAP', 'Daerah Khusus Papua '),
	('RIU', 'Riau'),
	('SLB', 'Sulawesi Barat'),
	('SLG', 'Sulawesi Tengah'),
	('SLR', 'Sulawesi Tenggara'),
	('SLS', 'Sulawesi Selatan'),
	('SLU', 'Sulawesi Utara'),
	('SUB', 'Sumatera Barat'),
	('SUS', 'Sumatera Selatan'),
	('SUT', 'Sumatera Utara');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;

-- Dumping structure for table logondb.reservation
DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `reservationcode` char(6) NOT NULL,
  `idarmada` char(6) NOT NULL,
  `departureidbranch` char(6) NOT NULL,
  `arrivalidbranch` char(6) NOT NULL,
  `reservationdate` datetime NOT NULL,
  `deliverydate` datetime NOT NULL,
  `cargoweight` float NOT NULL,
  `cargolength` float NOT NULL,
  `cargowidth` float NOT NULL,
  `cargoheight` float NOT NULL,
  `idcargocategory` char(3) NOT NULL,
  `insurance` char(1) NOT NULL,
  `sendername` varchar(45) NOT NULL,
  `senderaddress` varchar(150) NOT NULL,
  `senderemail` varchar(45) NOT NULL,
  `senderphone` varchar(14) NOT NULL,
  `recipientname` varchar(45) NOT NULL,
  `recipientaddress` varchar(150) NOT NULL,
  `recipientphone` varchar(14) NOT NULL,
  `fare` float NOT NULL,
  `lat` varchar(15) NOT NULL,
  `lang` varchar(15) NOT NULL,
  `reservationstatus` char(1) NOT NULL,
  PRIMARY KEY (`reservationcode`),
  KEY `fkroutetoreservation` (`idarmada`,`departureidbranch`,`arrivalidbranch`),
  CONSTRAINT `fkroutetoreservation` FOREIGN KEY (`idarmada`, `departureidbranch`, `arrivalidbranch`) REFERENCES `route` (`idarmada`, `departureidbranch`, `arrivalidbranch`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.reservation: ~7 rows (approximately)
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` (`reservationcode`, `idarmada`, `departureidbranch`, `arrivalidbranch`, `reservationdate`, `deliverydate`, `cargoweight`, `cargolength`, `cargowidth`, `cargoheight`, `idcargocategory`, `insurance`, `sendername`, `senderaddress`, `senderemail`, `senderphone`, `recipientname`, `recipientaddress`, `recipientphone`, `fare`, `lat`, `lang`, `reservationstatus`) VALUES
	('RSV001', 'ARM001', 'BDG001', 'SOL001', '2016-08-26 16:49:37', '2016-08-29 21:00:00', 5, 0.1, 0.1, 0.1, 'LIM', '1', 'Fathir', 'Bandung', 'fathir@mail.com', '081', 'Dayat', 'Solo', '082', 75000, '1', '1', '1'),
	('RSV002', 'ARM001', 'BDG001', 'SOL001', '2016-08-29 09:08:39', '2016-08-29 21:00:00', 4, 0.1, 0.1, 0.1, 'LIM', '0', 'Dayat', 'Bandung', 'dayat@mail.com', '081', 'Fathir', 'Solo', '081', 60000, '1', '1', '2'),
	('RSV003', 'ARM001', 'BDG001', 'SOL001', '2016-08-29 09:09:06', '2016-08-29 21:00:00', 3, 0.1, 0.1, 0.1, 'LIM', '1', 'Fathir', 'Bandung', 'f@mail.com', '081', 'Dayat', 'Solo', '082', 45000, '1', '1', '2'),
	('RSV004', 'ARM004', 'SOL002', 'JTS001', '2016-08-30 10:09:57', '2016-09-03 21:00:00', 10, 0.1, 0.1, 0.1, 'KIM', '1', 'Dimas', 'Solo', 'dimas@mail.com', '081', 'Kiristian', 'Jakarta Selatan', '082', 200000, '1', '1', '2'),
	('RSV005', 'ARM003', 'SOL001', 'BDG001', '2016-08-29 08:07:25', '2016-09-03 21:00:00', 30, 0.1, 0.1, 0.1, 'KUL', '1', 'Nurjannah', 'Solo', 'nurjannah@mail.com', '081', 'Ninscha', 'Bandung', '082', 450000, '1', '1', '1'),
	('RSV006', 'ARM002', 'JTB002', 'BDG001', '2016-09-04 22:27:24', '2016-09-07 07:00:00', 2, 0.3, 0.2, 0.5, 'ELK', '1', 'Fathir', 'Jalan Pulogadung No. 444', 'fathirizzuddin@gmail.com', '085790697366', 'Dayat', 'Jalan Cipedes Atas No. 41', '085790697722', 14000, '1', '1', '2'),
	('RSV007', 'ARM002', 'JTB002', 'BDG001', '2016-09-05 04:39:35', '2016-09-14 07:00:00', 4, 0.3, 0.4, 0.3, 'REG', '0', 'Dimas', 'Jalan Pulogadung No. 444', 'dimas@gmail.com', '+6285790697366', 'Dayat', 'Jalan Cipedes Atas No. 41', '+6285790697366', 28000, '1', '1', '2'),
	('RSV008', 'ARM001', 'BDG001', 'SOL001', '2017-01-09 05:09:45', '2017-02-13 21:00:00', 2, 1, 1, 1, 'LIM', '0', 'Fathir Izzuddin Qisthi', 'Jalan Kembang Kertas 99B, Kecamatan Lowokwaru, Kelurahan Jatimulyo', 'fathirizzuddin@gmail.com', '085790697366', 'Ricky Darmawan', 'Jalan Stasiun Balapan no 99 03/13', '085790697225', 30000, '1', '1', '1');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;

-- Dumping structure for table logondb.route
DROP TABLE IF EXISTS `route`;
CREATE TABLE IF NOT EXISTS `route` (
  `idarmada` char(6) NOT NULL,
  `departureidbranch` char(6) NOT NULL,
  `arrivalidbranch` char(6) NOT NULL,
  `departureday` varchar(9) NOT NULL,
  `departuretime` time NOT NULL,
  `arrivalday` varchar(9) NOT NULL,
  `arrivaltime` time NOT NULL,
  `fareperdimension` float NOT NULL,
  `fareperkilos` float NOT NULL,
  PRIMARY KEY (`idarmada`,`departureidbranch`,`arrivalidbranch`),
  KEY `fkbranchtodepartureroute` (`departureidbranch`),
  KEY `fkbranchtoarrivalroute` (`arrivalidbranch`),
  CONSTRAINT `fkarmadatoroute` FOREIGN KEY (`idarmada`) REFERENCES `armada` (`idarmada`),
  CONSTRAINT `fkbranchtoarrivalroute` FOREIGN KEY (`arrivalidbranch`) REFERENCES `branch` (`idbranch`),
  CONSTRAINT `fkbranchtodepartureroute` FOREIGN KEY (`departureidbranch`) REFERENCES `branch` (`idbranch`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.route: ~19 rows (approximately)
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` (`idarmada`, `departureidbranch`, `arrivalidbranch`, `departureday`, `departuretime`, `arrivalday`, `arrivaltime`, `fareperdimension`, `fareperkilos`) VALUES
	('ARM001', 'BDG001', 'JTB002', 'Jumat', '07:00:00', 'Jumat', '11:00:00', 21000, 7000),
	('ARM001', 'BDG001', 'SOL001', 'Senin', '21:00:00', 'Selasa', '06:00:00', 45000, 15000),
	('ARM001', 'JTB001', 'JTS002', 'Sabtu', '07:00:00', 'Sabtu', '09:00:00', 15000, 5000),
	('ARM001', 'JTU002', 'BDG002', 'Rabu', '19:00:00', 'Kamis', '23:00:00', 21000, 7000),
	('ARM001', 'SOL002', 'JTU001', 'Selasa', '17:00:00', 'Rabu', '09:00:00', 60000, 20000),
	('ARM002', 'BDG002', 'JTM001', 'Senin', '07:00:00', 'Senin', '11:00:00', 15000, 5000),
	('ARM002', 'JTB002', 'BDG001', 'Rabu', '07:00:00', 'Rabu', '10:00:00', 21000, 7000),
	('ARM002', 'JTM002', 'JTS001', 'Senin', '17:00:00', 'Senin', '19:00:00', 15000, 5000),
	('ARM002', 'JTP002', 'JTB001', 'Selasa', '17:00:00', 'Selasa', '19:00:00', 15000, 5000),
	('ARM002', 'JTS002', 'JTP001', 'Selasa', '07:00:00', 'Selasa', '08:00:00', 15000, 5000),
	('ARM003', 'BDG002', 'JTS001', 'Minggu', '07:00:00', 'Minggu', '11:00:00', 21000, 7000),
	('ARM003', 'JTB002', 'JTM001', 'Kamis', '17:00:00', 'Kamis', '18:00:00', 15000, 5000),
	('ARM003', 'JTP001', 'SOL002', 'Jumat', '21:00:00', 'Sabtu', '13:00:00', 60000, 20000),
	('ARM003', 'JTS002', 'JTB001', 'Kamis', '09:00:00', 'Kamis', '10:00:00', 15000, 5000),
	('ARM003', 'SOL001', 'BDG001', 'Sabtu', '21:00:00', 'Sabtu', '05:00:00', 45000, 15000),
	('ARM004', 'BDG002', 'SOL001', 'Jumat', '21:00:00', 'Sabtu', '05:00:00', 45000, 15000),
	('ARM004', 'JTP002', 'BDG001', 'Kamis', '07:00:00', 'Kamis', '11:00:00', 21000, 7000),
	('ARM004', 'JTU002', 'JTP001', 'Rabu', '07:00:00', 'Rabu', '08:00:00', 15000, 5000),
	('ARM004', 'SOL002', 'JTS001', 'Sabtu', '21:00:00', 'Minggu', '13:00:00', 60000, 20000);
/*!40000 ALTER TABLE `route` ENABLE KEYS */;

-- Dumping structure for table logondb.testimonial
DROP TABLE IF EXISTS `testimonial`;
CREATE TABLE IF NOT EXISTS `testimonial` (
  `receiptnumber` varchar(20) NOT NULL,
  `testimonialdate` datetime NOT NULL,
  `testimonial` text NOT NULL,
  KEY `fk_fixedbookingtotestimonial` (`receiptnumber`),
  CONSTRAINT `fk_fixedbookingtotestimonial` FOREIGN KEY (`receiptnumber`) REFERENCES `fixedbooking` (`receiptnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.testimonial: ~2 rows (approximately)
/*!40000 ALTER TABLE `testimonial` DISABLE KEYS */;
INSERT INTO `testimonial` (`receiptnumber`, `testimonialdate`, `testimonial`) VALUES
	('764119EE0BA765EBFF98', '2016-08-31 11:16:41', 'Akhirnya sampai juga, gitu dong!'),
	('404D4CD176799D4715FC', '2016-09-04 10:40:06', 'Oh ternyata diterima tetangga saya Mas, tadi saya sedang diluar rumah'),
	('404D4CD176799D4715FC', '2017-01-10 05:13:20', 'Terima kasih logistik Online');
/*!40000 ALTER TABLE `testimonial` ENABLE KEYS */;

-- Dumping structure for table logondb.vehicletype
DROP TABLE IF EXISTS `vehicletype`;
CREATE TABLE IF NOT EXISTS `vehicletype` (
  `idvehicletype` char(3) NOT NULL,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`idvehicletype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table logondb.vehicletype: ~5 rows (approximately)
/*!40000 ALTER TABLE `vehicletype` DISABLE KEYS */;
INSERT INTO `vehicletype` (`idvehicletype`, `type`) VALUES
	('BOX', 'Mobil Box'),
	('BUS', 'Bus'),
	('CON', 'Truk Container'),
	('SED', 'Sedan'),
	('TRK', 'Truk Kecil');
/*!40000 ALTER TABLE `vehicletype` ENABLE KEYS */;

-- Dumping structure for view logondb.expedition
DROP VIEW IF EXISTS `expedition`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `expedition` (
	`idarmada` CHAR(6) NOT NULL COLLATE 'latin1_swedish_ci',
	`departureidbranch` CHAR(6) NOT NULL COLLATE 'latin1_swedish_ci',
	`arrivalidbranch` CHAR(6) NOT NULL COLLATE 'latin1_swedish_ci',
	`deliverydate` DATETIME NOT NULL,
	`totalpackage` BIGINT(21) NOT NULL,
	`departuretime` TIME NOT NULL,
	`arrivaltime` TIME NOT NULL,
	`shipmentstatus` CHAR(1) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view logondb.reservationmonitor
DROP VIEW IF EXISTS `reservationmonitor`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `reservationmonitor` (
	`reservationcode` CHAR(6) NOT NULL COLLATE 'latin1_swedish_ci',
	`sendername` VARCHAR(45) NOT NULL COLLATE 'latin1_swedish_ci',
	`departurecity` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`departuretime` TIME NOT NULL,
	`arrivalcity` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`arrivaltime` TIME NOT NULL,
	`deliverydate` DATE NULL,
	`reservationstatus` CHAR(1) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view logondb.shipmenthistory
DROP VIEW IF EXISTS `shipmenthistory`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `shipmenthistory` (
	`receiptnumber` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`timeevent` TIMESTAMP NOT NULL,
	`shipmentstatus` CHAR(1) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view logondb.tracking
DROP VIEW IF EXISTS `tracking`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `tracking` (
	`receiptnumber` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`idarmada` CHAR(6) NOT NULL COLLATE 'latin1_swedish_ci',
	`origincity` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`meetingpoint` VARCHAR(60) NOT NULL COLLATE 'latin1_swedish_ci',
	`destinationcity` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`droppoint` VARCHAR(60) NOT NULL COLLATE 'latin1_swedish_ci',
	`recipientaddress` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`recipientname` VARCHAR(45) NOT NULL COLLATE 'latin1_swedish_ci',
	`currentlocation` VARCHAR(15) NOT NULL COLLATE 'latin1_swedish_ci',
	`shipmentstatus` CHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`timeevent` TIMESTAMP NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view logondb.trackingdetail
DROP VIEW IF EXISTS `trackingdetail`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `trackingdetail` (
	`receiptnumber` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`vehiclenumber` VARCHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`drivername` VARCHAR(45) NOT NULL COLLATE 'latin1_swedish_ci',
	`deliverydate` DATETIME NOT NULL,
	`origincity` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`meetingpoint` VARCHAR(60) NOT NULL COLLATE 'latin1_swedish_ci',
	`mpaddress` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`departureidbranch` CHAR(6) NOT NULL COLLATE 'latin1_swedish_ci',
	`destinationcity` VARCHAR(35) NOT NULL COLLATE 'latin1_swedish_ci',
	`droppoint` VARCHAR(60) NOT NULL COLLATE 'latin1_swedish_ci',
	`dpaddress` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`arrivalidbranch` CHAR(6) NOT NULL COLLATE 'latin1_swedish_ci',
	`sendername` VARCHAR(45) NOT NULL COLLATE 'latin1_swedish_ci',
	`senderaddress` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
	`recipientname` VARCHAR(45) NOT NULL COLLATE 'latin1_swedish_ci',
	`recipientaddress` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for trigger logondb.trig_deleteaccountbyemail
DROP TRIGGER IF EXISTS `trig_deleteaccountbyemail`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trig_deleteaccountbyemail` AFTER DELETE ON `login` FOR EACH ROW BEGIN
	DELETE FROM courier WHERE courier.courieremail = old.email;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger logondb.trig_deletearmadaforcourier
DROP TRIGGER IF EXISTS `trig_deletearmadaforcourier`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trig_deletearmadaforcourier` AFTER UPDATE ON `courier` FOR EACH ROW BEGIN
	IF (OLD.courierstatus = '5') THEN
		UPDATE armada SET armada.armadastatus = '5' WHERE armada.idcourier = OLD.idcourier;
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger logondb.trig_deletecagocategoryofarmada
DROP TRIGGER IF EXISTS `trig_deletecagocategoryofarmada`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trig_deletecagocategoryofarmada` AFTER DELETE ON `route` FOR EACH ROW BEGIN
	DELETE FROM cargocategoryofarmada WHERE cargocategoryofarmada.idarmada = OLD.idarmada;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger logondb.trig_deleteloginforagent
DROP TRIGGER IF EXISTS `trig_deleteloginforagent`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trig_deleteloginforagent` AFTER UPDATE ON `agent` FOR EACH ROW BEGIN
	IF (OLD.agentstatus = '5') THEN
		DELETE FROM login WHERE email = OLD.agentemail;
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger logondb.trig_deleteloginforbranch
DROP TRIGGER IF EXISTS `trig_deleteloginforbranch`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trig_deleteloginforbranch` AFTER UPDATE ON `branch` FOR EACH ROW BEGIN
	IF (OLD.branchstatus = '5') THEN
		UPDATE agent SET agent.agentstatus = '5' WHERE agent.idbranch = OLD.idbranch;
		DELETE FROM login WHERE email = OLD.bmemail;
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger logondb.trig_deleterouteforarmada
DROP TRIGGER IF EXISTS `trig_deleterouteforarmada`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trig_deleterouteforarmada` AFTER UPDATE ON `armada` FOR EACH ROW BEGIN
	IF (OLD.armadastatus = '5') THEN
		DELETE FROM route WHERE route.idarmada = OLD.idarmada;
	END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger logondb.trig_insertloginforagent
DROP TRIGGER IF EXISTS `trig_insertloginforagent`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trig_insertloginforagent` BEFORE INSERT ON `agent` FOR EACH ROW BEGIN
	INSERT INTO login (email, pwd) VALUES (NEW.agentemail, 'asdasd');
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger logondb.trig_insertloginforbranch
DROP TRIGGER IF EXISTS `trig_insertloginforbranch`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `trig_insertloginforbranch` BEFORE INSERT ON `branch` FOR EACH ROW BEGIN
	INSERT INTO login (email, pwd) VALUES (NEW.bmemail, 'asdasd');
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for view logondb.expedition
DROP VIEW IF EXISTS `expedition`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `expedition`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `expedition` AS SELECT 
	reservation.idarmada, 
	reservation.departureidbranch, 
	reservation.arrivalidbranch, 
	reservation.deliverydate,
	COUNT(fixedbooking.receiptnumber) AS totalpackage, 
	route.departuretime,
	route.arrivaltime,
	fixedbooking.shipmentstatus
FROM 
	fixedbooking
JOIN reservation 
	ON reservation.reservationcode = fixedbooking.reservationcode
JOIN route 
	ON route.idarmada = reservation.idarmada 
		AND route.departureidbranch = reservation.departureidbranch
		AND route.arrivalidbranch = reservation.arrivalidbranch
GROUP BY
	reservation.idarmada, reservation.departureidbranch, reservation.arrivalidbranch, reservation.deliverydate ;

-- Dumping structure for view logondb.reservationmonitor
DROP VIEW IF EXISTS `reservationmonitor`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `reservationmonitor`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservationmonitor` AS SELECT
	reservationcode, 
	sendername, 
   citya.city as departurecity, 
   routea.departuretime, 
   cityb.city as arrivalcity, 
   routea.arrivaltime,
   DATE(reservation.deliverydate) as deliverydate,
   reservationstatus
FROM
	reservation
JOIN
	branch brancha ON reservation.departureidbranch = brancha.idbranch
JOIN 
	branch branchb ON reservation.arrivalidbranch = branchb.idbranch
JOIN
	city citya ON citya.idcity = brancha.idcity
JOIN 
	city cityb ON cityb.idcity = branchb.idcity
JOIN 
	route routea 
	ON
		routea.idarmada = reservation.idarmada 
		AND routea.departureidbranch = reservation.departureidbranch 
		AND routea.arrivalidbranch = reservation.arrivalidbranch ;

-- Dumping structure for view logondb.shipmenthistory
DROP VIEW IF EXISTS `shipmenthistory`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `shipmenthistory`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `shipmenthistory` AS SELECT
	logbooking.receiptnumber,
	logbooking.timeevent,
	logbooking.shipmentstatus
FROM logbooking ;

-- Dumping structure for view logondb.tracking
DROP VIEW IF EXISTS `tracking`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `tracking`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tracking` AS SELECT
	fixedbooking.receiptnumber,
	reservation.idarmada,
	citya.city as origincity,
	brancha.branchname as meetingpoint,
	cityb.city as destinationcity,
	branchb.branchname as droppoint,
	reservation.recipientaddress,
	reservation.recipientname,
	logbooking.lat as currentlocation,
	logbooking.shipmentstatus,
	logbooking.timeevent
FROM 
	logbooking
JOIN
	fixedbooking
		ON fixedbooking.receiptnumber = logbooking.receiptnumber
JOIN 
	reservation
		ON reservation.reservationcode = fixedbooking.reservationcode
JOIN
	armada
		ON reservation.idarmada = armada.idarmada
JOIN
	branch brancha
		ON brancha.idbranch = reservation.departureidbranch
JOIN
	branch branchb
		ON branchb.idbranch = reservation.arrivalidbranch
JOIN
	city citya
		ON brancha.idcity = citya.idcity
JOIN
	city cityb
		ON branchb.idcity = cityb.idcity
ORDER BY logbooking.timeevent DESC ;

-- Dumping structure for view logondb.trackingdetail
DROP VIEW IF EXISTS `trackingdetail`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `trackingdetail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `trackingdetail` AS SELECT
	fixedbooking.receiptnumber,
	armada.vehiclenumber,
	armada.drivername,
	reservation.deliverydate,
	citya.city as origincity,
	brancha.branchname as meetingpoint,
	brancha.branchaddress as mpaddress,
	reservation.departureidbranch,
	cityb.city as destinationcity,
	branchb.branchname as droppoint,
	branchb.branchaddress as dpaddress,
	reservation.arrivalidbranch,
	reservation.sendername,
	reservation.senderaddress,
	reservation.recipientname,
	reservation.recipientaddress
FROM
	fixedbooking
JOIN
	reservation
	ON reservation.reservationcode = fixedbooking.reservationcode
JOIN
	armada
		ON reservation.idarmada = armada.idarmada
JOIN
	branch brancha
		ON brancha.idbranch = reservation.departureidbranch
JOIN
	branch branchb
		ON branchb.idbranch = reservation.arrivalidbranch
JOIN
	city citya
		ON brancha.idcity = citya.idcity
JOIN
	city cityb
		ON branchb.idcity = cityb.idcity ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
