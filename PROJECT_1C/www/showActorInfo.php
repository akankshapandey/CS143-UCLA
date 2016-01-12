<html>
	<head>
		<title>
			Show Actor Info
		</title>
		<center>
			<table border="0">
				<tr>
					<th BGCOLOR="Gainsboro">
						<a href="addA-D.php">Add Actor or Director</a>
					</th>
					<th>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="addMovieInfo.php">Add Movie Info</a>
					</th>
					<th>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="addReview.php">Add Movie Review</a>
					</th>
					<th>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="addActorToMovie.php">Add Actor To movie</a>
					</th>
					<th>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="addDirectorToMovie.php">Add Director To Movie</a>
					</th>
					<th>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="browseActor.php">Browse Actor</a>
					</th>
					<th>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="browseMovie.php">Browse Movie</a>
					</th>
					<th>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="search.php">Search</a>
					</th>
					<th>
					</th>
				</tr>
			</table>
		</center>
		<body BGCOLOR="Mistyrose">
			<?php
$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);
$dbID=trim($_GET["id"]);
if($dbID=="")
{
	echo "Invalid actor ID.";
}
else 
{
	$dbQuery = "SELECT last, first, sex, dob, dod FROM Actor WHERE id=$dbID";
	$test = mysql_query($dbQuery, $db_connection) or die(mysql_error());
	$row = mysql_fetch_row($test);
	echo "Name: ".$row[1]." ".$row[0]."<br/>"; 
	echo "Sex:".$row[2]."<br/>"; 
	echo "Date of Birth: ".$row[3]."<br/>"; 
	if($row[4]!="")
		echo "Date of Death: ".$row[4]."</br>";
	else
		echo "Date of Death:Alive!"."</br></br>"; 
	mysql_free_result($test);


	$dbQuery2 = "SELECT MA.role, M.title, M.year, M.id FROM MovieActor MA, Movie M WHERE MA.aid=$dbID AND MA.mid=M.id ORDER BY M.year DESC";
	$test2 = mysql_query($dbQuery2, $db_connection) or die(mysql_error());
$a=mysql_num_rows($test2);
if($a==0)
{echo "No related movies";}


else
{
echo "Related Movies:"."</br>";
	while ($row2 = mysql_fetch_assoc($test2))
	{
		$gotolink = "<a href=\"showMovieInfo.php?id=".$row2["id"]."\">".$row2["title"]." (".$row2["year"].")</a>";
		echo "\"".$row2["role"]."\" in ".$gotolink."<br/>";
	}
}	mysql_free_result($test2);
}
mysql_close($db_connection);
			?>
		</body>
	</html>
