<script>
	$(document.ready(function (){
		$('a[title="posts"]').addClass("active");
	});
</script>

<? foreach($posts as $key => $post): ?>
	<div class='post'>
		<div class="glow-bubble">
			<span><?=$post['first_name']?> <?=$post['last_name']?></span>
			<p class='text'><?=$post['content']?></p>
			<p class='created'><?= Time::display($post['created'], null, null)?></p>
		</div>
	</div>
	
<? endforeach; ?>