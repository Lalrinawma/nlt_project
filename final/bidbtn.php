<?php
session_start();
$conn = new mysqli('localhost','terinao','Bingo-@06','project_nlt');
$username=$_SESSION['username'];
if (!$conn) 
{
	echo "error";
	return;
}
        $lid=$_POST['id'];
        $rate=$_POST['rate'];
        $comment=$_POST['comment'];
        $bid=$lid."bid";
        $like_qry = "update postdb set bid=bid+1 where id ='$lid'";
        $likers_qry="insert into `".$bid."`(bidders,rate,comment) values('$username','$rate','$comment')";
        $slike_qry="select bid from postdb where id='$lid'";
        if ($conn->query($likers_qry))
        { 
            if($conn->query($like_qry))
            {
                if ($r=$conn->query($slike_qry)) {
                	$row=mysqli_fetch_array($r);
                	echo $row['bid'];
                    echo "Bids";
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