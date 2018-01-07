<html>
	<head>
		<title>LogApp - The Log Utility for Radiology Residents</title>

		<link rel="stylesheet" type="text/css" href="LogApp.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<?php
			include 'includes/login.php';
		?>
	</head>

	<body>
		<table>
			<tr>
			<td id="signIn">
				<?php
				    if (isset($_SESSION['email']))
					   print( "You are logged in as:<br><h3>" . $_SESSION['given_name'] . " " . $_SESSION['family_name'] . "<br>(" . $_SESSION['email'] . ")</h3>");
				?>
			</td>
			<tr><td><a href='preferences.php'>Preferences</a>
			<tr>
			<td>
				<button onClick="signOut()">Log Out</button>
				<script>
					function signOut() {
						$.ajax({
							url: "logout.php",
							type: "GET"
						})
						.done(function( json ) {
								$( "#signIn" ).html( "You have logged out." );
						})
						.fail(function( xhr, status, errorThrown ) {
		    					alert( "There was a problem with logging out." );
						})
					}
				</script>
			</td>
			<tr>
			<td><a href="includes/testPermissions.php">Forbidden Resource</a>
			</tr>
		</table>
	</body>
</html>
