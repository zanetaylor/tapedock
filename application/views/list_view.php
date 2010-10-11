<ul>
	<? foreach($tapes as $row) : ?>
	<li><a href="<?=site_url('tape/play/'.$row->tape_id)?>"><?=$row->title?></a></li>
	<? endforeach; ?>
</ul>