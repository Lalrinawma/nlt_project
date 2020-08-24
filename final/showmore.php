<?php
session_start();
	if ($_POST['action']== 'true')
  {
	 $conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");
         $username=$_SESSION["username"];
         		    if(isset($_POST['id']))
         		{
                        $pcid=$_POST['id'];
               
                        $pname= array(9);
                        $pskill=array(9);
                        $ptype=array(9);
                        $pdescription=array(9);
                        $pbid=array(9);
                        $plike=array(9);
                        $rtime=array(9);
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
              foreach ($string as $k => &$v)
              {
                  if ($diff->$k) {
                      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                  } else {
                      unset($string[$k]);
                  }
              }

              if (!$full) $string = array_slice($string, 0, 1);
              return $string ? implode(', ', $string) . ' ago' : 'just now';
        }
      }
     
?>