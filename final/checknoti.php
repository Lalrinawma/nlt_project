<?php
session_start();
$username = $_SESSION['username'];
	$conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");
	$check = "select notifications from useri_nfo where user_name='$username'";
	if ($r=$conn->query($check)) {
		$rf = mysqli_fetch_array($r);
		echo $rf['notifications'];
	}
	else
	{
		echo "errr";
	}
?>