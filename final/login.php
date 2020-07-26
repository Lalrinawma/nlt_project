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
 
<!DOCTYPE html>
<html>
<head>
  <title>login</title>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" id="applicationStylesheet" href="home2.css"/>
</head>
<body>
<div>
  <div class="col-sm-12">
      <div class="header">
        <h1>Welcome To  Edesk</h1>
        <p>Get worker or find here</p>
      </div>
  </div>
</div>
<div class="row" style="margin: 5px;">
 <div class="col-sm-3">
        <div class="card" style="margin-top: 20px;">

          <h5 class="card-header info-color white-text text-center py-4">
            <strong>Sign in</strong>
          </h5>

          <!--Card content-->
          <div class="card-body px-sm-3 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" enctype="multipart/form-data" action="<?php echo($_SERVER["PHP_SELF"]); ?>"	 method="POST">
              <!-- Email -->
              <div class="sm-form">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username">
                
              </div>

              <!-- Password -->
              <div class="sm-form">
                <label for="materialLoginFormPassword">Password</label>
                <input type="password" id="materialLoginFormPassword" class="form-control" name="password">
                
              </div>

              <div class="d-flex justify-content-around">
                <div>
                  <!-- Remember me -->
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                    <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                  </div>
                </div>
                <div>
                  <!-- Forgot password -->
                  <a href="">Forgot password?</a>
                </div>
              </div>
              
              <!-- Sign in button -->
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="login">Sign in</button>
            

              <!-- Register -->
              <p>Not a member?
                <a href="register.php">Register</a>
              </p>
            </form>
            <!-- Form -->

          </div>

        </div>
  </div>
  

  <div class="col-sm-8">
    <div class="card" style="margin-top: 20px;">
      <div class="card-header">
        <h5>About This Page</h5>
      </div>
      <div class="card-body">
        <p>
          Edesk is developed to minimize the gap between worker and employer who deos not know each other, we hope to bring together the worker who wants works and employer who needs workers. 
        </p>
      </div>
    </div>
  </div>

</div>

</body>
</html>

