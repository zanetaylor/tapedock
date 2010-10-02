<html>
	<head>
		<title><?=$page_title?></title>
	</head>
	<body>
		<ul>
			<?php foreach($tape_data['upload_data'] as $item => $value):?>
			<li><?php echo $item;?>: <?php echo $value;?></li>
			<?php endforeach; ?>
		</ul>
		
		<?=validation_errors()?>
		<?=form_open('tape/create')?>
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
		?>
			<dl>
				<dt><label for="title">Title</label></dt>
					<dd><?=form_input($title_input)?></dd>
				<dt><label for="short_desc">Description</label></dt>
					<dd><?=form_input($short_desc_input)?></dd>
					
				<dt><?=form_button($submit_button)?></dt>
			</dl>
		<?=form_close()?>
	</body>
</html>