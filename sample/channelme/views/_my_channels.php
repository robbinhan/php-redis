<? $channels = user_channel_peer::instance()->get_list($_SESSION['user_id']); ?>

<h3>My channels</h3>
<ul id="my_channels_list">
	<? foreach ( $channels as $data ) { ?>
		<? $channel = channel_peer::instance()->get_by_id( $data['id'] ) ?>
		<li id="c<?=$data['id']?>">
			<a onclick="App.channelSelect(this);" href="#body:channel&id=<?=$channel['id']?>"><?=$channel['title']?></a>
		</li>
	<? } ?>
</ul>