<?php
$conn = new mysqli('localhost','terinao','Bingo-@06','project_nlt');
if (isset($_POST['name'])) {
	$uname = $_POST['name'];
	$uaddress = $_POST['address'];
	$ucontact = $_POST['phone_no'];
	$skills= $_POST['skills'];
	$gender= $_POST['gender'];
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
			$qry = "insert into useri_nfo(user_name,user_password,address,phone_no,skills,gender,speciality,status,dp,notifications,email) values('$uname','$password','$uaddress','$ucontact','$skills','$gender','$speciality','available','avatar.png',1,'')";
			if($conn->query($qry))
			{
				$qry2 = "select u_id from useri_nfo where user_name = '$uname'";
				if ($result = $conn->query($qry2)) {
					$row = mysqli_fetch_array($result);
					$notidbname = $row['u_id']."notidb";
					$qry3 ="CREATE TABLE `".$notidbname."` (n_id int(11) AUTO_INCREMENT PRIMARY KEY,sender varchar(40) COLLATE utf8_bin NOT NULL,type int(10) NOT NULL,pid int(11) DEFAULT NULL,rate varchar(40) COLLATE utf8_bin DEFAULT NULL,comment varchar(100) COLLATE utf8_bin DEFAULT NULL,Time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
					if ($conn->query($qry3)) {
						echo"success";
						return true;
					}
					else
					{
						echo "Database busy";
					}
				}
				
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