/* Author: 

*/


$(function(){

	header_width = 780 - $("#nav").width()-1;
	$("header").width(header_width);
	
	var uploader = new qq.FileUploader({
	    // pass the dom node (ex. $(selector)[0] for jQuery users)
	    element: document.getElementById('file-uploader'),
	    // path to server-side upload script
	    action: '/index.php/tape/upload/',
	    allowedExtensions: ['mp3'],
	    debug: false
	});

});