<? foreach($posts as $key => $post): ?>
	<div class='post'>
		<div class="post-background"></div>
		<div class="post-text">
			<span><?=$post['first_name']?> <?=$post['last_name']?></span>
			<br />
			<?=$post['content']?>
		</div>
	</div>
	
<? endforeach; ?>