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
<link rel="icon" href="data:;base64,iVBORw0KGgo=">
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
    $('#edit-btn').click(function(){
      window.location.href = "editprofile.php";
    });
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

  $("#imageupload").click(function()
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
  

<div class="column " >

        <div class="rowh">
            <header class="head-main navication">
              <div class="navbar navbar-dark box-shadow" style="background-color: black;">
                <div class="navb d-flex align-items-center">
                  <a class="nav-button"><span id="nav-icon3"><span></span><span></span><span></span><span></span></span></a> 
                  <h4>E-Desk</h4>
                              
                </div>   
              </div>
              <div class="main-menu align-items-center">
                
                <div class="nav ">
                 
                    <a href="newhome.php"><i class="fa fa-home" ></i>Home </a>
                    <a href="newnotification.php" ><i class="fa fa-bell" ></i>Notification<span class="fg">new</span></a>
                    <a  href="newprofile.php" ><i class="fa fa-user " ></i>Profile</a>
                    <a href="#"><i class="fas fa-sign-out-alt"></i>Log out</a>
            
                </div>
              </div>
            </header>
        </div>
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
                        <button id="edit-btn" type="button" class="profile-edit-btn" ><i class='fas fa-edit'></i> Edit profile</button>
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
                    <div class="card-header" style="color: #4285f4; background-color: #000000;">
                         <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">About</a>
                    </div>
                    <div class="card-body">
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

</body>
</html>