ALTER TABLE `hs_hr_emp_work_experience` ADD COLUMN `eexp_address` varchar(150) DEFAULT NULL AFTER `eexp_to_date`;
ALTER TABLE `hs_hr_emp_work_experience` ADD COLUMN `eexp_immediate_superior` varchar(100) DEFAULT NULL AFTER `eexp_address`;
ALTER TABLE `hs_hr_emp_work_experience` ADD COLUMN `eexp_salary` decimal(10,2) DEFAULT 0.00 AFTER `eexp_immediate_superior`;
ALTER TABLE `hs_hr_emp_work_experience` ADD COLUMN `eexp_contact_number` varchar(30) DEFAULT NULL AFTER `eexp_salary`;