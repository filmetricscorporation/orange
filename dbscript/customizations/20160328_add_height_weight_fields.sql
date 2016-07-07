ALTER TABLE `hs_hr_employee` ADD COLUMN `height` decimal(4,2) DEFAULT 0.00 AFTER `emp_gender`;
ALTER TABLE `hs_hr_employee` ADD COLUMN `weight` decimal(4,2) DEFAULT 0.00 AFTER `height`;