<html>
	<h2>
		Calculator
	</h2>
	<form method="GET" action="">
		<input type="text" name="arg_string" value="">
		<input type="submit" name="submit" value="CALCULATE">
	</form>
</html>
<?php
if(!empty($_GET["submit"]))
{
	$arg_str=$_GET["arg_string"];
	for($i=0;$i<strlen($arg_str);$i++){
		if($arg_str[$i]=='-' && $arg_str[$i+1]=='-')
		{
			$arg_str[$i+1]='+';
			$sbstr1 = substr($arg_str,0,$i);
			$sbstr2 = substr($arg_str,$i+1,strlen($arg_str));
			$temp_str=$temp_str.$sbstr1;
			$temp_str=$temp_str.$sbstr2;
			$arg_str = $temp_str;
		}
		if($arg_str[$i]=='/' && $arg_str[$i+1]=='0')
		{ ?>
<html>
	<h2>
		Result
	</h2>
</html>
<?php exit("Division by 0 error!");
		}
		if (preg_match('/^[.\0-9\+\-\*\/]+$/', $arg_str))
		{
			continue;
		}
		else
		{?><html>
<h2>
	Result
</h2>
</html>
<?php echo "Invalid Expression!";
		 exit;}
	}
	$expression = $arg_str;
	eval( '$result = (' . $arg_str . ');' );
	
?>
<html>
	<h2>
		Result
		<br>
		<?php echo $arg_str."=". $result;
		?></h2>
</html>
<?php
}
?>
