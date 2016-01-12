

/*Count of all the actors who acted in multiple movies*/
SELECT COUNT(*) AS Actors_who_acted_in_multiple_movies
FROM (SELECT COUNT(aid)
      FROM MovieActor  
      group by mid
      having count(*)>1) AS A;



/*Names of all the actors in the movie Die Another Day*/

SELECT concat(first,last)
FROM Actor 
WHERE id IN (SELECT aid 
	     FROM MovieActor 
	     WHERE mid IN (SELECT id 
			   FROM Movie 
                           WHERE title='Die Another Day'));








/*Names of Actors who have acted in a movie directed by Joel Zwick*/
SELECT concat(first," ", last) AS ACTORS
FROM Actor
WHERE id IN(
SELECT aid 
FROM MovieActor
WHERE mid IN
(SELECT mid 
FROM MovieDirector 
WHERE did IN
(SELECT id
FROM Director 
WHERE last='Zwick' AND first='Joel'))); 

