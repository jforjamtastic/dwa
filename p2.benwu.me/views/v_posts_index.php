<? foreach($posts as $key => $post): ?>
	<div class='post'>
		<?=$post['first_name']?> <?=$post['last_name']?> posted:
		<?=$post['content']?>
	
	</div>
	
<? endforeach; ?>