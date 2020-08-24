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
                      <div class='row justify-content-center align-self-center' >
                        <div class='container-fluid'>
                         <div class='col-md-4 mx-auto'>
                           <div class='card gedf-card align-self-center' >
                                <div class='card-header' style='background-color:#DDDEE9; color: #4893E9;'>
                                    <div class='d-flex justify-content-between align-items-center'>
                                            <div class='d-flex justify-content-between align-items-center'>
                                                <div class='mr-2'>
                                                    <img class='rounded-circle' width='45' src='uploads/profile_img/$pdp[$counter]' alt=''>
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
                                    <div class='text-muted h7 mb-2'> <i class='fa fa-clock-o'></i>$rtime[$counter]</div>
                                </div>
                                <div class='card-body' style='background-color:#DDDEE9; color:#04093A;'>
                                    
                                        <h6 class='card-title'>i'm looking for <label>$pskill[$counter]</label>
                                                

                                    <p class='card-text'>
                                        $pdescription[$counter]
                                    </p>
                                </div>";
                                echo "
                                <div class='card-footer' style='background-color:#DDDEE9;'>
                                  <div class='btn-wrapper text-center'>" ;
                                  if($l=$conn->query($checkl))
                                  {
                                      if(!empty($l))
                                      {
                                          $row=mysqli_fetch_array($l);
                                          if (isset($row['0'])) {
                                              echo "
                                              <div class='group'>
                                                  <button class='btn-group iconc' type='submit' id='like' name='$pid[$counter]'><i class='fa fa-thumbs-up'></i></button>
                                                  <label id='l$pid[$counter]'>$plike[$counter]</label>
                                                </div>" ; 
                                          }
                                           else
                                          {
                                           echo "
                                            <div class='group'>
                                            <button class='btn-group icon' type='submit' id='like' name='$pid[$counter]' onclick='likesubmit(this.name); return false;'><i class='fa fa-thumbs-up'></i></button>
                                            <label id='l$pid[$counter]'>$plike[$counter]</label>
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
                                              echo "<div class='group'>
                                                    <button class='btn-group iconc' type='submit' name='$pid[$counter]'><i class='fa fa-handshake-o'></i></input></button>";
                                              echo "<label class='b$pid[$counter]'>$pbid[$counter]Bids</label>
                                                    </div>";
                                         }
                                       else
                                         {
                                              echo "
                                                <div class='group'>
                                                  <button class='btn-group icon' type='button' data-id='$pid[$counter]' name='bid-btn' data-toggle='modal' data-target='#myModal' return false;'><i class='fa fa-handshake-o'></i></input></button>";
                                              echo "<label class='b$pid[$counter]'>$pbid[$counter]Bids</label>
                                                </div>" ; 
                                               
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
                              </div>
                        
                        </div>";
                            $counter++;
               echo "</div>
                </div><br>";
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