DROP TABLE IF EXISTS `hs_hr_overtime_matrix`;
CREATE TABLE `hs_hr_overtime_matrix` (
  `id` int(11) 				NOT NULL AUTO_INCREMENT,
  `number_of_hours` 		decimal(5,2) NOT NULL DEFAULT '0.00',
  `regular_work_shift` 		decimal(5,2) NOT NULL DEFAULT '0.00',
  `rest_day` 				decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (3, 		3, 			3);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (3.5, 		3, 			3);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (4, 		3.5, 		4);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (4.5, 		4, 			4.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (5, 		4.5, 		5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (5.5, 		5, 			5.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (6, 		5.5, 		6);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (6.5, 		5.5, 		6.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (7, 		6, 			7);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (7.5, 		6.5, 		7.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (8, 		7, 			8);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (8.5, 		7.5, 		8.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (9, 		8, 			8);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (9.5, 		8, 			8.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (10, 		8.5, 		9);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (10.5, 	9, 			9.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (11, 		9.5, 		10);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (11.5, 	10, 		10.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (12, 		10.5, 		10.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (12.5, 	10.5, 		11);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (13, 		11, 		11.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (13.5, 	11.5, 		12);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (14, 		12, 		12.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (14.5, 	12.5, 		13);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (15, 		13, 		13);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (15.5, 	13, 		13.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (16, 		13.5, 		14);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (16.5, 	14, 		14.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (17, 		14.5, 		15);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (17.5, 	15, 		15.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (18, 		15.5, 		15.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (18.5, 	15.5, 		16);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (19, 		16, 		16.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (19.5, 	16.5, 		17);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (20, 		17, 		17.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (20.5, 	17.5, 		18);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (21, 		18, 		18);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (21.5, 	18, 		18.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (22, 		18.5, 		19);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (22.5, 	19, 		19.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (23, 		19.5, 		20);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (23.5, 	20, 		20.5);
INSERT INTO hs_hr_overtime_matrix (number_of_hours, regular_work_shift, rest_day) VALUES (24, 		20, 		20.5);
