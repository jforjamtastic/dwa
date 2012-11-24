<!DOCTYPE html>

<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" media="all" href="/css/style.css"/>	
	<link rel="stylesheet" media="all" href="/css/jquery-jvectormap.css"/>
	
	<!-- JS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	<script src="js/jquery-jvectormap-1.1.1.min.js"></script>
	<script src="js/jquery-jvectormap-us-aea-en.js"></script>
	<script src="js/maps.js"></script>
				
	<!-- Controller Specific JS/CSS -->
	<?=@$client_files; ?>
	
</head>

<body>	
	<?=$header;?>
	<?=$content;?> 

</body>
</html>