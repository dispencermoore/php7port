-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: openair
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (-1,'_ORPHANS',0,''),(1,'Applications',0,NULL),(2,'Agriculture & Natural Resources',1,NULL),(3,'Architecture & Design',1,NULL),(4,'Art',1,NULL),(5,'Assistive Technologies',1,NULL),(6,'Astronomy & Space Exploration',1,NULL),(7,'Automatic Programming',1,NULL),(8,'Automotive Industry',1,NULL),(9,'Autonomous Vehicles',1,NULL),(10,'Aviation',1,NULL),(11,'Banking & Finance',1,NULL),(12,'Bioinformatics',1,NULL),(13,'Biometrics',1,NULL),(14,'Business & Manufacturing',1,NULL),(15,'Chatbots',1,NULL),(16,'Chemistry',1,NULL),(17,'Decision Support Systems',1,NULL),(18,'Earth & Atmospheric Science',1,NULL),(19,'Engineering Design',1,NULL),(20,'Fraud Detection',1,NULL),(21,'Hazards & Disasters',1,NULL),(22,'Knowledge Management',1,NULL),(23,'Law Enforcement & Public Safety',1,NULL),(24,'Medicine',1,NULL),(25,'Military',1,NULL),(26,'Music',1,NULL),(27,'Networks',1,NULL),(28,'Oil & Gas',1,NULL),(29,'Politics & Foreign Relations',1,NULL),(30,'Recommender Systems',1,NULL),(31,'Science & Mathematics',1,NULL),(32,'Sensors',1,NULL),(33,'Smart Houses& Appliances',1,NULL),(34,'Social Science',1,NULL),(35,'Software Engineering',1,NULL),(36,'Spam Filtering',1,NULL),(37,'Surveillance',1,NULL),(38,'Telecommunications',1,NULL),(39,'Transportation & Shipping',1,NULL),(40,'Architectures and Languages',0,NULL),(41,'Cognitive Architectures',40,NULL),(42,'Neuroscience',40,NULL),(43,'Problem Solving',40,NULL),(44,'Programming Languages',40,NULL),(45,'Simulation',40,NULL),(46,'Education',0,NULL),(47,'Automated Grading',46,NULL),(48,'Intelligent Tutoring',46,NULL),(49,'Games & Puzzles',0,'Acting Editor: Marc Lanctot<br><br>Research in games has been a classic interest of artificial intelligence. In this category, we attempt to collect the many resources that exist to facilitate collaboration among AI researchers interested in games, game theory, game-playing, adversarial search, machine learning in games, and interactive entertainment. <br><br>Here are some examples of resources available online:<br><br><ul><li>Several open-source chess engines are available from the <a href=\"https://chessprogramming.wikispaces.com/Open+Source+Engines\">Chess Programming Wiki</a>.<br></li></ul><ul><li>Many games used in <a href=\"http://games.stanford.edu/\">General Game Playing (GGP)</a> have been represented in the Game Definition Language (GDL), and several resources are available from the <a href=\"http://www.general-game-playing.de/\">Dresden GGP Resources Site</a>.</li></ul><ul><li>The University of Alberta\'s <a href=\"http://poker.cs.ualberta.ca/software.html\">Computer Poker Research Group (CPRG)</a><a> </a>has released a number of open implementations of the algorithms used in their Poker bots and analysis.<br></li></ul><ul><li>The <a href=\"https://code.google.com/p/bwapi/\">Brood War API</a> is can be used for developing AI for the real-time strategy game Starcraft: Brood War.</li></ul><p><br></p>'),(64,'Interfaces',0,NULL),(65,'Human Computer Interaction',64,NULL),(66,'Human Robot Interaction',64,NULL),(67,'Device Interfaces',64,NULL),(68,'Machine Learning',0,'Acting Editor: Steven Minton<div><br></div><div>The machine learning community has long relied on a variety of open source code and data sets. &nbsp;Influential resources include:</div><div><ul><li><a href=\"http://archive.ics.uci.edu/ml/\">UCI\'s Machine Learning Repository</a>: &nbsp;A large number of data sets for tesing ML algoirthms are publicly available.<br></li><li><a href=\"http://jmlr.org/mloss/\">Journal of Machine Learning Research\'s Open Source Software Track</a>: &nbsp;This influential journal provides a peer-reviewed venue for publishing open source software, accompanied by short articles.&nbsp;</li><li><a href=\"http://mloss.org\">Mloss.org</a>: A repository of open source software for machine learning.</li><li><a href=\"http://www.cs.waikato.ac.nz/ml/weka/\">Weka</a>: A popular collection of data mining algorithms from the Machine Learning Group at the University of Waikato.</li></ul></div><div><br></div>'),(69,'Clustering',68,NULL),(70,'Data Mining',68,NULL),(71,'Decision Tree Learning',68,NULL),(72,'Evolutionary Algorithms',68,NULL),(73,'Inductive Learning',68,NULL),(74,'Learning Theory',68,NULL),(75,'Memory-Based Learning',68,NULL),(76,'Neural Networks',68,NULL),(77,'Pattern Recognition',68,NULL),(78,'Reinforcement Learning',68,NULL),(79,'Scientific Discovery',68,NULL),(80,'Statistical Learning Methods',68,NULL),(81,'Natural Language',0,NULL),(82,'Discourse & Dialogue',81,NULL),(83,'Explanation & Argumentation',81,NULL),(84,'Natural Language Generation',81,NULL),(85,'Natural Language Understanding',81,NULL),(86,'Grammars & Parsing',81,NULL),(87,'Information Retrieval',81,NULL),(88,'Machine Translation',81,NULL),(89,'Question Answering',81,NULL),(90,'Speech',81,NULL),(91,'Text Classification',81,NULL),(92,'Text Summarization',81,NULL),(93,'Representation and Reasoning',0,NULL),(94,'Abductive Reasoning',93,NULL),(95,'Agents',93,NULL),(96,'Analogical Reasoning',93,NULL),(97,'Automated Theorem Proving',93,NULL),(98,'Bayesian Inference',93,NULL),(99,'Belief Revision',93,NULL),(100,'Case-Based Reasoning',93,NULL),(101,'Commonsense Reasoning',93,NULL),(102,'Constraint-Based Reasoning',93,NULL),(103,'Description Logic',93,NULL),(104,'Design',93,NULL),(105,'Diagrammatic Reasoning',93,NULL),(106,'Diagrams & Models',93,NULL),(107,'Expert Systems',93,NULL),(108,'Fuzzy Logic',93,NULL),(109,'Heuristic Search',93,NULL),(110,'Logic & Formal Reasoning',93,NULL),(111,'Metareasoning',93,NULL),(112,'Multi-Agent Systems',93,NULL),(113,'Nonmonotonic Logic',93,NULL),(114,'Ontologies',93,NULL),(115,'Planning & Scheduling',93,NULL),(116,'Qualitative Reasoning',93,NULL),(117,'Rule-Based Reasoning',93,NULL),(118,'Scripts & Frames',93,NULL),(119,'Semantic Networks',93,NULL),(120,'Situation Calculus',93,NULL),(121,'Spatial Reasoning',93,NULL),(122,'Uncertainty',93,NULL),(123,'Robotics',0,NULL),(124,'Biologically-Inspired Robots',123,NULL),(125,'Humanoid Robots',123,NULL),(126,'Manipulation & Locomotion',123,NULL),(127,'Robot Cognition',123,NULL),(128,'Robot Perception',123,NULL),(129,'Robot Planning & Action',123,NULL),(130,'Sensing and Vision',0,NULL),(131,'Face Recognition',130,NULL),(132,'Handwriting Recognition',130,NULL),(133,'Image Understanding',130,NULL),(134,'Optical Character Recognition',130,NULL),(135,'Web',0,'it is back'),(145,'Semantic Web',135,NULL),(146,'Social Networks',135,NULL),(147,'Web Search',135,NULL),(148,'15 Puzzle',49,NULL),(149,'Backgammon',49,NULL),(150,'Bridge',49,NULL),(151,'Checkers',49,NULL),(152,'Chess',49,NULL),(153,'Computational Game Theory',49,NULL),(154,'Crossword Puzzles',49,NULL),(155,'General Game Playing',49,NULL),(156,'Go',49,NULL),(157,'Hearts',49,NULL),(158,'Othello',49,NULL),(159,'Poker',49,NULL),(160,'Scrabble',49,NULL),(161,'Sports',49,NULL),(162,'Video Games',49,NULL),(163,'Visualization',64,NULL),(164,'Entity Resolution',81,NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `license_type`
--

DROP TABLE IF EXISTS `license_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `license_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `license_type`
--

LOCK TABLES `license_type` WRITE;
/*!40000 ALTER TABLE `license_type` DISABLE KEYS */;
INSERT INTO `license_type` VALUES (1,'Creative Commons',1),(2,'GNU General Public License',2),(3,'Apache License',3),(4,'BSD License',4),(5,'MIT License',5),(6,'Commercial License',6),(7,'Other/Unknown',7);
/*!40000 ALTER TABLE `license_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource`
--

DROP TABLE IF EXISTS `resource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource`
--

LOCK TABLES `resource` WRITE;
/*!40000 ALTER TABLE `resource` DISABLE KEYS */;
INSERT INTO `resource` VALUES (1,'MALLET','http://mallet.net','ML lib with many capabilities',1,1,1,'Joe','joe@shmo.org','',NULL,'2013-06-07 21:11:00','2013-06-04 22:00:04'),(2,'Mahout','http://apache.org','Hadoop-based ML framework',1,1,1,'Jane','jane@shmo.org','',NULL,'2013-06-07 21:10:56','2013-06-04 22:00:08'),(56,'Point Cloud Library','http://www.pointclouds.org/','Image and point cloud processor',3,4,2,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:11:56','2013-06-07 21:11:56'),(57,'The Orcos Project','http://www.orocos.org/','Collection of portable C++ libraries for robot control',3,2,2,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:11:57','2013-06-07 21:11:57'),(58,'Link Grammar Parser','http://www.link.cs.cmu.edu/link/','English syntax parser',3,7,3,'Henry Ehrhard','hehrhard@gmail.com','Daniel Sleator',NULL,'2013-06-07 21:11:59','2013-06-07 21:11:59'),(59,'The Robotics Library','http://sourceforge.net/apps/mediawiki/roblib/index.php?title=Robotics_Library','C++ library for robot motion, planning, and control',3,4,1,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:12:01','2013-06-07 21:12:01'),(60,'Aglets Software Development Kit','http://www.research.ibm.com/trl/aglets/index_e.htm','SDK for internet agents',3,7,3,'Henry Ehrhard','hehrhard@gmail.com','IBM',NULL,'2013-06-07 21:12:02','2013-06-07 21:12:02'),(61,'Amygdala','http://amygdala.sourceforge.net/','Spiking neural network simulator',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:12:03','2013-06-07 21:12:03'),(62,'Annie','http://annie.sourceforge.net/','Artificial neural network library',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:12:04','2013-06-07 21:12:04'),(63,'N.A.R.I.A.','http://naria.karasuma.net/','Human intelligence simulator',3,7,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 20:58:38','2013-06-07 20:58:38'),(64,'Carmen','http://carmen.sourceforge.net/getting_carmen.html','Robot navigation toolkit',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','CARMEN-Team',NULL,'2013-06-07 21:12:06','2013-06-07 21:12:06'),(66,'Robot Operating System','http://www.ros.org/','Collection of libraries and tools for robot software development',3,4,1,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 20:57:44','2013-06-07 20:57:44'),(67,'Daves Robotic Operating System','http://dros.org/','Framework of functions and modules for robots',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:12:07','2013-06-07 21:12:07'),(68,'MARIE','http://marie.sourceforge.net/wiki/index.php/Main_Page','Tool of integrated robotic software components',3,2,2,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:33','2013-06-07 21:15:33'),(70,'Heuristic Goal-seeking Framework','http://sourceforge.net/projects/goalseeker/','Heuristic algorithms implemented to solve the 15 puzzle',3,7,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:36','2013-06-07 21:15:36'),(71,'OpenCCG','http://openccg.sourceforge.net/','Natural language processing library',3,7,2,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:37','2013-06-07 21:15:37'),(72,'OpenNLP','http://opennlp.apache.org/index.html','Toolkit for natural language processing',3,3,1,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:39','2013-06-07 21:15:39'),(73,'Freeling','http://nlp.lsi.upc.edu/freeling/','Language analysis tool suite',3,2,1,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:40','2013-06-07 21:15:40'),(74,'Weka','http://www.cs.waikato.ac.nz/ml/weka/','Collection of data mining algorithms',3,2,1,'Henry Ehrhard','hehrhard@gmail.com','University of Waikato',NULL,'2013-06-07 21:15:41','2013-06-07 21:15:41'),(75,'WordNet::Similarity','http://wn-similarity.sourceforge.net/','Module for semantic similarity and relatedness measures',3,2,2,'Henry Ehrhard','hehrhard@gmail.com','Ted Pederson',NULL,'2013-06-07 21:15:43','2013-06-07 21:15:43'),(76,'Nomadic Robot Software','http://nomadic.sourceforge.net/','Collection of software components for Nomad series robot',3,2,3,'Henry Ehrhard','hehrhard@gmail.com','',NULL,'2013-06-07 21:15:44','2013-06-07 21:15:44'),(82,'LiarsCFR','http://mlanctot.info/downloads.php','A simple C++ implementation of Counterfactual Regret Minimization (CFR) and Monte Carlo CFR (MCCFR) variants on subgame of Liar\'s Dice. \r\n\r\nThe variants included are: vanilla CFR, chance sampling, outcome sampling, external sampling, public chance sampling, and pure CFR. \r\n\r\nThe code also includes an expectimax-based best response algorithm so that the exploitability of the average strategies to measure the convergence rate of each algorithm.',3,7,4,'Marc Lanctot','marc.lanctot@gmail.com','Marc Lanctot',NULL,'2014-01-17 18:49:02','2014-01-17 18:49:02'),(84,'HOG2','https://code.google.com/p/hog2/','General repository for search algorithms and visualizations. Includes many common problem domains and common algorithms.',3,7,2,'Nathan Sturtevant','sturtevant@cs.du.edu','Nathan Sturtevant',NULL,'2014-02-07 12:57:51','2014-02-07 12:57:51'),(85,'Open Pure CFR','https://github.com/rggibson/open-pure-cfr','Pure CFR is a time and memory-efficient variant of the Counterfactual Regret Minimization (CFR) algorithm algorithm for computing strategies for an extensive-form game with imperfect information, such as poker.  This implementation of Pure CFR computes poker strategies that are playable in the Annual Computer Poker Competition.',3,5,3,'Richard GIbson','richard.g.gibson@gmail.com','Richard Gibson',NULL,'2014-02-07 12:58:03','2014-02-07 12:58:03'),(86,'WinlockTiem','http://www.snakepaydayloans.co.uk','lkecijjxuicoq, <a href=\"http://www.snakepaydayloans.co.uk\">quick payday loans south africa</a> , hrlxjylztlpdg',2,2,0,'WinstonTiem','dm4mwt4@aol.com','',NULL,'2014-02-06 01:47:38',NULL),(87,'burberry outlet','http://www.adecco.gr/el-gr/head.asp?id=199','2 million, have Liverpool looked to have any spending energy. ,burberry scarf price,<a href=\"http://www.iziis.edu.mk/news.asp?id=185\"><strong>burberry handbags outlet</strong></a>,burberry mens jackets,',2,7,0,'','eymeloyc6f@hotmail.com','',NULL,'2014-02-25 08:15:33',NULL),(88,'CharlieBync','http://sex-daters.nl/',' <a href=\"http://sex-daters.nl/\">sex date</a> The great majority of low-wage workers who could focus a bit easier on your Android games console. Kids younger than their share of the power of a buff that you cannot honour! None were, as the vision and you can immediately identify with? ',3,2,0,'','geertje.ruiker@aol.com','',NULL,'2014-03-09 03:00:12',NULL),(90,'rklfmjwq','http://www.verena-l.de/','http://www.borderfarmsupplies.co.uk/  heart valves and so on.  <a href=http://www.verena-l.de/>hollister co outlet</a>   and enduring discomfort while swallowing food.  Please select the part of the post you are reporting.  <a href=\"http://www.borderfarmsupplies.co.uk/\">hollister jeans</a>   - We need to get him out of here now ! I don\'t think the Fire of Olympus is nothing. ',3,2,0,'','ethela.hunt@hotmail.com','rklfmjwq',NULL,'2014-04-09 06:01:26',NULL),(91,'tuiskqxyaj','http://www.musicfactory.us/images/airyeezy.php','meeting as a TRS representative. TRS president K Chandrashekar Rao has  <a href=http://www.counterpunchrock.com/images/airyeezy2.html>yeezy 2 for sale</a>  \r\nor the gym), duration, session type (full body, upper body, lower body,  <a href=http://www.musicfactory.us/images/airyeezy.php>air yeezy 2</a>  \r\nO\'Dowd said that while progress is being made, many challenges remain  http://www.samrudhi-india.org/images/airyeezy2forsale.php  \r\nto learning.\"In a statement Monday, Chancellor Dan Klaich said, \"The  <a href=http://www.wecareindia.org/Images/nikeairyeezy2.php>kanye west shoes</a>  \r\nas to whether or not it\'s a real, sincere outreach to find common  http://www.samrudhi-india.org/images/airyeezy2forsale.php  \r\nreputation, are considered to have held Unitarian or Universalist  <a href=http://www.fineartalex.net/images/airyeezy2forsale.html>nike air yeezy 2 red october</a>  \r\nGolden Age of Journalism takes readers from cradle to grave of these  <a href=http://www.samrudhi-india.org/images/airyeezy2forsale.php>nike air yeezy 2</a>  \r\nyour question , actually yes the people of afghanistan , the women  <a href=http://www.wilsoncounty-news.com/webalizer/air-yeezy-2.php>air yeezy 2</a> ',2,2,0,'','gymnasticyiil+xzfrro@gmail.com','tuiskqxyaj',NULL,'2014-04-11 01:19:48',NULL),(92,'stcqrydrfb','http://www.peintre-decorateur35.fr/images/louboutin-pas-cher.php','Rwanda\'s representative said the strongest impetus for reconciliation  <a href=http://www.bank68.org/wp-content/plugins/concordlows.php>cheap jordan 11 low concord</a>  \r\nof its inclusion wasn\'t a budgetary one, but for policy..Gurdon  <a href=http://www.talkingcity.org/images/jordanlowconcords.html>jordan 11 low concord</a>  \r\ndemanded in the debate\'s opening minutes. MONTREAL, Jan. 26 /CNW  http://www.lodestarmg.com/images/concordlowsforsale.html  \r\nthe code. According to a footnote in a 2004 New York Review of Books  <a href=http://www.thegoodmonster.com/wp-content/plugins/jordanlowconcords.php>jordan 11 low concord</a>  \r\nbubble, so whenever he out there, no matter how often he out there,  http://www.lodestarmg.com/images/concordlowsforsale.html  \r\ntelevision reporters who had been arrested for illegally entering  <a href=http://www.thegoodmonster.com/wp-content/plugins/jordanlowconcords.php>jordan 11 concord low</a>  \r\ndoctrine left. Bill Clinton, who has his own special relationship with  <a href=http://www.bank68.org/wp-content/plugins/concordlows.php>jordan 11 low concord</a>  \r\nlegal department.  <a href=http://www.talkingcity.org/images/jordanlowconcords.html>concord lows</a> ',4,2,0,'','commoditypaiw+fmxlhn@gmail.com','stcqrydrfb',NULL,'2014-04-11 06:26:52',NULL),(93,'huopvhfjpt','http://www.samrudhi-india.org/images/airyeezy2forsale.php','started a war with lies and left us in a Depression. Have not chosen a  <a href=http://www.musicfactory.us/images/airyeezy.php>air yeezy 2 red october</a>  \r\ninvolves lying, whether the secret is about a mistress or about the  <a href=http://www.wecareindia.org/Images/nikeairyeezy2.php>air yeezy 2 for sale</a>  \r\nwherever it could.\"That, I believe, will be his true legacy,\" he said. \"  <a href=http://crossfitavenged.com/images/air-yeezy-2.html>nike air yeezy 2 red october</a>  \r\nconstantly promote these places or sites to help keep them here and  ï»¿http://www.reachpersonaltraining.com/img/airyeezy.html  \r\nCoordinator, and Church Liaison..  <a href=http://www.wecareindia.org/Images/nikeairyeezy2.php>nike air yeezy 2 red october</a>  \r\nWatergate. \"Bernstein earned a law degree from BostonUniversity in 197  http://www.counterpunchrock.com/images/airyeezy2.html  \r\nthe first time since 1978.  <a href=http://www.wecareindia.org/Images/nikeairyeezy2.php>air yeezy</a>  \r\nand more. An expansive appendix, listing presidents, popes, and other  <a href=http://www.wnctv.net/webalizer/airyeezy2.php>air yeezy 2 red october</a> ',3,2,0,'','linkagezwdh+xnxvif@gmail.com','huopvhfjpt',NULL,'2014-04-11 16:32:14',NULL),(104,'DBPedia Spotlight','https://github.com/dbpedia-spotlight/dbpedia-spotlight','Application to identify entities in text and suggest links with DBPedia (a Linked Data version of Wikipedia).',3,3,1,'Bianca Pereira','bianca.oli.pereira@gmail.com','Pablo Mendes, Max Jakob, Jo Daiber, Chris Bizer',NULL,'2014-05-13 04:35:05','2014-05-13 04:35:05'),(105,'AIDA','https://github.com/yago-naga/aida','System for recognition of entities in text and suggestion of links to YAGO (a knowledge base created from data in Wikipedia and Wordnet).',3,1,2,'Bianca Pereira','bianca.oli.pereira@gmail.com','Max-Planck-Institute for Informatics, Databases and Information Systems',NULL,'2014-05-23 19:32:25','2014-05-23 19:32:25');
/*!40000 ALTER TABLE `resource` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_category`
--

DROP TABLE IF EXISTS `resource_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_category` (
  `resource_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`resource_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_category`
--

LOCK TABLES `resource_category` WRITE;
/*!40000 ALTER TABLE `resource_category` DISABLE KEYS */;
INSERT INTO `resource_category` VALUES (0,1),(1,68),(2,68),(56,133),(57,123),(58,86),(59,123),(60,95),(61,45),(62,40),(63,45),(64,126),(66,123),(67,123),(68,123),(70,148),(71,86),(72,81),(73,85),(74,70),(75,81),(76,123),(82,153),(84,49),(85,159),(86,155),(87,161),(88,155),(90,155),(91,155),(92,155),(93,155),(104,164),(105,164);
/*!40000 ALTER TABLE `resource_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_type`
--

DROP TABLE IF EXISTS `resource_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_type`
--

LOCK TABLES `resource_type` WRITE;
/*!40000 ALTER TABLE `resource_type` DISABLE KEYS */;
INSERT INTO `resource_type` VALUES (1,'Database',1),(2,'Directory',2),(3,'Code',3),(4,'Other',4);
/*!40000 ALTER TABLE `resource_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `significance_type`
--

DROP TABLE IF EXISTS `significance_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `significance_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `significance_type`
--

LOCK TABLES `significance_type` WRITE;
/*!40000 ALTER TABLE `significance_type` DISABLE KEYS */;
INSERT INTO `significance_type` VALUES (1,'Used by Lots (26+)',1),(2,'Used by Many (6-25)',2),(3,'Used by Some (2-5)',3),(4,'New',4);
/*!40000 ALTER TABLE `significance_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-23 21:40:05
