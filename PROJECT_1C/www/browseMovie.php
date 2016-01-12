<html>
	<head>
		<title>
			browse Movie
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
					<th BGCOLOR="Pink">
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
			<br>
			<br>
			<br>
			Type the name of Movie you want to search:
			<form method="GET">
				<input type="text" name="search">
				<?php $_GET["search"]; ?></input>		
			<input type="submit" value="Search" />
		</form>
		<?php
$dbSearch = $_GET["search"];
$dbSearch = mysql_escape_string($dbSearch);
$terms=explode(' ', $dbSearch);
$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);
if(trim($dbSearch)!="")
{
	echo "Found Movie(s): ";
	$dbQuery2 = "SELECT id, title, year FROM Movie WHERE title LIKE '%$terms[0]%'";
	for($i=1; $i<count($terms); $i++)
	{
		$term=$terms[$i];
		$dbQuery2=$dbQuery2." AND title LIKE '%$terms[$i]%'";
	}
	$test2 = mysql_query($dbQuery2, $db_connection) or die(mysql_error());


	
$num=mysql_numrows($test2);
if($num==0)
{echo "No records found";}

else
{

	
	while ($row2 = mysql_fetch_assoc($test2))
	{
		echo "<a href=\"showMovieInfo.php?id=".$row2["id"]."\">".$row2["title"]." (".$row2["year"].")</a><br/>";
	}
	echo "<br/>";
	mysql_free_result($test2);
}
}		?>	
	</body>
</html>
