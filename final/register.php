
<!DOCTYPE html>
<html>
<head>
	<title>register new user</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
					window.location.href = "login.php";
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
	<div class="col-md-6 align-self-center">
		<div class="card ">
			 <div class="card-header">
			 	<h5>Register new-user</h5>
			 </div>
			 <div class="card-body">
			 	<form id="myform">
			 	<div class="li">
			 		<h6>User Details:</h6>
			 		<div>
			 			<input class="" type="text" name="name" placeholder="Name*">
			 		</div>
			 		<div>
			 			<input class="" type="text" name="address" placeholder="Address*">
			 		</div>
			 		<div>
			 			<input class="" type="text" maxlength="10" name="phone_no" placeholder="Phone_no*">
			 		</div>
			 	</div>
			 	<div class="li">
			 		<h6>Looking for
			 			<select onchange="utypefunction(this.value);" name="type">
			 			<option value="work">Work/job</option>
			 			<option value="worker">Worker</option>
			 			</select>
			 		</h6>

			 		<div id="skills">
			 			<input type="text" name="skills1" list="suggestion" placeholder="skills1*">
			 			<input type="text" name="skills2" list="suggestion" placeholder="skills2">
			 			<input type="text" name="skills3" list="suggestion" placeholder="skills3">
			 			<input type="text" name="skills4" list="suggestion" placeholder="skills4">
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
			 		<h6>Password</h6>
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