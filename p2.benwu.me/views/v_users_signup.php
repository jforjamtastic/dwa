<div id="header">
	<a href="#" title="the Timeline"><h1> the Timeline</h1></a>
	<ul>
		<li><a href="/users/login" title="login">login</a></li>
		<li class="active"><a href="/users/signup" title"signup">signup</a></li>
	</ul>
</div>

<div id="content">
	<form method='Post' action='/users/p_signup'>
		<fieldset>
			<h2>Signup</h2>
			<label for='first_name'>First Name</label><br />
			<input type='text' name='first_name' id='first_name'><br /><br />
		
			<label for='last_name'>Last Name</label><br />
			<input type='text' name='last_name' id='last_name'><br /><br />
			
			<label for='email'>email</label><br />
			<input type='text' name='email' id='email'><br /><br />
			
			<label for='password'>Password</label><br />
			<input type='password' name='password' id='password'><br /><br />
			
			<input type='submit' name="submit"><br /><br />
		</fieldset>

		</form>
</div>