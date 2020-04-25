CREATE DATABASE hospitalDatabase;

use hospitalDatabase;

create table login_info(username varchar(10), password varchar(60) primary key(username));

/*insert into login_info values("doctorman", "PASSWORDHASH");*/