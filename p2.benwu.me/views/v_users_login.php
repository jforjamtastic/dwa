<div id="login">
	<div class="grey-bubble">
		<form method='Post' class='validate' action='/users/p_login'>
			<h2>Login</h2>
			<label for="email">email</label><br />
			<input type='text' class='required' name='email'>
			<br /><br />
			password<br />
			<input type='password' class='required' name='password'>
			<br /><br />
			<input type='submit' value='login' class='submit'>
			<? if($error): ?>
				<div class='error'>
					<p> Login failed. </p>
				</div>
				<br>
			<? endif;?>	
		</form>
	
	</div>
</div>
<?=$subview?>
