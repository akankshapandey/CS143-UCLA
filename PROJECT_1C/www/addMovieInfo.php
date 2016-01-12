<html>
	<HEAD>
	<script type="text/javascript">
			function checkBoxCheck(){
				var genre=document.getElementsByName('genre[]');
				var flag=false;
				for(var i=0;i<genre.length;i++)
				{
					if(genre[i].checked)
					{
						flag=true;
					break;
return true;
					}
				}




				if (flag==false)
				{
					window.location='addMovieInfo.php?success=2';
					return false;
				}
				
			}
		</script>	
	</HEAD>
	
	<title>
			Add movie info
		</title>
		<center>
			<table border="0">
				<tr>
					<th BGCOLOR="Gainsboro">
						<a href="addA-D.php">Add Actor or Director</a>
					</th>
					<th BGCOLOR="Pink">
						<a href="addMovieInfo.php">Add Movie Info</a>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="addReview.php">Add Movie Review</a>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="addActorToMovie.php">Add Movie Actor</a>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="addDirectorToMovie.php">Add Movie Director</a>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="browseActor.php">Browse Actor</a>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="browseMovie.php">Browse Movie</a>
					</th>
					<th BGCOLOR="Gainsboro">
						<a href="search.php">Search</a>
					</th>
				</tr>
			</table>
		</center>
		<body BGCOLOR="Mistyrose">
	<form method="GET" NAME="form1" >
		<br>
		<br>
		Title: &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
		<input type= text name="title" value ="" REQUIRED/>
		<br>
		Company:
		<input type= text name="company" value ="" REQUIRED/>
		<br>
		




Year:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="year" REQUIRED>
    <?php for ($i = date('Y'); $i >=1 ; $i--) : ?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php endfor; ?>
</select>





		
		MPAA Rating:
		<select name="rating">
			<option value="G">G</option>
			<option value="NC-17">NC-17</option>
			<option value="PG">PG</option>
			<option value="PG-13">PG-13</option>
			<option value="R">R</option>
			<option value="surrendere">surrendere</option>
		</select>
		<br>
		Genre :
			<table border="0" style="width:600px">
				<tr>
					<td>
						<input type="checkbox" name="genre[]" value="Action">Action</input></td>
					<td><input type="checkbox" name="genre[]" value="Adult">Adult</input></td>
					<td><input type="checkbox" name="genre[]" value="Adventure">Adventure</input></td>
					<td><input type="checkbox" name="genre[]" value="Animation">Animation</input></td>
				</tr>
				<tr>					
					<td><input type="checkbox" name="genre[]" value="Comedy">Comedy</input></td>

					<td><input type="checkbox" name="genre[]" value="Crime">Crime</input></td>
					<td><input type="checkbox" name="genre[]" value="Documentary">Documentary</input</td>
					<td><input type="checkbox" name="genre[]" value="Drama">Drama</input></td>

					
				</tr>
				<tr>
					<td><input type="checkbox" name="genre[]" value="Family">Family</input></td>
					<td><input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input></td>

					<td><input type="checkbox" name="genre[]" value="Horror">Horror</input></td>
					<td><input type="checkbox" name="genre[]" value="Musical">Musical</input></td>
</tr>
				<tr>
					<td><input type="checkbox" name="genre[]" value="Mystery">Mystery</input></td>

					<td><input type="checkbox" name="genre[]" value="Romance">Romance</input></td>
					<td><input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</input></td>
					<td><input type="checkbox" name="genre[]" value="Short">Short</input></td>


				</tr>
				<tr>

					<td><input type="checkbox" name="genre[]" value="Thriller">Thriller</input></td>
					<td><input type="checkbox" name="genre[]" value="War">War</input></td>
					<td><input type="checkbox" name="genre[]" value="Western">Western</input></td>
				</tr>
			</table> 
		<Input type= submit name="submit" value="add" onclick="return checkBoxCheck();"/>
	</form>
</html>
<?php


if(isset($_GET['success'])&&$_GET['success']==2)
{
echo "No genre selected";

}



if(isset($_GET['success'])&&$_GET['success']==1)
{
echo "Success";

}



if(isset($_GET['submit']))
{
	$title = $_GET["title"];
$title = mysql_escape_string($title);
			
	$company = $_GET["company"];
$company = mysql_escape_string($company);
	$year= $_GET["year"];
	$month=$_GET["month"];
	$date=$_GET["date"];
	$rating = $_GET["rating"];
	$genre = $_GET["genre"];
	
	
	$db_connection = mysql_connect("localhost", "cs143", ""); 
	//connecting to CS143
	if(!$db_connection) {
		$errmsg = mysql_error($db_connection);    //error message if not able to connect to cs143
			print "Connection failed: $errmsg <br />";
		exit(1);
	}
	mysql_select_db("CS143", $db_connection); 
	$update_maxID="update MaxMovieID SET id=id+1";
	mysql_query($update_maxID,$db_connection);
	//selecting the current id to be given
	$temp="select * from MaxMovieID";
	$temp_id=mysql_query($temp,$db_connection);
	$row = mysql_fetch_row($temp_id);
	$id=intval($row[0]);
	//inserting new tuple
	$query="insert into Movie values($id,'$title','$year','$rating','$company')";	
	$runMovie=mysql_query($query,$db_connection);	
	
	foreach($_GET['genre'] as $genre){
		$query1="insert into MovieGenre values($id,'$genre')";	
		$run=mysql_query($query1,$db_connection);
		
	}
	
if($runMovie==true){
	echo "<script>window.location='addMovieInfo.php?success=1'</script>";
}

else
{
echo "<script>window.location='addMovieInfo.php?success=1'</script>";
}
	mysql_close($db_connection);	
}
?>
</body>
	
</html>
