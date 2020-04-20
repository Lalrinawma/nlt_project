<?php
session_start();
$conn = new mysqli("localhost","root","","project_nlt");
    if (is_null($_SESSION["username"])) {
          echo "please login or register";
        header("location:login.php");
           
           
            
     }         
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>



<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">
        
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

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
  

<!------ Include the above in your HEAD tag ---------->
<div class="column " >
<div class="header">
    <h1>Get worker and Work</h1>
    <p>specially for hand worker</p>
  </div>
<header class="head-main rowh">
  <div class="navbar navbar-dark bg-dark box-shadow">
    <div class="navb d-flex align-items-center">

      <a class="nav-button"><span id="nav-icon3"><span></span><span></span><span></span><span></span></span></a> 
      <h4>E-Tlangau</h4>
      
    </div>
           <div>
            <i class="fa fa-user-circle-o"></i>
          </div>
          <form class="form-inline ml-auto mr-5 ">
          <div class="src">
              <input class="form-control form-control-sm ml-3 w-93" type="text" placeholder="text here"
                aria-label="Search">
          </div>
          <div class="src">
              <button class="btn btn-rounded btn-sm my-0 ml-sm-2 mr-auto" type="submit"><i class="fa fa-search"></i> Search</button>
          </div>
          </form>
         
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
<div class="row">
    <div class="col-sm-8">
      <h5>Notifications</h5>
      <div class="card">
        <div class="card-body">
          <p>Bootstrap's grid system is built with flexbox and allows up to 12 columns across the page.
          If you do not want to use all 12 columns individually, you can group the columns together to create wider columns:
          span 1  span 1  span 1  span 1  span 1  span 1  span 1  span 1  span 1  span 1  span 1  
          </p>
        </div>
        <div class="card-footer">
          <button type="submit">Hire</button>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>