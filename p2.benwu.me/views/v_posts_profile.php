<? foreach($posts as $key => $post): ?>
	<div class='post'>
		<div class="glow-bubble">
	
			<h4><a href="/users/profile/<?=$post['user_id']?>"><?=$post['first_name']?> <?=$post['last_name']?></a></h4>
			<p class='text'><?=$post['content']?></p>
			<p class='created'><?= Time::display($post['created'], null, 'America/New_York')?></p>
		</div>
	</div>	
<? endforeach; ?>
