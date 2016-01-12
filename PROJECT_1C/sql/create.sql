CREATE TABLE Movie(
id int,
title varchar(100) NOT NULL,/*Every movie must have a title.*/
year int,
rating varchar(10),
company varchar(50),
PRIMARY KEY(id), /*The primary key id uniquely identifies each movie.*/
CHECK(id>0)/*The id should be greater than zero.*/
)ENGINE = INNODB;


CREATE TABLE Actor(
id int,
last varchar(20),
first varchar(20),
sex varchar(6),
dob date,
dod date,
PRIMARY KEY(id), /*The primary key id uniquely identifies each actor.*/
CHECK(id>0),/*The id should be greater than zero.*/
CHECK(dob IS NOT NULL)/*Every actor must have a date of birth*/
)ENGINE = INNODB;


CREATE TABLE Director(
id int,
last varchar(20),
first varchar(20),
dob date,
dod date,
PRIMARY KEY(id), /*The primary key id uniquely identifies each director.*/
CHECK(id>0),/*The id should be greater than zero.*/
CHECK(dob IS NOT NULL),/*Every actor must have a date of birth*/
CHECK(first IS NOT NULL)/*Every actor must have a first name.*/
)ENGINE = INNODB;


CREATE TABLE MovieGenre(
mid int,
genre varchar(20),
FOREIGN KEY(mid) REFERENCES Movie(id) /*The foreign key mid refers to the id attribute in its parent table,Movie*/
)ENGINE = INNODB;



CREATE TABLE MovieDirector(
mid int,
did int,
FOREIGN KEY (mid) REFERENCES Movie(id),/*The foreign key mid refers to the id attribute in its parent table,Movie*/
FOREIGN KEY (did) REFERENCES Director(id)/*The foreign key did refers to the id attribute in its parent table,Director*/
)ENGINE = INNODB;



CREATE TABLE MovieActor(
mid int,
aid int,
role varchar(50),
FOREIGN KEY (mid) REFERENCES Movie(id),/*The foreign key mid refers to the id attribute in its parent table,Movie*/
FOREIGN KEY (aid) REFERENCES Actor(id)/*The foreign key aid refers to the id attribute in its parent table,Actor*/
)ENGINE = INNODB;





CREATE TABLE Review(
name varchar(20),
time timestamp,
mid int,
rating int,
comment varchar(500),
FOREIGN KEY(mid) REFERENCES Movie(id) /*The foreign key mid refers to the id attribute in its parent table,Movie*/
)ENGINE = INNODB;


CREATE TABLE MaxPersonID(
id int
)ENGINE = INNODB;



CREATE TABLE MaxMovieID(
id int
)ENGINE = INNODB;




