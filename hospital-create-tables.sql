CREATE TABLE Department(
dep_name			varchar(255) ,
department_head     varchar(255) NOT NULL,
PRIMARY KEY (dep_name)
);

Create table Rooms(
department		varchar(255),
room_number		varchar(255),
room_floor		varchar(255),
PRIMARY KEY (room_number));

Create table Person(
first_name		varchar(255),
last_name 		varchar(255),
SSN			char(15) UNIQUE,
address		varchar(255),
dob			varchar(255),
PRIMARY KEY (SSN));

Create table Employee(
eID			varchar(255),
SSN			char(15) NOT NULL UNIQUE, 
hire_date	varchar(255),
PRIMARY KEY (eID),
FOREIGN KEY (SSN) REFERENCES Person (SSN));

Create table Doctor(
eID					varchar(255),
date_of_degree		varchar(255),
PRIMARY KEY (eID),
FOREIGN KEY (eID) REFERENCES Employee (eID));


Create table Nurse (
eID 			varchar(255), 
registered		text,
PRIMARY KEY (eID),
FOREIGN KEY (eID) REFERENCES Employee (eID));

Create table Medical_Assistant(
eID			    varchar(255),
physician		varchar(255),
PRIMARY KEY (eID),
FOREIGN KEY (eID) REFERENCES Employee (eID),
FOREIGN KEY (physician) REFERENCES Doctor (eID));

Create table Patient (
pID 				varchar(255),
SSN 				char(15) NOT NULL UNIQUE,
type_of_insurance	text,
PRIMARY KEY (pID),
FOREIGN KEY (SSN) REFERENCES Person (SSN));

Create table Visit(
visitID 		varchar(255),
pID				varchar(255),
admission_time	varchar(255) NOT NULL,
discharge_time	varchar(255) NOT NULL,
medical_issue	text,
room_number		varchar(255),
PRIMARY KEY (visitID),
FOREIGN KEY (pID) REFERENCES Patient (pID),
FOREIGN KEY (room_number) REFERENCES Rooms (room_number));

Create table Procedures(
procID			varchar(255),
visitID			varchar(255) NOT NULL,
procedure_name 	text NOT NULL,
department 		varchar(255),
cost			varchar(255) NOT NULL,
room_number		varchar(255),
PRIMARY KEY (procID),
FOREIGN KEY (visitID) REFERENCES Visit (visitID),
FOREIGN KEY (room_number) REFERENCES Rooms (room_number),
FOREIGN KEY (department) REFERENCES Department (dep_name));

Create table Procedure_Med(
procID			varchar(255),
medication		varchar(255),
PRIMARY KEY (procID, Medication),
FOREIGN KEY (procID) REFERENCES Procedures (procID),
FOREIGN KEY (medication) REFERENCES Medication(medication_name)
);

Create table Procedure_Docs(
procID			varchar(255),
doctor			varchar(255),
PRIMARY KEY (procID, doctor),
FOREIGN KEY (procID) REFERENCES Procedures (procID),
FOREIGN KEY (doctor) REFERENCES Doctor(eID)
);

Create table Procedure_Nurses(
procID			varchar(255),
nurses			varchar(255),
PRIMARY KEY (procID, nurses),
FOREIGN KEY (procID) REFERENCES Procedures (procID),
FOREIGN KEY (nurses) REFERENCES Nurse (eID)
);


Create table Prescription(
prescriptionID	varchar(255),
pID			    varchar(255) NOT NULL,
visitID			varchar(255),
medication		varchar(255) NOT NULL,
directions		text NOT NULL,
start_date		text NOT NULL,
end_date 		text NOT NULL,
	PRIMARY KEY (prescriptionID),
	FOREIGN KEY (pID) REFERENCES Patient (pID),
	FOREIGN KEY (visitID) REFERENCES Visit (visitID),
	FOREIGN KEY (medication) REFERENCES Medication (medication_name));

Create table Medication (
medication_name	varchar(255),
cost			varchar(255) NOT NULL,
PRIMARY KEY (medication_name));
