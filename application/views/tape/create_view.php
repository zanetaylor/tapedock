<h2>Upload Your Tracks</h2>
<?=validation_errors()?>
<?=$error?>
<?=$this->session->userdata('upload_dir')?>



<div id="file-uploader">       
    <noscript>          
        <p>Please enable JavaScript to use file uploader.</p>
        <!-- or put a simple form for upload here -->
    </noscript>         
</div>

<?=form_open_multipart('tape/save')?>
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
?>
<fieldset>
	<dl>
		<dt><label for="title">Title</label></dt>
			<dd><?=form_input($title_input)?></dd>
		<dt><label for="short_desc">Description</label></dt>
			<dd><?=form_input($short_desc_input)?></dd>
		<dt><label for="short_desc">Public?</label></dt>
			<dd><?=form_checkbox($public_checkbox)?></dd>
			
		<dt><?=form_button($submit_button)?></dt>
	</dl>
</fieldset>
<?=form_close()?>