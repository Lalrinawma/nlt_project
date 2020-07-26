<!DOCTYPE html>
<html>
<head>
	<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>


<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">     
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
 <link rel="stylesheet" type="text/css" href="quickfind.css">

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
                <div class="flex-center p-5">
                  <ul class="nav flex-row">
                    <li class="nav-item delay-1"><a class="nav-link" href="newhome.php"><i class="fa fa-home"></i> HOME</a></li>
                    <li class="nav-item delay-2"><a class="nav-link" href="newprofile.php"><i class="fa fa-user-o"></i>PROFILE</a></li>
                    <li class="nav-item delay-3"><a class="nav-link" href="newnotification.php"><i class="fa fa-bell"></i>NOTIFICATION</a></li>
                    <li class="nav-item delay-4"><a class="nav-link" href="#"><i class="fa fa-phone"></i>CONTACT US</a></li>
                  </ul>
                </div>

              </div>
            </header>
        <br>
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
      <h6 class='card-title'>$name[$i]</h6>
      <p1>$skills[$i] 
          $address[$i]</p1><br>
      <button class='btn btn-primary'>Hire</button>
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