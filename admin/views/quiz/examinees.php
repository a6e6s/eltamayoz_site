<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
$model = new model();
if (!isset($id) || empty($id) || !is_numeric($id)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'quiz/items');
}
$quiz = $model->Get('quiz', 'id', " WHERE id = '" . $id . "' ");
if (!is_array($quiz)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'quiz/items');
}
$quiz_examinees = $model->Get('quiz_examinees', '*', " WHERE quiz_id = $id ");
?>
<div class="main-container" id="main-container">
    <?php require ADMIN_PATH . DS . 'views' . DS . 'sidebar.php'; ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <!--<a href="<?php // echo ADMIN_URL;         ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active">Quizzes</li>
                    <li class="active">Items</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1 class="col-xs-12 col-sm-10"> Quizzes</h1>
                    <div class="clearfix"></div>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/colorbox.min.css" />
                        <?php
                        echo (!empty($session->message)) ? $session->message : null;
                        ?>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
<!--                                    <th class="center" width="5%">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" value="0" />
                                            <span class="lbl"></span>
                                        </label>
                                    </th>-->
                                    <th width="30%">Name</th>
                                    <th class="center" width="25%">Email</th>
                                    <th class="center" width="15%">Phone</th>
                                    <th class="center" width="30%">Results</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($quiz_examinees)) {
                                    foreach ($quiz_examinees as $item) {
                                        $_id = (isset($item['id'])) ? $item['id'] : array();
                                        $_username = (isset($item['username'])) ? $item['username'] : '';
                                        $_email = (isset($item['email'])) ? $item['email'] : ' -- ';
                                        $_phone = (isset($item['phone'])) ? $item['phone'] : ' -- ';
                                        $_created = (isset($item['created_date']) && $item['created_date'] != 0) ? date('d-m-Y   h:i A', $item['created_date']) : 'No Date';
                                        $where = " WHERE quiz_examinees_results.quiz_examinees_id = '" . $_id . "' AND quiz_examinees_results.quiz_questions_id = quiz_questions.id  ";
                                        $select = " quiz_examinees_results.option_id,quiz_questions.title,quiz_questions.options ";
                                        $quiz_options = $model->Get('quiz_examinees_results,quiz_questions', $select, $where, 'quiz_examinees_results.id');
                                        $option_result = '';
                                        if (is_array($quiz_options)) {
                                            for ($x = 0; $x < count($quiz_options); $x++) {
                                                $_options_array = (isset($quiz_options[$x]['options'])) ? unserialize(base64_decode($quiz_options[$x]['options'])) : [];
                                                $_question_title_array = (isset($quiz_options[$x]['title'])) ? unserialize(base64_decode($quiz_options[$x]['title'])) : [];
                                                $_question_title = isset($_question_title_array['en']) ? $model->Cut_Words($_question_title_array['en'], 0, 30) : '';
                                                $option_id = 'option_' . $quiz_options[$x]['option_id'] . '_en';
                                                foreach ($_options_array as $kay => $val) {
                                                    if ($kay == $option_id) {
                                                        $option_result .= $_question_title . ' => ' . $val . '<br/>';
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        <tr>
<!--                                            <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace" value="<?php // echo $item['id']; ?>" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>-->
                                            <td>
                                                <?php echo $_username; ?>
                                                <br/><small class="grey"><strong>Created:</strong> <?php echo $_created; ?></small>
                                            </td>
                                            <td class="center"><?php echo $_email; ?></td>
                                            <td class="center"><?php echo $_phone; ?></td>
                                            <td class="center"><?php echo $option_result; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
<script src="<?php echo ADMIN_URL ?>templates/js/jquery.dataTables.min.js"></script>
<script src="<?php echo ADMIN_URL ?>templates/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo ADMIN_URL ?>templates/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //        table ......
        //         //initiate dataTables plugin
        var oTable1 =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                         null, null,null,
                        {"bSortable": false}
                    ],
                    "aaSorting": []
                });
        //initiate TableTools extension
        var tableTools_obj = new $.fn.dataTable.TableTools(oTable1, {
            "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
            "sRowSelector": "td:not(:last-child)",
            "sRowSelect": "multi",
            "fnRowSelected": function (row) {
                //check checkbox when row is selected
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = true
                } catch (e) {
                }
            },
            "fnRowDeselected": function (row) {
                //uncheck checkbox
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = false
                } catch (e) {
                }
            },
            "sSelectedClass": "success"
        });

        $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked)
                    tableTools_obj.fnSelect(row);
                else
                    tableTools_obj.fnDeselect(row);
            });
        });
        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
            var row = $(this).closest('tr').get(0);
            if (!this.checked)
                tableTools_obj.fnSelect(row);
            else
                tableTools_obj.fnDeselect($(this).closest('tr').get(0));
        });

//        //    actions ........
//        $('#dynamic-table_wrapper > div:first-child').append('<div class="col-xs-12 col-sm-6 actions"></div>');
//        $('#dynamic-table_wrapper .actions').append('<strong>Actions: </strong>');
//        $('#dynamic-table_wrapper .actions').append('<a href="#" action="delete" class="action" data-rel="tooltip" data-placement="top" title="Delete"><i class="ace-icon fa fa- fa-trash-o red bigger-130"></i></a>');

        //        tooltip .........
        $('[data-rel=tooltip]').tooltip();
    });
</script>
