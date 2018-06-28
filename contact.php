<?php 
	include 'createDB.php';
	session_start();
?>	
<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<title>CS Tools - Contact Us</title>
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
					88 Fake Street<br />
					Geelong, 3220<br />
					Victoria<p />
					<a href="tel:88888888">8888-8888</a><p />
					<a href="mailto:contact@cstools.net">contact@CSTools.net</a><p />
					<hr>
					<form id="contactForm" class='formTable' method=post>
						<table>
							<tr>
								<td>Name:</td>
								<td><input required /></td>
							</tr>
							<tr>
								<td>E-mail:</td>
								<td><input type=email name=email required /></td>
							</tr>
							<tr>	
								<td>Questions / Comments:</td>
								<td><textarea rows=8 cols=50></textarea></td>
						</table>		
						<p /><input type=submit name='submit' />
<?php
	if(isset($_POST['submit'])){
		header('Location: contactThankyou.php');
	}
?>					
					</form>					
				</div>
			</div>
			<div id="footer">&copy; Shaun Mueller</div>
		</div>
	</body>
</html>