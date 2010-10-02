<html>
	<head>
		<title><?=$page_title?></title>
	</head>
	<body>
		<ul>
			<?php foreach($upload_data['upload_data'] as $item => $value):?>
			<li><?php echo $item;?>: <?php echo $value;?></li>
			<?php endforeach; ?>
		</ul>
		
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
					
				<dt>
					<?=form_button($submit_button)?>
					<?=form_hidden($id_input)?>
				</dt>
			</dl>
		<?=form_close()?>
	</body>
</html>