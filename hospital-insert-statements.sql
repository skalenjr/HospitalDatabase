INSERT INTO Department (dep_name, department_head) VALUES 
('Emergency department' , 'Jeffrey Dean'),
('Cardiology' , 'Jennie Farmer'),
('Paediatric Intensive Care Unit' , 'Nadine Soto'),
('Neonatal Intensive Care Unit' , 'Mayson Holcomb'),
('Cardiovascular Intensive Care Unit' , 'Tomas Dunne'),
('Neurology' , 'Bo Duffy'),
('Oncology' , 'Nida Webb'),
('Obstetrics and Gynaecology' , 'Emmy Gale');


INSERT INTO Person (first_name, last_name, SSN, address, dob) VALUES
('Mohsin' , 'Tapia' , '636-82-9871', '572 Charles Ave. New Cuyama, CA 93254','12/2/1958'),
('Eloise', 'Walter', '357-76-4435', '59 Wharf Drive Oakland, CA 94606', '7/16/1970'),
('Latoya', 'Carson', '619-08-4756', '9799 Kingston Court Mendota, CA 93640','6/13/1972'),
('Luc' , 'Barajas', '546-49-7689', '768 Shade Road Fresno, CA 93775','5/27/1980'),
('Yvette' ,'Dodd', '545-65-2324', '9676 Bright Street Los Angeles, CA 90054','11/18/1994'),
('Rima', 'Kaufman', '608-66-5583', '7011 Euclid Drive Markleeville, CA 96120','4/29/1998'),
('Cindy', 'Rice', '552-83-5249', '82 East Vine Ave. Clovis, CA 93611','5/1/1947');

INSERT into Person (first_name, last_name, SSN, address, dob) VALUES 
('Jennifer', 'Thomas', '213-98-3803', '3183  West Street, Comstock Park, MI', '4/16/1962'), 
('Diana', 'Anderson', '519-04-8969', '1680  Newton Street STOCKTON, CA', '4/28/1998'), 
('Hubert', 'Martinez', '253-59-3480', '128  Bagwell Avenue Weekiwachee Spgs., FL', '12/21/1998'), 
('Betty', 'Perez', '532-52-8977', '3110  North Street REDWOOD, NY', '6/11/1970'), 
('Michael', 'Santana', '159-58-2752', '4137  Briercliff Road Rego Park Queens, NY', '5/19/1964'), 
('John', 'Mullins', '525-32-0207', '2339  Spruce Drive Pittsburgh, PA', '2/25/1969'), 
('Jessica', 'Stark', '213-36-8214', '3040  Fincham Road BUFORD, GA', '11/21/1954'), 
('Richard', 'Jolly', '426-08-4661', '3487  Bolman Court Springfield, IL', '1/22/1964'), 
('Brian', 'Salsbury', '529-90-1876', '1463  Freshour Circle San Antonio, TX', '7/3/1988'), 
('Willie', 'Medford', '440-13-7032', '4633  Rainbow Drive Youngstown, OH', '5/24/1993'), 
('Tracy', 'Bushong','680-52-7323', '1168  Goosetown Drive Hendersonville, NC', '12/1/1973');

INSERT  into Person (first_name, last_name, SSN, address, dob) VALUES 
('Kim', 'Sasse', '575-95-4789', '4636  Harper Street SOUND BEACH, NY', '2/17/1985'), 
('Matt', 'Hull', '011-46-1137', '4750  Cinnamon Lane SHELBY, IA', '8/25/1987'), 
('Chad ', 'Johnson', '502-68-7713', '2649  Chardonnay Drive Westport, WA', '10/24/1977'), 
('William', 'Smith', '221-94-4203', '4065  Oval Lake Road Minnetonka, MN', '11/23/1996'), 
('Jocelyn ', 'Dunham', '247-69-7503', '4605  Sweetwood Drive Denver, CO','1/20/1968'), 
('Joseph', 'Hughes', '526-97-2376', '1005  Argonne Street Frederica, DE', '	6/3/1962'), 
('Naomi', 'Mann', '051-64-7905', '690  John Calvin Drive Elk Grove Village, IL', '	8/24/1986');

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

INSERT INTO Visit (visitID, pID, admission_time, discharge_time, medical_issue, room_number) VALUES
(208,	1680,	'8:32 PM', '1:52 PM','Other specified disorders of left external ear', 1377),
(287,	2322,	'5:57 PM', '1:26 PM','Inflammatory polyneuropathy, unspecified' ,1459),
(107,	1319,	'9:39 PM', '2:37 PM','Secondary lacrimal gland atrophy'	, 3076),
(377,	3212,	'9:41 AM', '9:20 PM','Adverse effect of antifungal antibiotics, systemically used',1015),
(105,	1411,	'10:20 AM','10:05 AM','Salter-Harris Type III physeal fracture of upper end of humerus',1243),
(250,	4788,	'9:15 AM', '9:42 PM', 'Unspecified injury of extensor muscle, fascia and tendon of right index finger at forearm level', 4632);

INSERT INTO Procedures (procID, visitID, procedure_name, department, cost, room_number) VALUES
(4181, 208,'Debridement of wound, burn, or infection', 'Emergency Department', '200', 1927),
(3706, 287,'Debridement of wound, burn, or infection', 'Emergency Department', '200', 1537),
(4410, 107,'Hysteroscopy'	,'Emergency Department', '1,500', 1278),
(3230, 377,'Minimally invasive endonasal endoscopic surgery', 'Neurology', '40,000', 3339),
(2549, 250,'Carotid endarterectomy','Cardiology', '15,000', 2125);

INSERT INTO Rooms (department, room_number, room_floor) VALUES 
('Emergency department', 1337, 1),
('Cardiology', 1459, 1),
('Neurology', 3076, 3),
('Oncology', 1015, 1),
('Pediatric Intensive care', 1243, 1),
('Cardiology', 4632, 4),
('Emergency Department', 1927, 1),
('Emergency Department', 1537, 1),
('Emergency Department', 1278, 1),
('Neurology', 3339, 3),
('Cardiology', 2125, 2);

INSERT INTO Doctor (eID, date_of_degree) VALUES
(3779, '5/2/1969'),
(3294, '3/21/1973'),
(2603, '7/18/1966'),
(3332, '9/18/1977'),
(2577, '8/7/1989'),
(1992, '8/14/2000');

INSERT INTO Nurse (eID, registered) VALUES 
(1875, 'yes'),
(2603, 'yes'),
(2166, 'yes'),
(2025, 'yes'),
(4506, 'yes');

INSERT INTO Medical_Assistant (eID, physician) VALUES 
(2025 , 3779),
(1529, 3294);

INSERT INTO Procedure_Med (procID, medication) VALUES 
(4181,'Xanax'),
(3230,'Amoxicillin');

INSERT INTO Procedure_Docs (procID, doctor) VALUES 
(4181,3779),
(3706,3294),
(4410,2603),
(3230,3332);

INSERT INTO Procedure_Nurses (procID, nurses) VALUES 
(4181,1875),
(3706,2603),
(4410,2166);

INSERT INTO Prescription (prescriptionID, pID, visitID, medication, directions, start_date, end_date) VALUES
(28296,	1680,	208,	'Amoxicillin', ' 500 mg orally 3 times a day for 7 days', '8/15/2019', '8/22/2019'),
(13644,	2322,	287,	'Ibuprofen', '200 mg daily every 4 to 6 hours','9/10/2019', '10/10/2019'),
(26475,	3212,	377,	'Xanax', '0.5 mg 3 times a day', '4/13/20', '4/20/20'),
(18589,	1411,	105,	'Amoxicillin',' 500 mg orally 3 times a day for 7 days', '3/20/2015', '3/27/2015');

INSERT INTO login_info(username, password) VALUES ('doctorguy','$2y$10$GmYvHhvMlsxTYP1kqS4gMeA5XkWNbQxqZQpDQ9kb2TZW6EJIizpgW');
