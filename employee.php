<?php

$conn = new mysqli("127.0.0.1","root","","project_nlt");

if (!$conn) {
	echo "database error";
    die("Connection failed: " . mysqli_connect_error());
    
}

if(isset($_POST['submit']))
{
$name=$_POST['username'];
$address=$_POST['address'];
$contact=$_POST['contact'];
$query = $conn->prepare("insert into employees(employeeId,employeeName,employeeAddress,employeeContact) values='$name','$address','$contact'");// prepate a query
// binding parameters via a safer way than via direct insertion into the query. 'i' tells mysql that it should expect an integer.
// actually perform the query
if($query->execute())
{
  echo "success";
}
else
{
  echo "error";
}

mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>employee</title>
</head>
<body>

  <div>
 <div >
        <div>

          <h5>
            <strong>Employeee</strong>
          </h5>

          <!--Card content-->
          <div>

            <!-- Form -->
            <form style="color: #757575;" enctype="multipart/form-data" action="<?php echo($_SERVER["PHP_SELF"]); ?>"	 method="POST">
              <!-- Email -->
              <div class="sm-form">
                <label for="username">Name</label>
                <input type="text" class="form-control" name="username">
                
              </div>
              <div>
                <label for="address">Address</label>
                <input type="text" name="address">
                
              </div>
              <div>
                <label for="contact">Contact</label>
                <input type="text" name="contact">
                
              </div>
                    <button type="submit" name="submit">Submit</button>
    
            </form>
            <!-- Form -->

          </div>

        </div>
      </div>
      
  </div>
</body>
</html>

