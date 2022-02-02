CKEDITOR.plugins.add('pricetable', {
    icons: 'pricetable',
    init: function(editor) {
//        CKEDITOR.dialog.add('simplebox', this.path + 'dialogs/simplebox.js');

        editor.widgets.add('pricetable', {
            button: 'Price Table',
            template:
                    '<div class="plan-wrapper col-xs-12 col-sm-6 col-md-3">' +
                    '<div class="plan col-xs-12 wow zoomIn" data-wow-delay=".5s">' +
                    '<price>' +
                    '<num>100</num>' +
                    '<period>ريال - سنويا</period>' +
                    '</price>' +
                    '<plan class="row">الخطة الأولى</plan>' +
                    '<ul class="fetures row">' +
                    '<li></li>' +
                    '<li>24/7  دعم فنى</li>' +
                    '<li>1GB  مساحة تخزين</li>' +
                    '<li>10GB  تبادل بيانات</li>' +
                    '<li>ترقية مجانية</li>' +
                    '<li>دومين مجانى</li>' +
                    '<li>دومينات فرعية غير محدوده</li>' +
                    '<li>حسابات FTP غير محدوده</li>' +
                    '<li>لوحة تحكم  C-Panal</li>' +
                    '<li>إسترجاع الأموال</li>' +
                    '<li></li>' +
                    ' </ul>' +
                    '<a href="#" class="readmore">إشترك الآن</a>' +
                    '</div>' +
                    '</div>',
            editables: {
                title: {
                    selector: '.plan-wrapper'
                }
            }
//            dialog: 'simplebox'
        });
    }
});