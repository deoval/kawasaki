/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.stylesSet.add( 'my_styles', [
    // Block-level styles
    { name: 'Titulo', element: 'h2', styles: {} },
    { name: 'Titulo 2' , element: 'h3', styles: {} },
    { name: 'Titulo 3' , element: 'h4', styles: {} },
    { name: 'Titulo 4' , element: 'h5', styles: {} },
    { name: 'Titulo 5' , element: 'h6', styles: {} },

    // Inline styles
    { name: 'Obs', element: 'span', styles: { 'font-size': '11px !important', 'display': 'block !important', 'width': '100% !important', 'color': '#2a2b2d !important', 'line-height': '17px !important', 'margin-top': '27px !important' } }
    //{ name: 'Obs', element: 'span', attributes: { 'class': 'my_style' } },
] );

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
    config.language = 'pt-br';
    //config.uiColor = '#494437';
    config.extraPlugins = 'youtube';
    config.allowedContent = true;
    config.filebrowserBrowseUrl = '../../_assets/js/componente/ckeditor/ckfinder/ckfinder.html',
    config.filebrowserImageBrowseUrl = '../../_assets/js/componente/ckeditor/ckfinder/ckfinder.html?type=Images',
    config.filebrowserFlashBrowseUrl = '../../_assets/js/componente/ckeditor/ckfinder/ckfinder.html?type=Flash',
    config.filebrowserUploadUrl = '../../_assets/js/componente/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    config.filebrowserImageUploadUrl = '../../_assets/js/componente/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    config.filebrowserFlashUploadUrl = '../../_assets/js/componente/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
    config.skin = 'bootstrapck',
    config.forcePasteAsPlainText = true,
    config.resize_enabled = true,
    config.resize_maxWidth = 970,
    config.resize_maxHeight = 800,
    config.stylesSet = 'my_styles';
    config.toolbar_Default = [
        ['Source', '-', 'Undo', 'Redo', 'Maximize'],
        ['Styles', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['Link', 'Unlink'],
        ['Youtube', 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'BulletedList']
    ];
    /*
    config.toolbar_Default = [
        ['Source', '-', 'Undo', 'Redo', 'Maximize'],
        ['Format', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['Link', 'Unlink'],
        ['Youtube', 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'BulletedList']
    ];
    */
};
