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

/*Table structure for table `atividades` */

DROP TABLE IF EXISTS `atividades`;

CREATE TABLE `atividades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `atividades` */

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `atividade_id` bigint(20) unsigned NOT NULL,
  `razao_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_fantasia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pago` enum('Sim','Não') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Não',
  `dt_experiencia` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `empresas_atividade_id_foreign` (`atividade_id`),
  CONSTRAINT `empresas_atividade_id_foreign` FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `empresas` */

/*Table structure for table `enderecos` */

DROP TABLE IF EXISTS `enderecos`;

CREATE TABLE `enderecos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `cep` varchar(15) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `principal` enum('Sim','Não') DEFAULT NULL,
  `usuario_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_endereco` (`usuario_id`),
  CONSTRAINT `fk_usuario_endereco` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `enderecos` */

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
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `tipo` enum('Laboratório','Colaborador','Parceiro','Veterinário','Administrador') NOT NULL DEFAULT 'Laboratório',
  `avatar` varchar(255) DEFAULT NULL,
  `cpf_cnpj` varchar(14) DEFAULT NULL,
  `ativo` enum('Sim','Não') DEFAULT 'Sim',
  `telefone` varchar(20) DEFAULT NULL,
  `empresa_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email` (`email`),
  KEY `users_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `users_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nome`,`email`,`senha`,`tipo`,`avatar`,`cpf_cnpj`,`ativo`,`telefone`,`empresa_id`) values (1,'Matheus de Mello','matheusnarciso@hotmail.com','e10adc3949ba59abbe56e057f20f883e','Laboratório',NULL,'36848874809','Sim','16991838523',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
