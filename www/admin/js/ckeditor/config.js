/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {

    config.toolbarGroups = [
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing']},
        {name: 'links', groups: ['links']},
        {name: 'insert', groups: ['insert']},
        {name: 'forms', groups: ['forms']},
        {name: 'tools', groups: ['tools']},
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'others', groups: ['others']},
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']},
        {name: 'styles', groups: ['styles']},
        {name: 'colors', groups: ['colors']},
        {name: 'about', groups: ['about']}
    ];


    config.removeDialogTabs = 'image:advanced;image:Link;link:advanced;link:upload';

    config.removeButtons = 'Subscript,Superscript,Find,Replace,SelectAll,Flash,Smiley,PageBreak,Iframe,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,ShowBlocks,Save,NewPage,Preview,Print,Templates,CopyFormatting,Underline,CreateDiv,BidiLtr,BidiRtl,Language,Font,FontSize,TextColor,BGColor,About';

    //URL atual, incluindo porta, protocolo e locale
    var url = window.location.href;
    url = url.split('/');
    url = url[0] + '//' + url[2] + '/' + url[3];

    config.filebrowserUploadUrl = url+'/admin/ckeditor-upload';
};