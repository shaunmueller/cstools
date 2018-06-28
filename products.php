<?php 
	include 'createDB.php';
	session_start();
?>	
<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<title>CS Tools - Products</title>
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
					<form method=post action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
						<select name=options onchange="this.form.submit()">
							<option>Select Product:</option>
							<option value="All Products">All Products</option>
							<option value="Cables">Cables</option>
							<option value="Cases">Cases</option>
							<option value="CPUs">CPUs</option>
							<option value="GPUs">GPUs</option>
							<option value="HDDs">HDDs</option>
							<option value="Keyboards">Keyboards</option>
							<option value="Mice">Mice</option>
							<option value="Monitors">Monitors</option>
							<option value="Motherboards">Motherboards</option>
							<option value="Networking Package">Networking Packages</option>
							<option value="PC Package">PC Packages</option>
							<option value="PSUs">PSUs</option>
							<option value="RAM">RAM</option>
						</select>
					</form>										
<?php
	if(isset($_POST['options'])){		
		$connection = mysqli_connect('localhost','root','','ShaunM_CSTools');
		$selection = $_POST['options'];
		if($selection == 'All Products'){
			$sql = mysqli_query($connection, "	SELECT * 
												FROM part" );
		}
		else{
			$sql = mysqli_query($connection, "	SELECT * 
												FROM part
												WHERE category = '$selection'" );			
		}
		echo "<hr><h1> $selection </h1>";
		echo "	<table>
					<tr>
						<th>Part Number</th>
						<th>Part Name</th>
						<th>Description</th>
						<th>Specs</th>						
						<th>On Hand</th>					
						<th>Warehouse</th>	
						<th>Price</th>";	
		while($row = mysqli_fetch_array($sql)){
			echo "<tr>";
			echo "<td>" . $row['PartNum'] . "</td>";
			echo "<td>" . $row['PartName'] . "</td>";
			echo "<td>" . $row['Description'] . "</td>";
			echo "<td>" . $row['Specs'] . "</td>";			
			echo "<td>" . $row['OnHand'] . "</td>";		
			echo "<td>" . $row['Warehouse'] . "</td>";
			echo "<td>$" . number_format((float)$row['ListPrice'], 2, '.', '') . "</td>";
			echo "</tr>";
		}		
		echo "</table>";
		mysqli_close($connection);
	}
?>					
				</div>
			</div>
			<div id="footer">&copy; Shaun Mueller</div>
		</div>
	</body>
</html>