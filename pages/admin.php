<?php
    include_once 'includes/LogApp.php';

    if (LogApp::noSessionEmailOrSessionEmailEmpty() || !LogApp::isAdminUser()) {
        print "Unauthorized access.";
        die();
    }
?>
    
<h2>LogApp Authorized Users
	<table>
		<tr>	<th>User Id</th><th>e-mail Address</th><th>Is Admin?</th>
<?php  
    $dh = '';
    $dh = new DataHelper();
    $dh->getAdminUsersInfo();
?>
   </tr></table>
   
   <button id='enable'>Toggle Changes</button>
   <button id='update'>Update Changes</button>
   <script>
   		$("#update").hide();
   		
		disabled = true;
		
		$("#enable").click(function() {
			disabled = !disabled;
			$(".admin").attr('disabled', disabled);
		});
		
		$(".admingit ").click(function() {
			$("#update").show();
		});
   </script>