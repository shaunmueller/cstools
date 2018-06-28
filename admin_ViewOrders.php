<?php 
	session_start();
	if(!isset($_SESSION["username"])){
		echo "<h1 style=text-align:center;>Nice try...<p /><img src=boop.gif /><br />BOOP!</h1>";
		header('refresh:2, url=index.php');
		die();
	}	
?>	
<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<title>CS Tools - View Orders</title>
	</head>
	<body>
		<div id="container">			
			<a href="index.php"><img src="logo.png" id="banner"></a>
			<div id="links">
				<ul>
					<li><a href="products.php">Products</a></li>
					<li><a href="customerRequest.php">Place An Order</a></li>
					<li><a href="contact.php">Contact Us</a></li>
<?php 
	if(!isset($_SESSION["username"])){
		echo "<li><a href=admin_Login.php>Admin Login</a></li>";
	}
	else{
		echo "<li><a href=logout.php>Log Out</a></li>";
	}	
?>													
				</ul>
			</div>	
<?php 
	if(isset($_SESSION["username"])){
		echo "<div id=adminLinks>
				<ul>
					<li><a href=admin_AddRecords.php>Add Records</a></li>
					<li><a href=admin_UpdateTables.php>Update Records</a></li>
					<li><a href=admin_ViewOrders.php>View Orders</a></li>								
				</ul>
			</div>";
	}		
?>			
			<div id="contentBorder">
				<div id="innerContent"> 
					<form method=post action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
						Enter Order Number:<p /><input name=orderNum placeholder='Order Numbers start at 8000' autofocus required /><p />
						<input type=submit name=submit />
					</form>
					<form method=post action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
						<input type=submit name=allOrders value="Display All Orders" /><p /><hr>
<?php
	$connection = mysqli_connect('localhost','root','','ShaunM_CSTools');	
	if(!isset($_POST['submit']) || isset($_POST['allOrders'])){
		$sql = mysqli_query($connection, "	SELECT Orders.*, Customer.CustomerFirstName, Customer.CustomerSurname, Part.PartName
											FROM Orders, Customer, Part
											WHERE Orders.CustomerID = Customer.CustomerID
											AND Orders.PartNum = Part.PartNum" );
	}	
	if(isset($_POST['submit'])){			
		$orderNum = mysqli_real_escape_string($connection, $_POST['orderNum']);	
		$sql = mysqli_query($connection, "	SELECT Orders.*, Customer.CustomerFirstName, Customer.CustomerSurname, Part.PartName
											FROM Orders, Customer, Part
											WHERE Orders.CustomerID = Customer.CustomerID
											AND Orders.PartNum = Part.PartNum
											AND OrderNum = $orderNum" );	
	}
	echo "	<table>
				<tr>
					<th>Order Number</th>
					<th>Order Date</th>
					<th>Customer ID</th>
					<th>Customer</th>
					<th>Part Number</th>
					<th>Part Name</th>
					<th>Number Ordered</th>
					<th>Quoted Price</th>";
		while($row = mysqli_fetch_array($sql)){
			echo "<tr>";
			echo "<td>" . $row['OrderNum'] . "</td>";
			echo "<td>" . $row['OrderDate'] . "</td>";
			echo "<td>" . $row['CustomerID'] . "</td>";
			echo "<td>" . $row['CustomerFirstName'] . " " . $row['CustomerSurname']  . "</td>";
			echo "<td>" . $row['PartNum'] . "</td>";
			echo "<td>" . $row['PartName'] . "</td>";
			echo "<td>" . $row['NumberOrdered'] . "</td>";
			echo "<td>$" . number_format((float)$row['QuotedPrice'], 2, '.', '') . "</td>";
			echo "</tr>";
	}
	echo "</table>";		
	mysqli_close($connection);		
?>				
					</form>						
				</div>
			</div>
			<div id="footer">&copy; Shaun Mueller</div>
		</div>
	</body>
</html>