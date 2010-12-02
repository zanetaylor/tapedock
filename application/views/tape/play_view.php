<h1><?=$tape['title']?></h1>
<ul>
	<li><?=$tape['title']?></li>
	<li><?=$tape['short_desc']?></li>
	<li><a id="player" href="<?=$tape['tape_id']?>"></a></li>
</ul>
<script type="text/javascript" charset="utf-8" src="<?=base_url()?>js/libs/jwplayer.js"></script>
<script type="text/javascript" charset="utf-8">
	jwplayer("player").setup({
		flashplayer: "/flash/player.swf",
		file: "/tapes/<?=$tape['tape_id']?>.mp3",
		height: 30,
		width: 480
	});
</script>