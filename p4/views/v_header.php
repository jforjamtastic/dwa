<div id="header">
	<div id='menu'>
		<ul>
			<? if (!$user) { ?>
			<li><a href="/users/login" title="login">login</a></li>
			<li><a href="/users/signup" title="signup">signup</a></li>
			<? } 
			else {?>
			
			<li>logged in as: <a href="/users/logout" title="logout">signout</a></li>
			
			<? } ?>
			
		</ul>
	</div>


	<h2>Interactive Map</h2>
	
</div>