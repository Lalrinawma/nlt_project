<?php
session_start();
$conn = new mysqli("localhost","root","","project_nlt");
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
                $pre_phone=$r['phone_pre'];
                $post_phone=$r['phone_post'];
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
    if (isset($POST['dp'])) 
    {
        $target_dir = "profile_img/";
        $src=$_FILES["fileToUpload"]["tmp_name"];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (!$conn)
            {
                echo "database error";
                die("Connection failed: " . mysqli_connect_error());
                
            }
            $conn->query("UPDATE useri_nfo SET dp= '$src' WHERE user_name='$username'");
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
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
    <h1>E-desk</h1>
    <p>specially for hand worker</p>
  </div>
<header class="head-main rowh">
  <div class="navbar navbar-dark bg-dark box-shadow">
    <div class="navb d-flex align-items-center">

      <a class="nav-button"><span id="nav-icon3"><span></span><span></span><span></span><span></span></span></a> 
      <h4>E-Desk</h4>
      
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
        <li class="nav-item delay-3"><a class="nav-link" href=" newnotification.php"><i class="fa fa-bell"></i>NOTIFICATION</a></li>
        <li class="nav-item delay-4"><a class="nav-link" href="#"><i class="fa fa-phone"></i>CONTACT US</a></li>
      </ul>
    </div>

  </div>
</header>
<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="uploads/profile_img/<?php echo $dpsrc; ?>" alt="Image"/>
                            <form enctype="multipart/form-data" action="<?php echo($_SERVER["PHP_SELF"]); ?>"    method="POST">
                            
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
                        <input type="submit" class="profile-edit-btn" name="" value="Edit Profile"/>
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
                                                <p><?php echo $pre_phone.$post_phone;?></p>
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
                        
                        <div class="col-md-12">
                                <div style="8px; color: #0062cc;">
                                    <h6>Gallery</h6>
                                </div>
                                <?php
                                 $qry ="SELECT * FROM user_galerry WHERE u_id='$uid'";
                                    if($result1 = $conn->query($qry)) 
                                    {
                                        
                                        if($r2=$result1->fetch_row())
                                        {
                                            $nrow=mysqli_num_fields($result1);
                                            $n=1;
                                            $count=0;
                                            while($n < $nrow && $count <=6)
                                            {
                                             echo "<img id='' src='uploads/gallery/$r2[$n]' style='width: 25%; padding: 3px;' onclick='openModal();currentSlide(1)'>";
                                             $n++;
                                             $count++;
                                            
                                            }

                                        }
                                        else
                                        {
                                            echo "errr";
                                        }
                                    }
                                    else
                                    {
                                      echo "eRROR";
                                    } 
                                ?>
                               
                                <div id="myModal" class="modal">
                                  <span class="close cursor" onclick="closeModal()">&times;</span>
                                  <div class="modal-content">

                                    <div class="mySlides">
                                      <div class="numbertext">1 / 4</div>
                                      <img src="uploads/gallery/<?php $r2["$n"]; ?>" style="width:100%">
                                    </div>

                                    <div class="mySlides">
                                      <div class="numbertext">2 / 4</div>
                                      <img src="img_snow_wide.jpg" style="width:100%">
                                    </div>

                                    <div class="mySlides">
                                      <div class="numbertext">3 / 4</div>
                                      <img src="img_mountains_wide.jpg" style="width:100%">
                                    </div>
                                    
                                    <div class="mySlides">
                                      <div class="numbertext">4 / 4</div>
                                      <img src="img_lights_wide.jpg" style="width:100%">
                                    </div>
                                    
                                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                                    <div class="caption-container">
                                      <p id="caption"></p>
                                    </div>


                                    
                                  </div>
                                </div>

                                <script>
                                function openModal() {
                                  document.getElementById("myModal").style.display = "block";
                                }

                                function closeModal() {
                                  document.getElementById("myModal").style.display = "none";
                                }

                                var slideIndex = 1;
                                showSlides(slideIndex);

                                function plusSlides(n) {
                                  showSlides(slideIndex += n);
                                }

                                function currentSlide(n) {
                                  showSlides(slideIndex = n);
                                }

                                function showSlides(n) {
                                  var i;
                                  var slides = document.getElementsByClassName("mySlides");
                                  var dots = document.getElementsByClassName("demo");
                                  var captionText = document.getElementById("caption");
                                  if (n > slides.length) {slideIndex = 1}
                                  if (n < 1) {slideIndex = slides.length}
                                  for (i = 0; i < slides.length; i++) {
                                      slides[i].style.display = "none";
                                  }
                                  for (i = 0; i < dots.length; i++) {
                                      dots[i].className = dots[i].className.replace(" active", "");
                                  }
                                  slides[slideIndex-1].style.display = "block";
                                  dots[slideIndex-1].className += " active";
                                  captionText.innerHTML = dots[slideIndex-1].alt;
                                }
                                </script>
                 </div>
                                
        </div>
</div>

</body>
</html>