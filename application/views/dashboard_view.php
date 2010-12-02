<h1>The Latest</h1>
(here are the latest tapes shared with you or public tapes by people you follow, and the latest tapes you've made, friend requests, followers, etc.)

<h1>Your Tape History</h1>
(tapes you've made, shared, etc.)

<? if($user_tapes) { ?>
<ol class="tape-list">
	<? foreach($user_tapes as $row) : ?>
	<li><a class="title" href="<?=site_url('tape/play/'.$row->tape_id)?>"><span><?=$row->title?></span></a></li>
	<? endforeach; ?>
</ol>
<? } ?>

<?=anchor('user/logout', 'Sign Out')?>