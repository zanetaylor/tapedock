<h1>Welcome to this thing!</h1>
<?=anchor('user/signup', 'Sign Up')?>
<?=anchor('user/login', 'Sign In')?>
<ol class="tape-list">
	<? foreach($tapes as $row) : ?>
	<li><a class="title" href="<?=site_url('tape/play/'.$row->tape_id)?>"><span><?=$row->title?></span></a><a class="creator" href="/">bigtd8</a></li>
	<? endforeach; ?>
</ol>