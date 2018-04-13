<?php
	ob_start();
	error_reporting(2);
	session_start();
	
	include 'config.php';
	include 'function.php';
	
	$page=addslashes(strip_tags($_GET['page']));
	$action=addslashes(strip_tags($_GET['action']));
	$id_cat=addslashes(strip_tags($_GET['id_Cat']));
	$id=addslashes(strip_tags($_GET['id']));
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Portal Extrakulikuler SMKN 5 TANGERANG</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	</head>
	<body>
		
	<?php include 'header.php';?>

		<div class="wrapper">
			
			<?php include 'banner.php';?>
			
			<!-- content section -->
			<div id="content">
				
				<!-- content left section -->
				<?php include 'left.php';?>
				<!-- /content left section -->
					
				
				<!-- content right section -->
				<?php 
					if($page=="") {
						include "page/home.php";
					} else if($action=="") {
						include "page/$page.php";
					} else {
						include "page/$page-$action.php";
					}
				?>
				<!-- /content right section -->
				
			</div>
			<!-- /content section -->
		</div>
		
		<!-- footer section -->
		<?php include 'footer.php';?>
		<!-- /footer section -->
		
	</body>
</html>