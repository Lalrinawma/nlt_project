 <?php
 $conn = new mysqli("localhost","root","","project_nlt");
 if (isset($_GET['like'])) 
    {
        $lid=$_GET['id'];
        $like_qry = "update postdb set likes=likes+1 where id ='$lid'";
        if ($conn->query($like_qry)) { 
            echo "PINGPONG";
        }
        else
        {
            echo "erre";
        }
    }
?>