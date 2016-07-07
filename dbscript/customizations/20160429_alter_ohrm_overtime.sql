ALTER TABLE `ohrm_overtime` ADD COLUMN `ot_date` DATE NOT NULL AFTER status;
ALTER TABLE `ohrm_overtime` ADD COLUMN `start_time` TIME NOT NULL AFTER `ot_date`;
ALTER TABLE `ohrm_overtime` ADD COLUMN `end_time` time NOT NULL AFTER `start_time`;
ALTER TABLE `ohrm_overtime` ADD COLUMN `hours_rendered` DECIMAL(5,2) NOT NULL DEFAULT 0.00 AFTER `end_time`;

ALTER TABLE `ohrm_leave_file` ADD COLUMN `start_datetime` TIME NOT NULL AFTER `remarks`;
ALTER TABLE `ohrm_leave_file` ADD COLUMN `end_datetime` time NOT NULL AFTER `start_time`;

