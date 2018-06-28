<?php 
	include 'createDB.php';
	session_start();
?>	
<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<title>CS Tools - Admin Login</title>
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
					<form method=post action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> class='formTable'>
						<table>
							<tr>
								<td>Username:</td>
								<td><input name=username required autofocus /></td>
							</tr>
							<tr>
								<td>Password:</td>
								<td><input type=password name=password required /></td>
							</tr>	
						</table>
						<p /><input type=submit name=submit value="Log in" />
<?php
	if(isset($_POST['submit'])){
		$username = "admin";
		$password = "Password1";		
		$connection = mysqli_connect("localhost","root","","ShaunM_CSTools");			
		$enteredUsername = mysqli_real_escape_string($connection, $_POST['username']);
		$enteredPassword = mysqli_real_escape_string($connection, $_POST['password']);	
		if ($enteredUsername == $username && $enteredPassword == $password){		
			session_start();
			$_SESSION["username"] = $enteredUsername;		
			header('Location: index.php');
		}
		else{		
			echo "	<p />Login failed
					<p /><i>username: admin
					<br />password: Password1</i>";
		}	
	}
?>
					</form>					
				</div>
			</div>
			<div id="footer">&copy; Shaun Mueller</div>
		</div>
	</body>
</html>