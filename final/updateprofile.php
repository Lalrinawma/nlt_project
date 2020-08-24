<?php
session_start();
$user_name = $_SESSION['username'];
$conn = new mysqli('localhost','terinao','Bingo-@06','project_nlt');
if (isset($_POST['name'])) {
	$uid = $_POST['uid'];
	$uname = $_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$contact = $_POST['phone_no'];
	$skills = $_POST['skills'];
	$gender= $_POST['gender'];
	$speciality =$_POST['speciality'];
	$tqry = "select * from useri_nfo where user_name= '$uname'";
	if($row=$conn->query($tqry))
	{	$r = mysqli_fetch_array($row);
		if ( $r['user_name'] == $user_name || mysqli_num_rows($row) == 0) 
		{
			$qry = "update useri_nfo set user_name ='$uname',phone_no = '$contact',address = '$address',email = '$email',skills = '$skills',gender ='$gender',speciality = '$speciality' where u_id='$uid' ";
			if($conn->query($qry))
			{
				echo"success";
			
			}
			else
			{
				echo "Failed";
			}
			
		}
		else
		{
			echo "taken";
		}
	}
}
else
{
	echo"error";
}

?>