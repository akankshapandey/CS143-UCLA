 

/*Primary Key Constraint Violation*/

INSERT INTO Movie VALUES(4732,'Spider Man',1994,'R','New Light Films');
 /* Explanation:- Trying to insert a duplicate primary key. Thus, duplication of primary key violates the SQL Query format.*/
 /*Output:- ERROR 1062 (23000): Duplicate entry '4732' for key 'PRIMARY'*/

INSERT INTO Actor VALUES(68635,'Joe','Bruin','Male',1969-11-19,NULL);
/* Explanation:- Trying to insert a duplicate primary key. Thus, duplication of primary key violates the SQL Query format.*/
/*Output:- ERROR 1062 (23000): Duplicate entry '68635' for key 'PRIMARY'*/

INSERT INTO Director VALUES(68626,'Regan','Hanes','1940-03-16',NULL);
 /* Explanation:- Trying to insert a duplicate primary key. Thus, duplication of primary key violates the SQL Query format.*/
 /*Output:- ERROR 1062 (23000): Duplicate entry '68626' for key 'PRIMARY'*/

 /*-------------------------------------------------------------------------------------------------------------------------*/

/*Foreign Key Constraint Violation*/

DELETE FROM Movie WHERE id=4734; 
/* Explanation:- Trying to delete the parent table's(Movie`s) tuple first. i.e. deleting a tuple from the parent table(Movie) while the child(MovieGenre) is still existing, violates the SQL query format. */
/*Output:- ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key 

constraint fails (`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` 

FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))*/

DELETE FROM Director WHERE id=68622; 
/*Explanation:- Trying to delete the parent table's(Director`s) tuple first. i.e. deleting a tuple from the parent table(Director) while the child(MovieDirector) is still existing, violates the SQL query format. */
/*Output:- ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key 

constraint fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` 

FOREIGN KEY (`did`) REFERENCES `Director` (`id`))*/

DELETE FROM Movie WHERE id=844; 
/* Explanation:- Trying to delete the parent table's(Movie) tuple first. i.e. deleting a tuple from the parent table(Movie) while the child(MovieDirector) is still existing violates, the SQL query format. */
/*Output:- ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key 

constraint fails (`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` 

FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))*/

UPDATE MovieDirector 
set mid=mid+1;
/* Explanation:- mid is a foreign key in the table MovieDirector. It references id in the Movie table. So, we cannot update it keeping in mind Referential Integrity.*/ 
/*Output:- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint 

fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY 

(`mid`) REFERENCES `Movie` (`id`))*/

UPDATE MovieDirector 
set did=did+1;
/* Explanation:- did is a foreign key in the child table-MovieDirecctor. It references id in the Director table. So, we cannot update it keeping in mind Referential Integrity.*/ 
/*Output:- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint 

fails (`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY 

(`did`) REFERENCES `Director` (`id`))*/

UPDATE MovieActor 
set mid=mid+1;
/* Explanation:-  mid is a foreign key in the child table-MovieActor. It references id in the Movie table. So, we cannot update it keeping in mind Referential Integrity.*/ 
/*Output:- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint 

fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY 

(`mid`) REFERENCES `Movie` (`id`))*/

UPDATE MovieActor
set aid=aid+1; 
/* Explanation:- aid is a foreign key in the child table-MovieActor. It references id in the Actor table. So, we cannot update it keeping in mind Referential Integrity.*/ 
/*Output:- ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint 

fails (`TEST`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY 

(`aid`) REFERENCES `Actor` (`id`))*/

/*-------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*Check Constraint Violation*/

INSERT INTO Movie VALUES(-4,'Spider Man',1994,'R','New Light Films');
/*Explanation:- The check constraint on Movie Table specifies that the ID FIELD has to be greater than 0. This insert statement is a violation as we try to insert id=-4.*/
/*Output:- Query OK, 1 row affected (0.00 sec)*/

INSERT INTO Actor VALUES(-4,'Joe','Bruin','Male',1969-11-19,NULL);
/*Explanation:- The check constraint on Actor Table specifies that the ID FIELD has to be greater than 0. This insert statement is a violation as we try to insert id=-4.*/
/*Output:- Query OK, 1 row affected, 1 warning (0.00 sec)*/

INSERT INTO Actor VALUES(6800000,'Joe','Bruin','Male',NULL,NULL);
/*Explanation:- The check constraint on Actor Table specifies that the DOB FIELD cannot be NULL. This insert statement is a violation as we try to insert dob=NULL*/
/*Output:- Query OK, 1 row affected (0.01 sec)*/

INSERT INTO Director VALUES(-4,'Regan','Hanes','1940-03-16',NULL);
/* Explanation:- The check constraint on Director Table specifies that the ID FIELD has to be greater than 0. This insert statement is a violation as we try to insert id=-4.*/
/*Output:- Query OK, 1 row affected (0.00 sec)
The check query runs as mysql doesn`t support CHECK*/

INSERT INTO Director VALUES(6987654,'Regan','Hanes',NULL,NULL);
/* Explanation:- The check constraint on Director Table specifies that the DOB FIELD cannot be NULL. This insert statement is a violation as we try to insert dob=NULL*/
/*Output:- Query OK, 1 row affected (0.00 sec)
The check query runs as mysql doesn`t support CHECK*/

INSERT INTO Director VALUES(5543321,NULL,'Hanes','1940-03-16',NULL);
/* Explanation:- The check constraint on Director Table specifies that the FIRST FIELD cannot be NULL. This insert statement is a violation as we try to insert first=NULL*/
/*Output:-Query OK, 1 row affected (0.00 sec)
The check query runs as mysql doesn`t support CHECK */





