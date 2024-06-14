CKEDITOR.editorConfig = function( config ) {
	config.language = 'es';
	config.extraPlugins = 'uploadimage,oembed,widget';
	config.uploadUrl = '/admin/file/upload';
	config.filebrowserUploadUrl = '/admin/file/upload?_token=' + $('meta[name="csrf-token"]').attr('content');

	config.toolbar = [
		// { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ] }, // 'PasteFromWord'
		// { name: 'editing', items: [ 'Scayt' ] },
		// { name: 'links', items: [ 'Link', 'Unlink' ] }, // 'Anchor'
		// { name: 'insert', items: [ 'Image', 'oembed', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		// { name: 'tools', items: [ 'Maximize' ] },
		// { name: 'document', items: [ 'Source' ] },
		'/',
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
		// { name: 'styles', items: [ 'Styles', 'Format' ] },
		// { name: 'about', items: [ 'About' ] }
	];

	config.removeDialogTabs = 'image:advanced;link:advanced';
};
