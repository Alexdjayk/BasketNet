/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

// Register a templates definition set named "default".
CKEDITOR.addTemplates( 'default',
{
	// The name of sub folder which hold the shortcut preview images of the
	// templates.
	imagesPath : CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'templates' ) + 'templates/images/' ),

	// The templates definitions.
	templates :
		[
			{
				title: 'Image and Title',
				image: 'template1.gif',
				description: 'One main image with a title and text that surround the image.',
				html:
					'<h3>' +
						'<img style="margin-right: 10px" height="100" width="100" align="left"/>' +
						'Type the title here'+
					'</h3>' +
					'<p>' +
						'Type the text here' +
					'</p>'
			},
			{
				title: 'Strange Template',
				image: 'template2.gif',
				description: 'A template that defines two colums, each one with a title, and some text.',
				html:
					'<table cellspacing="0" cellpadding="0" style="width:100%" border="0">' +
						'<tr>' +
							'<td style="width:50%">' +
								'<h3>Title 1</h3>' +
							'</td>' +
							'<td></td>' +
							'<td style="width:50%">' +
								'<h3>Title 2</h3>' +
							'</td>' +
						'</tr>' +
						'<tr>' +
							'<td>' +
								'Text 1' +
							'</td>' +
							'<td></td>' +
							'<td>' +
								'Text 2' +
							'</td>' +
						'</tr>' +
					'</table>' +
					'<p>' +
						'More text goes here.' +
					'</p>'
			},
			{
				title: 'Text and Table',
				image: 'template3.gif',
				description: 'A title with some text and a table.',
				html:
					'<div style="width: 80%">' +
						'<h3>' +
							'Title goes here' +
						'</h3>' +
						'<table style="width:150px;float: right" cellspacing="0" cellpadding="0" border="1">' +
							'<caption style="border:solid 1px black">' +
								'<strong>Table title</strong>' +
							'</caption>' +
							'</tr>' +
							'<tr>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
							'</tr>' +
							'<tr>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
							'</tr>' +
							'<tr>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
								'<td>&nbsp;</td>' +
							'</tr>' +
						'</table>' +
						'<p>' +
							'Type the text here' +
						'</p>' +
					'</div>'
			},
			{
				title:'Texte descriptif court article (V1)',
				image:'template4.gif',
				description:'Image 187/100px',
				html:'' +				
						'<p>' +
							'<img class="border_magic" alt="" src="" style="width: 187px; height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;" />' +
							'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' +
						'</p>' +
						'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.</p>'
			},
			{
				title:'Texte descriptif court article (V2)',
				image:'template5.gif',
				description:'Image 100/157px',
				html:'' +				
						'<p>' +
							'<img alt="" class="border_magic" src="" style="width: 100px; height: 157px; float: left; margin-right: 10px; margin-bottom: 10px;" />' +
							'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' +
						'</p>' +
						'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.</p>'
			}
		]
});
