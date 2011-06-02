$(function()
{
	$('.imageUpload').fileUploader({
		imageLoader: "< ?php echo $html->url('/img/image_upload.gif'); ?>",
		allowedExtension: 'jpg|jpeg|gif|png|zip',
		limit: 5,
		callback: function(e) 
		{
			console.log( $(e).contents().find("#message").text() );
		}
	});
});