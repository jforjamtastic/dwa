<? if(($posts==NULL)) { ?>
	<p class='stream-error'>There are no posts. Either <a href='/posts/users/'>follow</a> someone,
	or <a href='/posts/add/'>write</a> something yourself</p>
<? }

else  {?>

	<? foreach($posts as $key => $post): ?>
		<? if ($post['user_id'] == $user_id){?>
			<div class="own-post">
		<? } 
		else { ?>
			<div class='post'>
		<? } ?>
			<div class="glow-bubble">
		
				<h4><?=$post['first_name']?> <?=$post['last_name']?></h4>
				<p class='text'><?=$post['content']?></p>
				<p class='created'><?= Time::display($post['created'], null, 'America/New_York')?></p>
			</div>
		</div>
		
	<? endforeach; ?>
<? } ?>