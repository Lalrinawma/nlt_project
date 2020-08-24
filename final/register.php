
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
<link rel="stylesheet" type="text/css" href="register.css">

<script type="text/javascript">
	function utypefunction(utype)
	{	
		if (utype == 'worker')
		{
			$(skills).hide();
		}
		if (utype == 'work') 
		{
			$(skills).show();
		}
	}
	function newreg()
	{	var myform = document.getElementById("myform");
		var fd = new FormData(myform);
		$(spin).show();
		$.ajax({
			url:"newuser_reg.php",
			type: 'POST',
			data: fd,
			processData: false,
    		contentType: false,
			cache: false,
			success:function(data){
				console.log(data);
				if (data == "success")
				{
					alert("Register Sucessfully");
					window.location.href = "newlogin.php";
				}
				else
				{
					if (data == "taken")
					{
						alert("Username taken");
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
	function checkpassword()
	{	var myform = document.getElementById('myform');
		if (myform.password.value != myform.Confirm.value)
		{
			document.getElementById("wlabel").innerHTML="password deos't match";
		}
		else
		{
			document.getElementById("wlabel").innerHTML="";

		}
	}
</script>
</head>
<body>
<div class="row justify-content-center">
	<div class="col-md-6 align-self-center" style="margin-top: 40px;">
		<div class="card">
			 <div class="card-header brand_logo_container">
				<img src="resource/Edesk.png" class="brand_logo" alt="Logo">
			 </div>
			 
			 <div class="card-body" style="background-color: #173a4b;">
			 <div class="card-title" style="background: #c0392b; text-align: center; padding: 10px;">
			 	<h5>Register new user</h5>
			 </div>
			 	<form id="myform">
			 	<div class="li">
			 		<h7>User Details:</76>
			 		<div>
			 			<input class="" type="text" name="name" placeholder="Name*">
			 		</div>
			 		<div>
			 			<input class="" type="text" name="address" placeholder="Address*">
			 		</div>
			 		<div>
			 			<input class="" type="text" maxlength="10" name="phone_no" placeholder="Phone_no*">
			 		</div>
			 		<div>
			 			<label>Gender</label>
			 			<select name="gender" class="btn">
			 				<option value="Male"> Male</option>
			 				<option value="Female">Female</option>
			 			</select>
			 		</div>
			 	</div>
			 	<div class="li">
			 		<h7>Looking for
			 			<select onchange="utypefunction(this.value);" name="type" class="btn">
			 			<option  value="work">Work/job</option>
			 			<option  value="worker">Worker</option>
			 			</select>
			 		</h7>

			 		<div id="skills">
			 			<input type="text" name="skills" list="suggestion" placeholder="skills1*">
			 			<datalist id="suggestion">
			 				<option value="Plumber">
			 				<option value="electrician">
			 				<option value="Woodworker">
			 				<option value="Cement mistiri">
			 				<option value="Labour/helper">
			 			</datalist>
			 			<input type="text" name="speciality" placeholder="speciality">
			 		</div>
			 	</div>
			 	<div class="li">
			 		<h7>Password</h7>
			 		<div>
			 			<input type="password" name="password" placeholder="Password*">
			 		</div>
			 		<div>
			 			<input type="password" name="Confirm" placeholder="Confirm Password*" oninput="checkpassword();">
			 			<label id="wlabel" for="Confirm"></label>
			 		</div>
			 	</div>
			 	<button class="btn btn-primary" type="button" onclick="newreg();">Submit <span id="spin" class="spinner-border spinner-border-sm"></span></button>
			 </form>

			 </div>
		</div>
	</div>
</div>
</body>
</html>