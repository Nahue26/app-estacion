CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 0,
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0,
  `recupero` tinyint(1) NOT NULL DEFAULT 0,
  `token_action` varchar(255) DEFAULT NULL,
  `add_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_date` datetime DEFAULT NULL,
  `active_date` datetime DEFAULT NULL,
  `blocked_date` datetime DEFAULT NULL,
  `recover_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;