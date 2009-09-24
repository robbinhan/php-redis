<? $post = post_peer::instance()->get_by_id($id) ?>
<? $user = user_peer::instance()->get_by_id($post['user_id']) ?>
<li id="p<?=$id?>" <?=$hidden ? 'class="hidden"' : ''?>>
	<span class="meta">
		<b><?=$user['nickname']?></b>
		<?=date('H:i', $post['ts'])?>
	</span>
	<span class="body"><?=post_helper::body($post['text'])?></span>
</li>