
--
-- Database: `medical`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` longtext NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`)
);

DROP TABLE IF EXISTS `admission`;
CREATE TABLE IF NOT EXISTS `admission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(50) NOT NULL,
  `room_id` int(11) NOT NULL,
  `report` longtext,
  `admitted_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `discharge_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `room_id` (`room_id`)
);

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receptionist_id` varchar(50) DEFAULT NULL,
  `doctor_id` varchar(50) NOT NULL,
  `patient_id` varchar(50) NOT NULL,
  `report` longtext,
  `app_date` datetime NOT NULL,
  `next_app_date` datetime DEFAULT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `receptionist_id` (`receptionist_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `patient_id` (`patient_id`)
);

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` longtext NOT NULL,
  `specialization` varchar(250) NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`doctor_id`)
);

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `action` longtext NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `nurse`;
CREATE TABLE IF NOT EXISTS `nurse` (
  `nurse_id` varchar(50) NOT NULL,
  `doctor_id` varchar(50) DEFAULT NULL,
  `room_id` varchar(50) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` longtext NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nurse_id`),
  KEY `doctor_id` (`doctor_id`)
);


DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` varchar(50) NOT NULL,
  `addedby` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(1) DEFAULT '1',
  `dob` date NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` longtext NOT NULL,
  `medical_history` longtext NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`patient_id`),
  KEY `receptionist_id` (`addedby`)
);

DROP TABLE IF EXISTS `receptionist`;
CREATE TABLE IF NOT EXISTS `receptionist` (
  `receptionist_id` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` longtext NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`receptionist_id`)
);

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`room_id`)
);

DROP TABLE IF EXISTS `specialization`;
CREATE TABLE IF NOT EXISTS `specialization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
); 

DROP TABLE IF EXISTS `billing`;
CREATE TABLE IF NOT EXISTS `billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` varchar(50) NOT NULL,
  `consultation_fee` int DEFAULT 0,
  `lab_test` int DEFAULT 0,
  `purchases` int DEFAULT 0,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);