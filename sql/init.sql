DROP TABLE response_sessions;
DROP TABLE response_answers;

CREATE TABLE IF NOT EXISTS `response_sessions` (
  `id_session` int(10) NOT NULL AUTO_INCREMENT,
  `start` varchar(40) NOT NULL,
  `end` varchar(40) NOT NULL,
  `custom_vars` LONGTEXT,
  `custom_data` LONGTEXT,
  PRIMARY KEY (`id_session`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `response_answers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_session` int(10) NOT NULL,
  `question_id` int(10) NOT NULL,
  `time` varchar(40) NOT NULL,
  `answer` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_session` (`id_session`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
