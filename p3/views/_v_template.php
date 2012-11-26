<!DOCTYPE html>

<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" media="screen" href="/css/style.css"/>	
	<link rel="stylesheet" media="screen" href="/css/jquery-jvectormap.css"/>
	<link rel="stylesheet" media="screen" href="/css/jquery-ui-1.9.2.custom.min.css"/>
	<link rel="stylesheet" media="screen" href="/css/tablecss/red/style.css"/>

	
	<!-- JS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	<script src="js/jquery-jvectormap-1.1.1.min.js"></script>
	<script src="js/jquery-jvectormap-us-aea-en.js"></script>
	<script src="js/jquery.tablesorter.js"></script>
	<script src="js/maps.js"></script>
				
	<!-- Controller Specific JS/CSS -->
	<?=@$client_files; ?>
	
</head>

<body>	
	<div id="wrapper">
		<?=$header;?>
		<?=$content;?> 
	</div>
</body>
</html>