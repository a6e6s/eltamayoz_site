/* 
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
CKEDITOR.plugins.add('abbr', {
    requires: 'widget',
    icons: 'abbr',
    init: function(editor) {
        // Plugin logic goes here...
        editor.addCommand('abbr', new CKEDITOR.dialogCommand('abbrDialog'));
        editor.ui.addButton('Abbr', {
            label: 'Insert Abbreviation',
            command: 'abbr',
            toolbar: 'insert',
        });
         CKEDITOR.dialog.add( 'abbrDialog', this.path + 'dialogs/abbr.js' );
    }
});

