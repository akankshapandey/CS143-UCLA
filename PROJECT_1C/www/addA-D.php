<html>
	<head>
		<style>
			ul {
				list-style-type: none;
			}
			li {
				display: inline;
			}
		</style>
	</head>
	<body bgcolor="mistyrose"><center>
			<table border="0">
				<tr>
					<th BGCOLOR="Pink">
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
		</center>
<br><br>
		<form method="GET">
			<h4>Please choose what you wish to do:</h4>
			<br>
			Actor:
			<input type=radio name="add_actor_or_director" value="Actor" checked>
		</input>
		Director:
		<input type=radio name="add_actor_or_director" value="Director">
	</input>
	<br>
	<br>
	Enter first name:
	<input type=text name="fname"/ REQUIRED>
	<br><br>
	Enter last name:&nbsp
	<input type=text name="lname"/ REQUIRED>
	<br><br>
	Sex:
	Male:
	<input type=radio name="sex" value="Male" checked>
</input>
Female:
<input type=radio name="sex" value="Female">
</input>
<br><br>
Date of Birth:&nbsp&nbsp&nbsp






<select name="year" REQUIRED>
    <?php for ($i = date('Y'); $i >=1 ; $i--) : ?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php endfor; ?>
</select>


<select name="month" REQUIRED>
    <?php for ($i =1; $i <=12 ; $i++) : ?>
<?php
if($i>=1&&$i<=9)
{
$i="0".$i;}

?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php endfor; ?>
</select>


<select name="date" REQUIRED>
    <?php for ($i = 1; $i <=31 ; $i++) : ?>
<?php
if($i>=1&&$i<=9)
{
$i="0".$i;}

?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    <?php endfor; ?>
</select>

<br><br>
Date of Death:&nbsp&nbsp
<input type=text name="dod"/>


<br><br>
<center>
<input type=submit name="submit" value="Submit"/></center>

</form>
</body>
</html>
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
$c=0;
	$choice = $_GET["add_actor_or_director"];
	$first = $_GET["fname"];
	$last= $_GET["lname"];
	$sex = $_GET["sex"];
	$year = $_GET["year"];
	$month = $_GET["month"];
	$date = $_GET["date"];
$dob=$year.'-'.$month.'-'.$date;

$dod=$_GET["dod"];
if($dod=="")
{
$dod=null;}



	
	$db_connection = mysql_connect("localhost", "cs143", ""); //connecting to CS143
	if(!$db_connection) {
		$errmsg = mysql_error($db_connection);    //error message if not able to connect to cs143
		print "Connection failed: $errmsg <br />";
		exit(1);
	}

//Validating name
	
		 if(preg_match('/[^A-Za-z\s\'-]/', $first) || preg_match('/[^A-Za-z\s\'-]/', $last))
		{
			echo "Only letters, spaces, single-quotes, and hyphens are allowed in the name.";
			$c=1;

		}
		
		else
		{
			$last = mysql_escape_string($last);
			$first = mysql_escape_string($first);
		}





        if($choice=="Actor"&&$c==0){
 
         //updating MaxPersonID before insert
	mysql_select_db("CS143", $db_connection); 
	$update_maxID="update MaxPersonID SET id=id+1";
	mysql_query($update_maxID,$db_connection);	

	//selecting the current id to be given
	$temp="select * from MaxPersonID";
	$temp_id=mysql_query($temp,$db_connection);
	$row = mysql_fetch_row($temp_id);
	$id=intval($row[0]);

	//inserting new tuple
	
if($c==0)
{
if($dod==null)
{
$query="insert into Actor values($id,'$last','$first','$sex','$dob',null)";
}
else
{$query="insert into Actor values($id,'$last','$first','$sex','$dob','$dod')";}	

	$run=mysql_query($query,$db_connection);
	
echo "<script> window.location='addA-D.php?success=1'</script>"; 
}
if($c==1)
{
echo "<script> window.location='addA-D.php?success=2'</script>"; 

}

	
}




        if($choice=="Director"&&$c==0){

	//updating MaxPersonID before insert
	mysql_select_db("CS143", $db_connection); 
	$update_maxID="update MaxPersonID SET id=id+1";
	mysql_query($update_maxID,$db_connection);

	//selecting the current id to be given
	$temp="select * from MaxPersonID";
	$temp_id=mysql_query($temp,$db_connection);
	$row = mysql_fetch_row($temp_id);
	$id=intval($row[0]);

}

		



if($c==0)
{
//inserting new tuple
	$query="insert into Director values($id,'$last','$first','$dob','$dod')";	

	$run=mysql_query($query,$db_connection);	


echo "<script> window.location='addA-D.php?success=1'</script>"; 
}
else
{
echo "<script> window.location='addA-D.php?success=2'</script>"; 

}




 


mysql_close($db_connection);

}
?>
