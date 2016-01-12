<html>
	<body bgcolor= "Mistyrose">

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

					<th BGCOLOR="Pink">
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
					<th BGCOLOR="Gainsboro">
						<a href="browseMovie.php">Browse Movie</a>
					</th>
<th></th>

					<th BGCOLOR="Gainsboro">
						<a href="search.php">Search</a>
					</th>
<th></th>
				</tr>
			</table>
	
		
	</body>
		</center>
		




		<form method=get>
			<h5>ADD NEW COMMENT:</h5><BR><BR><?php 
$db_connection=mysql_connect("localhost","cs143","");
$dbID=trim($_GET["id"]);
if(!db_connection)
{
	$errmsg=mysql_error(db_connection);
	print "Connection failed: $errmsg";
	exit(1);
}
mysql_select_db("CS143",$db_connection);
			?>
			
			<br>
			Movie:&nbsp
			<select name="title" REQUIRED>
				<option value="">Movie</option>;
				<?php
if($dbID=="")
{
	$request="select concat(title,' ','(',year,')')as title from Movie";
}
else
{
	$request="select concat(title,' ','(',year,')')as title from Movie WHERE id=".$dbID;
}
$result=mysql_query($request);
while($fetch=mysql_fetch_array($result))
{
	echo '<option value="'.$fetch['title'].'">'.$fetch
		['title'].'</option>';
}
				?>
			</select>
			<br/><br>
			<input type="hidden" name="id" value= "
<?php echo $dbID;?>"/>
			Name:&nbsp&nbsp
			<input type="textbox" name="reviewer" value="" required/>
			<br>
			<br>
			Rating:
			<select name="rating">
				<option value="5">5-Excellent</option>
				<option value="4">4-Good</option>
				<option value="3">3-Okay</option>
				<option value="2">2-Not worth it</option>
				<option value="1">1-I hate it</option>
			</select>
			<br><br>
			Comments:
			<textarea rows="10" cols="80" name="comment"></textarea>
			<br><br>
			<input type=submit name="submit" value="Add Review">
		</form>
		<?php
if(isset($_GET['submit']))
{	
	$id=$_GET["id"];
	
	$title = $_GET["title"];
	$name = $_GET["reviewer"];
$name=mysql_escape_string($name);
	$rating= $_GET["rating"];
	$comment= $_GET["comment"];
	$rating1=(int)$rating;
	$today = date("Y-m-d H:i:s"); 
	$timestamp = date('Y-m-d H:i:s', strtotime($today)); 
	$parts1 = explode("(", $title);
	$title1 = $parts1[0];
	
	$request=("SELECT id FROM Movie WHERE title='".$title1 ."' ;");
	
	if ($id===true)
	{
		continue;
	}
	else
	{
		
		$request=("SELECT id FROM Movie WHERE title='".$title1 ."';");
		$run=mysql_query($request,$db_connection);
		
		while($fetch=mysql_fetch_array($run))
		{$id=$fetch['id'];
		 
		}
	}
	$query="insert into Review values('$name','$timestamp',$id,$rating1,'$comment')";
	$run=mysql_query($query,$db_connection);
	
	if($run)
	{
		echo "Succesfully Added";
		echo ("<SCRIPT LANGUAGE='JavaScript'>

window.location.href='showMovieInfo.php?id=$id';
</SCRIPT>");
	}
	else
	{echo "Not Added";
		echo ("<SCRIPT LANGUAGE='JavaScript'>

window.location.href='showMovieInfo.php?id=$id';
</SCRIPT>");
	}
	mysql_close($db_connection);	
}
		?>
	</body>
</html>
