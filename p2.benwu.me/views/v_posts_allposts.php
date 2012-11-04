<? if(($posts==NULL)) { ?>
	<p class='stream-error'>There are no posts. Either <a href='/posts/users/'>follow</a> someone,
	or <a href='/posts/add/'>write</a> something yourself</p>
<? }

else  {?>
	<h2 class=""> The Global Timeline</h2>
	<? foreach($posts as $key => $post): ?>
		<? if ($post['user_id'] == $user_id){?>
			<div class="own-post">
		<? } 
		else { ?>
			<div class='post'>
		<? } ?>
			<div class="glow-bubble">
				<h4><a href="/users/profile/<?=$post['user_id']?>"><?=$post['first_name']?> <?=$post['last_name']?></a></h4>
				<p class='text'><?=$post['content']?></p>
				<p class='created'><?= Time::display($post['created'], null, 'America/New_York')?></p>
			</div>
		</div>
		
	<? endforeach; ?>
<? } ?>