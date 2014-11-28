# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.44)
# Database: 99motoboy
# Generation Time: 2014-11-07 06:56:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table analytics
# ------------------------------------------------------------

DROP TABLE IF EXISTS `analytics`;

CREATE TABLE `analytics` (
  `id_analytics` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` varchar(100) DEFAULT NULL,
  `token_type` varchar(100) DEFAULT NULL,
  `expires_in` int(11) DEFAULT NULL,
  `refresh_token` varchar(100) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `data_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`id_analytics`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table analytics_profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `analytics_profile`;

CREATE TABLE `analytics_profile` (
  `id_analytics_profile` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `id` int(11) NOT NULL,
  `property_id` varchar(20) NOT NULL,
  `site_url` varchar(250) NOT NULL,
  `time_shift` varchar(20) NOT NULL,
  `time_zone` varchar(40) NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_analytics_profile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table cliente
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `termos` int(1) NOT NULL DEFAULT '0',
  `ativo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;

INSERT INTO `cliente` (`id_cliente`, `nome`, `email`, `cpf`, `cnpj`, `telefone`, `senha`, `termos`, `ativo`)
VALUES
	(1,'Roberto','rcmsjr@gmail.com','092.342.456-09','','(51) 9012-3245','81dc9bdb52d04dc20036dbd8313ed055',1,1),
	(2,'Teste','teste@gmail.com','334.142.421-34','','(21) 3413-41251','81dc9bdb52d04dc20036dbd8313ed055',0,1);

/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cliente_endereco
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cliente_endereco`;

CREATE TABLE `cliente_endereco` (
  `id_cliente_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `local` varchar(250) NOT NULL,
  `numero` int(11) NOT NULL COMMENT '			',
  `complemento` varchar(70) DEFAULT NULL,
  `responsavel` varchar(70) NOT NULL COMMENT '				',
  `observacao` varchar(250) DEFAULT NULL,
  `lat` varchar(70) NOT NULL,
  `long` varchar(70) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente_endereco`),
  KEY `fk_cliente_endereco_cliemne1_idx` (`id_cliente`),
  CONSTRAINT `fk_cliente_endereco_cliemne1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(70) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table institucional
# ------------------------------------------------------------

DROP TABLE IF EXISTS `institucional`;

CREATE TABLE `institucional` (
  `id_institucional` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `subtitulo` varchar(250) DEFAULT NULL,
  `texto` text,
  PRIMARY KEY (`id_institucional`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `institucional` WRITE;
/*!40000 ALTER TABLE `institucional` DISABLE KEYS */;

INSERT INTO `institucional` (`id_institucional`, `titulo`, `subtitulo`, `texto`)
VALUES
	(1,'Sobre o Moto Fretes','','Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.\r\n'),
	(2,'Valores e Missão','','Casamentiss faiz malandris se pirulitá, Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer Ispecialista im mé intende tudis nuam golada, vinho, uiski, carirí, rum da jamaikis, só num pode ser mijis. Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
	(3,'Preciso de frete','','Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.');

/*!40000 ALTER TABLE `institucional` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table motoboy
# ------------------------------------------------------------

DROP TABLE IF EXISTS `motoboy`;

CREATE TABLE `motoboy` (
  `id_motoboy` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `placa` varchar(8) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(70) DEFAULT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  `lat` varchar(70) NOT NULL,
  `lng` varchar(70) NOT NULL DEFAULT '',
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(12) NOT NULL,
  `condumoto` varchar(10) DEFAULT NULL,
  `licenca` varchar(10) DEFAULT NULL,
  `senha` varchar(32) NOT NULL,
  `imagem` varchar(38) DEFAULT NULL,
  `copia_cnh` varchar(38) NOT NULL,
  `termos` int(1) NOT NULL DEFAULT '0',
  `ativo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_motoboy`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `rg_UNIQUE` (`rg`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `placa_UNIQUE` (`placa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `motoboy` WRITE;
/*!40000 ALTER TABLE `motoboy` DISABLE KEYS */;

INSERT INTO `motoboy` (`id_motoboy`, `nome`, `email`, `data_nascimento`, `telefone`, `celular`, `placa`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `lat`, `lng`, `cpf`, `rg`, `condumoto`, `licenca`, `senha`, `imagem`, `copia_cnh`, `termos`, `ativo`)
VALUES
	(1,'Roberto','rcmsjr@gmail.com','1989-07-09','(51) 8542-9069','','asd-1234','91520-630','Rua Saldanha da Gama',853,'','São José','-30.062849','-51.1620206','122.323.232-12','12345678','','','81dc9bdb52d04dc20036dbd8313ed055','','',1,1);

/*!40000 ALTER TABLE `motoboy` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table newsletter
# ------------------------------------------------------------

DROP TABLE IF EXISTS `newsletter`;

CREATE TABLE `newsletter` (
  `id_newsletter` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) DEFAULT NULL,
  `email` varchar(70) NOT NULL,
  `data` date NOT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_newsletter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_perfil` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `sobrenome` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `telefone` varchar(70) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `ativo` int(1) NOT NULL DEFAULT '1',
  `usuario` varchar(70) NOT NULL,
  `senha` varchar(70) NOT NULL,
  `imagem` varchar(38) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuario_usuario_perfil_idx` (`id_usuario_perfil`),
  CONSTRAINT `fk_usuario_usuario_perfil` FOREIGN KEY (`id_usuario_perfil`) REFERENCES `usuario_perfil` (`id_usuario_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;

INSERT INTO `usuario` (`id_usuario`, `id_usuario_perfil`, `nome`, `sobrenome`, `email`, `telefone`, `data_nascimento`, `ativo`, `usuario`, `senha`, `imagem`)
VALUES
	(1,1,'Root','teste','rcmsjr@gmail.com','(51) 8542-9069','1989-07-09',1,'root','81369639051442778f272fd27e39353a','2bcb8cdc7db09010fdb85cc568cfe8f7.'),
	(2,2,'Leonardo','Schilfield','leonardo@ls.com','','0000-00-00',0,'leonardo','81dc9bdb52d04dc20036dbd8313ed055','3d32b99bc7e307f88c597fe463667af4.'),
	(3,2,'Admin','','marcelo@anb.net.br','','0000-00-00',1,'admin','0192023a7bbd73250516f069df18b500','9c1cfac622234b2327add35be46b5719.'),
	(4,2,'teste2','teste2','teste2@teste.tee','','0000-00-00',1,'teste2','81dc9bdb52d04dc20036dbd8313ed055','b6e0a087a3893a42009b57243cabef0f.');

/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table usuario_perfil
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuario_perfil`;

CREATE TABLE `usuario_perfil` (
  `id_usuario_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  PRIMARY KEY (`id_usuario_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usuario_perfil` WRITE;
/*!40000 ALTER TABLE `usuario_perfil` DISABLE KEYS */;

INSERT INTO `usuario_perfil` (`id_usuario_perfil`, `titulo`)
VALUES
	(1,'Desenvolvedor'),
	(2,'Master');

/*!40000 ALTER TABLE `usuario_perfil` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
