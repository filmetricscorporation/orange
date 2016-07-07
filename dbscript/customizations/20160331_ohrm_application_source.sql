DROP TABLE IF EXISTS `ohrm_application_source`
CREATE TABLE `ohrm_application_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ohrm_application_source` (`name`) VALUES ('Referral');
INSERT INTO `ohrm_application_source` (`name`) VALUES ('Walk-In');
INSERT INTO `ohrm_application_source` (`name`) VALUES ('Filmetrics-Careers');
INSERT INTO `ohrm_application_source` (`name`) VALUES ('JobStreet');
INSERT INTO `ohrm_application_source` (`name`) VALUES ('Kalibrr');
INSERT INTO `ohrm_application_source` (`name`) VALUES ('JobsDB');


-- ohrm_screen
INSERT INTO ohrm_screen (name, module_id, action_url) VALUES ('Application Source List', '7', 'viewApplicationSources');

-- add to ohrm_menu_item
UPDATE ohrm_menu_item SET screen_id = 118 WHERE menu_title = 'Application Sources';

-- ohrm_user_role_screen
INSERT INTO ohrm_user_role_screen(user_role_id, screen_id, can_read, can_create, can_update, can_delete)
VALUES (1, 118, 1, 1, 1, 1);

