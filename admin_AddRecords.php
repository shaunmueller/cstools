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
		<title>CS Tools - Add Records</title>
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
							<option>Select Table:</option>
							<option value="Customer">Customer Table</option>
							<option value="Orders">Orders Table</option>
							<option value="Part">Parts Table</option>		
						</select>
					</form>
<?php
	$connection = mysqli_connect('localhost','root','','ShaunM_CSTools');
	if(isset($_POST['options'])){
		$selection = $_POST['options'];		
		// SHOW CUSTOMER TABLE
		if($selection == "Customer"){
			echo	"<hr><h1> $selection </h1>
					<form method=post class='formTable' action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . ">
						<table>
							<tr>
								<td>First Name:</td>
								<td><input name=firstName autofocus></td>
							</tr>
							<tr>		
								<td>Surname:</td>
								<td><input name=surname></td>
							</tr>
							<tr>	
								<td>Address:</td>
								<td><input name=address></td>
							</tr>
							<tr>
								<td>City:</td>
								<td><input name=city></td>
							</tr>
							<tr>	
								<td>State:</td>
								<td>
									<select name=state>
										<option value='ACT'>Australian Capital Territory</option>
										<option value='NSW'>New South Wales</option>
										<option value='NT'>Northern Territory</option>
										<option value='QLD'>Queensland</option>
										<option value='SA'>South Australia</option>
										<option value='TAS'>Tasmania</option>
										<option value='VIC'>Victoria</option>
										<option value='WA'>Western Australia</option>
									</select>
								</td>
							</tr>	
							<tr>
								<td>Zip Code:</td>
								<td><input name=zip></td>
							</tr>
							<tr>
								<td>Balance:</td>
								<td><input name=balance></td>
							</tr>
							<tr>
								<td>Credit Limit:</td>
								<td>
									<select name=creditLimit>
										<option value='0'>No Credit</option>
										<option value='1000'>$1000</option>
										<option value='2000'>$2000</option>
										<option value='3000'>$3000</option>
										<option value='4000'>$4000</option>
										<option value='5000'>$5000</option>
									</select>
								</td>
							</tr>
						</table>
						<p /><input type=submit name='custSubmit'>
					</form>";
		}
		// SHOW ORDERS TABLE
		if($selection == "Orders"){
			echo	"<hr><h1> $selection </h1>
					<form method=post class='formTable' action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . ">
						<table>
							<tr>
								<td>Order Date:</td>
								<td><input name=date placeholder='yyyy-mm-dd' autofocus></td>
							</tr>
							<tr>	
								<td>Customer ID:</td>
								<td><input name=custID required>*</td>
							</tr>	
							<tr>
								<td>Number Ordered:</td>
								<td><input name=amount></td>
							</tr>
							<tr>	
								<td>Quoted Price:</td>
								<td><input name=price></td>
							</tr>
							<tr>
								<td>Part Number:</td>
								<td><input name=partNum required>*</td>
							</tr>
						</table>	
						<p /><input type=submit name='ordersSubmit'>
					</form>";
		}
		// SHOW PARTS TABLE
		if($selection == "Part"){
			echo	"<hr><h1> $selection </h1>
					<form method=post class='formTable' action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . ">
						<table>
							<tr>
								<td>Part Name:</td>
								<td><input name=partName autofocus></td>
							</tr>
							<tr>	
								<td>Description:</td>
								<td><input name=description></td>
							</tr>
							<tr>
								<td>Specs:</td>
								<td><input name=specs></td>
							</tr>
							<tr>
								<td>Stock On Hand:</td>
								<td><input name=stock></td>
							</tr>
							<tr>		
								<td>Category:</td> 		
								<td>
									<select name=category>
										<option value='Cables'>Cables</option>
										<option value='Cases'>Cases</option>
										<option value='CPUs'>CPUs</option>
										<option value='GPUs'>GPUs</option>
										<option value='HDDs'>HDDs</option>
										<option value='Keyboards'>Keyboards</option>
										<option value='Mice'>Mice</option>
										<option value='Monitors'>Monitors</option>
										<option value='Motherboards'>Motherboards</option>
										<option value='Networking Package'>Networking Package</option>
										<option value='PC Package'>PC Package</option>
										<option value='PSUs'>PSUs</option>
										<option value='RAM'>RAM</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Warehouse:</td>
								<td><input type=radio name=warehouse value='Frankston' id='frankston'><label for='frankston'>Frankston</label><br /> 
								<input type=radio name=warehouse value='Melbourne' id='melbourne'><label for='melbourne'>Melbourne</label></td>
							</tr>
							<tr>	
								<td>List Price:</td>
								<td><input name=price></td>
							</tr>
						</table>	
						<p /><input type=submit name='partSubmit'>
					</form>";
		}
	}
	// SUBMIT TO CUSTOMER TABLE
	if(isset($_POST['custSubmit'])){
		$connection = mysqli_connect("localhost", "root", "", "ShaunM_CSTools");		
		$firstName = mysqli_real_escape_string($connection, $_POST["firstName"]);
		$surname = mysqli_real_escape_string($connection, $_POST["surname"]);
		$address = mysqli_real_escape_string($connection, $_POST["address"]);
		$city = mysqli_real_escape_string($connection, $_POST["city"]);
		$state = mysqli_real_escape_string($connection, $_POST["state"]);
		$zip = mysqli_real_escape_string($connection, $_POST["zip"]);
		$balance = mysqli_real_escape_string($connection, $_POST["balance"]);
		$creditLimit = mysqli_real_escape_string($connection, $_POST["creditLimit"]);		
		$sql = "	INSERT INTO Customer (CustomerFirstName, CustomerSurName, StreetAddress, City, State, Zip, Balance, CreditLimit)
					VALUES ('$firstName', '$surname', '$address', '$city', '$state', '$zip', '$balance', '$creditLimit')";			
		if(!mysqli_query($connection, $sql)){
			echo "Error: " . mysqli_error($connection);
		}			
		else{
			echo "Entry added";		
		}
	}
	// SUBMIT TO ORDERS TABLE
	if(isset($_POST['ordersSubmit'])){
		$connection = mysqli_connect("localhost", "root", "", "ShaunM_CSTools");		
		$date = mysqli_real_escape_string($connection, $_POST["date"]);
		$custID = mysqli_real_escape_string($connection, $_POST["custID"]);
		$amount = mysqli_real_escape_string($connection, $_POST["amount"]);
		$price = mysqli_real_escape_string($connection, $_POST["price"]);
		$partNum = mysqli_real_escape_string($connection, $_POST["partNum"]);
		$sql = "	INSERT INTO Orders (OrderDate, CustomerID, NumberOrdered, QuotedPrice, PartNum)
				VALUES ('$date', '$custID', '$amount', '$price', '$partNum')";			
		if(!mysqli_query($connection, $sql)){
			echo "Error: " . mysqli_error($connection);
		}			
		else{
			echo "Entry added";		
		}
	}
	// SUBMIT TO PARTS TABLE
	if(isset($_POST['partSubmit'])){
		$connection = mysqli_connect("localhost", "root", "", "ShaunM_CSTools");		
		$partName = mysqli_real_escape_string($connection, $_POST["partName"]);
		$description = mysqli_real_escape_string($connection, $_POST["description"]);
		$specs = mysqli_real_escape_string($connection, $_POST["specs"]);
		$stock = mysqli_real_escape_string($connection, $_POST["stock"]);
		$category = mysqli_real_escape_string($connection, $_POST["category"]);
		$warehouse = mysqli_real_escape_string($connection, $_POST["warehouse"]);
		$price = mysqli_real_escape_string($connection, $_POST["price"]);				
		$sql = "	INSERT INTO Part (PartName, Description, Specs, OnHand, Category, Warehouse, ListPrice)
					VALUES ('$partName', '$description', '$specs', '$stock', '$category', '$warehouse', '$price')";			
		if(!mysqli_query($connection, $sql)){
			echo "Error: " . mysqli_error($connection);
		}			
		else{
			echo "Entry added";		
		}
	}
	mysqli_close($connection);
?>					
				</div>
			</div>
			<div id="footer">&copy; Shaun Mueller</div>
		</div>
	</body>
</html>