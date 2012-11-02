<script>
	$(document.ready(function (){
		$('a[title="posts"]').addClass("active");
	});
</script>

<? foreach($posts as $key => $post): ?>
	<div class='post'>
	<? if ($post['user_id'] = $user_id){?>
		<div class="glow-bubble own-post">
	<? } 
	else { ?>

		<div class="glow-bubble">
	<? } ?>
			<span><?=$post['first_name']?> <?=$post['last_name']?></span>
			<p class='text'><?=$post['content']?></p>
			<p class='created'><?= Time::display($post['created'], null, 'America/New_York')?></p>
		</div>
	</div>
	
<? endforeach; ?>