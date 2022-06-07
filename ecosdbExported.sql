/*
SQLyog Ultimate v9.02 
MySQL - 5.0.45-community-nt : Database - ecosdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `categorias` */

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` int(11) NOT NULL auto_increment,
  `categoria` varchar(30) default NULL,
  `nombre` varchar(80) default NULL,
  `precio` varchar(30) default NULL,
  `artista` varchar(80) default NULL,
  `imagen` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `productos` */

insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (1,'CD','Radiohead - COM LAG EP','500','Radiohead','products-images/comlag.jpg');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (17,'CD','The White Stripes - Elephant','400','The White Stripes','products-images/R-567336-124958620520220604050635.jpg');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (26,'CD','Tool - Undertow','400','Tool','products-images/R-7698859-1471741427-871020220604070613.jpg');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (35,'CD','Deftones - Koi No Yokan','550','Deftones','products-images/DEFTONES-KOI-NO-YOKAN-BIG-560x60020220605050633.jpg');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (36,'Vinilo','The Alan Parsons Project - I Robot','1000','The Alan Parsons Project','products-images/irobot20220605050629.JPG');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (37,'Vinilo','Pink Floyd - The Piper At The Gates Of Dawn','1200','Pink Floyd','products-images/piper20220605050636.JPG');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (38,'DVD','Soda Stereo - Gira Me Veras Volver','500','Soda Stereo','products-images/meverasvolver20220605050625.JPG');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (39,'DVD','Pink Floyd - The Wall','600','Pink Floyd','products-images/thewalldvd20220605050608.JPG');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (40,'Vinilo','Frank Zappa - Sheik Yerbouti','1000','Frank Zappa','products-images/sheik20220605050608.JPG');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (41,'Vinilo','U2 - The Unforgettable Fire','1200','U2','products-images/unforgettable20220605050620.JPG');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (42,'CD','Muse - The Resistance','400','Muse','products-images/resistance20220605050631.JPG');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (43,'Ropa','Remera Tool 10000 Days Negra','800','Tool','products-images/remeratool20220605060641.JPG');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (44,'Ropa','Remera Soundgarden Badmotorfinger','800','Soundgarden','products-images/remerasound20220605060659.JPG');
insert  into `productos`(`id`,`categoria`,`nombre`,`precio`,`artista`,`imagen`) values (45,'Ropa','Buzo Manga Larga Godflesh Negro','700','Godflesh','products-images/remeragodflesh20220605060648.JPG');

/*Table structure for table `productos_img` */

DROP TABLE IF EXISTS `productos_img`;

CREATE TABLE `productos_img` (
  `id_producto` int(11) NOT NULL,
  `imagen` text NOT NULL,
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `productos_img` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
