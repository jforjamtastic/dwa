<!DOCTYPE html>

<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" media="screen" href="/css/style.css"/>	
	<link rel="stylesheet" media="screen" href="/css/jquery-ui-1.9.2.custom.min.css"/>
	

	
	<!-- JS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	
				
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