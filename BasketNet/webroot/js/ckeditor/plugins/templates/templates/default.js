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
				title: 'Gallerie',
				image: 'template1.gif',
				description: 'Gallerie de 10 images',
				html:
					
					'<img style="margin-right: 10px" height="100" width="100" align="left"/>' +
					'<img style="margin-right: 10px" height="100" width="100" align="center"/>' +
					'<img style="margin-right: 10px" height="100" width="100" align="right"/>' +
					'<img style="margin-right: 10px" height="100" width="100" align="left"/>' +
					'<img style="margin-right: 10px" height="100" width="100" align="center"/>' +
					'<img style="margin-right: 10px" height="100" width="100" align="right"/>' +
					'<img style="margin-right: 10px" height="100" width="100" align="left"/>' +
					'<img style="margin-right: 10px" height="100" width="100" align="center"/>' +
					'<img style="margin-right: 10px" height="100" width="100" align="right"/>' +	
					'<img style="margin-right: 10px" height="100" width="100" />' 
					
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
						'<img class="border_magic" alt="" src="" style="width: 187px; height: 100px; float: left; margin-right: 10px; margin-bottom: 10px; margin-left:35px;" />' +
						'<p>' +
							
							'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s. ' +
						'</p>' +
						'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.</p>'
			},
			{
				title:'Texte descriptif court article (V2)',
				image:'template4.gif',
				description:'Image 100/157px',
				html:'' +				
						'<p>' +
							'<img alt="" class="border_magic" src="" style="width: 100px; height: 157px; float: left; margin-right: 10px; margin-bottom: 10px; margin-left:35px;" />' +
							'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' +
						'</p>' +
						'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.</p>'
			},
			{
				title:'Texte descriptif long article (V1)',
				image:'desc_long_article.gif',
				description:'Images 264/111px',
				html:'' +				
						
						'<p style="margin-left:25px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.</p>' +
						'<div class="gs_4" style="margin-left:35px; margin-right:0px;">' +
							'<a class="zoomer" href="/" rel="prettyPhoto"><img alt="" class="border_magic" src="" style="width: 264px; height: 111px;  margin-bottom:10px;" /></a>' +
							'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>' +
						'</div>' +
						'<div class="gs_4" style="margin-right:0px;">' +
							'<a class="zoomer" href="/" rel="prettyPhoto"><img alt="" class="border_magic" src="" style="width: 264px; height: 111px;  margin-bottom:10px;" /></a>' +
							'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>' +
						'</div>' +
						'<div class="gs_4 omega" style="margin-right:0px;">' +
							'<a class="zoomer" href="/" rel="prettyPhoto"><img alt="" class="border_magic" src="" style="width: 264px; height: 111px;  margin-bottom:10px;" /></a>' +
							'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>' +
						'</div>' +
						'<div class="hr"><div class="inner_hr">&nbsp;</div></div>' +
						'<blockquote><p style="margin-left:25px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p></blockquote>' +
						'<div class="hr"><div class="inner_hr">&nbsp;</div></div>' +
						'<ul class="bullet-arrow" >' +
							'<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry,</li>' +
							'<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry,</li>' +
							'<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry,</li>' +
							'<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry,</li>' +
							'<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry,</li>' +
							'<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry,</li>' +
							'<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry,</li>' +
							'<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry,</li>' +
							'<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>' +
						'</ul>' +
						'<p class="information" style="margin-left:40px; margin-right:18px;"><strong>Lorem Ipsum :</strong><br />Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>' +
						'<div class="gs_4" style="margin-left:35px; margin-right:0px;">' +
							'<a class="zoomer" href="/" rel="prettyPhoto"><img alt="" class="border_magic" src="" style="width: 264px; height: 111px;  margin-bottom:10px;" /></a>' +
							'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>' +
						'</div>' +
						'<div class="gs_4" style="margin-right:0px;">' +
							'<a class="zoomer" href="/" rel="prettyPhoto"><img alt="" class="border_magic" src="" style="width: 264px; height: 111px;  margin-bottom:10px;" /></a>' +
							'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>' +
						'</div>' +
						'<div class="gs_4 omega" style="margin-right:0px;">' +
							'<a class="zoomer" href="/" rel="prettyPhoto"><img alt="" class="border_magic" src="" style="width: 264px; height: 111px;  margin-bottom:10px;" /></a>' +
							'<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>' +
						'</div>' +
						'<p style="margin-left:25px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>'
			},
			{
				title:'Texte focus',
				image:'focus.gif',
				description:'Image 48/48px',
				html:'' +
						'<h3 class="widgettitle">Lorem ipsum</h3>' +
						'<p>' +
							'<img alt="" src="" style="width: 48px; height: 48px; float: left; margin-right: 5px; margin-bottom: 5px;" />' +
							'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' +
						'</p>' +
						'<p>' + 
							'<a class="superbutton" href="/">Lorem ipsum</a>' + 
						'</p>'
			},
			{
				title:'Texte portrait',
				image:'focus.gif',
				description:'Image 128/128px',
				html:'' +
						'<h3 class="widgettitle">Lorem ipsum</h3>' +
						'<h5 class="widgettitle">Lorem ipsum</h5>' +
						'<p>' +
							'<img alt="" src="" class="border_magic" style="width: 128px; height: 128px; float: left; margin-right: 5px; margin-bottom: 5px;" />' +
							'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.' +
						'</p>' +
						'<p>' + 
							'<a class="superbutton" href="/">Lorem ipsum</a>' + 
						'</p>'
			},
		]
});
