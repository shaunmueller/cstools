<?php 
	ob_start(); 
	include 'createDB.php';
	session_start();
?>	
<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<script src="crScript.js"></script>
		<title>CS Tools - Orders</title>
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
					<form id="orderForm" class='formTable' method=post>
						<table>
							<tr>
								<td>Name:</td>
								<td><input name=name required /></td>
							</tr>
							<tr>
								<td>E-mail:</td>
								<td><input type=email name=email required /></td>
							</tr>
							<tr>
								<td>Postcode:</td>
								<td><input name=postcode pattern="[0-9]{4}" /></td>
							</tr>														
							<tr>	
								<td><input type=radio name=choice id=preBuilt value=preBuilt><label for=preBuilt>Prebuilt PC Packages</label></td>
								<td><input type=radio name=choice id=build value=build><label for=build>Build You Own</label></td>
							</tr>
						</table>	
						<div id=preBuiltForm>
							<hr>
							<table>
								<tr><td><input type=radio name=pcPackage value=package1 id=basicOffice><label for=basicOffice>Basic Office PC - 2GB RAM, 250GB HDD, 2.5Ghz Dual Core ($500)</label></td></tr>
								<tr><td><input type=radio name=pcPackage value=package2 id=basicGaming><label for=basicGaming>Basic Gaming PC - 4GB RAM, 500GB HDD, 2.5Ghz Quad Core ($1000)</label></td></tr>
								<tr><td><input type=radio name=pcPackage value=package3 id=ultraGaming><label for=ultraGaming>Ultra Gaming PC - 16GB RAM, 1TB HDD, 320GB SSD, 3.5Ghz Octa Core ($3000)</label></td></tr>
							</table>	
							<p /><input type=submit name='submit' />
						</div>
						<div id=buildForm>
							<hr>
							<table class=buildList>
								<tr>
									<td>Case:</td>
									<td>
										<select name=case>
											<option>No Case</option>
											<option>Generic Case - Blue ($50)</option>
											<option>Generic Case - White ($30)</option>
											<option>Generic Case - Black ($50)</option>		
											<option>Antec Eleven Case ($99.99)</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>CPU:</td>
									<td>
										<select name=cpu>
											<option>No CPU</option>
											<option>AMD E233 CPU ($99.99)</option>
											<option>AMD F654 CPU ($375.65)</option>
											<option>Intel 23E3 CPU ($99.99)</option>		
											<option>Intel 87GG CPU ($430.95)</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>GPU:</td>
									<td>
										<select name=cpu>
											<option>No GPU</option>
											<option>ATI G35 GPU ($200.50)</option>
											<option>ATI G55 GPU ($352.45)</option>
											<option>Nvidia 56T GPU ($200.50)</option>		
											<option>Nvidia 96T GPU ($344.45)</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>HDD:</td>
									<td>
										<select name=hdd>
											<option>No HDD</option>
											<option>1TB Hard Drive ($90.45)</option>
											<option>250GB Solid State Drive ($100)</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>Keyboard:</td>
									<td>
										<select name=keyboard>
											<option>No Keyboard</option>
											<option>Normal Keyboard ($10.55)</option>
											<option>Mechanical Keyboard ($60.95)</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>Mouse:</td>
									<td>
										<select name=mouse>
											<option>No Mouse</option>
											<option>Standard Mouse ($4.45)</option>
											<option>Gaming Mouse with extra buttons ($54.45)</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>Monitor:</td>
									<td>
										<select name=monitor>
											<option>No Monitor</option>
											<option>Standard Monitor - 1366x768, DVI, VGA ($99.99)</option>
											<option>BenQ Monitor - 1920x1080, HDMI, DVI ($300.20)</option>
											<option>LG Monitor - 1920x1080, HDMI, DVI ($340.54)</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>Motherboard:</td>
									<td>
										<select name=motherboard>
											<option>No Motherboard</option>
											<option>Gigabyte Motherboard - LGA1150, 4xDDR3 ($150.45)</option>
											<option>ASRock Motherboard - LGA1150, 4xDDR3 ($70.99)</option>
											<option>ASUS Motherboard - LGA1150, 4xDDR3 ($200.84)</option>
											<option>MSI Motherboard - LGA1150, 4xDDR3($120.56)</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>PSU:</td>
									<td>
										<select name=psu>
											<option>No PSU</option>
											<option>Standard PSU - 500W ($34.45)</option>
											<option>Gaming PSU - 1050W ($34.45)</option>
											<option>Antec PSU - 1050W ($34.45)</option>
											<option>Aerocool PSU - 1050W ($34.45)</option>
											<option>CoolerMaster PSU - 1050W ($34.45)</option>
										</select>
									</td>
								</tr>	
								<tr>
									<td>RAM:</td>
									<td>	
										<select name=ram>
											<option>No RAM</option>
											<option>Standard RAM 1GB ($34.45)</option>
											<option>Standard RAM 2GB ($34.45)</option>
											<option>Standard RAM 4GB ($34.45)</option>
											<option>Generic Gaming RAM 1GB ($34.45)</option>
											<option>Generic Gaming RAM 2GB ($34.45)</option>
											<option>Generic Gaming RAM 4GB ($34.45)</option>
										</select>
									</td>
								</tr>	
							</table>	
							<p /><input type=submit name='submit' />
						</div>			
<?php	
	if(isset($_POST['submit'])){
		header('Location: orderThankyou.php');
	}
?>			
					</form>					
				</div>
			</div>
			<div id="footer">&copy; Shaun Mueller</div>
		</div>
	</body>
</html>