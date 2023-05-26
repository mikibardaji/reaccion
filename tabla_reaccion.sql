CREATE TABLE `reaccion` (
  `palabra` varchar(25) NOT NULL,
  `revisada` tinyint(1) NOT NULL,
  `n_cadena` bigint(20) NOT NULL,
  `pos` int(11) NOT NULL,
  `ordre_secuencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


COMMIT;