DROP TABLE IF EXISTS `ohrm_day_name`;
CREATE TABLE `ohrm_day_name` (
  `id` 		int(10) unsigned NOT NULL AUTO_INCREMENT,
  `day_name` varchar(20) NOT NULL DEFAULT 'n/a',
  `short_day_name` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`,`day_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `ohrm_day_name`(day_name, short_day_name) VALUES ('Monday', 'MON');
INSERT INTO `ohrm_day_name`(day_name, short_day_name) VALUES ('Tuesday', 'TUE');
INSERT INTO `ohrm_day_name`(day_name, short_day_name) VALUES ('Wednesday', 'WED');
INSERT INTO `ohrm_day_name`(day_name, short_day_name) VALUES ('Thursday', 'THU');
INSERT INTO `ohrm_day_name`(day_name, short_day_name) VALUES ('Friday', 'FRI');
INSERT INTO `ohrm_day_name`(day_name, short_day_name) VALUES ('Saturday', 'SAT');
INSERT INTO `ohrm_day_name`(day_name, short_day_name) VALUES ('Sunday', 'SUN');