DROP TABLE IF EXISTS `ohrm_holiday_location`;
CREATE TABLE `ohrm_holiday_location` (
  `holiday_location_id` 	int(11) NOT NULL AUTO_INCREMENT,
  `holiday_id` 				int(11) unsigned NOT NULL,
  `location_id` 			int(11) unsigned NOT NULL,
  `date_created` 			datetime DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`holiday_location_id`),
  KEY `holiday_id` (`holiday_id`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `ohrm_holiday_location_ibfk_1` FOREIGN KEY (`holiday_id`) REFERENCES `ohrm_holiday` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;