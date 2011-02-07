<ul>
	<? if ($this->session->userdata('is_logged_in')) { ?>
	<li><a href="<?=site_url("tape/create")?>">make a mix</a></li>
	<li>
		<a href="/"><?=$username?></a>
		<ul>
			<li><a href="/">dashboard</a></li>
			<li><a href="/">profile</a></li>
			<li><a href="/">settings</a></li>
			<li><a href="<?=site_url("user/logout")?>">sign out</a></li>
		</ul>
	</li>
	<!-- <li><a href="<?=site_url("logout")?>">sign out</a></li> -->
	<? } else { ?>
	<li><a href="<?=site_url("site/about")?>">what?</a></li>
	<li><a href="<?=site_url("user")?>">sign in</a></li>
	<? } ?>
</ul>