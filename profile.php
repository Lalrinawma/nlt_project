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
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" id="applicationStylesheet" href="profile.css"/>
</head>
<body>
    <div class="header">
        <h1>Get worker and Work</h1>
        <p>specially for hand worker</p>
    </div>
    <div class="column">
    <div class="topnav">
        <div>
            <a href="home.php">
                <i>
                <svg class="Icon_material_home" viewBox="3 4.5 18 14.5">
                <path fill="rgba(211,217,240,1)" class="Icon_material_home_Class" d="M 10.19999980926514 19 L 10.19999980926514 13.88235378265381 L 13.80000019073486 13.88235378265381 L 13.80000019073486 19 L 18.30000114440918 19 L 18.30000114440918 12.17647075653076 L 21.00000190734863 12.17647075653076 L 12 4.5 L 3 12.17647075653076 L 5.699999809265137 12.17647075653076 L 5.699999809265137 19 L 10.19999980926514 19 Z">
                </path>
                </svg>
                </i>
        Home</a>
        </div>
        <a href="notification.php">
            <i>
            <svg class="Icon_material_notifications" viewBox="6 3.75 11.241 14.771">
            <path fill="rgba(211,217,240,1)" class="Icon_material_notifications_Class" d="M 11.6207275390625 18.52064323425293 C 12.39357757568359 18.52064323425293 13.02590942382813 17.83891868591309 13.02590942382813 17.00570678710938 L 10.21554565429688 17.00570678710938 C 10.21554565429688 17.83891868591309 10.84085083007813 18.52064323425293 11.6207275390625 18.52064323425293 Z M 15.83627128601074 13.97582817077637 L 15.83627128601074 10.18848514556885 C 15.83627128601074 7.86305570602417 14.68402481079102 5.916361331939697 12.67461204528809 5.401283264160156 L 12.67461204528809 4.886204719543457 C 12.67461204528809 4.257505416870117 12.20387840270996 3.750000953674316 11.6207275390625 3.750000953674316 C 11.03757476806641 3.750000953674316 10.56683921813965 4.257505416870117 10.56683921813965 4.886204719543457 L 10.56683921813965 5.401282787322998 C 8.550405502319336 5.916361331939697 7.405182361602783 7.855481624603271 7.405182361602783 10.18848514556885 L 7.405182361602783 13.97582817077637 L 6 15.49076747894287 L 6 16.24823760986328 L 17.241455078125 16.24823760986328 L 17.241455078125 15.49076747894287 L 15.83627128601074 13.97582817077637 Z">
            </path>
            </svg>
            </i>
        Notifications</a>
        <div>
        <a href="profile.php">
            <i>
            <svg class="Icon_metro_profile" viewBox="4.499 7.712 15.661 11.766">
            <path fill="rgba(211,217,240,1)" class="Icon_metro_profile_Class" d="M 19.04144287109375 9.392937660217285 L 17.94626617431641 9.392937660217285 L 17.94626617431641 7.746869564056396 L 15.68543148040771 7.712132930755615 L 15.69717693328857 9.392937660217285 L 8.903496742248535 9.392937660217285 L 8.949920654296875 7.712132930755615 L 6.736074447631836 7.746869564056396 L 6.736074447631836 9.427675247192383 L 5.617403984069824 9.392939567565918 C 4.999898433685303 9.392939567565918 4.498734474182129 9.894938468933105 4.498734474182129 10.51347541809082 L 4.498734474182129 18.35723304748535 C 4.498734474182129 18.97576713562012 4.999898433685303 19.4777660369873 5.617403984069824 19.4777660369873 L 19.04144287109375 19.4777660369873 C 19.65894889831543 19.4777660369873 20.16011047363281 18.97576904296875 20.16011047363281 18.35723304748535 L 20.16011047363281 10.51347541809082 C 20.16011047363281 9.894937515258789 19.65894889831543 9.392937660217285 19.04144287109375 9.392937660217285 Z M 16.24476623535156 8.272400856018066 L 17.36343765258789 8.272400856018066 L 17.36343765258789 10.5134744644165 L 16.24476623535156 10.5134744644165 L 16.24476623535156 8.272400856018066 Z M 8.97341251373291 12.08894920349121 C 9.649088859558105 12.08894920349121 10.19723892211914 12.81001472473145 10.19723892211914 13.69971942901611 C 10.19723892211914 14.5894250869751 9.649088859558105 15.31049251556396 8.97341251373291 15.31049251556396 C 8.297736167907715 15.31049251556396 7.749589443206787 14.5894250869751 7.749589443206787 13.69971942901611 C 7.749589443206787 12.81001472473145 8.297736167907715 12.08894729614258 8.97341251373291 12.08894729614258 Z M 7.295408725738525 8.272400856018066 L 8.414079666137695 8.272400856018066 L 8.414079666137695 10.5134744644165 L 7.295408725738525 10.5134744644165 L 7.295408725738525 8.272400856018066 Z M 6.54981517791748 17.20755577087402 C 6.54981517791748 17.20755577087402 6.682377815246582 16.14192771911621 6.983859062194824 15.94079303741455 C 7.284780979156494 15.73965930938721 8.15286922454834 15.60575199127197 8.15286922454834 15.60575199127197 C 8.15286922454834 15.60575199127197 8.715559959411621 16.20804023742676 8.954954147338867 16.20804023742676 C 9.193792343139648 16.20804023742676 9.756484031677246 15.60575199127197 9.756484031677246 15.60575199127197 C 9.756484031677246 15.60575199127197 10.6245698928833 15.73909854888916 10.92605018615723 15.94079303741455 C 11.28010940551758 16.17722511291504 11.36848449707031 17.20755577087402 11.36848449707031 17.20755577087402 L 6.549816131591797 17.20755577087402 Z M 17.92276954650879 16.67642402648926 L 12.88875579833984 16.67642402648926 L 12.88875579833984 16.11615753173828 L 17.92276954650879 16.11615753173828 L 17.92276954650879 16.67642402648926 Z M 17.92276954650879 15.55589008331299 L 12.88875579833984 15.55589008331299 L 12.88875579833984 14.99561786651611 L 17.92276954650879 14.99561786651611 L 17.92276954650879 15.55589008331299 Z M 17.92276954650879 14.43535232543945 L 12.88875579833984 14.43535232543945 L 12.88875579833984 13.87508`583068848 L 17.92276954650879 13.87508583068848 L 17.92276954650879 14.43535232543945 Z M 17.92276954650879 13.3148136138916 L 12.88875579833984 13.3148136138916 L 12.88875579833984 12.75454711914063 L 17.92276954650879 12.75454711914063 L 17.92276954650879 13.3148136138916 Z">
            </path>
            </svg>
            </i>
            Profile</a>
        </div>
        <div>
        
        </div>
        <div>   
        <a href="#">
            <i>
            <svg class="Icon_awesome_phone_alt" viewBox="0 0 19.249 15.747">
            <path fill="rgba(211,217,240,1)" class="Icon_awesome_phone_alt_Class" d="M 18.69997406005859 11.12785053253174 L 14.4891996383667 9.651553153991699 C 14.11967754364014 9.522721290588379 13.6905460357666 9.609231948852539 13.4365062713623 9.863771438598633 L 11.57173538208008 11.72759819030762 C 8.645151138305664 10.59878444671631 6.289923191070557 8.672050476074219 4.910064697265625 6.277906894683838 L 7.188394546508789 4.752395153045654 C 7.50021505355835 4.544922351837158 7.606086254119873 4.193463325500488 7.447807788848877 3.891221284866333 L 5.643190383911133 0.4465241432189941 C 5.468773365020752 0.1193968579173088 5.034704208374023 -0.06008893996477127 4.609294414520264 0.01901270262897015 L 0.6992893815040588 0.7571621537208557 C 0.2898712158203125 0.834505021572113 -9.420151036465541e-05 1.132804036140442 -5.546789338950475e-08 1.476549744606018 C -5.546789338950475e-08 9.365519523620605 7.816250324249268 15.7474365234375 17.44463920593262 15.7474365234375 C 17.86497497558594 15.74765777587891 18.22981834411621 15.51041412353516 18.32439231872559 15.17537021636963 L 19.22669792175293 11.97672271728516 C 19.32276153564453 11.62703800201416 19.10172462463379 11.2708158493042 18.69997406005859 11.12785243988037 Z">
            </path>
            </svg>
            </i>
            Contact-Us</a>
        </div>
    </div>

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
</body>
</html>