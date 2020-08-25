<?php
session_start();
$username = $_SESSION['username'];
$conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");
if (is_null($_SESSION["username"])) 
  {
        echo "please login or register";
        header("location:login.php");
           
           
            
            
  }
  $reset = "update useri_nfo set notifications=0 where user_name='$username'";
  $conn->query($reset);
class noti
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
  public function shownoti()
  {
      $username = $_SESSION['username'];
      $conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");

      $fetchuid = "select u_id from useri_nfo where user_name='$username'";
      if ($result=$conn->query($fetchuid)) {
        $r = mysqli_fetch_array($result);
        $uid = $r['u_id'];
        $notidb = $uid."notidb";
                                $idquery="select n_id from `".$notidb."` order by n_id DESC limit 1";
                                if ($result=$conn->query($idquery))
                                {
                                    $r=mysqli_fetch_assoc($result);
                                     $pcid=$r['n_id'];
                                      $sdp = array(9);
                            $sender= array(9);
                            $type=array(9);
                            $comment=array(9);
                            $nid=array(9);
                            $pid = array(9);
                            $plike=array(9);
                            $rtime=array(9);
                            $call = new noti;
                            $count=0;
                            while ($count <= 9 && $pcid >= 1) 
                            {
                                 $fetch="select * from `".$notidb."` where n_id='$pcid' ";
                                 if($r=$conn->query($fetch))
                                 {
                                    if($row=mysqli_fetch_array($r))
                                    {
                                    $nid[$count]=$row['n_id'];
                                    $sender[$count]= $row['sender'];
                                    $rate[$count]=$row['rate'];
                                    $comment[$count]=$row['comment'];
                                    $pid[$count] = $row['pid'];
                                    $type[$count] = $row['type'];
                                    $rtime[$count] = $call->diff($row['Time']);
                                    $qrysdp = "select dp from useri_nfo where user_name ='$sender[$count]'";
                                    
                                    if($rdp = $conn->query($qrysdp))
                                    {
                                      if ($fdp = mysqli_fetch_array($rdp)) {
                                        $sdp[$count] = $fdp['dp'];
                                      }
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
                            $counter = 0;
                            while ($count > $counter)
                            {
                              if($type[$counter] == 1)
                              {
                                echo " <div class='card' style='margin-top: 10px; '>
                                          <div class='card-body' style='background-color: #ffffff; color:#353b48;'>";
                                            echo"
                                                <div class='mr-2'>
                                                    <img class='rounded-circle' width='45' src='uploads/profile_img/$sdp[$counter]' alt=''>";
                                              echo "<label class='card-title font-weight-bold mb-2 ' >$sender[$counter]</label>"; echo " bid on your <a href='#'>Post</a>

                                                </div>";
                                            echo "
                                            <hr>
                                           <div class='text-muted h7 mb-2'> <i class='fa fa-clock-o'></i>$rtime[$counter]</div>
                                            <p>
                                              Rate:"; echo $rate[$counter]; echo"
                                            </p>
                                            <p>
                                              "; echo $comment[$counter]; echo"
                                            </p>
                                          </div>
                                          <div class='card-footer' style='background-color: #ffffff;'>
                                          
                                            <button class='btn btn-primary' type='button' name='$pid[$counter]' id='$sender[$counter]' onclick='sendnoti2(this.id,this.name)'>Hire</button>
                                            <form enctype='multipart/form-data' action='seeprofile.php' method='POST'>
                                            <button type='submit' class='btn btn-primary' name='name' value='$sender[$counter]'> see profile</button>
                                            </form>
                                          </div>
                                          
                                        </div>";
                                        $counter++;
                              }
                              elseif ($type[$counter]==2)
                              {
                                 echo " <div class='card' style='margin-top: 10px;background-color: #ffffff;color:#353b48;'>
                                          <div class='card-header'>
                                          <div class='text-muted h7 mb-2'><i class='fa fa-clock-o'></i>$rtime[$counter]</div>
                                            <p>";
                                              echo"
                                                <div class='mr-2'>
                                                    <img class='rounded-circle' width='45' src='uploads/profile_img/$sdp[$counter]' alt=''>";
                                              echo $sender[$counter]; echo" accepted your bid and awarded you on his <a href='#'>post</a>
                                                </div>
                                            </p>
                                          </div>
                                          <div class='card-footer'>
                                            <form enctype='multipart/form-data' action='seeprofile.php' method='POST'>
                                            <button type='submit' class='btn btn-primary' name='name' value='$sender[$counter]'> see profile</button>
                                            </form>
                                          </div>
                                        </div>";
                                        $counter++;
                              }
                              else
                              {
                                 echo " <div class='card' style='margin-top: 10px;background-color:#ffffff; color:#353b48;'>
                                        <div class='card-header'>
                                        <div class='text-muted h7 mb-2'> <i class='fa fa-clock-o'></i>$rtime[$counter]</div>
                                          <p>";
                                            echo"
                                                <div class='mr-2'>
                                                    <img class='rounded-circle' width='45' src='uploads/profile_img/$sdp[$counter]' alt=''>";
                                            echo $sender[$counter]; echo" like your <a href='#'>post</a>
                                                </div>
                                          </p>
                                        </div>
                                      </div>";
                                      $counter++;
                              }
                            }

                          if ($pcid<=1) {
                          echo "<div class='row justify-content-center align-self-center'>
                                    <p1 style='color:red; margin-top:10px;'>No more result</p1>
                                  </div>";
                          }
                          else
                          {
                          echo "<div class='row justify-content-center align-self-center'>
                                  <button class='$pcid' type='button' name='$pcid' onclick='showmore(this.name);' style='border-radius: 15px; color: blue;margin-top:10px; background-color:#000000;'>Showmore<i class='fa fa-caret-down'></i></button>
                                </div>";
                                 
                          }
                                  
                                }
                                else
                                {
                                    echo "errrr";
                                }
                           
                          echo "
                          <div id='$pcid'>
                          </div>";
      }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
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


<link rel="stylesheet" type="text/css" href="newprofile.css">
<script type="text/javascript">
  $(document).ready(function(){
    $('.hire').click(function(){

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
</script>
<script type="text/javascript">
  function showmore(id)
     {
      console.log(id);
      $.ajax({
           type: "POST",  
           url:'showmorenoti.php',
           data:{action:'true',id : id},
           success:function(html) {
            $("#" + id).html(html);
            $("." + id).hide();
            
           }


      });
 
     }
     function sendnoti2(id,pid)
     {
      console.log(id,pid);
      $.ajax({
           type: "POST",  
           url:'sendnoti2.php',
           data:{action:'true',id : id,pid : pid},
           success:function(html) {
           console.log(html);
           alert("Hired");
            
           }


      });
 
     }

</script>
</head>
<body>
  

<!------ Include the above in your HEAD tag ---------->
<div class="column " >

  <div class="rowh">
            <header class="head-main navication">
              <div class="navbar navbar-dark box-shadow" style="background-color: black;">
                <div class="navb d-flex align-items-center">
                  <a class="nav-button"><span id="nav-icon3"><span></span><span></span><span></span><span></span></span></a> 
                  <img src="resource/Edesk.png" class="brand_logo" alt="Logo" style="height: 100px; width: 100px;">
                              
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
<div class="row justify-content-center">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body" style="background-color: #353b48; color: blue;">
              <h5 class="card-title font-weight-bold mb-2">Notifications</h5>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
      <?php
      $fetch = new noti;
      $fetch->shownoti();
      ?>
      
     
    </div>
  </div>
</div>

</body>
</html>