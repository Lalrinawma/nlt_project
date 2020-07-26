<?php
session_start();
	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username']; 
	}
	else
	{
		echo "please login or signup";
		header("location:login.php");
	}
	$conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");
	$qry = "select * from useri_nfo where user_name='$username' ";
	if ($row = $conn->query($qry)) {
		if ($r =  mysqli_fetch_array($row))
		{
			$name = $r['user_name'];
			$uid = $r['u_id'];
			$phone_no = $r['phone_no'];
			$address = $r['address'];
			$gender = $r['gender'];
			$skills = $r['skills'];
			$email = $r['email'];
			$speciality = $r['speciality'];

		}
		else
		{
			echo "error";
		}

	}
	else
	{
		echo "error loading";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>register new user</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="editpr.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">     
<script type="text/javascript">
	
	
	function update()
	{	
		var myform = document.getElementById("myform");
		var fd = new FormData(myform);
		$(spin).show();
		$.ajax({
			url:"updateprofile.php",
			type: 'POST',
			data: fd,
			processData: false,
    		contentType: false,
			cache: false,
			success:function(data){
				console.log(data);
				if (data == "success")
				{
					alert("Updated");
					window.location.href="newprofile.php";
				}
				else
				{
					if (data == "taken")
					{
						alert("Username taken  please try again");
					}
					else
					{
						alert("error");
					}
				}	
				
			},
			error:function(html)
			{
				console.log(html);
			}
		});
	}
	function changevalue()
	{	var myform = document.getElementById('myform');
		if (myform.gender.value == 'Male')
		{
			myform.gender.value = 'Female'; 
		}
		else
		{
			myform.gender.value = 'Male'; 

		}
	}
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $('.nav-button').click(function(){
  $('body').toggleClass('nav-open');
  });
  $('.nav-button2').click(function(){
  $('body').toggleClass('nav-open');
  });
});
</script>
<link rel="stylesheet" type="text/css" href="editprofile.css">
</head>
<body>
<div class="header">
    <h1>Welcome to E-Desk</h1>
    <p>the best place to find worker of different skills</p>
  </div>


            <header class="head-main rowh">
              <div class="navbar navbar-dark box-shadow" style="background-color: black;">
                <div class="navb d-flex align-items-center">

                  <a class="nav-button"><span id="nav-icon3"><span></span><span></span><span></span><span></span></span></a> 
                  <h4>E-Desk</h4>
                  
                </div>
                   
                      
                     
              </div>
              
              <div class="fixed-top main-menu">
                <div class="d-flex-center p-5">
                  <ul class="nav flex-row">
                    <li class="nav-item delay-1"><a class="nav-link" href="newhome.php"><i class="fa fa-home"></i> HOME</a></li>
                    <li class="nav-item delay-2"><a class="nav-link" href="newprofile.php"><i class="fa fa-user-o"></i>PROFILE</a></li>
                    <li class="nav-item delay-3"><a class="nav-link" href="newnotification.php"><i class="fa fa-bell"></i>NOTIFICATION</a></li>
                    <li class="nav-item delay-4"><a class="nav-link" href="#"><i class="fa fa-phone"></i>CONTACT US</a></li>
                  </ul>
                </div>

              </div>
          	</header>
<div class="row justify-content-center" style="margin-top: 5px;">
	<div class="col-md-6 align-self-center">
		<div class="card ">
			 <div class="card-header">
			 	<h5>Edit Profile</h5>
			 </div>
			 <div class="card-body">
			 	<form id="myform">
			 	<div class="li">
			 		<h6>User Details:</h6>
			 		<div>
			 			<label>Name</label><br/>
			 			<input class="" type="text" name="name" value="<?php echo $name;?>">
			 		</div>
			 		<div>
			 			<label>Address</label><br/>
			 			<input class="" type="text" name="address" value="<?php echo $address; ?>" >
			 		</div>
			 		<div>
			 			<label>Phone No</label><br/>
			 			<input class="" type="text" name='phone_no' maxlength="10" value="<?php echo $phone_no; ?>">
			 		</div>
			 		<div>
			 			<label>Gender</label><br/>
			 			<input class="" type="text" name="gender" value="<?php echo $gender; ?> " readonly><button class="btn btn-outline-dark" type="button" onclick="changevalue();"><i class="fa fa-refresh fa-spin fa-1x"></i></button>
			 		</div>
			 		<div>
			 			<label>Skills</label><br/>
			 			<input class="" type="text" name="skills" value="<?php echo $skills; ?>" >
			 		</div>
			 		<div>
			 			<label>Email</label><br/>
			 			<input class="" type="text" name="email" value="<?php echo $email; ?>" >
			 		</div>
			 		<div>
			 			<label>Speciality</label><br/>
			 			<input class="" type="text" name="speciality" value="<?php echo $speciality; ?>" >
			 		</div>
			 		<div>
			 			<input type="hidden" name="uid" value="<?php echo $uid; ?>">
			 		</div>
			 		
			 	</div>
			 	
			 	<button class="btn btn-primary" type="button" onclick="update();">Update <span id="spin" class="spinner-border spinner-border-sm"></span></button>
			 </form>

			 </div>
		</div>
	</div>
</div>
</body>
</html>