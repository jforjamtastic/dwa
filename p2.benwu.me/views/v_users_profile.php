<div id="profile">	 
	<? foreach($users as $key => $user):?>

		<h2>profile for <?=$user['first_name']?> <?=$user['last_name']?> 
	<? endforeach; ?>
	<br />
</div>
