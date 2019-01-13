DROP TABLE Kata_test_sesion;
DROP TABLE Kata_test_odpoved;

CREATE TABLE IF NOT EXISTS `Kata_test_sesion` (
  `id_sesion` int(10) NOT NULL AUTO_INCREMENT,
  `zacatek` varchar(40) NOT NULL,
  `delka_plneni` int(10) NOT NULL,
  `konec` varchar(40) NOT NULL,
  PRIMARY KEY (`id_sesion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `Kata_test_odpoved` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_sesion` int(10) NOT NULL,
  `cas` varchar(40) NOT NULL,
  `odpoved` varchar(40) NOT NULL,
  `otazka` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sesion` (`id_sesion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;