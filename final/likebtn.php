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
        $slike_qry="select likes from postdb where id='$lid'";
        if ($conn->query($likers_qry))
        { 
            if($conn->query($like_qry))
            {
                if ($r=$conn->query($slike_qry)) {
                	$row=mysqli_fetch_array($r);
                	echo $row['likes'];
                    echo "likes";
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