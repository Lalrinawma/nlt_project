<?php
session_start();
	$_SESSION['pageid']++;
	if ($_POST['action']== 'true') {
	 $conn = new mysqli("localhost","root","","project_nlt");
         $username=$_SESSION["username"];
     
         		    if(isset($_SESSION['pcid']))
         		{
                        $pcid=$_SESSION['pcid'];
                   
                        
               
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
                       
                        $_SESSION['pcid']=$pcid;
                       

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
                                <div class='card-header'style='background-color: #35414F;' >
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
                                <div class='card-body' style='background-color: #35414F;'>
                                    <div class='text-muted h7 mb-2'> <i class='fa fa-clock-o'></i>10 min ago</div>
                                        <h6 class='card-title'>i'm looking for <label>$pskill[$counter]</label>
                                                    <label>$ptype[$counter]</label></h6>

                                    <p class='card-text'>
                                        $pdescription[$counter]
                                    </p>
                                </div>";
                                echo "
                                <div class='card-footer' style='background-color: #35414F;'>
                                <form>";
                                if($l=$conn->query($checkl))
                                {
                                    if(!empty($l))
                                    {
                                        $row=mysqli_fetch_array($l);
                                        if (isset($row['0'])) {
                                            echo "<button type='submit' id='$pid[$counter]' style='margin-right: 10px;background-color: white;border: 2px solid blue ; border-radius:4px;' disabled><i class='fa fa-thumbs-up icon'></i>$plike[$counter]</button>" ; 
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
                                            echo "<button type='submit' name='$pid[$counter]' style='margin-right:10px ; background-color: blue; border: 2px solid #4CAF50;' disabled><i class='fa fa-handshake-o'></i>$pbid[$counter]Bid</input></button>";
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
                			 echo "</div></div><br>";
               			}
                if ($pcid==0)
                {
               		echo "<div class='row justify-content-center align-self-center'>
               			<p1 style='color:red;'>No more result</p1>
                      </div>";
                }
                else
                {
                echo "<div class='row justify-content-center align-self-center'>
                      <button class='$pcid' type='button'  name='$pcid' onclick='showmore(this.name);' style='border-radius: 15px; color: blue;'' >Showmore<i class='fa fa-caret-down'></i> </button>";
                }
                echo " 
                <div id='$pcid'>
                </div>";
           }
        }
     
?>