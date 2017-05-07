$(document).ready(function () {
	var user_href;
	var user_href_splitted;
	var user_id;
	var image_src;
	var image_href_splitted;
	var image_name;
	var photo_id;

	$('.modal_thumbnails').click(function(){
	  		$('#set_user_image').prop('disabled', false);
	  		user_href = $('#user-id').prop('href');
	  		user_href_splitted = user_href.split("=");
	  		user_id = user_href_splitted[user_href_splitted.length-1];

	  		image_src = $(this).prop("src");
	  		image_href_splitted = image_src.split("/");
	  		image_name = image_href_splitted[image_href_splitted.length-1];
	  	})

	$('#set_user_image').click(function(){
		$.ajax({
			url:"admin_includes/ajax_code.php",
			data: {image_name:image_name, user_id:user_id},
			type: "POST",
			success: function(data){
				if (!data.error) {
					$('.user_image_box a img').prop('src', data);
				}
			}
		})
	})





	// ACTIVE GIZMO
	var url = window.location;
	// Will only work if string in href matches with location
	$('ul.nav a[href="'+ url +'"]').parent().addClass('active');

	// Will also work for relative and absolute hrefs
	$('ul.nav a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');


	// TOGGLING THAT SIDEBAR THING IN EDIT PICTURE
	$('#toggle').click(function(){
		$('.box-inner, .info-box-delete').slideToggle();
		$(this).toggleClass('glyphicon-menu-up');
	})

	// WYSIWYG CONFIGUREATION
	  tinymce.init({
		  selector: '#description',
		  height: 500,
		  theme: 'modern',
		  plugins: [
		    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
		    'searchreplace wordcount visualblocks visualchars code fullscreen',
		    'insertdatetime media nonbreaking save table contextmenu directionality',
		    'emoticons template paste textcolor colorpicker textpattern imagetools'
		  ],
		  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		  toolbar2: 'print preview media | forecolor backcolor emoticons',
		  image_advtab: true,
		  templates: [
		    { title: 'Test template 1', content: 'Test 1' },
		    { title: 'Test template 2', content: 'Test 2' }
		  ],
		  content_css: [
		    'https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		    'https://www.tinymce.com/css/codepen.min.css'
		  ]
		 });

	  	$('.delete_btn').click(function(){
	  		return confirm("Are you sure you want to delete this photo?");
	  	})
})
