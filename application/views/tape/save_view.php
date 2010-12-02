<?=validation_errors()?>
<?=form_open('tape/save')?>
<?
	$title_input = array(
		'name'	=> 'title',
		'id'	=> 'title',
		'value'	=> set_value('title')
	);
	$short_desc_input = array(
		'name'	=> 'short_desc',
		'id'	=> 'short_desc',
		'value'	=> set_value('short_desc')
	);
	$public_checkbox = array(
		'name'	=> 'public',
		'id'	=> 'public',
		'value'	=> set_value('public')
	);
	$submit_button = array(
		'id'		=> 'submit',
		'type'		=> 'submit',
		'content'	=> 'Save'
	);
	$id_input = array(
		'tape_id'	=> $id
	);
?>
	<dl>
		<dt><label for="title">Title</label></dt>
			<dd><?=form_input($title_input)?></dd>
		<dt><label for="short_desc">Description</label></dt>
			<dd><?=form_input($short_desc_input)?></dd>
		<dt><label for="short_desc">Public?</label></dt>
			<dd><?=form_checkbox($public_checkbox)?></dd>
			
		<dt>
			<?=form_button($submit_button)?>
			<?=form_hidden($id_input)?>
		</dt>
	</dl>
<?=form_close()?>