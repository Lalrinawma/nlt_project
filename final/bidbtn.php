<?php
session_start();
$conn = new mysqli('localhost','root','','project_nlt');
$username=$_SESSION['username'];
if (!$conn) {
	echo "error";
	return;
}
        $lid=$_GET['q'];
        $bid=$lid."bid";
        $like_qry = "update postdb set bid=bid+1 where id ='$lid'";
        $likers_qry="insert into `".$bid."`(bidders) values('$username')";
        $slike_qry="select bid from postdb where id='$lid'";
        if ($conn->query($likers_qry))
        { 
            if($conn->query($like_qry))
            {
                if ($r=$conn->query($slike_qry)) {
                	$row=mysqli_fetch_array($r);
                	echo $row['bid'];
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