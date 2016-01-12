<html>
	<head>
		<title>
			Add Movie Director
		</title>
		<body bgcolor="Mistyrose">
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
						<th BGCOLOR="Pink">
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
		</body>
		<br>
		<br>
		<form action="" method="get">
			<h5>
				ADD DIRECTOR TO MOVIE:
			</h5>
			<?php 
$db_connection=mysql_connect("localhost","cs143","");
if(!db_connection)
{
	$errmsg=mysql_error(db_connection);
	print "Connection failed: $errmsg";
	exit(1);
}
mysql_select_db("CS143",$db_connection);
			?>
			Movie:&nbsp&nbsp&nbsp
			<select name="title" REQUIRED>
				<option value="">Movie</option>;
				<?php
$request="select concat(title,' ','(',year,')')as title from Movie";
$result=mysql_query($request);
while($fetch=mysql_fetch_array($result))
{
	echo '<option value="'.$fetch['title'].'">'.$fetch['title'].'</option>';
}
				?>
			</select>
			<br/>
			<br>
			Director:
			<select name="director" REQUIRED>
				<option value="">Director</option>;
				<?php
$request1="select concat(first,' ',last,' ','(',dob,')') AS name from Director";
$result1=mysql_query($request1);
while($fetch=mysql_fetch_array($result1))
{
	echo '<option value="'.$fetch['name'].'">'.$fetch['name'].'</option>';
}
				?>
			</select>
			<br/>
			<BR>
			<input type=submit name="submit" value="ADD"/>
		</form>
		<br/>
		<br/>
		<?php


if(isset($_GET['success']) && ($_GET['success']==1))

{
echo "Added Successfully!!!";
}
if(isset($_GET['success']) && ($_GET['success']==2))
{
echo "Not added!!";
}




if(isset($_GET['submit']))
{
	$title = $_GET["title"];
	$director = $_GET["director"];
	$db_connection = mysql_connect("localhost", "cs143", ""); 
	if(!$db_connection) {
		$errmsg = mysql_error($db_connection);   
		print "Connection failed: $errmsg <br />";
		exit(1);
	}
	mysql_select_db("CS143", $db_connection);
	$parts1 = explode("(",$title);
	$title1 = $parts1[0];
	$query=("SELECT id FROM Movie WHERE title='".$title1 ."' ;");
	
	$result2=mysql_query($query,$db_connection); 
	$row = mysql_fetch_row($result2);
	$id=intval($row[0]);
	
	$parts = explode("(", $director);
	$director1 = $parts[0];
	$query1=("SELECT id,concat(first,' ',last)as name FROM Director WHERE concat(first,' ',last) ='".$director1."';");
	$result3=mysql_query($query1,$db_connection); 
	$row1 = mysql_fetch_row($result3);
	$id1=intval($row1[0]);
	
	$query2="insert into MovieDirector values($id,$id1)";
	$run=mysql_query($query2,$db_connection); 
	
	if($run)
{

echo "<script> window.location='addDirectorToMovie.php?success=1'</script>"; 
}
else
{
echo "<script> window.location='addDirectorToMovie.php?success=2'</script>"; 

}
	//close connection
	mysql_close($db_connection);	
}
		?>
	</body>
</head>
