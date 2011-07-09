<?
	$button_params = array(
		'type' => 'submit',
		'content' => 'sign in'
	)
?>
<h1>Sign In</h1>
<div id="content">
	<section>
		<?=form_open('user/validate')?>
			<fieldset>
				<dl>
					<dt>Username</dt>
					<dd><?=form_input('username', 'Username')?></dd>
					<dt>Password</dt>
					<dd><?=form_password('password', 'Password')?></dd>
				</dl>
				<p><?=form_button($button_params)?></p>
			</fieldset>
		<?=form_close()?>
		<p class="callout">Not a member yet? <?=anchor('user/signup', 'Sign up!')?></p>
		<div class="shadow"></div>
	</section>
</div>
<div id="sidebar">
	<section class="clearfix">
		<h3>Whatever</h3>
		<p>Something something something.</p>
		<div class="shadow"></div>
	</section>
</div>