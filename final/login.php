<?php
session_start(); 
$username="";
$password="";
$conn = new mysqli("127.0.0.1","terinao","Bingo-@06","project_nlt");

if (!$conn) {
	echo "database error";
    die("Connection failed: " . mysqli_connect_error());
    
}

if(isset($_POST['login']))
{

$username=$_POST["username"];
$password=$_POST["password"];
$query = $conn->prepare("SELECT user_password FROM useri_nfo WHERE user_name='$username' ");// prepate a query
// binding parameters via a safer way than via direct insertion into the query. 'i' tells mysql that it should expect an integer.
$query->execute(); // actually perform the query
if($result = $query->get_result()) 
{
if($r = $result->fetch_array(MYSQLI_ASSOC)) // bind the data from the first result row to $r
{
	if ($password==$r['user_password']){
		$_SESSION["username"]=$username;
		$_SESSION["password"]=$password;
		header("location:newhome.php");
	}
	else
	{
		echo "incorrect password";
	}
}
else
{
	echo "incorrect password";
}
}
else
{
	echo "incorrect username";
}


mysqli_close($conn);
}
?>
 
