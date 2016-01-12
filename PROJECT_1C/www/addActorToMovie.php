<html>
	<head>
		<title>
			Add Movie Actor
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
					<th BGCOLOR="Pink">
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
		<br>
		<br>
		<body BGCOLOR="Mistyrose">
			<h5>
				ADD ACTOR TO MOVIE:
			</h5>
			<form  method="get">
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
				Movie:
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
				Actor:&nbsp
				<select name="actor" REQUIRED>
					<option value="">Actor</option>;
					<?php
$request1="select concat(first,' ',last,' ','(',dob,')') AS name from Actor";
$result1=mysql_query($request1);
while($fetch=mysql_fetch_array($result1))
{
	echo '<option value="'.$fetch['name'].'">'.$fetch['name'].'</option>';
}
					?>
				</select>
				<br/>
				<br>
				Role:&nbsp&nbsp
				<INPUT TYPE="text" name="role" value="" REQUIRED/>
				<BR>
				<br>
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
	$actor = $_GET["actor"];
	$role= $_GET["role"];
$role=mysql_escape_string($role);
	$db_connection = mysql_connect("localhost", "cs143", ""); //connecting to CS143
	if(!$db_connection) {
		$errmsg = mysql_error($db_connection);    //error message if not able to connect to cs143
		print "Connection failed: $errmsg <br />";
		exit(1);
	}
	mysql_select_db("CS143", $db_connection);
	
	$parts1 = explode("(", $title);
	$title1 = $parts1[0];
	
	$query=("SELECT id FROM Movie WHERE title='".$title1 ."' ;");
	
	$result2=mysql_query($query,$db_connection); 
	$row = mysql_fetch_row($result2);
	$id=intval($row[0]);
	
	
	$parts = explode("(", $actor);
	$actor1 = $parts[0];
	$query1=("SELECT id,concat(first,' ',last)as name FROM Actor WHERE concat(first,' ',last) ='".$actor1."';");
	$result3=mysql_query($query1,$db_connection); 
	$row1 = mysql_fetch_row($result3);
	$id1=intval($row1[0]);
	
	
	$query2="insert into MovieActor values($id,$id1,'$role')";
	$run=mysql_query($query2,$db_connection); 
	
	if($run)
{

echo "<script> window.location='addActorToMovie.php?success=1'</script>"; 
}
else
{
echo "<script> window.location='addActorToMovie.php?success=2'</script>"; 

}
	
	
	mysql_close($db_connection);	
}
			?>
		</body>
	</html>
