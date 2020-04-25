CREATE DATABASE hospitalDatabase;

use hospitalDatabase;

create table login_info(username varchar(10), password varchar(60) primary key(username));

insert into login_info values("DoctorMA", "$2y$10$zX/A5s19ZUOKJLJ5uC.ek.aIr1I1zR7WuXTHuVkBFxdxkV1DqWJ7y");