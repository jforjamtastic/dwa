<div id="user-list" class='grey-bubble'>	
	<h2> User List </h2>
	<? foreach($users as $key => $user):?>
		<p><?=$user['first_name']?> <?=$user['last_name']?> |
		
		<? if(isset($connections[$user['user_id']])): ?>
			<a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
		<? else: ?>
			<a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
		<? endif; ?>
		</p>
	<? endforeach; ?>
	<br />
</div>