<?php
session_start();
$conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");
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
        header("location:newlogin.php");
    }
    if (isset($_POST['post'])) 
    {
      
        $rskill=$_POST['rskill'];
        $description=$_POST['description'];
        $iqry= "insert into postdb(publisher,rskills,description,likes,bid,Time) values('$username','$rskill','$description','0','0',now())";
        $sqry= "select id from postdb where description='$description' && publisher='$username'";
      

        if($conn->query($iqry)) {
            if($ff=$conn->query($sqry))
            {
                $f=mysqli_fetch_array($ff);;
                $idl=$f['0']."like";
                $idb=$f['0']."bid";
                $cqry = "create table `".$idl."`(id INT(10) not null auto_increment primary key, likers varchar(35) not null default '0')";
                if($conn->query($cqry))
                {
                      echo "posted";
                }
                else
                {
                    echo "ERrr";
                    
                }
                 $cqry2 = "create table `".$idb."`(id INT(10) not null auto_increment primary key, bidders varchar(35) not null default '0' ,rate varchar(50),comment varchar(100))";
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
        {   echo "error";
        }


    }

    

    class data
    {
      public function diff($datetime, $full = false)
      {
          $now = new DateTime;
          $ago = new DateTime($datetime);
          $diff = $now->diff($ago);

          $diff->w = floor($diff->d / 7);
          $diff->d -= $diff->w * 7;

          $string = array(
              'y' => 'year',
              'm' => 'month',
              'w' => 'week',
              'd' => 'day',
              'h' => 'hour',
              'i' => 'minute',
              's' => 'second',
          );
          foreach ($string as $k => &$v) {
              if ($diff->$k) {
                  $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
              } else {
                  unset($string[$k]);
              }
          }

          if (!$full) $string = array_slice($string, 0, 1);
          return $string ? implode(', ', $string) . ' ago' : 'just now';
      }
     
      public function newsfeed()
     {  $conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");
         $username=$_SESSION["username"];
                
                      $idquery="select id from postdb order by id DESC limit 1";
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
                        $rtime=array(9);
                        $pdp =array(9);
                        $count=0;
                        $call = new Data;
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
                                $pdescription[$count]=$row['description'];
                                $pbid[$count]=$row['bid'];
                                $plike[$count]=$row['likes'];
                                $rtime[$count] = $call->diff($row['Time']);
                                
                                
                                $pqry="select * from useri_nfo where user_name='$pname[$count]'";

                                  if ($p=$conn->query($pqry))
                                  {
                                    if ($pr = mysqli_fetch_array($p))
                                    {
                                      $pdp[$count]= $pr['dp'];
                                    }
                                  }
                                  else
                                  {
                                    echo "errrr";
                                  }
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

                        $counter=0;
                        while ($counter < $count) 
                        {
                        $checklid=$pid[$counter]."like";
                        $checkbid=$pid[$counter]."bid";
                        $checkl="select likers from `".$checklid."` where likers='$username'";
                        $check2="select bidders from `".$checkbid."` where bidders='$username'";
                         echo "
                         <div class='card promoting-card' style='margin-top:5px;'>

                            <!-- Card content -->
                            <div class='card-body d-flex flex-row'>

                              <!-- Avatar -->
                              <img src='uploads/profile_img/$pdp[$counter]' class='rounded-circle mr-3' height='50px' width='50px' alt='avatar'>

                              <!-- Content -->
                              <div>

                                <!-- Title -->
                                <a href='#' class='card-title font-weight-bold mb-2'>$pname[$counter]</a>
                                <!-- Subtitle -->
                                <p class='card-text text-muted'><i class='fa fa-clock pr-2'></i>$rtime[$counter]</p>

                              </div>

                            </div>
                            <div class='view overlay' style='padding-left: 15px;'>
                              <p class='card-text' > <span style='background-color:#e44d3a;border-radius:3px; padding: 3px;color:#e3f0fe; font: italic 14px/30px Georgia, serif;'>i'm looking for <label> $pskill[$counter]</label> </span></p>
                            </div>
                            <div class='view overlay' style='padding-left: 15px; font:15px/30px Georgia, serif;'>
                              <p class='card-text'> $pdescription[$counter]</p>
                            </div>
                            <hr>
                            <!-- Card content -->
                            <div class='card-body postfooter'>

                              
                                <!-- Button -->";
                                if($l=$conn->query($checkl))
                                  {
                                      if(!empty($l))
                                      {
                                          $row=mysqli_fetch_array($l);
                                          if (isset($row['0'])) {
                                              echo "
                                              <div id='f$pid[$counter]'>
                                                <i class='fa fa-heart   p-1 my-1 mr-3' style='color:#e44d3a' name='$pid[$counter]'  title='I like it'><label id='l$pid[$counter]'>$plike[$counter]</label></i>
                                            </div>"; 
                                          }
                                           else
                                          {
                                           echo "
                                           <div id='i$pid[$counter]'>
                                                <i class='fa fa-heart p-1 my-1 mr-3' name='$pid[$counter]' onclick='likesubmit($pid[$counter]);' title='I like it'><label id='l$pid[$counter]'>$plike[$counter]</label></i>
                                            </div>";
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
                                              echo "<i class='fas fa-dollar-sign p-1 my-1' name='$pid[$counter]' style='color:#e44d3a;' data-placement='top' title='Bid'><label class='b$pid[$counter]'>$pbid[$counter]Bids</label></i>";
                                              
                                         }
                                       else
                                         {
                                              echo "
                                                   <i class='fas fa-dollar-sign p-1 my-1' id='bi$pid[$counter]' data-toggle='modal' data-id='$pid[$counter]'  data-target='#myModal'  name='$pid[$counter]' data-placement='top' title='Bid'><label class='b$pid[$counter]'>$pbid[$counter]Bids</label></i>
                                               "; 
                                               
                                         }
                                      }
                                  }
                                  else
                                  { 
                                      echo "string";
                                  }
                                  echo "
                               
                                

                              

                            </div>

                      </div>
              
                     <!-- Card -->
                ";
                  $counter++;
                }  
                if ($pcid<=1) {
                  echo "<div class='row justify-content-center align-self-center'>
                          <p1 style='color:red;'>No more result</p1>
                        </div>";
                }
                else
                {
                echo "<div class='row justify-content-center align-self-center'>
                        <button class='$pcid' type='button' name='$pcid' onclick='showmore(this.name);' style='border-radius: 15px; color: blue;'>Showmore<i class='fa fa-caret-down'></i></button>
                      </div>";
                       
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
<meta name="viewport" content="width=device-width, initial-scale=1">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript" src="node_modules/mdbootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="node_modules/mdbootstrap/js/mdb.min.js"></script>
<link rel="icon" href="data:;base64,iVBORw0KGgo=">
<link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
<link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css">
<link rel="stylesheet" href="/nlt_project/final/fontawesome/css/all.css" >
<link rel="stylesheet" type="text/css" href="newhome.css">

<script type="text/javascript">
 
    $(document).ready(function(){
       $('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
          var next = $(this).next();
          if (!next.length) {
            next = $(this).siblings(':first');
          }
          next.children(':first-child').clone().appendTo($(this));

          for (var i=0;i<4;i++) {
            next=next.next();
            if (!next.length) {
              next=$(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
          }
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
              document.getElementByClassName("badge")[0].innerHTML() = this.responseText;


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
</script>
<script type="text/javascript">
      function likesubmit(pid)
    {                $("#i"+pid).css({"color":"red"});
                     console.log(pid);
                     var xmlhttp = new XMLHttpRequest();
                     xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("l"+pid).innerHTML = this.responseText;

                        }
                     };
                     xmlhttp.open("GET", "likebtn.php?q=" + pid, true);
                     xmlhttp.send();

     }
</script>
<script>
    
    
     $(document).ready(function()
    { 
    
     $('#myModal').on('show.bs.modal', function (e)
        {
          var pid = $(e.relatedTarget).data('id');
          
          var bid = 'bi'+pid;
          if (bid != null)
          {
            console.log(bid);
          }
          else
          {
            console.log("null");
          }
        $('#bidsubmit').click(function()
        {
             $("#bi"+pid).css({"color":"red"});
             var myform = document.getElementById("form1");
             var fd = new FormData(myform);
             fd.append('id',pid);
              $.ajax({
                url:"bidbtn.php",
                type: 'POST',
                data:fd,

                processData: false,
                contentType: false,
                cache: false,
                success:function(html)
                {
                  $('#comment').val("");
                  $('#rate').val("");
                  document.getElementById('#'+bid).innerHTML(html);
                  console.log(html);
                  
                },
                error:function(html)
                {
                  console.log(html);
                }
              });
        });
      });
    });

     function showmore(id)
     {
      console.log(id);
      jQuery.ajax({
           type: "POST",  
           url:'showmore.php',
           data:{action:'true',id : id},
           success:function(html) {
            $("#" + id).html(html);
            $("." + id).hide();
            
           }


      });
 
     }
     function logout()
     {
       window.location.href="logout.php";
       
     }
                  
 </script> 
</head>
<body>
  
<div class="column" >
            <form id="form2" enctype="multipart/form-data" action="<?php echo($_SERVER["PHP_SELF"]); ?>"    method="POST">
                <div class="modal fade" id="postmodal">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                           <h6 class="modal-title">Make publication</h6>
                           <button type='button' class='close' data-dismiss='modal'>&times;</button>
                        </div>
                        <div class="modal-body">
                            
                                            <input class="form-control" type="text" name="rskill" placeholder="What are you looking/selling">
                                            <label class="sr-only" for="message">post</label>
                                            <textarea class="form-control" id="message" rows="3" placeholder="Describe your publication" name="description" style=""></textarea>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" name="post" class="btn btn-primary">Post</button>
                        </div>
                      </div>
                    </div>
                </div>
              </form>
  <form id='form1'>                                  
    <div class='modal fade' data-keyboard='false' data-backdrop='static' id='myModal'>
      <div class='modal-dialog'>      
        <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Enter detail</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <div class='modal-body'>
              <h6>Rate:</h6>
              <input class='btn-primary' type='text' id="rate" name='rate' placeholder='eg.$100-per/square'>
              <h6>Comment:</h6>
              <input class='btn-primary' type='text' id="comment" name='comment'>
    
            </div>
            <div class='modal-footer'>
              <button type='button' id="bidsubmit" name='bid' class='btn btn-primary' data-dismiss='modal'>Bid</button>
            </div>
        </div>
      </div>
    </div>
  </form>
  

        <div class="rowh">
            <header class="head-main navication">
              <div class="navbar navbar-dark box-shadow" style="background-color: black;">
                <div class="navb d-flex align-items-center">
                  <a class="nav-button"><span id="nav-icon3"><span></span><span></span><span></span><span></span></span></a> 
                  <img src="resource/Edesk.png" class="brand_logo" alt="Logo" style="height: 50%; width: 50%;">
                              
                </div>   
              </div>
              <div class="main-menu align-items-center">
                
                <div class="nav ">
                 
                    <a href="newhome.php"><i class="fa fa-home" ></i>Home </a>
                    <a  href="newprofile.php" ><i class="fa fa-user " ></i>Profile</a>
                    <a href="newnotification.php" ><i class="fa fa-bell" ></i>Notification<span class="fg">new</span></a>
                    <a onclick="logout();"><i class="fas fa-sign-out-alt"></i>Log out</a>
            
                </div>
              </div>
            </header>
        </div>

 
<div class="container-fluid" style="margin-top: 40px;">
  
  <div class="row " >
    <div class="col-md-3 sidenav">

      <div class="container-fluid" style="margin-bottom: 50px; margin-top: 5px;">
        <h7>Quick find</h7>
        <hr>
        <form class="d-flex-center jutify-content-center sidenav" action="quickfind.php" method="POST" enctype="multipart/form-data">
        <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
              <div class="searchbar">
                <input class="search_input" type="text" name="" placeholder="Search...">
                <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
    <div class="col-sm-6 "> 
       <div class="row justify-content-center epd">
          <div class="container-fluid" > 
            <div class="card promoting-card" style='margin-bottom: 15px' >
              <div class='card-body' style="background-color:#000000; opacity: 5; float: left;" >
                  <!-- Avatar -->
                  <img src='uploads/profile_img/<?php echo $psrc; ?>' class='rounded-circle mr-3' height='50px' width='50px' alt='avatar'>
                  <!-- Content -->
                  <button class="btn btn-default" style="float:right;" data-toggle="modal" data-target="#postmodal" type="button" placeholder="Make publication">Create Post</button>
              </div>
            </div>
          </div>
           
           <div class="container-fluid">
                <?php 
                $fetch = new data;
                $fetch->newsfeed();
                ?>           
           </div>
      </div>
    </div>
  </div>
</div>
</div>



</body>
</html>