<div id="user-list" class='grey-bubble'>	
	<h2> User List </h2>
	<? foreach($users as $key => $user):?>
		<p><a class='following-link' href="/users/profile/<?=$user['user_id']?>"><?=$user['first_name']?> <?=$user['last_name']?></a> |
		
		<? if(isset($connections[$user['user_id']])): ?>
			<a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
		<? else: ?>
			<a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
		<? endif; ?>
		</p>
	<? endforeach; ?>
	<br />
</div>

<p class='sidebar-text'> See some interesting posts in the Global Timeline? Why not follow the author? <p>