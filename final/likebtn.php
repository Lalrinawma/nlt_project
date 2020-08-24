<?php
session_start();
$conn = new mysqli('localhost','terinao','Bingo-@06','project_nlt');
$username=$_SESSION['username'];
if (!$conn) {
	echo "error";
	return;
}
        $lid=$_GET['q'];
        $idl=$lid."like";
        $like_qry = "update postdb set likes=likes+1 where id ='$lid'";
        $likers_qry="insert into `".$idl."`(likers) values('$username')";
        $selectpublisher = "select publisher from postdb where id ='$lid'";
        $slike_qry="select likes from postdb where id='$lid'";
        if ($conn->query($likers_qry))
        { 
            if($conn->query($like_qry))
            {
                if ($r=$conn->query($slike_qry)) {
                	$row=mysqli_fetch_array($r);
                	echo $row['likes'];
                    if($row['likes'] <= 1)
                    {
                        echo "like";
                    }
                    else
                    {
                        echo "likes";
                    }
                    if($n = $conn->query($selectpublisher))
                    {
                        $nr = mysqli_fetch_array($n);
                        $target = $nr['publisher'];
                        $selectpublisherid = "select u_id from useri_nfo where user_name='$target'"; 
                        if ($uidfetch = $conn->query($selectpublisherid)) 
                        {
                            $uidr = mysqli_fetch_array($uidfetch);
                            $uidrselect = $uidr['u_id'];
                            $targetnoti = $uidr['u_id']."notidb";
                            $sendnoti = "insert into `".$targetnoti."`(sender,type,pid,rate,comment) values('$username','3','$lid','','')";
                            if ($conn->query($sendnoti)) {
                                $act = "update useri_nfo set notifications=notifications+1 where u_id='$uidrselect'";
                                try {
                                    $conn->query($act);
                                } catch (Exception $e) {
                                    echo $e;
                                }
                            }
                            else
                            {
                                echo "1";
                            }
                        }
                        else
                        {
                            echo "2";
                        }
                    }
                    else
                    {
                        echo "string";
                    }
                }
                else
                {
                	echo "errors";
                }
            }
            else
            {
            	echo "error";
            }
        }
        else
        {
            echo "erre";
        }
  

?>