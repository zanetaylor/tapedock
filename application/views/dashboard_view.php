<h1>Hey, <?=$username?>.</h1>

<div id="content">
	<h2>Recent Activity</h2>
	<section>
		<ol>
			<li>Fernando shared "Dog Boyz" with you.</li>
			<li>You are now friends with Lucille.</li>
			<li>Jerome commented on your tape, "Starface."</li>
			<li>Ralph commented on track 2 of your tape, "Bug in my Soup."</li>
		</ol>
		<div class="shadow"></div>
	</section>
</div>
<div id="sidebar">
	<h2>Tapes</h2>
	<section>
		(tapes you've made, shared, etc.)
		
		<? if($user_tapes) { ?>
		<ol class="tape-list">
			<? foreach($user_tapes as $row) : ?>
			<li><a class="title" href="<?=site_url('tape/play/'.$row->tape_id)?>"><span><?=$row->title?></span></a></li>
			<? endforeach; ?>
		</ol>
		<? } ?>
		<div class="shadow"></div>
	</section>
</div>