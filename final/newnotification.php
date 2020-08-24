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
                                  
                                }
                                else
                                {
                                    echo "errrr";
                                }
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
                                echo " <div class='card' style='margin-top: 10px; margin-left: 8px; margin-right:8px;'>
                                          <div class='card-header'>
                                            <p>";
                                              echo"
                                                <div class='mr-2'>
                                                    <img class='rounded-circle' width='45' src='uploads/profile_img/$sdp[$counter]' alt=''>";
                                              echo $sender[$counter]; echo "bid on your <a href='#'>Post</a>

                                                </div>";

                                              echo"
                                            </p>
                                          </div>
                                          <div class='card-body'>
                                           <div class='text-muted h7 mb-2'> <i class='fa fa-clock-o'></i>$rtime[$counter]</div>
                                            <p>
                                              Rate:"; echo $rate[$counter]; echo"
                                            </p>
                                            <p>
                                              "; echo $comment[$counter]; echo"
                                            </p>
                                          </div>
                                          <div class='card-footer'>
                                            <button class='btn btn-primary' type='submit'>Hire</button>
                                            <button class='btn btn-primary'> see profile</button>
                                          </div>
                                        </div>";
                                        $counter++;
                              }
                              elseif ($type[$counter]==2)
                              {
                                 echo " <div class='card' style='margin-top: 10px;'>
                                          <div class='card-header'>
                                          <div class='text-muted h7 mb-2'><i class='fa fa-clock-o'></i>$rtime[$counter]</div>
                                            <p>";
                                              echo"
                                                <div class='mr-2'>
                                                    <img class='rounded-circle' width='45' src='uploads/profile_img/$sdp[$counter]' alt=''>";
                                              echo $sender[$counter]; echo" accepted your bid and awarded you oh his <a href='#'>post</a>
                                                </div>
                                            </p>
                                          </div>
                                          <div class='card-footer'>
                                            <button class='btn btn-primary' type='submit'>Hire</button>
                                            <button class='btn btn-primary'> see profile</button>
                                          </div>
                                        </div>";
                                        $counter++;
                              }
                              else
                              {
                                 echo " <div class='card' style='margin-top: 10px;'>
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
                                  <button class='$pcid' type='button' name='$pcid' onclick='showmore(this.name);' style='border-radius: 15px; color: blue;margin-top:10px;'>Showmore<i class='fa fa-caret-down'></i></button>
                                </div>";
                                 
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
</script>
</head>
<body>
  

<!------ Include the above in your HEAD tag ---------->
<div class="column " >
<div class="header">
    <h1>Get worker and Work</h1>
    <p>specially for hand worker</p>
  </div>
  <div class="navication rowh">
              <header class="head-main ">
                <div class="navbar navbar-dark box-shadow" style="background-color: black;">
                  <div class="navb d-flex align-items-center">
                    <a class="nav-button"><span id="nav-icon3"><span></span><span></span><span></span><span></span></span></a> 
                    <h4>E-Desk</h4>             
                  </div>


                
                  <div>
                    <a href="login.php">Log out</a>
                  </div>     
                </div>
                <div class="fixed-top main-menu">
                  <button type="button" class="nav-button">&times;</button>
                  <div class="d-flex-center p-5 ">
                    <ul class="nav flex-row align-text-center">
                      <li class="nav-item delay-1"><a class="nav-link" href="newhome.php"><i class="fa fa-home"></i>HOME     </a></li>
                      <li class="nav-item delay-3"><a class="nav-link" href="newnotification.php"><i class="fa fa-bell"></i>NOTIFICATION<span class="fg">new</span></a></li>
                      <li class="nav-item delay-2"><a class="nav-link" href="newprofile.php"><i class="fa fa-user"></i>PROFILE</a></li>
                      <li class="nav-item delay-4"><a class="nav-link" href="#"><i class="fa fa-phone"></i>CONTACT US</a></li>
                    </ul>
                  </div>
                </div>
              </header>
  </div>
<div class="row justify-content-center">
    <div class="col-sm-8">
      <h5>Notifications</h5>
      <?php
      $fetch = new noti;
      $fetch->shownoti();
      ?>
      
     
    </div>
  </div>
</div>

</body>
</html>