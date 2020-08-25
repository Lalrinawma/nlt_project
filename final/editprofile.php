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
			$status = $r['status'];

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
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript" src="node_modules/mdbootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/mdb.min.js"></script>
<link rel="icon" href="data:;base64,iVBORw0KGgo=">
<link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
<link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css">
<link rel="stylesheet" href="/nlt_project/final/fontawesome/css/all.css" >


<link rel="stylesheet" type="text/css" href="newprofile.css">  
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
	function changevaluestatus()
	{	var myform = document.getElementById('myform');
		if (myform.status.value == 'Available')
		{
			myform.status.value = 'Busy'; 
		}
		else
		{
			myform.status.value = 'Available'; 

		}
	}
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.nav-button').click(function(){
      $.ajax({
        url : "checknoti.php",
        type : "GET",
        success: function(data)
        {
          console.log(data);
          if(data > 0 && data < 99)
          {
              $('.fg').toggleClass('badge');
              document.getElementByClassName("badge")[0].innerHTML = this.responseText;


          }
          else
          {
              if (data > 0 && data > 99 )
              {
                $('.fg').toggleClass('badge');
                document.getElementByClassName("badge")[0].innerHTML("99+");
              }
          
          }
        }
      });
    $('.navication').toggleClass('nav-open');
    });
  
  });
</script>
<link rel="stylesheet" type="text/css" href="editprofile.css">
</head>
<body>


        <div class="rowh">
            <header class="head-main navication">
              <div class="navbar navbar-dark box-shadow" style="background-color: black;">
                <div class="navb d-flex align-items-center">
                  <a class="nav-button"><span id="nav-icon3"><span></span><span></span><span></span><span></span></span></a> 
                  <img src="resource/Edesk.png" class="brand_logo" alt="Logo" style="height: 80px; width: 80px;">
                              
                </div>   
              </div>
              <div class="main-menu ">
                
                <div class="nav ">
                 
                    <a href="newhome.php"><i class="fa fa-home" ></i>Home </a>
                    <a  href="newprofile.php" ><i class="fa fa-user " ></i>Profile</a>
                    <a href="newnotification.php" ><i class="fa fa-bell" ></i>Notification<span class="fg">new</span></a>
                    <a onclick="logout();"><i class="fas fa-sign-out-alt"></i>Log out</a>
            
                </div>
              </div>
            </header>
        </div>
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
			 			<input class="" type="text" name="gender" value="<?php echo $gender; ?> " readonly><button class="btn btn-outline-dark" type="button" onclick="changevalue();"><i class="fas fa-redo fa-spin fa-1x"></i></button>
			 		</div>
			 		<div>
			 			<label>Status</label><br/>
			 			<input class="" type="text" name="status" value="<?php echo $status; ?> " readonly><button class="btn btn-outline-dark" type="button" onclick="changevaluestatus();"><i class="fas fa-redo fa-spin fa-1x"></i></button>
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