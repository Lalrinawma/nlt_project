<?php
session_start();
$conn = new mysqli("localhost","root","","project_nlt");
    if (isset($_SESSION["username"]))
    {
         
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
                $phone_no=$r['phone_no'];
                $address=$r['address'];
                $email=$r['email'];
                $dpsrc=$r['dp'];
                $status=$r['status'];
                $skills=$r['skills'];
                $uid=$r['u_id'];
                $psrc=$r['dp'];
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
    if (isset($_POST['post'])) {
        $type=$_POST['type'];
        $rskill=$_POST['rskill'];
        $description=$_POST['description'];
        $iqry= "insert into postdb (type,publisher,rskills,description) values ('$type','$username','$rskill','$description')";
        $sqry= "select id from postdb where description='$description' && publisher='$username'";


        if ($conn->query($iqry)) {
            if($ff=$conn->query($sqry))
            {
                $f=mysqli_fetch_array($ff);;
                $idl=$f['0']."like";
                $idb=$f['0']."bid";
                $cqry = "create table `".$idl."`(id INT(10) not null auto_increment primary key, likers int(15) not null default '0')";
                if($conn->query($cqry))
                {
                      echo "posted";
                }
                else
                {
                    echo "ER";
                    
                }
                 $cqry2 = "create table `".$idb."`(id INT(10) not null auto_increment primary key, bidders int(15) not null default '0')";
                if($conn->query($cqry2))
                {
                      echo "posted";
                }
                else
                {
                    echo "DS";
                }
              
            }
            else
            {
                echo"errrr";
            }
        }
        else
        {   echo "<script>";
            echo 'alert"error"';
            echo "</script>";
        }


    }
    

    class data
    {
     
      public function newsfeed()
     {  $conn = new mysqli("localhost","root","","project_nlt");
         $username=$_SESSION["username"];
                
                      $idquery="select id from postdb order by date ASC limit 1";
                            if ($result=$conn->query($idquery))
                            {
                                $r=mysqli_fetch_assoc($result);
                                 $pcid=$r['id'];

                            }
                            else
                            {
                                echo "errrr";
                            }
                
                        $pname= array(9);
                        $pskill=array(9);
                        $ptype=array(9);
                        $pdescription=array(9);
                        $pbid=array(9);
                        $plike=array(9);
                        $count=0;
                        while ($count <= 9 && $pcid >= 1) 
                        {
                             $fetch="select * from postdb where id='$pcid' ";
                             if($r=$conn->query($fetch))
                             {
                                if($row=mysqli_fetch_array($r))
                                {
                                $pid[$count]=$row['id'];
                                $pname[$count]= $row['publisher'];
                                $pskill[$count]=$row['rskills'];
                                $ptype[$count]=$row['type'];
                                $pdescription[$count]=$row['description'];
                                $pbid[$count]=$row['bid'];
                                $plike[$count]=$row['likes'];
                                $count++;
                                $pcid--;

                                }
                                else
                                {
                                    $pcid--;
                                }
                             }
                             else
                             {
                                echo "connection_aborted";
                             }
                        }
                        $_SESSION['pcid']= $pcid;
                       
                        
                       

                        $counter=0;
                        while ($counter < $count) 
                        {
                        $checklid=$pid[$counter]."like";
                        $checkbid=$pid[$counter]."bid";
                        $checkl="select likers from `".$checklid."` where likers='$username'";
                        $check2="select bidders from `".$checkbid."` where bidders='$username'";
                         echo "
                        <div class='row justify-content-center align-self-center' >
                         <div class='container-fluid'>
                         <div class='col-md-6 mx-auto'>
                           <div class='card gedf-card align-self-center' >
                                <div class='card-header' style='background-color:#DDDEE9; color: #4893E9;'>
                                    <div class='d-flex justify-content-between align-items-center'>
                                            <div class='d-flex justify-content-between align-items-center'>
                                                <div class='mr-2'>
                                                    <img class='rounded-circle' width='45' src='#' alt=''>
                                                </div>
                                                <div class='ml-2'>
                                                   <div class='h5 m-0'>$pname[$counter]</div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class='dropdown'>
                                                    <button class='btn btn-link dropdown-toggle' type='button' id='gedf-drop1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <i class='fa fa-ellipsis-h'></i>
                                                    </button>
                                                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='gedf-drop1'>
                                                        <div class='h6 dropdown-header'>Configuration</div>
                                                        <a class='dropdown-item' href='#'>Save</a>
                                                        <a class='dropdown-item' href='#'>Hide</a>
                                                        <a class='dropdown-item' href='#''>Report</a>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                                <div class='card-body' style='background-color:#DDDEE9; color:#04093A;'>
                                    <div class='text-muted h7 mb-2'> <i class='fa fa-clock-o'></i>10 min ago</div>
                                        <h6 class='card-title'>i'm looking for <label>$pskill[$counter]</label>
                                                    <label>$ptype[$counter]</label></h6>

                                    <p class='card-text'>
                                        $pdescription[$counter]
                                    </p>
                                </div>";
                                echo "
                                <div class='card-footer' style='background-color:#DDDEE9;'>
                                <form>";
                                if($l=$conn->query($checkl))
                                {
                                    if(!empty($l))
                                    {
                                        $row=mysqli_fetch_array($l);
                                        if (isset($row['0'])) {
                                            echo "<button type='submit' id='$pid[$counter]' style='margin-right: 10px;background-color: #4893E9;border: 2px solid blue ; border-radius:4px;' disabled><i class='fa fa-thumbs-up icon'></i>$plike[$counter]</button>" ; 
                                        }
                                         else
                                        {
                                         echo "<button type='submit' id='$pid[$counter]' onclick='likesubmit(this.id); return false;'><i class='fa fa-thumbs-up icon'></i>$plike[$counter]</button>";
                                        }
                                    }
                                    
                                }
                                else{
                                    echo "eRROR1s";
                                }

                                 if($b=$conn->query($check2))
                                {   
                                    if(!empty($b))
                                    {
                                       $row=mysqli_fetch_array($b);
                                       if (isset($row['0'])) {
                                            echo "<button type='submit' name='$pid[$counter]' style='margin-right:10px ; background-color: #4893E9; border: 2px solid #4CAF50;' disabled><i class='fa fa-handshake-o'></i>$pbid[$counter]Bid</input></button>";
                                       }
                                     else
                                       {
                                            echo "<button type='submit' name='$pid[$counter]' onclick='bidsubmit(this.name); return false;'><i class='fa fa-handshake-o'></i>$pbid[$counter]Bid</input></button> " ; 
                                       }
                                    }
                                }
                                else
                                {
                                    echo "string";
                                }
                                echo "    
                                </form>
                                </div>
                                </div>
        
                        </div>";
                            $counter++;
                 echo "</div>
                </div><br>";
              

                }
                if ($pcid==0) {
                  echo "<div class='row justify-content-center align-self-center'>
                    <p1 style='color:red;'>No more result</p1>
                      </div>";
                }
                else
                {
                echo "<div class='row justify-content-center align-self-center'>
                      <button class='$pcid' type='button'  name='$pcid' onclick='showmore(this.name);' style='border-radius: 15px; color: blue;'' >Showmore<i class='fa fa-caret-down'></i> </button>
                      </div>";
                        $_SESSION['pcid']=$pcid;
                }
                echo "
                <div id='$pcid'>
                </div>";
           } 
    }

?>
<!DOCTYPE html>
<html>
<head>
  <title>E-Desk</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>


<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">     
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>



<link rel="stylesheet" type="text/css" href="newhome.css">
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
<script>
    function likesubmit(pid)
    {
                    if (pid.length == 0) {
                        return;
                    }
                    
                     var xmlhttp = new XMLHttpRequest();
                     xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("responsetxt").innerHTML = this.responseText;
                        }
                     };
                     xmlhttp.open("GET", "likebtn.php?q=" + pid, true);
                     xmlhttp.send();

     }
    
     function bidsubmit(pid)
    {
                    if (pid.length == 0) {
                        return;
                    }
                    
                     var xmlhttp = new XMLHttpRequest();
                     xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("responsetxt").innerHTML = this.responseText;
                        }
                     };
                     xmlhttp.open("GET", "bidbtn.php?q=" + pid, true);
                     xmlhttp.send();

     }
     function showmore(id)
     {
      jQuery.ajax({
           type: "POST",  
           url:'showmore.php',
           data:{action:'true'},
           success:function(html) {
            $("#" + id).html(html);
            $("." + id).hide();
           }


      });
 
     }
                  
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
                       
                      <form class="form-inline ml-auto mr-5 ">
                      <div class="src">
                          <input class="form-control form-control-sm ml-3 w-93" type="text" placeholder="text here"
                            aria-label="Search">
                      </div>
                      <div class="src">
                          <button class="btn btn-rounded btn-sm my-0 ml-sm-2 mr-auto" type="submit"><i class="fa fa-search"></i> Search</button>
                      </div>
                      </form>
                      <div class="dropdown">
                        <img class='rounded-circle' width="50px" src='uploads/gallery/<?php echo $psrc; ?>' alt=''>
                          <div class="dropdown-content">
                            <a href="logout.php">Log out</a>
                          </div>
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
    
       
    
    <div class="container-fluid gedf-wrapper" >

          <div class="row ">
                  <div class="col-md-3">
                    <div class="card">
                        <div class="card-header align-text-center">
                            <h6 style="color:#4893E9; ">Quick Find</h6>
                        </div>
                        <div class="sidenav">
                          <div class="card-body">
                            <form action="quickfind.php" method="POST" enctype="multipart/form-data">
                              <button type="submit" name="name" value="woodworker" class="btn btn-outline-info" >Woodworker</button>
                              <button type="submit" name="name" value="Cement-mistiri" class="btn btn-outline-warning" >Cement-mistiri</button>
                              <button type="submit" name="name" value="labour" class="btn btn-outline-success">Labour/helper</button>
                              <button type="submit" name="name" value="electrician" class="btn btn-outline-dark">Electrician</button>
                              <button type="submit" name="name" value="plumer" class="btn btn-outline-primary">Plumber</button>
                              <button type="submit" name="name" value="painter" class="btn btn-outline-danger">Painter</button>
                            </form>
                          </div>
                        </div>
                    </div>
                  </div>
                  <br>
                 <div class="col-md-6 gedf-main" style="position: relative;">

                        <!--- \\\\\\\Post-->
                    <form enctype="multipart/form-data" action="<?php echo($_SERVER["PHP_SELF"]); ?>"    method="POST">
                        <div class="card gedf-card">
                            <div class="card-header" style="background-color: #35414F;">
                              <h5 style="color: #4893E9">Make Publication</h5>
                            </div>
                            <div class="card-body" style=' background-color: #35414F;'>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                        
                                        <br>
                                        <div>
                                            <input class="form-control" type="text" name="rskill" placeholder="skills required" style="border-radius: 5px; padding-left: 5px; background-color: #35414F; color: white;">
                                        </div>
                                       <br>
                                        <div class="form-group">
                                            <label class="sr-only" for="message">post</label>
                                            <textarea class="form-control" id="message" rows="3" placeholder="Describe your publication" name="description" style="background-color: #35414F; color: white;"></textarea>
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="btn-toolbar justify-content-between">
                                    <div class="btn-group">
                                        <button type="submit" name="post" class="btn btn-primary">Post</button>
                                    </div>
                                    <div class="btn-group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-globe"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>  
        
        <br><br>
            

         <div>
            <?php 
            $fetch = new data;
            $fetch->newsfeed();
            ?>           
         </div>
           
  </div>

      
  </div>
    <br>
    <div class="footers">
      
  </div>
   


</body>
</html>