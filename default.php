<html>
	<head>
		<title>LogApp - The Log Utility for Radiology Residents</title>

		<link rel="stylesheet" type="text/css" href="LogApp.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<?php
			include 'includes/login.php';
			
			// Script to setup page content
			
			// First, get the log in information
			$logInInfo = '';
			if (isset($_SESSION['email']))
			    $logInInfo = "<li><b>You are logged in as:</b><br>" . "<b>" . $_SESSION['given_name'] . " " . $_SESSION['family_name'] . "<br>(" . $_SESSION['email'] . ")</b>";
			
			// Initialize header and article text
			$headerText = '';
			$articleSource = '';
			
			// get the HTTP_GET argument 'view' specifying page
			$view = '';
		    if (isset($_GET['view']) )
			     $view = $_GET['view'];
		    
		    // Set header and article accordingly
		    switch ($view)  {
		        case 'settings':
		            $headerText = 'User Settings';
		            $articleSource = 'pages/settings.php';
		            break;
		            
		        case 'logout':
		            $headerText = 'You have logged out.';
		            $articleSource = 'logout.php';
		            break;
		            
		        case 'administrate':
		            $headerText = 'Administrative Options';
		            $articleSource = 'pages/admin.php';
		            break;
		            
		        case '':
		            $headerText = 'Radiology Logs Home';
		            $articleSource = '';
		            break;
		            
		        default:
		            // @TODO: Maybe redirect to 404?
		            $headerText =  'Twilight zone';
		            $articleSource = '';
		            break;	       
		    }
		    
		    $secretItems = '';
		    if (isset($_SESSION['role']) && $_SESSION['role'] == LogApp::ADMIN_ROLE) {
		        $secretItems .= "<li> <a href='default.php?view=administrate'>Administrative Options</a>";
		        $secretItems .= "<li> <a href='includes/testPermissions.php'>Forbidden Resource</a>";
		    }
		?>
	</head>

	<body>
		<div class=container>
        		<header id="signIn">
    				<h1> <?php print $headerText; ?> </h1>
        		</header>
        		
        		<nav>
        			<ul>
        			    	<li> <?php print $logInInfo; ?>
        			    	<li> <a href='default.php'>Home</a>
      				<li> <a href='default.php?view=settings'>Settings</a>
      				<?php print $secretItems; ?>
        				
        				<li> <a href='default.php?view=logout'>Log Out</a>		
        			</ul>
        		</nav>
        		
        		<article>
        			<?php ($articleSource == '') ? print '' : include $articleSource; ?>
        		</article>
        		
        		<footer>This is the footer.</footer>
		</div>
	</body>
</html>
