<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	
	<!== CSS ==>
	<link rel='stylesheet'
		media='screen and (min-width: 641px)'
		type="text/css" 
		href="/css/style.css"/>
		
	<link rel='stylesheet'
		media='screen and (max-width: 640px)'
		href='/css/mobile.css'/>
		
	<!-- Controller Specific JS/CSS -->
	<?php echo @$client_files; ?>
	
	<script type='text/javascript'>
	$(document).ready(function() {
		$("#menu").find("li").find("a[href='"+window.location.pathname+"']").each(function() {
			$(this).closest("li").addClass('active');
			console.log($(this).parent());
			});
		});
	</script>
	
</head>

<body>	

	<div id="header">
		<a href="/" title="title"><h1> the Timeline</h1></a>
		<br />
		<div id='menu'>
			<ul>
				<? if (!$user) { ?>
				<li><a href="/users/login" title="login">login</a></li>
				<li><a href="/users/signup" title="signup">signup</a></li>
				<? } 
				else {?>
				<li><a href="/posts/" title='posts'>timeline</a></li>
				<li><a href="/posts/users" title='following'>following</a></li>
				<li><a href="/posts/add" title='add'>compose</a></li>
				<li><a href="/users/logout" title="logout">signout</a></li>
			
				<? } ?>
				</ul>
		</div>
	</div>
	<div id="content">
		<div id="stream-side">
			<?=$content;?> 
		</div>
		<div id="sidebar">
			<?=$sidebar;?>
			<p>test
				test
				test
				test
				test
				test
				test
			</p>
		</div>
		<div id="footer">
			<span> version .10</span>
		</div>
	</div>
</body>
</html>

