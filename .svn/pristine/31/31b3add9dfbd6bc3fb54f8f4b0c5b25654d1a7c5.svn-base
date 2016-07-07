INSERT INTO `ohrm_data_group` (name, description, can_read, can_create, can_update, can_delete)
VALUES ('family_members', 'PIM - Family Members', 1, 1, 1, 1);
INSERT INTO `ohrm_data_group` (name, description, can_read, can_create, can_update, can_delete)
VALUES ('family_members_attachments', 'PIM - Family Members - Attachments', 1, 1, 1, 1);
INSERT INTO `ohrm_data_group` (name, description, can_read, can_create, can_update, can_delete)
VALUES ('family_members_custom_fields', 'PIM - Family Members - Custom Fields', 1, null, 1, null);


-- ADMIN
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (1, 61, 1, 1, 1, 1, 0);
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (1, 62, 1, 1, 1, 1, 0);
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (1, 63, 1, null, 1, null, 0);

-- ESS
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (2, 61, 1, 0, 0, 0, 1);
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (2, 62, 1, 0, 0, 0, 1);
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (2, 63, 1, 0, 0, 0, 1);

DROP TABLE IF EXISTS `hs_hr_emp_family_members`;
CREATE TABLE `hs_hr_emp_family_members` (
  `emp_number` int(7) NOT NULL DEFAULT '0',
  `ef_seqno` decimal(2,0) NOT NULL DEFAULT '0',
  `ef_name` varchar(100) DEFAULT '',
  `ef_relationship_type` enum('father','mother','brother','sister','child','other') DEFAULT NULL,
  `ef_relationship` varchar(100) DEFAULT '',
  `ef_date_of_birth` date DEFAULT NULL,
  `ef_occupation` varchar(100) DEFAULT '',
  PRIMARY KEY (`emp_number`,`ef_seqno`),
  CONSTRAINT `hs_hr_emp_family_members_ibfk_1` FOREIGN KEY (`emp_number`) REFERENCES `hs_hr_employee` (`emp_number`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;