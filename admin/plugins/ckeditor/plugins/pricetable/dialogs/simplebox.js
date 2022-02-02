/* 
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */

CKEDITOR.dialog.add('simplebox', function(editor) {
    return {
        title: 'Edit Simple Box ..',
        minWidth: 500,
        minHeight: 300,
        contents: [
            {
                id: 'info',
                elements: [
                    {
                        id: 'align',
                        type: 'select',
                        label: 'Align',
                        items: [
                            [editor.lang.common.notSet, ''],
                            [editor.lang.common.alignLeft, 'left'],
                            [editor.lang.common.alignRight, 'right'],
                            [editor.lang.common.alignCenter, 'center']
                        ],
                        setup: function(widget) {
                            this.setValue(widget.data.align);
                        },
                        commit: function(widget) {
                            widget.setData('align', this.getValue());
                        }
                    },
                    {
                        id: 'width',
                        type: 'text',
                        label: 'Width',
                        width: '100px',
                        setup: function(widget) {
                            this.setValue(widget.data.width);
                        },
                        commit: function(widget) {
                            widget.setData('width', this.getValue());
                        }
                    }

                ]
            }
        ],
        onOk: function() {
//            var dialog = this;
////                alert(dialog.getValueOf('info', 'width'));s
//            var abbr = editor.document.createElement('h1');
////            abbr.setAttribute('title', dialog.getValueOf('info', 'width'));
//            abbr.setText(dialog.getValueOf('info', 'width'));
//
////            var id = dialog.getValueOf('tab-adv', 'id');
////            if (id)
////                abbr.setAttribute('id', id);
//
//            editor.insertElement(abbr);
        }
    };
});
