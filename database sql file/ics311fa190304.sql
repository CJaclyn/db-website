DROP DATABASE IF EXISTS ics311fa190304;
create database ics311fa190304;
use ics311fa190304;

create table user
(username varchar(20) not null,
password varchar(20) not null,
email varchar(45) not null unique,
firstName varchar(15) not null,
lastName varchar(20) not null,
birthday date not null,
college varchar(45) not null,
major varchar(30) not null,
create_time timestamp default current_timestamp,
primary key (username)
);

create table class
(classID char(10) not null,
username varchar(20) not null,
className varchar(30) not null,
teacher varchar(15) not null,
email varchar(45),
primary key(classID, username),
constraint FK_username foreign key (username)
	references user(username)
	ON DELETE CASCADE
);

create table assignment
(assignmentID int(5) unsigned auto_increment not null,
username varchar(20) not null,
classID char(10) not null,
assignmentType char(8) not null,
assignmentName varchar(25) not null,
dueDate date not null,
primary key(assignmentID),
constraint FK_userTable foreign key (username)
	references user(username)
	ON DELETE CASCADE,
constraint FK_classID foreign key (classID)
	references class(classID)
	ON DELETE CASCADE
);

insert into user values
("jaclync", "12345", "jaclync@email.com", "Jaclyn", "Cao", "1965-01-01", "Metro State", "CIT", NOW()),
("totoc", "12345", "totoc@email.com", "Toto", "Cao", "2007-07-08", "Dog University", "Barking", NOW()),
("bob123", "12345", "bobert@email.com", "Bob", "Ert", "2001-09-20", "Bobsled University", "Bobsledding", NOW()),
("testacc", "12345", "testacc@email.com", "Tess", "Tacc", "1990-10-01", "Testing University", "Testing", NOW());

insert into class values
("MATH123", "bob123", "Calculus II", "Teech Er", "teech.er@email.edu"),
("ART101", "bob123", "Intro to Painting", "Bob Ross", "bobross@paint.net"),
("BOB496","bob123","Advanced Bobsledding","Rob Bert","robert@email.edu");

insert into assignment values
(1,"bob123", "ART101", "Project", "Paint a Sunset", "2019-11-20"),
(2,"bob123", "MATH123", "Homework", "Calc HW2", "2019-11-25");
