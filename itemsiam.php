<?php
	$conn=new mysqli("localhost","root","","shopdb");
	if (!$conn) {
		echo "error db";
	}
	$result=mysqli_query($conn,"select * from item");
	if (isset($_POST['submit']))
	 {
		$name=$_POST['itemname'];
		$cp=$_POST['itemcp'];
		$sp=$_POST['itemsp'];
		$dc=$_POST['itemdiscount'];
		$mrp=$_POST['itemmrp'];
		$query=("insert into item(ItemName,ItemCostprice,ItemSellingprice,ItemDiscountpc,ItemMrp) values('$name','$cp','$sp','$dc','$mrp')");
		
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>itemsiam</title>
</head>
<body>
	<form method="POST" action="<?php echo ($_SERVER["PHP_SELF"]) ?>">
		<label for="itemname">item-name</label>
		<input type="text" name="itemname"><br>
		<label for="itemcp">item-cp</label>
		<input type="text" name="itemcp"><br>
		<label for="itemsp">item-sp</label>
		<input type="text" name="itemsp"><br>
		<label for="itemdiscount">item-Discont</label>
		<input type="text" name="itemdiscount"><br>
		<label for="itemmrp">item-MRP</label>
		<input type="text" name="itemmrp"><br>
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
		<?php

			while ($row= mysqli_fetch_array($result)) {
			echo "<tr>";
				//$row=$result->fetch_array();
				echo "<td>".$row['ItemName']."</td>";
				echo "<td>".$row['ItemCostprice']."</td>";
				echo "<td>".$row['ItemSellingprice']."</td>";
				echo "<td>".$row['ItemDiscountpc']."</td>";
				echo "<td>".$row['ItemMrp']."</td>";
			echo "</tr>";
			}

		?>
	</table>

</body>
</html>