ALTER TABLE `hs_hr_employee` ADD COLUMN `is_confidential` tinyint(1) NOT NULL DEFAULT 0 AFTER `approval_signatory`;

ALTER TABLE `ohrm_user` ADD COLUMN `allow_access_confidential` tinyint(1) NOT NULL DEFAULT 0 AFTER `user_password_asp`;

INSERT INTO `hs_hr_config` (`key`, `value`) VALUES ('subunit_graph_start_level', '4');