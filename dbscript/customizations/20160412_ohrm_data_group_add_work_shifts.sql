INSERT INTO `ohrm_data_group` (name, description, can_read, can_create, can_update, can_delete)
VALUES ('work_shifts', 'PIM - Work Shifts', 1, 1, 1, 1);
INSERT INTO `ohrm_data_group` (name, description, can_read, can_create, can_update, can_delete)
VALUES ('work_shifts_attachments', 'PIM - Work Shifts - Attachments', 1, 1, 1, 1);
INSERT INTO `ohrm_data_group` (name, description, can_read, can_create, can_update, can_delete)
VALUES ('work_shifts_custom_fields', 'PIM - Work Shifts - Custom Fields', 1, null, 1, null);



-- ADMIN
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (1, 67, 1, 1, 1, 1, 0);
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (1, 68, 1, 1, 1, 1, 0);
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (1, 69, 1, null, 1, null, 0);

-- ESS
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (2, 67, 1, 0, 0, 0, 1);
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (2, 68, 1, 0, 0, 0, 1);
INSERT INTO ohrm_user_role_data_group(user_role_id, data_group_id, can_read, can_create, can_update, can_delete, self)
VALUES (2, 69, 1, 0, 0, 0, 1);