<div id="signup">	
	<div class='grey-bubble'>
		<form method='Post' class='validate' action='/users/p_signup'>
		
			<h2>Signup</h2>
			<label for='first_name'>First Name</label><br />
			<input type='text' class='required' name='first_name' id='first_name'>
			<br /><br />
		
			<label for='last_name'>Last Name</label><br />
			<input type='text' class='required' name='last_name' id='last_name'>
			<br /><br />
			
			<label for='email'>email</label><br />
			<input type='text' class='required' name='email' id='email'>
			<br /><br />
			
			<label for='password'>Password</label><br />
			<input type='password' class='required' name='password' id='email'>
			<br /><br />
			
			<input type='submit' value='submit' class='submit'>
			
			<br /><br />
			<? if($error): ?>
				<div class='error'>
					<p> Signup failed. Email already used </p>
				</div>
				<br>
			<? endif;?>
		
		</form>
	</div>
</div>