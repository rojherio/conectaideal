CREATE TABLE `bsc_unidade_organizacional_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seg_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bsc_unidade_organizacional_tipo_seg_usuario1_idx` (`seg_usuario_id`),
  CONSTRAINT `fk_bsc_unidade_organizacional_tipo_seg_usuario1` FOREIGN KEY (`seg_usuario_id`) REFERENCES `seg_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE `bsc_unidade_organizacional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(45) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seg_usuario_id` int(11) NOT NULL,
  `bsc_unidade_organizacional_tipo_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bsc_unidade_organizacional_seg_usuario1_idx` (`seg_usuario_id`),
  KEY `fk_bsc_unidade_organizacional_bsc_unidade_organizacional_ti_idx` (`bsc_unidade_organizacional_tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;



CREATE TABLE `eo_cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seg_usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_eo_cargo_seg_usuario1_idx` (`seg_usuario_id`),
  CONSTRAINT `fk_eo_cargo_seg_usuario1` FOREIGN KEY (`seg_usuario_id`) REFERENCES `seg_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;



CREATE TABLE `eo_setor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(45) DEFAULT NULL,
  `nome` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dt_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seg_usuario_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_eo_setor_seg_usuario1_idx` (`seg_usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;