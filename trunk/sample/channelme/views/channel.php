<h2><?=$channel['title']?> [boradcasting <?=$user_count?> users]</h2>

<? if ( $user_id ) { ?>
	<div <?= $is_mine ? 'class="hidden"' : '' ?> id="join_pane">
		<a href="javascript:;" onclick="App.joinChannel(<?=$channel['id']?>)">Join this channel</a>
		<br />
	</div>

	<form class="broadcast <?= !$is_mine ? 'hidden' : '' ?>" action="#post" id="post" rel="raw">
		<input type="hidden" name="channel_id" value="<?=$channel['id']?>">
		<textarea name="text"></textarea>

		<input type="submit" name="submit" value=" Broadcast " />
		<br clear="all" />

		<a href="javascript:;" onclick="App.leaveChannel(<?=$channel['id']?>)">Leave this channel</a>
	</form>
<? } ?>

<div class="clear"></div>
<br/>

<ul id="posts">
	<? foreach ( $posts as $data ) { $id = $data['id']; include '_post.php'; } ?>
</ul>