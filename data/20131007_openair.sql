# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: ec2-54-243-13-79.compute-1.amazonaws.com (MySQL 5.5.28-log)
# Database: openair
# Generation Time: 2013-06-07 21:53:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `name`, `parent`, `description`)
VALUES
	(-1,'_ORPHANS',0,''),
	(1,'Applications',0,NULL),
	(2,'Agriculture & Natural Resources',1,NULL),
	(3,'Architecture & Design',1,NULL),
	(4,'Art',1,NULL),
	(5,'Assistive Technologies',1,NULL),
	(6,'Astronomy & Space Exploration',1,NULL),
	(7,'Automatic Programming',1,NULL),
	(8,'Automotive Industry',1,NULL),
	(9,'Autonomous Vehicles',1,NULL),
	(10,'Aviation',1,NULL),
	(11,'Banking & Finance',1,NULL),
	(12,'Bioinformatics',1,NULL),
	(13,'Biometrics',1,NULL),
	(14,'Business & Manufacturing',1,NULL),
	(15,'Chatbots',1,NULL),
	(16,'Chemistry',1,NULL),
	(17,'Decision Support Systems',1,NULL),
	(18,'Earth & Atmospheric Science',1,NULL),
	(19,'Engineering Design',1,NULL),
	(20,'Fraud Detection',1,NULL),
	(21,'Hazards & Disasters',1,NULL),
	(22,'Knowledge Management',1,NULL),
	(23,'Law Enforcement & Public Safety',1,NULL),
	(24,'Medicine',1,NULL),
	(25,'Military',1,NULL),
	(26,'Music',1,NULL),
	(27,'Networks',1,NULL),
	(28,'Oil & Gas',1,NULL),
	(29,'Politics & Foreign Relations',1,NULL),
	(30,'Recommender Systems',1,NULL),
	(31,'Science & Mathematics',1,NULL),
	(32,'Sensors',1,NULL),
	(33,'Smart Houses& Appliances',1,NULL),
	(34,'Social Science',1,NULL),
	(35,'Software Engineering',1,NULL),
	(36,'Spam Filtering',1,NULL),
	(37,'Surveillance',1,NULL),
	(38,'Telecommunications',1,NULL),
	(39,'Transportation & Shipping',1,NULL),
	(40,'Architectures and Languages',0,NULL),
	(41,'Cognitive Architectures',40,NULL),
	(42,'Neuroscience',40,NULL),
	(43,'Problem Solving',40,NULL),
	(44,'Programming Languages',40,NULL),
	(45,'Simulation',40,NULL),
	(46,'Education',0,NULL),
	(47,'Automated Grading',46,NULL),
	(48,'Intelligent Tutoring',46,NULL),
	(49,'Games & Puzzles',0,NULL),
	(50,'15 Puzzle',49,NULL),
	(51,'Backgammon',49,NULL),
	(52,'Bridge',49,NULL),
	(53,'Checkers',49,NULL),
	(54,'Chess',49,NULL),
	(55,'Crossword Puzzles',49,NULL),
	(56,'General Game Playing',49,NULL),
	(57,'Go',49,NULL),
	(58,'Hearts',49,NULL),
	(59,'Othello',49,NULL),
	(60,'Poker',49,NULL),
	(61,'Scrabble',49,NULL),
	(62,'Sports',49,NULL),
	(63,'Video Games',49,NULL),
	(64,'Interfaces',0,NULL),
	(65,'Human Computer Interaction',64,NULL),
	(66,'Human Robot Interaction',64,NULL),
	(67,'Device Interfaces',64,NULL),
	(68,'Machine Learning',0,NULL),
	(69,'Clustering',68,NULL),
	(70,'Data Mining',68,NULL),
	(71,'Decision Tree Learning',68,NULL),
	(72,'Evolutionary Algorithms',68,NULL),
	(73,'Inductive Learning',68,NULL),
	(74,'Learning Theory',68,NULL),
	(75,'Memory-Based Learning',68,NULL),
	(76,'Neural Networks',68,NULL),
	(77,'Pattern Recognition',68,NULL),
	(78,'Reinforcement Learning',68,NULL),
	(79,'Scientific Discovery',68,NULL),
	(80,'Statistical Learning Methods',68,NULL),
	(81,'Natural Language',0,NULL),
	(82,'Discourse & Dialogue',81,NULL),
	(83,'Explanation & Argumentation',81,NULL),
	(84,'Natural Language Generation',81,NULL),
	(85,'Natural Language Understanding',81,NULL),
	(86,'Grammars & Parsing',81,NULL),
	(87,'Information Retrieval',81,NULL),
	(88,'Machine Translation',81,NULL),
	(89,'Question Answering',81,NULL),
	(90,'Speech',81,NULL),
	(91,'Text Classification',81,NULL),
	(92,'Text Summarization',81,NULL),
	(93,'Representation and Reasoning',0,NULL),
	(94,'Abductive Reasoning',93,NULL),
	(95,'Agents',93,NULL),
	(96,'Analogical Reasoning',93,NULL),
	(97,'Automated Theorem Proving',93,NULL),
	(98,'Bayesian Inference',93,NULL),
	(99,'Belief Revision',93,NULL),
	(100,'Case-Based Reasoning',93,NULL),
	(101,'Commonsense Reasoning',93,NULL),
	(102,'Constraint-Based Reasoning',93,NULL),
	(103,'Description Logic',93,NULL),
	(104,'Design',93,NULL),
	(105,'Diagrammatic Reasoning',93,NULL),
	(106,'Diagrams & Models',93,NULL),
	(107,'Expert Systems',93,NULL),
	(108,'Fuzzy Logic',93,NULL),
	(109,'Heuristic Search',93,NULL),
	(110,'Logic & Formal Reasoning',93,NULL),
	(111,'Metareasoning',93,NULL),
	(112,'Multi-Agent Systems',93,NULL),
	(113,'Nonmonotonic Logic',93,NULL),
	(114,'Ontologies',93,NULL),
	(115,'Planning & Scheduling',93,NULL),
	(116,'Qualitative Reasoning',93,NULL),
	(117,'Rule-Based Reasoning',93,NULL),
	(118,'Scripts & Frames',93,NULL),
	(119,'Semantic Networks',93,NULL),
	(120,'Situation Calculus',93,NULL),
	(121,'Spatial Reasoning',93,NULL),
	(122,'Uncertainty',93,NULL),
	(123,'Robotics',0,NULL),
	(124,'Biologically-Inspired Robots',123,NULL),
	(125,'Humanoid Robots',123,NULL),
	(126,'Manipulation & Locomotion',123,NULL),
	(127,'Robot Cognition',123,NULL),
	(128,'Robot Perception',123,NULL),
	(129,'Robot Planning & Action',123,NULL),
	(130,'Sensing and Vision',0,NULL),
	(131,'Face Recognition',130,NULL),
	(132,'Handwriting Recognition',130,NULL),
	(133,'Image Understanding',130,NULL),
	(134,'Optical Character Recognition',130,NULL),
	(135,'Web',0,'it is back'),
	(145,'Semantic Web',135,NULL),
	(146,'Social Networks',135,NULL),
	(147,'Web Search',135,NULL);

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table license_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `license_type`;

CREATE TABLE `license_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `license_type` WRITE;
/*!40000 ALTER TABLE `license_type` DISABLE KEYS */;

INSERT INTO `license_type` (`id`, `name`)
VALUES
	(1,'Creative Commons'),
	(2,'GNU General Public License'),
	(3,'Apache License'),
	(4,'BSD License'),
	(5,'MIT License'),
	(6,'Commercial License'),
	(7,'Other/Unknown');

/*!40000 ALTER TABLE `license_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table resource
# ------------------------------------------------------------

DROP TABLE IF EXISTS `resource`;

CREATE TABLE `resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link` varchar(1024) NOT NULL,
  `description` longtext NOT NULL,
  `resource_type` int(11) NOT NULL,
  `license_type` int(11) NOT NULL,
  `significance_type` int(11) NOT NULL,
  `submitters_name` varchar(255) NOT NULL,
  `submitters_email` varchar(255) NOT NULL,
  `owner` varchar(1024) DEFAULT NULL,
  `programming_lang` varchar(255) DEFAULT NULL,
  `last_edited_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approved_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resource_type` (`resource_type`),
  KEY `license_type` (`license_type`),
  CONSTRAINT `resource_ibfk_1` FOREIGN KEY (`resource_type`) REFERENCES `resource_type` (`id`),
  CONSTRAINT `resource_ibfk_2` FOREIGN KEY (`license_type`) REFERENCES `license_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `resource` WRITE;
/*!40000 ALTER TABLE `resource` DISABLE KEYS */;

INSERT INTO `resource` (`id`, `name`, `link`, `description`, `resource_type`, `license_type`, `significance_type`, `submitters_name`, `submitters_email`, `owner`, `programming_lang`, `last_edited_date`, `approved_date`)
VALUES
	(1,'MALLET','http://mallet.net','ML lib with many capabilities',1,1,1,'Joe','joe@shmo.org','',NULL,'2013-06-07 21:11:00','2013-06-04 22:00:04'),
	(2,'Mahout','http://apache.org','Hadoop-based ML framework',1,1,1,'Jane','jane@shmo.org','',NULL,'2013-06-07 21:10:56','2013-06-04 22:00:08'),
	(56,'Point Cloud Library','http://www.pointclouds.org/','Image and point cloud processor',3,4,2,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:11:56','2013-06-07 21:11:56'),
	(57,'The Orcos Project','http://www.orocos.org/','Collection of portable C++ libraries for robot control',3,2,2,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:11:57','2013-06-07 21:11:57'),
	(58,'Link Grammar Parser','http://www.link.cs.cmu.edu/link/','English syntax parser',3,7,3,'Henry Ehrhard','hehrhard@gmail.com','Daniel Sleator',NULL,'2013-06-07 21:11:59','2013-06-07 21:11:59'),
	(59,'The Robotics Library','http://sourceforge.net/apps/mediawiki/roblib/index.php?title=Robotics_Library','C++ library for robot motion, planning, and control',3,4,1,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:12:01','2013-06-07 21:12:01'),
	(60,'Aglets Software Development Kit','http://www.research.ibm.com/trl/aglets/index_e.htm','SDK for internet agents',3,7,3,'Henry Ehrhard','hehrhard@gmail.com','IBM',NULL,'2013-06-07 21:12:02','2013-06-07 21:12:02'),
	(61,'Amygdala','http://amygdala.sourceforge.net/','Spiking neural network simulator',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:12:03','2013-06-07 21:12:03'),
	(62,'Annie','http://annie.sourceforge.net/','Artificial neural network library',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:12:04','2013-06-07 21:12:04'),
	(63,'N.A.R.I.A.','http://naria.karasuma.net/','Human intelligence simulator',3,7,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 20:58:38','2013-06-07 20:58:38'),
	(64,'Carmen','http://carmen.sourceforge.net/getting_carmen.html','Robot navigation toolkit',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','CARMEN-Team',NULL,'2013-06-07 21:12:06','2013-06-07 21:12:06'),
	(66,'Robot Operating System','http://www.ros.org/','Collection of libraries and tools for robot software development',3,4,1,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 20:57:44','2013-06-07 20:57:44'),
	(67,'Daves Robotic Operating System','http://dros.org/','Framework of functions and modules for robots',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:12:07','2013-06-07 21:12:07'),
	(68,'MARIE','http://marie.sourceforge.net/wiki/index.php/Main_Page','Tool of integrated robotic software components',3,2,2,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:33','2013-06-07 21:15:33'),
	(69,'Excalibur','http://www.ai-center.com/projects/excalibur/','Agent architecture for computer game environments',3,7,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:35','2013-06-07 21:15:35'),
	(70,'Heuristic Goal-seeking Framework','http://sourceforge.net/projects/goalseeker/','Heuristic algorithms implemented to solve the 15 puzzle',3,7,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:36','2013-06-07 21:15:36'),
	(71,'OpenCCG','http://openccg.sourceforge.net/','Natural language processing library',3,7,2,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:37','2013-06-07 21:15:37'),
	(72,'OpenNLP','http://opennlp.apache.org/index.html','Toolkit for natural language processing',3,3,1,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:39','2013-06-07 21:15:39'),
	(73,'Freeling','http://nlp.lsi.upc.edu/freeling/','Language analysis tool suite',3,2,1,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:40','2013-06-07 21:15:40'),
	(74,'Weka','http://www.cs.waikato.ac.nz/ml/weka/','Collection of data mining algorithms',3,2,1,'Henry Ehrhard','hehrhard@gmail.com','University of Waikato',NULL,'2013-06-07 21:15:41','2013-06-07 21:15:41'),
	(75,'WordNet::Similarity','http://wn-similarity.sourceforge.net/','Module for semantic similarity and relatedness measures',3,2,2,'Henry Ehrhard','hehrhard@gmail.com','Ted Pederson',NULL,'2013-06-07 21:15:43','2013-06-07 21:15:43'),
	(76,'Nomadic Robot Software','http://nomadic.sourceforge.net/','Collection of software components for Nomad series robot',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:44','2013-06-07 21:15:44');

/*!40000 ALTER TABLE `resource` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table resource_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `resource_category`;

CREATE TABLE `resource_category` (
  `resource_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`resource_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `resource_category` WRITE;
/*!40000 ALTER TABLE `resource_category` DISABLE KEYS */;

INSERT INTO `resource_category` (`resource_id`, `category_id`)
VALUES
	(1,68),
	(2,68),
	(56,133),
	(57,123),
	(58,86),
	(59,123),
	(60,95),
	(61,45),
	(62,40),
	(63,45),
	(64,126),
	(66,123),
	(67,123),
	(68,123),
	(69,49),
	(70,50),
	(71,86),
	(72,81),
	(73,85),
	(74,70),
	(75,81),
	(76,123);

/*!40000 ALTER TABLE `resource_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table resource_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `resource_type`;

CREATE TABLE `resource_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `resource_type` WRITE;
/*!40000 ALTER TABLE `resource_type` DISABLE KEYS */;

INSERT INTO `resource_type` (`id`, `name`)
VALUES
	(1,'Database'),
	(2,'Directory'),
	(3,'Code'),
	(4,'Other');

/*!40000 ALTER TABLE `resource_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table significance_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `significance_type`;

CREATE TABLE `significance_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `significance_type` WRITE;
/*!40000 ALTER TABLE `significance_type` DISABLE KEYS */;

INSERT INTO `significance_type` (`id`, `name`, `order`)
VALUES
	(1,'Used by Lots (26+)',1),
	(2,'Used by Many (6-25)',2),
	(3,'Used by Some (2-5)',3),
	(4,'New',4);

/*!40000 ALTER TABLE `significance_type` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
