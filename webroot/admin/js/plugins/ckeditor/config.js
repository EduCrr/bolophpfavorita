/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.stylesSet.add( 'my_styles', [
    // Block-level styles
    { name: 'Pink Title', element: 'h1', styles: { 'color': 'Pink' } },
    { name: 'Blue Title', element: 'h2', styles: { 'color': 'Blue' } },
    { name: 'Red Title' , element: 'h3', styles: { 'color': 'Red' } },

    // Inline styles
    { name: 'CSS Style', element: 'span', attributes: { 'class': 'my_style' } },
    { name: 'Marker: Yellow', element: 'span', styles: { 'background-color': 'Yellow' } }
] );

CKEDITOR.editorConfig = function(config) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbarGroups = [
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'forms' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'others' },
		{ name: 'about' }
	];

	// The default plugins included in the basic setup define some buttons that
	// are not needed in a basic editor. They are removed here.
	// config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';

	// config.extraPlugins = 'image';
	config.extraPlugins = 'popup,filetools,filebrowser,maximize,table,tabletools,justify,image2,wordcount,sourcedialog,font,resize,panelbutton,colorbutton,colordialog,youtube,format';

	config.format_tags = 'p;h1';
	config.format_h1 = {element: 'h3'};

	config.contentsCss = [
		CKEDITOR.basePath + 'contents.css',
		CKEDITOR.basePath + 'custom.css',
	];

	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';

	config.filebrowserBrowseUrl = '/admin/js/plugins/elFinder/elfinder-cke.html';

	config.entities = false;
	config.entities_latin = false;
	config.basicEntities = true;
};
