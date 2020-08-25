<?php
session_start();
$username=$_SESSION["username"];
	$conn = new mysqli("localhost","terinao","Bingo-@06","project_nlt");
	if (isset($_POST['id'])) {
		 $pid = $_POST['pid'];
		 $target = $_POST['id'];
         $selectpublisherid = "select u_id from useri_nfo where user_name='$target'"; 
						if ($uidfetch = $conn->query($selectpublisherid)) 
                  		{
                            $uidr = mysqli_fetch_array($uidfetch);
                            $uidrselect = $uidr['u_id'];
                            $targetnoti = $uidr['u_id']."notidb";
                            $sendnoti = "insert into `".$targetnoti."`(sender,type,pid,rate,comment) values('$username','2','$pid','','')";
							if ($conn->query($sendnoti)) 
                            {
                                $act = "update useri_nfo set notifications=notifications+1 where u_id='$uidrselect'";
                                    if($conn->query($act))
                                    {
                                        echo "success";
                                    }
                                    else
                                    {
                                        echo "failed";
                                    }
                               
                                
                            }
                        }
	}
	
?>