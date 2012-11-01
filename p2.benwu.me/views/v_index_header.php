<div id="header">
	<a href="#" title="the Timeline"><h1> the Timeline</h1></a>
	<ul>
	<? if (!$user) { ?>
		<li><a href="/users/login" title="login">login</a></li>
		<li><a href="/users/signup" title="signup">signup</a></li>
	<? } 
		else {?>
		<li><a href="/users/profile/<? $user?>" title="profile">profile</a></li>
		<li><a href="/users/logout" title="logout">Signout</a></li>
	
	<? } ?>
	</ul>
</div>