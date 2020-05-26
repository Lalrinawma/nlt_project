<?php
$conn = new mysqli('localhost','root','','project_nlt');
if (isset($_POST['name'])) {
	$uname = $_POST['name'];
	$uaddress = $_POST['address'];
	$ucontact = $_POST['phone_no'];
	$skills1= $_POST['skills1'];
	$skills2= $_POST['skills2'];
	$skills3= $_POST['skills3'];
	$skills4= $_POST['skills4'];
	$speciality =$_POST['speciality'];
	$password = $_POST['password'];
	$tqry = "select * from useri_nfo where user_name= '$uname'";
	if($row=$conn->query($tqry))
	{
		if (mysqli_num_rows($row)>0) {
			echo "taken";
		}
		else
		{
			$qry = "insert into useri_nfo(user_name,user_password,address,phone_no,skills,skills2,skills3,skills4,speciality,status,dp) values('$uname','$password','$uaddress','$ucontact','$skills1','$skills2','$skills3','$skills4','$speciality','available','avatar.png')";
			if($conn->query($qry))
			{
				echo"success";
				return true;
			}
			else
			{
				echo "Failed";
			}
		}
	}
}
else
{
	echo"error";
}

?>