<html>
	<head>
		<title>
			Show Movie Info
		</title>
		<center>
			<table border="0">
				<tr>
					<th BGCOLOR="Gainsboro">
						<a href="addA-D.php">Add Actor or Director</a>
					</th>
<th></th>
					<th BGCOLOR="Gainsboro">
						<a href="addMovieInfo.php">Add Movie Info</a>
					</th>

<th></th>

					<th BGCOLOR="Gainsboro">
						<a href="addReview.php">Add Movie Review</a>
					</th>

<th></th>

					<th BGCOLOR="Gainsboro">
						<a href="addActorToMovie.php">Add Actor To movie</a>
					</th>

<th></th>

					<th BGCOLOR="Gainsboro">
						<a href="addDirectorToMovie.php">Add Director To Movie</a>
					</th>

<th></th>
					<th BGCOLOR="Gainsboro">
						<a href="browseActor.php">Browse Actor</a>
					</th>

<th></th>
					<th BGCOLOR="Pink">
						<a href="browseMovie.php">Browse Movie</a>
					</th>
<th></th>

					<th BGCOLOR="Gainsboro">
						<a href="search.php">Search</a>
					</th>
<th></th>
				</tr>
			</table>
		</center>
		<body BGCOLOR="Mistyrose">
			<form action="" method="get">
				<?php
$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);
$dbID=trim($_GET["id"]);
if($dbID=="")
{
	echo "Invalid Movie ID.";
}
else 
{
	echo "-------MOVIE INFORMATION--------"."<br>";
	$dbQuery = "SELECT title, year, rating, company FROM Movie WHERE id=$dbID";
	$test = mysql_query($dbQuery, $db_connection) or die(mysql_error());
	$row = mysql_fetch_row($test);
	echo "Title:".$row[0]."<br/>";
	echo "Year:".$row[1]."<br/>"; 
	echo "Rating: ".$row[2]."<br/>";
	echo "Producer: ".$row[3]."<br/>";
	$dbQuery = "SELECT CONCAT(first,' ',last,'(',dob,')') as name from Director WHERE id in (select did from MovieDirector where mid=
$dbID ) ";
	$test = mysql_query($dbQuery, $db_connection) or die(mysql_error());
	$row = mysql_fetch_row($test);
	echo "Director: ".$row[0]."<br/>";
	$dbQuery = "SELECT genre from MovieGenre WHERE mid=$dbID"; 
	$test = mysql_query($dbQuery, $db_connection) or die(mysql_error());
	while ($row = mysql_fetch_assoc($test)) {
		echo $row['genre']." ";
	}
	echo "<br>";
	//=================Actors in the above movie==============================
	echo "-------Actors who acted in the above movie--------"."<br>";
	$dbQuery = "SELECT id,role,concat(first,' ',last) as name FROM Actor,MovieActor WHERE id=aid and mid=".$dbID ;
	$test = mysql_query($dbQuery, $db_connection) or die(mysql_error());

$a=mysql_num_rows($test);
if($a==0)
{
echo "No Actors for this movie"."<br/>";}

else
{


	while ($row = mysql_fetch_assoc($test)) {
		$gotolink = "<a href=\"showActorInfo.php?id=".$row['id']."\">".$row['name']." </a>";
		echo $gotolink." "."acted as".$row['role'];
		echo "<br/>";
	}}
	//==================================User Review=========================================
	echo "-----User Review-----";
	echo "<br/>";
	$go1 = "<a href='addReview.php?id=$dbID'> Click here </a>";
	echo $go1."<br/>";
	$dbQuery = "SELECT name,time,mid,rating,comment FROM Review WHERE mid=".$dbID ;


	$dbQuery1 = "SELECT avg(rating) as avgRating FROM Review WHERE mid=".$dbID ;

	



	$test = mysql_query($dbQuery, $db_connection) or die(mysql_error());

$r=mysql_num_rows($test);
if($r==0)
{


echo "no reviews yet";}

else{
$test1 = mysql_query($dbQuery1, $db_connection) or die(mysql_error());



	$row1 = mysql_fetch_row($test1);
echo "Average rating is".$row1[0];
echo "<br>";


	while ($row = mysql_fetch_assoc($test)) {
		echo "In  ".$row['time']."  ".$row['name']."  said: I rate this Movie  ".$row['rating']." points. Here is my comment ".
			$row['comment'];
		echo "<br/>";
	}
	mysql_free_result($test);
	mysql_free_result($test2);

}}
mysql_close($db_connection);
				?>
			</body>
		</html>
