<h2>Upload Your Tracks</h2>
<?=validation_errors()?>
<?=$error?>
<?=form_open_multipart('tape/upload')?>
<?
	$track_input = array(
		'name'	=> 'track',
		'id'	=> 'track',
		'value'	=> set_value('track')
	);
	
	$submit_button = array(
		'id'		=> 'submit',
		'type'		=> 'submit',
		'content'	=> 'Save'
	);
?>
<div id="dropbox">Drag &amp; drop your track files here!</div>
<div id="preview" name="preview"></div>
<ul id="tracklist">
	<li></li>
</ul>
<dl>
	<dt><label for="track">Track 1</label></dt>
		<dd><?=form_upload($track_input)?></dd>
		
	<dt><?=form_button($submit_button)?></dt>
</dl>
<?=form_close()?>