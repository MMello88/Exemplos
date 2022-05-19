/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.10-MariaDB : Database - pet
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pet` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pet`;

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('main','header','footer','contato','sobre','serviço','plano') NOT NULL,
  `param` varchar(255) NOT NULL,
  `value` varchar(4000) DEFAULT NULL,
  `valueImg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_param` (`tipo`,`param`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pages` */

insert  into `pages`(`id`,`tipo`,`param`,`value`,`valueImg`) values (1,'header','titulo','Bem vindo ao Pets',NULL),(2,'header','meta','pet; laboratório; petshop; ',NULL);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `tipo` enum('Laboratório','Colaborador','Parceiro','Veterinário','Administrador') NOT NULL DEFAULT 'Laboratório',
  `avatar` varchar(255) DEFAULT NULL,
  `cpf_cnpj` varchar(14) DEFAULT NULL,
  `ativo` enum('Sim','Não') DEFAULT 'Sim',
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nome`,`email`,`senha`,`tipo`,`avatar`,`cpf_cnpj`,`ativo`,`telefone`) values (1,'Matheus de Mello','matheusnarciso@hotmail.com','e10adc3949ba59abbe56e057f20f883e','Laboratório',NULL,'36848874809','Sim','16991838523');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
