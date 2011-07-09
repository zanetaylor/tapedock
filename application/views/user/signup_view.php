<?
	$button_params = array(
		'type' => 'submit',
		'content' => 'signup!'
	)
?>
<h1>Enter the Mix</h1>
<section class="clearfix">
	<?=form_open('user/create')?>
		<fieldset>
			<dl>
				<dt></dt>
				<dd><?=form_input('username', set_value('username', 'Username'))?></dd>
				<dt></dt>
				<dd><?=form_input('email', set_value('email', 'Email Address'))?></dd>
				<dt></dt>
				<dd><?=form_password('password', set_value('password', 'Password'))?></dd>
				<dt></dt>
				<dd><?=form_password('password2', set_value('password2', 'Confirm Password'))?></dd>
			</dl>
		</fieldset>
		<p class="clearfix"><?=form_button($button_params)?></p>
	<?=form_close()?>
	
	<?=validation_errors('<p class="error">')?>
	<div class="shadow"></div>
</section>
