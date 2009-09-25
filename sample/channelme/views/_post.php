<? $post = post_peer::instance()->get_by_id($id) ?>
<? $channel = channel_peer::instance()->get_by_id($post['channel_id']) ?>
<? $user = user_peer::instance()->get_by_id($post['user_id']) ?>
<li id="p<?=$id?>" <?=$hidden ? 'class="hidden"' : ''?>>
	<span class="meta">
		<b><?=$user['nickname']?></b>
		<?=date('H:i', $post['ts'])?>
		<br/>
		<a href="#body:channel&id=<?=$channel['id']?>"><?=$channel['title']?></a>
	</span>
	<span class="body">
		<?=post_helper::body($post['text'])?>
	</span>
</li>