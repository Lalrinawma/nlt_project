<?php
session_start();
$conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");
    if (isset($_SESSION["username"])) {
         
            $username=$_SESSION["username"];
            if (!$conn)
            {
                echo "database error";
                die("Connection failed: " . mysqli_connect_error());
                
            }
            $query = $conn->prepare("SELECT * FROM useri_nfo WHERE user_name='$username'");
           
            $query->execute();

            if($result = $query->get_result()) 
            {
            $r = $result->fetch_array(MYSQLI_ASSOC); // bind the data from the first result row to $r
                $phone_no = $r['phone_no'];
                $address=$r['address'];
                $email=$r['email'];
                $dpsrc=$r['dp'];
                $status=$r['status'];
                $skills=$r['skills'];
                $uid=$r['u_id'];
                
            }
            else
            {
                echo "eRROR1";
            }
           
            
    }         
    else
    {
        echo "please login or register";
        header("location:login.php");
    }


?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>



<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">
        

 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
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

  $("#imageuplo").ready(function()
  {
    $.ajax(
    {
      type: "post",
      action:"uploadpicture.php",
      data:{action:'true'},
      success:function(data)
      {
        console.log(data);
        
      }

    });
  });

</script>
</head>
<body>
  

<!------ Include the above in your HEAD tag ---------->
<div class="column " >
<div class="header">
    <h1>E-desk</h1>
    <p>specially for hand worker</p>
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
        <li class="nav-item delay-3"><a class="nav-link" href=" newnotification.php"><i class="fa fa-bell"></i>NOTIFICATION</a></li>
        <li class="nav-item delay-4"><a class="nav-link" href="#"><i class="fa fa-phone"></i>CONTACT US</a></li>
      </ul>
    </div>

  </div>
</header>
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="myModal" >
  <div class="modal-dialog">

  <!-- Modal content-->
  <form id="myform" action="uploadpicture.php" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Profile-picture</h4>
        </div>
        <div class="modal-body">
          <h6>Choose Photo</h6>
          <input class="btn-primary" type="file" name="fileToUpload">
        </div>
        <div class="modal-footer">
          <button type="submit" id="imageupload" class="btn btn-primary">Upload</button>
        </div>
    </div>
  </form>

  </div>
</div>
<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="uploads/profile_img/<?php echo $dpsrc; ?>" alt="Image"/>
                              <div class="file btn btn-lg btn-primary">
                                  <button type="button" class="btn-primary-outline" data-toggle="modal" data-target="#myModal" style="color: white;">Change photo <i class="fa fa-camera"></i></button>
                              </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $_SESSION["username"]; ?>
                                    </h5>
                                    <h6>
                                        <?php echo $skills; ?>
                                    </h6>
                                    <p class="proile-rating">Ratings : <span>8/10</span></p>
                            
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="editprofile.php" class="profile-edit-btn" name="" value="Edit Profile">Edit profile</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <h6 style="padding-top: 8px; color: #0062cc;">Status</h6>
                            <label style="color:  #1abc9c; border: 1px solid  #1abc9c;"><?php echo $status; ?></label>
                    
                             <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br/>
                                        <p>Your detail description</p>
                                    </div>
                             </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card gedf-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">About</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                             <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $email;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone_no</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $phone_no;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $address;?></p>
                                            </div>
                                        </div>
                            </div>
                        </div>  

                     </div>
                            
                  </div>
                    </div>
                    <br><br>
                        
                        
                                
        </div>
</div>

</body>
</html>