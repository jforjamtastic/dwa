<div id="header">
	<div id='menu'>
		<ul>
			<? if (!$user) { ?>
			<li><a href="/users/login" title="login">login</a></li>
			<li><a href="/users/signup" title="signup">signup</a></li>
			<? } 
			else {?>
			logged in as: <?=$user->first_name?>
			<li><a href="/users/logout" title="logout">signout</a></li>
			
			<? } ?>
			
		</ul>
	</div>


	<h2><a href="/">Interactive Map</a></h2>
	
</div>