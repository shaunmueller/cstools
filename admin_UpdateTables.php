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
		<title>CS Tools - Update Records</title>
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
					<form method=post class=formTable action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> >
						<select name=options onchange="this.form.submit()">
							<option>Select Table:</option>
							<option value="Customer">Customer Table</option>
							<option value="Orders">Orders Table</option>
							<option value="Part">Parts Table</option>		
						</select>
<?php
	$connection = mysqli_connect('localhost','root','','ShaunM_CSTools');
	$selection = '';
	if(isset($_POST['options'])){
		$selection = $_POST['options'];
		mysqli_select_db($connection,$selection);
	}
	if($selection == "Customer"){
		echo 	"<hr><p />Enter Customer ID:<p /><input name=custID placeholder='Customer IDs start at 1' autofocus required /><p />
				<input type=submit name=custIDSubmit />";
	}
	if($selection == "Orders"){
		echo 	"<hr><p />Enter Order Number:<p /><input name=orderNum placeholder='Order Numbers start at 8000' autofocus required /><p />
				<input type=submit name=orderNumSubmit />";
	}
	if($selection == "Part"){
		echo 	"<hr><p />Enter Part Number:<p /><input name=partNum placeholder='Part Numbers start at 600' autofocus required /><p />
				<input type=submit name=partNumSubmit />";
	}
	// OPEN CUSTOMER FORM
	if(isset($_POST['custIDSubmit'])){
		$custID = mysqli_real_escape_string($connection, $_POST['custID']);
		$sql = 	mysqli_query($connection,	"SELECT *
											FROM Customer
											WHERE CustomerID = $custID");											
		while($row = mysqli_fetch_assoc($sql)){
			// SWITCH STATEMENT TO DETERMINE STATE PREFILL
			$actSel = $nswSel = $ntSel = $qldSel = $saSel = $tasSel = $vicSel = $waSel = '';
			switch ($row['State']){
				case 'ACT':
					$actSel = 'selected="selected"';
					break;
				case 'NSW':
					$nswSel = 'selected="selected"';
					break;
				case 'NT':
					$ntSel = 'selected="selected"';
					break;
				case 'QLD':
					$qldSel = 'selected="selected"';
					break;
				case 'SA':
					$saSel = 'selected="selected"';
					break;
				case 'TAS':
					$tasSel = 'selected="selected"';
					break;
				case 'VIC':
					$vicSel = 'selected="selected"';
					break;
				case 'WA':
					$waSel = 'selected="selected"';
					break;	
				default:
					$actSel = $nswSel = $ntSel = $qldSel = $saSel = $tasSel = $vicSel = $waSel = '';
			}
			// SWITCH STATEMENT TO DETERMINE CREDIT LIMIT PREFILL
			$zeroSel = $oneThouSel = $twoThouSel = $threeThouSel = $fourThouSel = $fiveThouSel = '';
			switch ($row['CreditLimit']){
				case '0':
					$zeroSel = 'selected="selected"';
					break;
				case '1000':
					$oneThouSel = 'selected="selected"';
					break;
				case '2000':
					$twoThouSel = 'selected="selected"';
					break;
				case '3000':
					$threeThouSel = 'selected="selected"';
					break;
				case '4000':
					$fourThouSel = 'selected="selected"';
					break;
				case '5000':
					$fiveThouSel = 'selected="selected"';
					break;					
				default:
					$zeroSel = $oneThouSel = $twoThouSel = $threeThouSel = $fourThouSel = $fiveThouSel = '';
			}
			echo 	"<hr><p />
					<table>
						<tr>
							<td>Customer ID:</td>
							<td><input name=custIDCustTable value='" . $row['CustomerID'] . "' readonly></td>
						</tr>
						<tr>
							<td>First Name:</td>
							<td><input name=firstName value='" . $row['CustomerFirstName'] . "'></td>
						</tr>
						<tr>
							<td>Surname:</td>
							<td><input name=surname value='" . $row['CustomerSurname'] . "'></td>
						</tr>
						<tr>
							<td>Address:</td>
							<td><input name=address value='" . $row['StreetAddress'] . "'></td>
						</tr>
						<tr>
							<td>City:</td>
							<td><input name=city value='" . $row['City'] . "'></td>
						</tr>
						<tr>	
							<td>State:</td>
							<td>	
								<select name=state>
									<option value='ACT' $actSel>Australian Capital Territory</option>
									<option value='NSW' $nswSel>New South Wales</option>
									<option value='NT' $ntSel>Northern Territory</option>
									<option value='QLD' $qldSel>Queensland</option>
									<option value='SA' $saSel>South Australia</option>
									<option value='TAS' $tasSel>Tasmania</option>
									<option value='VIC' $vicSel>Victoria</option> 
									<option value='WA' $waSel>Western Australia</option>
								</select>
							</td>
						</tr>	
						<tr>	
							<td>Zip Code:</td>
							<td><input name=zip value='" . $row['Zip'] . "'></td>
						</tr>
						<tr>
							<td>Balance ($):</td>
							<td><input name=balance value='" . number_format((float)$row['Balance'], 2, '.', '') . "'></td>
						</tr>
						<tr>
							<td>Credit Limit:</td>
							<td>	
								<select name=creditLimit>
									<option value='0' $zeroSel>No Credit</option>
									<option value='1000' $oneThouSel>$1000</option>
									<option value='2000' $twoThouSel>$2000</option>
									<option value='3000' $threeThouSel>$3000</option>
									<option value='4000' $fourThouSel>$4000</option>
									<option value='5000' $fiveThouSel>$5000</option>
								</select>
							</td>
						</tr>
					</table>		
				<p /><input type=submit name='custUpdate' value='Update'>";			
		}
	}
	// OPEN ORDER FORM
	if(isset($_POST['orderNumSubmit'])){
		$orderNum = mysqli_real_escape_string($connection, $_POST['orderNum']);
		$sql = 	mysqli_query($connection,	"SELECT *
											FROM Orders
											WHERE OrderNum = $orderNum");
		while($row = mysqli_fetch_assoc($sql)){
			echo "<hr><p />
					<table>
						<tr>
							<td>Order Number:</td>
							<td><input name=orderNumOrdersTable value='" . $row['OrderNum'] . "' readonly></td>
						</tr>
						<tr>
							<td>Order Date (YYYY-MM-DD):</td>
							<td><input name=date value='" . $row['OrderDate'] . "'></td>
						</tr>
						<tr>
							<td>Customer ID:</td>
							<td><input name=custIDOrdersTable value='" . $row['CustomerID'] . "' readonly></td>
						</tr>
						<tr>
							<td>Number Ordered:</td>
							<td><input name=amount value='" . $row['NumberOrdered'] . "'></td>
						</tr>
						<tr>
							<td>Quoted Price ($):</td>
							<td><input name=price value='" . number_format((float)$row['QuotedPrice'], 2, '.', '') . "'></td>
						</tr>
						<tr>
							<td>Part Number:</td>
							<td><input name=partNumOrdersTable value='" . $row['PartNum'] . "' readonly></td>
						</tr>
					</table>	
					<p /><input type=submit name='orderUpdate'>";
		}
	}
	// OPEN PARTS FORM
	if(isset($_POST['partNumSubmit'])){
		$partNum = mysqli_real_escape_string($connection, $_POST['partNum']);
		$sql = 	mysqli_query($connection,	"SELECT *
											FROM Part
											WHERE PartNum = $partNum");
		while($row = mysqli_fetch_assoc($sql)){
			// SWITCH STATEMENT TO DETERMINE CATEGORY PREFILL
			$cablesSel = $casesSel = $cpuSel = $gpuSel = $hddSel = $keyboardSel = $miceSel = $monitorSel = $motherboardSel = $networkingPackSel = $pcPackSel = $psuSel = $ramSel = '';
			switch ($row['Category']){
				case 'Cables':
					$cablesSel = 'selected="selected"';
					break;
				case 'Cases':
					$casesSel = 'selected="selected"';
					break;
				case 'CPUs':
					$cpuSel = 'selected="selected"';
					break;
				case 'GPUs':
					$gpuSel = 'selected="selected"';
					break;
				case 'HDDs':
					$hddSel = 'selected="selected"';
					break;
				case 'Keyboards':
					$keyboardSel = 'selected="selected"';
					break;
				case 'Mice':
					$miceSel = 'selected="selected"';
					break;	
				case 'Monitors':
					$monitorSel = 'selected="selected"';
					break;	
				case 'Motherboards':
					$motherboardSel = 'selected="selected"';
					break;	
				case 'Networking Package':
					$networkingPackSel = 'selected="selected"';
					break;	
				case 'PC Package':
					$pcPackSel = 'selected="selected"';
					break;	
				case 'PSUs':
					$psuSel = 'selected="selected"';
					break;	
				case 'RAM':
					$ramSel = 'selected="selected"';
					break;		
				default:
					$cablesSel = $casesSel = $cpuSel = $gpuSel = $hddSel = $keyboardSel = $miceSel = $monitorSel = $motherboardSel = $networkingPackSel = $pcPackSel = $psuSel = $ramSel = '';
			}
			// SWITCH STATEMENT TO DETERMINE WAREHOUSE PREFILL
			$franktonSel = $melbourneSel = '';
			switch ($row['Warehouse']){
				case 'Frankston':
					$franktonSel = 'checked';
					break;
				case 'Melbourne':
					$melbourneSel = 'checked';
					break;
				default:
					$franktonSel = $melbourneSel = '';				
			}
			echo "<hr><p />
					<table>
						<tr>
							<td>Part Number:</td>
							<td><input name=partNumPartTable value='" . $row['PartNum'] . "' readonly></td>
						</tr>
						<tr>		
							<td>Part Name:</td>
							<td><input name=partName value='" . $row['PartName'] . "'></td>
						</tr>
						<tr>
							<td>Description:</td>
							<td><input name=description value='" . $row['Description'] . "'></td>
						</tr>
						<tr>
							<td>Specs:</td>
							<td><input name=specs value='" . $row['Specs'] . "'></td>
						</tr>
						<tr>
							<td>Stock On Hand:</td>
							<td><input name=stock value='" . $row['OnHand'] . "'></td>
						</tr>
						<tr>		
							<td>Category:</td>
							<td>	
								<select name=category>
										<option value='Cables' $cablesSel>Cables</option>
										<option value='Cases'  $casesSel>Cases</option>
										<option value='CPUs' $cpuSel>CPUs</option>
										<option value='GPUs' $gpuSel>GPUs</option>
										<option value='HDDs' $hddSel>HDDs</option>
										<option value='Keyboards' $keyboardSel>Keyboards</option>
										<option value='Mice' $miceSel>Mice</option>
										<option value='Monitors' $monitorSel>Monitors</option>
										<option value='Motherboards' $motherboardSel>Motherboards</option>
										<option value='Networking Package' $networkingPackSel>Networking Package</option>
										<option value='PC Package' $pcPackSel>PC Package</option>
										<option value='PSUs' $psuSel>PSUs</option>
										<option value='RAM' $ramSel>RAM</option>
									</select>
							</td>
						</tr>
						<tr>	
							<td>Warehouse:</td>
							<td><input type=radio name=warehouse id='frankston' value='Frankston' $franktonSel><label for='frankston'>Frankston</label><br />
								<input type=radio name=warehouse id='melbourne' value='Melbourne' $melbourneSel><label for='melbourne'>Melbourne</label</td>
						</tr>
						<tr>
							<td>List Price ($):</td>
							<td><input name=price value='" . number_format((float)$row['ListPrice'], 2, '.', '') . "'></td>
						</tr>
					</table>	
					<p /><input type=submit name='partsUpdate'>";
		}
	}	
	// UPDATING CUSTOMER TABLE
	if(isset($_POST['custUpdate'])){
		$custIDCustTable = mysqli_real_escape_string($connection, $_POST['custIDCustTable']);
		$newFirstName = mysqli_real_escape_string($connection, $_POST['firstName']);
		$newSurname = mysqli_real_escape_string($connection, $_POST['surname']);
		$newAddress = mysqli_real_escape_string($connection, $_POST['address']);
		$newCity = mysqli_real_escape_string($connection, $_POST['city']);
		$newState = mysqli_real_escape_string($connection, $_POST['state']);
		$newZip = mysqli_real_escape_string($connection, $_POST['zip']);
		$newBalance = mysqli_real_escape_string($connection, $_POST['balance']);
		$newCreditLimit = mysqli_real_escape_string($connection, $_POST['creditLimit']);
		$sql = "	UPDATE Customer
					SET	CustomerFirstName = '$newFirstName',
						CustomerSurname = '$newSurname',
						StreetAddress = '$newAddress',
						City = '$newCity',
						State = '$newState',
						Zip = '$newZip',
						Balance = '$newBalance',
						CreditLimit = '$newCreditLimit'
					WHERE CustomerID = '$custIDCustTable'";
		if(mysqli_query($connection, $sql)){
			echo "<p />Entry Updated";
		}
		else{
			echo "<p />Error " . mysqli_error($connection);
		}
	}
	// UPDATING ORDERS TABLE
	if(isset($_POST['orderUpdate'])){
		$orderNumOrdersTable = mysqli_real_escape_string($connection, $_POST['orderNumOrdersTable']);
		$newOrderDate = mysqli_real_escape_string($connection, $_POST['date']);
		$custIDOrdersTable = mysqli_real_escape_string($connection, $_POST['custIDOrdersTable']);
		$newNumberOrdered = mysqli_real_escape_string($connection, $_POST['amount']);
		$newQuotedPrice = mysqli_real_escape_string($connection, $_POST['price']);
		$partNumOrdersTable = mysqli_real_escape_string($connection, $_POST['partNumOrdersTable']);
		$sql = "	UPDATE Orders
					SET OrderNum = '$orderNumOrdersTable',
						OrderDate = '$newOrderDate',
						CustomerID = '$custIDOrdersTable',
						NumberOrdered = '$newNumberOrdered',
						QuotedPrice = '$newQuotedPrice',
						PartNum = '$partNumOrdersTable'
					WHERE OrderNum = '$orderNumOrdersTable'";
		if(mysqli_query($connection, $sql)){
			echo "<p />Entry Updated";
		}
		else{
			echo "<p />Error " . mysqli_error($connection);
		}
	}	
	// UPDATING PARTS TABLE
	if(isset($_POST['partsUpdate'])){
		$partNumPartTable = mysqli_real_escape_string($connection, $_POST['partNumPartTable']);
		$newPartName = mysqli_real_escape_string($connection, $_POST['partName']);
		$newDescription = mysqli_real_escape_string($connection, $_POST['description']);
		$newSpecs = mysqli_real_escape_string($connection, $_POST['specs']);
		$newOnHand = mysqli_real_escape_string($connection, $_POST['stock']);
		$newCategory = mysqli_real_escape_string($connection, $_POST['category']);
		$newWarehouse = mysqli_real_escape_string($connection, $_POST['warehouse']);
		$newListPrice = mysqli_real_escape_string($connection, $_POST['price']);
		$sql = "	UPDATE Part
					SET PartNum = '$partNumPartTable',
						PartName = '$newPartName',
						Description = '$newDescription',
						Specs = '$newSpecs',
						OnHand = '$newOnHand',
						Category = '$newCategory',
						Warehouse = '$newWarehouse',
						ListPrice = '$newListPrice'
					WHERE PartNum = '$partNumPartTable'";
		if(mysqli_query($connection, $sql)){
			echo "<p />Entry Updated";
		}
		else{
			echo "<p />Error " . mysqli_error($connection);
		}
	}		
	mysqli_close($connection);	
?>
					</form>					
				</div>
			</div>
			<div id="footer">&copy; Shaun Mueller</div>
		</div>
	</body>
</html>