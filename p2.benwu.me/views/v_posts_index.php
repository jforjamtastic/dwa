<? foreach($posts as $key => $post): ?>
	<?=$post['first_name']?> <?=$post['last_name']?> posted:
	<?=$post['content']?>
	
	<br /><br />
	
<? endforeach; ?>