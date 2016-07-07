INSERT INTO `ohrm_data_group` (`name`, `description`, `can_read`, `can_create`, `can_update`, `can_delete`)
VALUES ('qualification_character_reference', 'PIM - Qualifications - Character Reference', 1, 1, 1, 1);

INSERT INTO `ohrm_user_role_data_group` (user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (1, 64, 1, 1, 1, 1, 0);