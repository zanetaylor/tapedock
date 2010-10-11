<html>
	<head>
		<title><?=$page_title?></title>
	</head>
	<body>
		<h1><?=$page_title?></h1>
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
		<ul id="tracklist">
			<li></li>
		</ul>
		<dl>
			<dt><label for="track">Track 1</label></dt>
				<dd><?=form_upload($track_input)?></dd>
				
			<dt><?=form_button($submit_button)?></dt>
		</dl>
		<?=form_close()?>
		<script type="text/javascript" charset="utf-8">
			var dropbox;
			
			dropbox = document.getElementById("dropbox");
			dropbox.addEventListener("dragenter", dragenter, false);
			dropbox.addEventListener("dragover", dragover, false);
			dropbox.addEventListener("drop", drop, false);
			
			function dragenter(e) {
			  e.stopPropagation();
			  e.preventDefault();
			}

			function dragover(e) {
			  e.stopPropagation();
			  e.preventDefault();
			}
			
			function drop(e) {
			  e.stopPropagation();
			  e.preventDefault();

			  var dt = e.dataTransfer;
			  var files = dt.files;

			  handleFiles(files);
			}
			
			function handleFiles(files) {
			  for (var i = 0; i < files.length; i++) {
			    var file = files[i];
			    var imageType = /image.*/;

			    if (!file.type.match(imageType)) {
			      continue;
			    }

			    var img = document.createElement("img");
			    img.classList.add("obj");
			    img.file = file;
			    preview.appendChild(img);

			    var reader = new FileReader();
			    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
			    reader.readAsDataURL(file);
			  }
		</script>
	</body>
</html>