/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
//	 config.language = 'fr';
//    config.uiColor = '#AADC6E';
    
    config.height = 500;        // 500 pixels.
    config.allowedContent = true;   
};
CKEDITOR.dtd.$removeEmpty['span'] = false;
