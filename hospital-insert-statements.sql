INSERT INTO Department (dep_name, department_head) VALUES 
('Emergency department' , 'Jeffrey Dean'),
('Cardiology' , 'Jennie Farmer'),
('Paediatric Intensive Care Unit' , 'Nadine Soto'),
('Neonatal Intensive Care Unit' , 'Mayson Holcomb'),
('Cardiovascular Intensive Care Unit' , 'Tomas Dunne'),
('Neurology' , 'Bo Duffy'),
('Oncology' , 'Nida Webb'),
('Obstetrics and Gynaecology' , 'Emmy Gale');

INSERT INTO Rooms (department, room_number, room_floor) VALUES 
('Emergency department', 1005, 1),
('Cardiology', 2006, 2),
('Neurology', 3010, 3),
('Oncology', 4021, 4),
('Pediatric Intensive care', 5010, 5);

INSERT INTO Person (first_name, last_name, SSN, address, dob) VALUES
('Mohsin' , 'Tapia' , '636-82-9871', '572 Charles Ave. New Cuyama, CA 93254','12/2/1958'),
('Eloise', 'Walter', '357-76-4435', '59 Wharf Drive Oakland, CA 94606', '7/16/1970'),
('Latoya', 'Carson', '619-08-4756', '9799 Kingston Court Mendota, CA 93640','6/13/1972'),
('Luc' , 'Barajas', '546-49-7689', '768 Shade Road Fresno, CA 93775','5/27/1980'),
('Yvette' ,'Dodd', '545-65-2324', '9676 Bright Street Los Angeles, CA 90054','11/18/1994'),
('Rima', 'Kaufman', '608-66-5583', '7011 Euclid Drive Markleeville, CA 96120','4/29/1998'),
('Cindy', 'Rice', '552-83-5249', '82 East Vine Ave. Clovis, CA 93611','5/1/1947');

INSERT INTO Employee (eID, SSN, hire_date) VALUES 
(2025, '532-52-8977', '6/23/1965'),
(3779, '440-13-7032', '8/18/1969'),
(3294, '426-08-4661', '5/14/1973'),
(2577, '525-32-0207', '11/6/1985'),
(2166, '159-58-2752','6/8/1989'),
(4506, '680-52-7323','12/24/1994'),
(1875, '519-04-8969','7/3/1999'),
(1529, '213-98-3803','3/22/2011'),
(1992, '253-59-3480','8/6/2012'),
(3332,'529-90-1876','8/27/2016'),
(2603, '213-36-8214','10/10/1979');

INSERT INTO Doctor (eID, date_of_degree) VALUES
(1228, '5/2/1969'),
(4242, '3/21/1973'),
(2443, '7/18/1966'),
(4649, '9/18/1977'),
(5757, '8/7/1989'),
(6627, '8/14/2000'),
(3246, '7/2/2016'),
(1905, '6/25/2017'),
(2083, '5/7/2018');

INSERT INTO Nurse (eID, registered) VALUES 
(1785, 'yes'),
(1303, 'yes'),
(4383, 'yes'),
(1602, 'yes'),
(2321, 'yes'),
(1565, 'yes'),
(1171, 'yes'),
(1532, 'yes'),
(2308, 'yes');

INSERT INTO Medical_Assistant (eID, physician) VALUES 
(3510, 4563),
(3834, 1237),
(3148, 1234),
(1404, 1236),
(2284, 3267),
(3346, 2345),
(1749, 2634),
(2484, 1265);

INSERT INTO Patients (pID, SSN, type_of_insurance) VALUES
(1680, '502-68-7713','Anthem'),
(2322, '221-94-4203', 'Medicare'),
(1319, '575-95-4789', 'UnitedHealth'),
(3212, '526-97-2376', 'Anthem'),
(1411, '011-46-1137', 'Medicaid'),
(4788, '051-64-7905', 'Humana'),
(3109, '247-69-7503', 'HCSC');

INSERT INTO Visit (visitID, pID, admission_time, discharge_time, medical_issue, room_number) VALUES
(208,	4035,	'8:32 PM', '1:52 PM','Other specified disorders of left external ear', 1377),
(287,	2196,	'5:57 PM', '1:26 PM','Inflammatory polyneuropathy, unspecified' ,1459),
(107,	3793,	'9:39 PM', '2:37 PM','Secondary lacrimal gland atrophy'	, 3076),
(377,	1676,	'9:41 AM', '9:20 PM','Adverse effect of antifungal antibiotics, systemically used',1015),
(105,	1377,	'10:20 AM','10:05 AM','Salter-Harris Type III physeal fracture of upper end of humerus',1243),
(250,	1459,	'9:15 AM', '9:42 PM', 'Unspecified injury of extensor muscle, fascia and tendon of right index finger at forearm level', 4632),
(310,	3076,	'3:08 PM', '8:41 PM','Acute appendicitis with localized peritonitis', 3076),
(129,	1015,	'7:36 PM', '3:49 PM','Altered mental status, unspecified',3628),
(394,	1243,	'3:45 PM', '9:56 PM', 'Burn of first degree of scapular region'	,2241),
(159,	4632,	'3:36 PM', '11:51 AM','Nondisplaced fracture of anterior process of left calcaneus'	,2175),
(119,	3076,	'2:08 PM', '11:33 AM','Acute embolism and thrombosis of right femoral vein'	,2302);


INSERT INTO Procedures (procID, visitID, procedure_name, department, cost, room_number) VALUES
(4181,	209,'Debridement of wound, burn, or infection', 'Emergency Department', '200', 1927),
(3706,	232,'Debridement of wound, burn, or infection', 'Emergency Department', '200',	1537),
(4410,	293,'Hysteroscopy'	,'Emergency Department', '1,500', 1278),
(3230,	327,'Minimally invasive endonasal endoscopic surgery', 'Neurology', '40,000', 3339),
(2549,	160,'Carotid endarterectomy','Cardiology', '15,000' , 2125);

INSERT INTO Procedure_Med (procID, medication) VALUES 
(2821,'Xanax')
(1017,'Amoxicillin')
(3777,'Lyrica')
(3731,'Codeine')
(2612,'Adderall');

INSERT INTO Procedure_Docs (procID, doctor) VALUES 
(1897,1253),
(1538,3673),
(2274,2336),
(1077,2356),
(4650,2434);

INSERT INTO Procdure_Nurses (procID, nurses) VALUES 
(4693,1838),
(4538,2389),
(2168,3425),
(3380,2359),
(1190,4928),
(4761,3936);

INSERT INTO Prescription (prescriptionID, pID, visitID, medication, directions, start_date, end_date) VALUES
(28296,	3987,	300,	'Amoxicillin', ' 500 mg orally 3 times a day for 7 days', '8/15/2019', '8/22/2019'),
(13644,	3554,	425,	'Ibuprofen', '200 mg daily every 4 to 6 hours','9/10/2019', '10/10/2019'),
(26475,	3143,	333,	'Xanax', '0.5 mg 3 times a day', '4/13/20', '4/20/20'),
(18589,	1563,	122,	'Amoxicillin',' 500 mg orally 3 times a day for 7 days', '3/20/2015', '3/27/2015');

INSERT INTO Medication (medication_name, cost) VALUES 
('Acetaminophen', '4.49'),
('Adderall', '791'),
('Amoxicillin', '23.99'),
('Codeine', '70'),
('Hydrochlorothiazide', '7'),
('Ibuprofen', '15'),
('Lyrica', '377.69'),
('Oxycodone', '80'),
('Viagra', '61.50'),
('Wellbutrin', '87'),
('Xanax', '470');