<?php
session_start();
	$username = $_SESSION['username'];
      $conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");

      $fetchuid = "select u_id from useri_nfo where user_name='$username'";
      if ($result=$conn->query($fetchuid))
      {
        $r = mysqli_fetch_array($result);
        $uid = $r['u_id'];
        $notidb = $uid."notidb";
                                
                    		$pcid = $_POST['id'];
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
                                echo " <div class='card' style='margin-top: 10px;'>
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
                          if ($pcid<=0) {
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
}
?>