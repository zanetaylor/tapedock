<ol class="tape-list">
	<? foreach($tapes as $row) : ?>
	<li><a class="title" href="<?=site_url('tape/play/'.$row->tape_id)?>"><span><?=$row->title?></span></a><a class="creator" href="/">bigtd8</a></li>
	<? endforeach; ?>
</ol>