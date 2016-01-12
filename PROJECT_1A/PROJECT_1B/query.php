<html>
	<body>
		Input your Query:<br>     <!--Input from the user-->
		<form method="GET">
			<textarea name="query" cols="60" rows="8" value=" "><?php echo $_GET['query']; ?></textarea><br>
			<input type=submit name="submit" value="Submit" />
		</form>
		
		<?php
if(!empty($_GET["submit"])){
	$input = $_GET["query"];
	
	$db_connection = mysql_connect("localhost", "cs143", ""); //connecting to CS143
	if(!$db_connection) {
		$errmsg = mysql_error($db_connection);    //error message if not able to connect to cs143
		print "Connection failed: $errmsg <br />";
		exit(1);
	}
	
	$query = $input;
	mysql_select_db("CS143", $db_connection); //using database CS143
?><b> <h3>Results from MySQL:</h3></b>
	<?php 
	$result = mysql_query($query, $db_connection);
	$i = 0;
	echo '<table border=1 cellspacing=1 cellpadding=2><tr>'; 
	while ($i < mysql_num_fields($result)){
		$inter = mysql_fetch_field($result, $i);
		echo '<td><b>' . $inter->name . '</b></td>';
		$i = $i + 1;
	}
	
	while ($row = mysql_fetch_row($result)){ //logic for adding rows
echo '<tr>';
		for($x=0; $x<$i; $x++){
			if ($row[$x] == NULL){
				echo '<td>N/A</td>';}
			else{
				echo '<td>' . $row[$x] . '</td>';
			}
		}
	echo '</tr>';}
}		?>
	</body>
</html>
