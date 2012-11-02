<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	
	<!== CSS ==>
	<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	<!-- Controller Specific JS/CSS -->
	<?php echo @$client_files; ?>
	
	<script type='text/javascript'>
	     $(document).ready(function() {
	     	$("#menu").find("a[href='"+window.location.pathname	+"']").each(function() {
	    			$(this).addClass("active");
			});
		});
	</script>
	
</head>

<body>	

	<div id="header">
		<a href="#" title="title"><h1> the Timeline</h1></a>
		<br />
		<div id='menu'>
			<ul>
				<? if (!$user) { ?>
				<li><a href="/users/login" title="login">login</a></li>
				<li><a href="/users/signup" title="signup">signup</a></li>
				<? } 
				else {?>
				<!--	<li><a href="/users/profile/<? $user?>" 		title="profile">profile</a></li> -->
				<li><a href="/posts/" title='posts'>timeline</a></li>
				<li><a href="/posts/users" title='following'>following</a></li>
				<li><a href="/posts/add" title='add'>compose</a></li>
				<li><a href="/users/logout" title="logout">signout</a></li>
			
				<? } ?>
				</ul>
		</div>
	</div>
	<div id="content">
		<?=$content;?> 
	</div>
</body>
</html>

