CREATE TABLE `hs_hr_paybasis` (
  `paybasis_code` varchar(13) NOT NULL DEFAULT '',
  `paybasis_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`paybasis_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO hs_hr_paybasis VALUES (1, 'Monthly');
INSERT INTO hs_hr_paybasis VALUES (2, 'Daily');


ALTER TABLE `hs_hr_emp_basicsalary` ADD COLUMN `paybasis_code` varchar(13) DEFAULT NULL AFTER `payperiod_code`;

-- POPULATE
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',1  , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',2  , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',3  , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',4  , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',5  , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',6  , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',7  , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',8  , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',9  , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',10 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',11 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',12 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',13 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',14 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',15 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',16 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',17 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',18 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',19 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',20 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',21 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',22 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',23 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',24 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',25 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',26 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',27 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',28 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',29 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',30 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',31 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',32 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',33 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',34 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',35 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',36 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',37 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',38 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',39 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',40 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',41 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',42 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',43 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',44 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',45 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',46 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',47 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',48 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',49 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',50 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',51 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',52 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',53 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',54 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',55 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',56 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',57 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',58 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',59 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',60 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',61 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',62 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',63 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',64 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',65 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',66 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',67 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',68 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',69 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',70 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',71 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',72 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',73 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',74 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',75 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',76 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',77 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',78 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',79 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',80 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',81 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',82 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',83 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',84 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',85 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',86 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',87 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',88 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',89 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',90 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',91 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',92 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',93 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',94 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',95 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',96 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',97 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',98 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',99 , 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',100, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',101, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',102, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',103, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',104, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',105, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',106, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',107, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',108, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',109, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',110, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',111, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',112, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',113, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',114, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',115, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',116, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',117, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',118, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',119, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',120, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',121, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',122, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',123, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',124, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',125, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',126, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',127, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('0',128, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',129, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',130, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',131, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',132, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',133, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',134, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('1',135, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',136, 'PHP');
INSERT INTO hs_hr_emp_basicsalary(paybasis_code, emp_number, currency_id) VALUES ('2',137, 'PHP');