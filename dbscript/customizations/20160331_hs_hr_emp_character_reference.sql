DROP TABLE IF EXISTS `hs_hr_emp_character_reference`;
CREATE TABLE `hs_hr_emp_character_reference` (
  `emp_number` int(7) NOT NULL DEFAULT '0',
  `ecr_seqno` decimal(10,0) NOT NULL DEFAULT '0',
  `ecr_name` varchar(150) DEFAULT NULL,
  `ecr_relation` varchar(30) DEFAULT NULL,
  `ecr_company` varchar(100) DEFAULT NULL,
  `ecr_position` varchar(50) DEFAULT NULL,
  `ecr_contact_number` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`ecr_seqno`),
  CONSTRAINT `hs_hr_emp_character_reference_ibfk_1` FOREIGN KEY (`emp_number`) REFERENCES `hs_hr_employee` (`emp_number`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `hs_hr_emp_character_reference`;
CREATE TABLE `hs_hr_emp_character_reference` (
  `emp_number` int(7) NOT NULL DEFAULT '0',
  `ecr_name` varchar(150) DEFAULT NULL,
  `ecr_relation` varchar(30) DEFAULT NULL,
  `ecr_company` varchar(100) DEFAULT NULL,
  `ecr_position` varchar(50) DEFAULT NULL,
  `ecr_contact_number` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`emp_number`,`ecr_seqno`),
  CONSTRAINT `hs_hr_emp_character_reference_ibfk_1` FOREIGN KEY (`emp_number`) REFERENCES `hs_hr_employee` (`emp_number`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;