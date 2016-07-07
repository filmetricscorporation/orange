ALTER TABLE `ohrm_holiday` ADD COLUMN `holiday_type_id` INT(10) NOT NULL DEFAULT 0 AFTER `operational_country_id`;

DROP TABLE IF EXISTS `ohrm_holiday_type`;
CREATE TABLE `ohrm_holiday_type` (
  `id` 			int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name`		varchar(100) NOT NULL,
	`deleted`	tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ohrm_screen
INSERT INTO ohrm_screen(`name`, `module_id`, `action_url`)
VALUES ('Holiday Type List', '4', 'holidayTypeList');

INSERT INTO ohrm_screen(`name`, `module_id`, `action_url`)
VALUES ('Define Leave Type', '4', 'defineHolidayType');
INSERT INTO ohrm_screen(`name`, `module_id`, `action_url`)
VALUES ('Undelete Leave Type', '4', 'undeleteHolidayType');
INSERT INTO ohrm_screen(`name`, `module_id`, `action_url`)
VALUES ('Delete Leave Type', '4', 'deleteHolidayType');


-- ohrm_menu_items
INSERT INTO ohrm_menu_item (`menu_title`, `screen_id`, `parent_id`, `level`, `order_hint`, `status`) 
VALUES ('Holiday Types', 118, 42, 3, 500, 1);

-- ohrm_data_group
INSERT INTO ohrm_data_group(`name`, `description`, `can_read`, `can_create`, `can_update`, `can_delete`)
VALUES ('holiday types', 'Holiday - Holiday Types', 1, 1, 1, 1);

-- ADMIN
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (1, 70, 1, 1, 1, 1, 0);
-- ESS
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (2, 70, 1, 0, 0, 0, 1);

-- ohrm_user_role_screen
INSERT INTO ohrm_user_role_screen(user_role_id, screen_id, can_read, can_create, can_update, can_delete)
VALUES (1, 118, 1, 1, 1, 1);
INSERT INTO ohrm_user_role_screen(user_role_id, screen_id, can_read, can_create, can_update, can_delete)
VALUES (1, 119, 1, 1, 1, 1);
INSERT INTO ohrm_user_role_screen(user_role_id, screen_id, can_read, can_create, can_update, can_delete)
VALUES (1, 120, 1, 1, 1, 1);
INSERT INTO ohrm_user_role_screen(user_role_id, screen_id, can_read, can_create, can_update, can_delete)
VALUES (1, 121, 1, 1, 1, 1);


-- ohrm_user_role_data_group
INSERT INTO ohrm_data_group_screen (data_group_id, screen_id, permission)
VALUES (70, 118, 1);
INSERT INTO ohrm_data_group_screen (data_group_id, screen_id, permission)
VALUES (70, 119, 1);
INSERT INTO ohrm_data_group_screen (data_group_id, screen_id, permission)
VALUES (70, 119, 2);
INSERT INTO ohrm_data_group_screen (data_group_id, screen_id, permission)
VALUES (70, 119, 3);
INSERT INTO ohrm_data_group_screen (data_group_id, screen_id, permission)
VALUES (70, 120, 2);
INSERT INTO ohrm_data_group_screen (data_group_id, screen_id, permission)
VALUES (70, 121, 4);

