ALTER TABLE `ohrm_work_shift` ADD COLUMN `first_half_start_time` TIME NOT NULL AFTER `end_time`;
ALTER TABLE `ohrm_work_shift` ADD COLUMN `first_half_end_time` TIME NOT NULL AFTER `first_half_start_time`;

ALTER TABLE `ohrm_work_shift` ADD COLUMN `second_half_start_time` TIME NOT NULL AFTER `first_half_end_time`;
ALTER TABLE `ohrm_work_shift` ADD COLUMN `second_half_end_time` TIME NOT NULL AFTER `second_half_start_time`;