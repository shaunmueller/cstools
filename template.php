<?php 
	include 'createDB.php';
	session_start();
?>	
<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<title>CS Tools - Index</title>
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
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae ex eget urna luctus viverra a vestibulum lorem. Nulla aliquet tellus eu magna iaculis posuere. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur nec justo in felis sollicitudin consectetur. Duis sagittis tellus ligula. Nam fringilla risus purus, id dapibus nulla condimentum sed. Aliquam a feugiat tortor. Duis mollis porttitor mattis. In hac habitasse platea dictumst.<p />
					<img src="computer.png" style="width:50%">					
				</div>
			</div>
			<div id="footer">&copy; Shaun Mueller</div>
		</div>
	</body>
</html>