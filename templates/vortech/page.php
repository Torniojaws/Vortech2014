<?php 
	error_reporting(E_ALL);
	include_once('res/defines.php');
?>
<!doctype html>
<html lang="en">
<head>
	<title><?php echo ucfirst($this->pageTitle); ?> &#124; VortechMusic.com</title>
	<link href="<?php echo $this->cssFile; ?>" rel="stylesheet" type="text/css" />
	<meta charset="UTF-8" />
	
	<!-- Extra features -->
	<link href="plugins/rateit.css" rel="stylesheet" type="text/css" />
	<link href="plugins/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="plugins/vortech.js"></script>
	<script src="plugins/jquery.rateit.js"></script>
	<script src="plugins/jquery.prettyPhoto.js"></script>
	<script src="plugins/jquery-ui-1.10.3.custom.min.js"></script>
</head>
<body>
	<div class="siteContainer">
		<header class="siteLogo">
			<?php include(ROOTPATH . '/templates/vortech/logo.php'); ?>
			
		</header>
		<nav class="siteMenu">
			<?php include(ROOTPATH . '/templates/vortech/menu.php'); ?>
		</nav>
		<div class="siteContents">
			<div class="siteContentsPadding">
				<?php 
					$contentsLocation = ROOTPATH . "/contents/";
					$target = $contentsLocation . $this->pageContentFile;
					if(is_file($target)) {
						include($target);
					} else {
						echo '<p>The page ', basename($target), ' was not found. The site was updated recently, so try the menu above instead, thanks!</p>';
					}
				?>
			</div> <!-- End siteContentsPadding -->
		</div> <!-- End siteContents -->
		<footer class="siteFooter">
			<p>Copyright &copy; <?php echo date('Y'); ?> Vortech</p>
			<p><?php include(ROOTPATH . '/plugins/counter.php'); ?> visitors</p>
			<?php include(ROOTPATH . '/contents/footerLinks.php'); ?>
		</footer>
	</div> <!-- End siteContainer -->
</body>
</html>