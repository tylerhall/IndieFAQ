# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.41-3ubuntu12.10)
# Database: support
# Generation Time: 2012-07-02 20:46:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table kb_articles
# ------------------------------------------------------------

CREATE TABLE `kb_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `body` text,
  `section_id` int(11) DEFAULT NULL,
  `keywords` text,
  `published` tinyint(4) DEFAULT NULL,
  `dt_created` datetime DEFAULT NULL,
  `dt_modified` datetime DEFAULT NULL,
  `pinned` tinyint(4) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table kb_searches
# ------------------------------------------------------------

CREATE TABLE `kb_searches` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `q` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table kb_sections
# ------------------------------------------------------------

CREATE TABLE `kb_sections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table kb_sessions
# ------------------------------------------------------------

CREATE TABLE `kb_sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_on` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
