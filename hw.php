<?php
	$conn=mysqli_connect("localhost","root","","shopdb");
	if(!$conn)
	{
		echo "error_reporting";
	}
	if (isset($_POST['insert'])) {
		
		$pn=$_POST['pn'];
		$pp=$_POST['pp'];
		$pq=$_POST['pq'];
		$pd=$_POST['pd'];
		$qry=("insert into stock(ProductName,ProductPrice,ProductQuantity,ProductDetail) values('$name','$pp','$pq','$pd')");
		if(mysqli_query($conn, $qry))
		{
			echo "inserted";
		}
		else
		{
			echo "error";
		}
		if (isset($_POST['submit'])) {
		$a=$_POST['a'];
		$b=$_POST['b'];
		$c=$_POST['c'];
		$d=$_POST['d'];
		$qry=("insert into stock(ProductName,ProductPrice,ProductQuantity,ProductDetail) values('$name','$pp','$pq','$pd')");
		if(mysqli_query($conn, $qry))
		{
			echo "inserted";
		}
		else
		{
			echo "error";
		}
			
		}

	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="<?php echo ($_SERVER["PHP_SELF"]) ?>">
		<label for="pn">ProductName</label>
		<input type="text" name="pn">
		<label for="pp">ProductPrice</label>
		<input type="text" name="pp">
		<label for="pq">ProductQuantity</label>
		<input type="text" name="pq">
		<label for="pd">ProductDetail</label>
		<input type="text" name="pd">
		<button type="submit" name="submit">submit</button>
	</form>
	<table style=" border: 3px solid;">
		<tr style="border: 1px">
			<td>Itemname</td>
			<td>Costprice</td>
			<td>Sellingprice</td>
			<td>Discountprice</td>
			<td>MRP</td>
		</tr>
	</table>
	<form method="POST" action="<?php echo ($_SERVER["PHP_SELF"])?>">
		<?php

			while ($row= mysqli_fetch_array($result)) {

			
				echo $row['ProductName'];echo "</t>";
				echo $row['Productprice'];echo "</t>";
				echo $row['ProductQuantity'];echo "</t>";
				echo $row['ProductDetail'];echo "</t>";
				
		?>
			
		<button type="submit" name="edit">edit </button>
		
		<?php
				if(isset($_POST['edit']))
				{
		?>
					<form method="POST" action="<?php echo ($_SERVER["PHP_SELF"])?>">
		
					echo "<input type="text" name="a">";echo "</t>";
					echo "<input type="text" name="b">";echo "</t>";
					echo "<input type="text" name="c">";echo "</t>";
					echo "<input type="text" name="d">";echo "</t>";
					echo "<button type="submit" name="submit"></button>";
					echo "</form>";
		<?php>				
				}
				
				
	
			}

		?>
	</form>
	
</body>
</html>