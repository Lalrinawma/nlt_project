<?php
session_start(); 
$username="";
$password="";
$conn = new mysqli("127.0.0.1","root","","project_nlt");

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
  <div class="header">
    <h1>Get worker and Work</h1>
    <p>specially for hand worker</p>
  </div>
  <div class="row">
 <div class="col-sm-3">
        <div class="card">

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
      <div class="col-sm-9">
          <div class="card">
              <div class="card-header">
                <h1>About this page</h1>
              </div>
              <div class="card-body">
                <p>
                  View 3+ more
                  Cambridge Advanced Learner's Dictionary
                  Cambridge Advanced Learner...
                  Webster's Dictionary for Students
                  Webster's Dictionary for Stude...
                  Co
                  Next
                  Complementary results
                  Knowledge result
                  Text
                  Literary theory
                  Image result for text
                  DescriptionIn literary theory, a text is any object that can be "read", whether this object is a work of literature, a street sign, an arrangement of buildings on a city block, or styles of clothing. It is a coherent set of signs that transmits some kind of informative message. Wikipedia
                  Feedback
                  See results about

                  Text messaging
                  Text messaging, or texting, is the act of composing and sending electronic ...
                  Footer links
                  IndiaAizawl, Mizoram - Based on your Location History - Use precise location - Learn more
                  HelpSend feedbackPrivacyTerms
                </p>
              </div>
            
          </div>
        
      </div>
  </div>
</body>
</html>

