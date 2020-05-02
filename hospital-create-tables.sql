CREATE TABLE Department(
department_ID               int(255) AUTO_INCREMENT,
department_name		          varchar(255) ,
department_head     	varchar(255) NOT NULL,
PRIMARY KEY (department_ID )
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
address			varchar(255),
dob			varchar(255),
PRIMARY KEY (SSN));

Create table Employee(
eID			int(255) AUTO_INCREMENT,
SSN			char(15) NOT NULL UNIQUE,
salary  double(8, 2),
username    varchar(255),
hire_date		varchar(255),
job_title   varchar(255),
department_ID int(255),
PRIMARY KEY (eID),
FOREIGN KEY (SSN) REFERENCES Person (SSN),
FOREIGN KEY (department_ID) REFERENCES Department (department_ID));

Create table Doctor(
eID			int(255),
date_of_degree		varchar(255),
PRIMARY KEY (eID),
FOREIGN KEY (eID) REFERENCES Employee (eID));


Create table Nurse (
eID 			int(255), 
registered		text,
PRIMARY KEY (eID),
FOREIGN KEY (eID) REFERENCES Employee (eID));

Create table Medical_Assistant(
eID			int(255),
physician		int(255),
PRIMARY KEY (eID),
FOREIGN KEY (eID) REFERENCES Employee (eID),
FOREIGN KEY (physician) REFERENCES Doctor (eID));

Create table Patient (
pID 			int(255) AUTO_INCREMENT,
SSN 			char(15) NOT NULL UNIQUE,
type_of_insurance	text,
PRIMARY KEY (pID),
FOREIGN KEY (SSN) REFERENCES Person (SSN));

Create table Visit(
visitID 		int(255) AUTO_INCREMENT,
pID			int(255),
admission_time		varchar(255) NOT NULL,
discharge_time		varchar(255) NOT NULL,
visit_date        text NOT NULL,
medical_issue		text,
room_number		varchar(255),
PRIMARY KEY (visitID),
FOREIGN KEY (pID) REFERENCES Patient (pID),
FOREIGN KEY (room_number) REFERENCES Rooms (room_number));

Create table Procedures(
procID			int(255) AUTO_INCREMENT,
visitID			int(255) NOT NULL,
procedure_name 		text NOT NULL,
department_ID 		int(255),
cost			varchar(255) NOT NULL,
room_number		varchar(255),
PRIMARY KEY (procID),
FOREIGN KEY (visitID) REFERENCES Visit (visitID),
FOREIGN KEY (room_number) REFERENCES Rooms (room_number),
FOREIGN KEY (department_ID) REFERENCES Department (department_ID));

Create table Medication (
medication_name		varchar(255),
cost			varchar(255) NOT NULL,
PRIMARY KEY (medication_name));
                                                
Create table Procedure_Med(
procID			int(255),
medication		varchar(255),
PRIMARY KEY (procID, Medication),
FOREIGN KEY (procID) REFERENCES Procedures (procID),
FOREIGN KEY (medication) REFERENCES Medication(medication_name)
);

Create table Procedure_Docs(
procID			int(255),
doctor			int(255),
PRIMARY KEY (procID, doctor),
FOREIGN KEY (procID) REFERENCES Procedures (procID),
FOREIGN KEY (doctor) REFERENCES Doctor(eID)
);

Create table Procedure_Nurses(
procID			int(255),
nurses			int(255),
PRIMARY KEY (procID, nurses),
FOREIGN KEY (procID) REFERENCES Procedures (procID),
FOREIGN KEY (nurses) REFERENCES Nurse (eID)
);


Create table Prescription(
prescriptionID		int(255) AUTO_INCREMENT,
pID			int(255) NOT NULL,
visitID			int(255),
medication		varchar(255) NOT NULL,
directions		text NOT NULL,
start_date		text NOT NULL,
end_date 		text NOT NULL,
PRIMARY KEY (prescriptionID),
FOREIGN KEY (pID) REFERENCES Patient (pID),
FOREIGN KEY (visitID) REFERENCES Visit (visitID),
FOREIGN KEY (medication) REFERENCES Medication (medication_name));
                                                
Create table login_info(
username varchar(20) NOT NULL,
password varchar(255) NOT NULL,
account_type int,
PRIMARY KEY (username));
