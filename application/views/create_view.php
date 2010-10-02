<html>
	<head>
		<title><?=$page_title?></title>
	</head>
	<body>
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
			<dl>
				<dt><label for="track">Track 1</label></dt>
					<dd><?=form_upload($track_input)?></dd>
					
				<dt><?=form_button($submit_button)?></dt>
			</dl>
		<?=form_close()?>
	</body>
</html>