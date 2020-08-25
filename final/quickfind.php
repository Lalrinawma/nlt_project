<!DOCTYPE html>
<html>
<head>
	<title></title>
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
  $(document).ready(function(){
  $('.nav-button').click(function(){
  $('body').toggleClass('nav-open');
  });
  $('.nav-button2').click(function(){
  $('body').toggleClass('nav-open');
  });
});
</script>
</head>
<body>
<div class="column " >
  
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

<div class="row" style="margin: 20px;">
<?php
   
   $skill = $_POST['name'];
   $conn = new mysqli('localhost','terinao','Bingo-@06','project_nlt');
   $qry = "select * from useri_nfo where skills='$skill' order by u_id ASC";
   if ($row = $conn->query($qry))
   {
    $numrow = $row->num_rows;
    $name = array($numrow);
    $profile_img=array($numrow);
    $skills = array($numrow);
    $address = array($numrow);
     $i = 0;
          while ($r = $row->fetch_array(MYSQLI_ASSOC)) {
              $name[$i] = $r['user_name'];
              $profile_img[$i] = $r['dp'];
              $skills[$i] = $r['skills'];
              $address[$i] = $r['address'];
            $i++;
          }
      
   }
   else
   {
     echo "error";
   }
   $i= 0;
   
   if ($numrow >= 1) {
   while ($numrow>$i) {
     echo "
     <div class='col-md-2 align-content-center '>
      <div class='card'>
    
      <img class='card-img-top' src='uploads/profile_img/$profile_img[$i]' alt='profile-image'>
      <div class='card-body' style='background-color: #E4E4E7;''>  
      <h6 class='card-title font-weight-bold mb-2'>$name[$i]</h6>
      <p1>$skills[$i] 
          $address[$i]</p1><br>
      <form enctype='multipart/form-data' action='seeprofile.php' method='POST'>
        <button type='submit' class='btn btn-primary' name='name' value='$name[$i]'> see profile</button>
      </form>
      </div>
      </div>
    </div>";
    $i++;
   }
  }
  else
  {
    echo " <p style='color:red; text-align:center;'>No available worker right-now</p>";
  }
?>
</div>
</body>
</html>