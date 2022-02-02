CKEDITOR.plugins.add('headingcenter', {
    icons: 'headingcenter',
    init: function(editor) {
//        CKEDITOR.dialog.add('simplebox', this.path + 'dialogs/simplebox.js');

        editor.widgets.add('headingcenter', {
            button: 'heading center',
            template:
                    '<div class="heading">' +
                    '<h2 class="wow zoomIn" data-wow-delay=".5s">heading </h2>' +
                    '<div class="line">' +
                    '<span></span>'+
                    '<span></span>'+
                    '</div>' +
                    '</div>'+
                    '<p>&nbsp;</p>',
            editables: {
                title: {
                    selector: '.heading h2'
                }
            }
//            dialog: 'simplebox'
        });
    }
});