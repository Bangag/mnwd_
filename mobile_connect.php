<?php
	define ('server', 'localhost');
	define ('user', 'root');
	define ('password', '');
	define ('database', 'mnwd');

	// Create connection
	$conn = mysqli_connect(server, user, password);

	// Check connection
	if ($conn) {
		$dbconn = mysqli_connect(server, user, password, database);
		if ($dbconn) {
			echo "connection success~";
		}
		else {
			echo "connection failed~";
		}
	}
	else {
		echo "Unable to connect to the server~";
	}
?>