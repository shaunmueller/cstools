<!--
	Shaun Mueller
	13171256
	15-09-2017
-->

<?php
	$connection = mysqli_connect('localhost', 'root', '');
	if (!$connection) {
		die('Could not connect: ' . mysqli_error());
	}
	$sql = 'DROP DATABASE ShaunM_CSTools';
	if (mysqli_query($connection, $sql)) {
		echo "Database ShaunM_CSTools was successfully dropped\n";
	} else {
		echo 'Error dropping database: ' . mysqli_error($connection) . "\n";
	}
	mysqli_close($connection);
?>