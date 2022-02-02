<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
$model = new model();
$where = " WHERE articles.user_id = users.id AND articles.category_id = categories.id ";
$select = " articles.id,articles.title,articles.alias,articles.status,articles.created,articles.modified,users.id as user_id,users.username,categories.id as category_id,categories.name as category_name ";
$items = $model->Get('articles,categories,users', $select, $where);
?>
<div class="main-container" id="main-container">
    <?php require ADMIN_PATH . DS . 'views' . DS . 'sidebar.php'; ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <!--<a href="<?php // echo ADMIN_URL; ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active">Blog</li>
                    <li class="active">Articles</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1 class="col-xs-12 col-sm-10"> Blog
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            List of Blog Articles
                        </small>
                    </h1>
                    <a href="<?php echo ADMIN_URL; ?>blog/new_article" class="btn btn-success col-xs-12 col-sm-2 btn-sm">New </a>
                    <div class="clearfix"></div>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <?php
                        echo (!empty($session->message)) ? $session->message : null;
                        ?>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center" width="5%">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" value="0" />
                                            <span class="lbl"></span>
                                        </label>
                                    </th>
                                    <th width="60%">Name</th>
                                    <th class="center" width="10%">User</th>
                                    <th class="center" width="15%">Category</th>
                                    <th class="center" width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($items)) {
                                    foreach ($items as $item) {
                                        $title_array = (isset($item['title'])) ? unserialize(base64_decode($item['title'])) : array();
                                        $title = is_array($title_array) ? $model->Cut_Words($title_array['en'],0,50) : '';
                                        $summary_title = $model->Cut_Words($title, 0, 100, 'yes');
                                        $_alias = (isset($item['alias'])) ? $item['alias'] : '';
                                        $category_id = (isset($item['category_id'])) ? $item['category_id'] : 0;
                                        $category_name_array = (isset($item['category_name'])) ? unserialize(base64_decode($item['category_name'])) : array();
                                        $category_name = (is_array($category_name_array)) ? $model->Cut_Words($category_name_array['en'],0,20) : '';
                                        $summary_category_name = $model->Cut_Words($category_name, 0, 50, 'yes');
                                        $author_id = (isset($item['user_id'])) ? $item['user_id'] : 0;
                                        $author = (isset($item['username'])) ? $item['username'] : '';
                                        $_created = (isset($item['created']) && $item['created'] != 0) ? date('d-m-Y   h:i A', $item['created']) : 'No Date';
                                        $_modified = (isset($item['modified']) && $item['modified'] != 0) ? date('d-m-Y   h:i A', $item['modified']) : 'Not Modified';
                                        ?>
                                        <tr>
                                            <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace" value="<?php echo $item['id']; ?>" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="<?php echo ADMIN_URL . 'blog/edit_article/' . $item['id']; ?>"><?php echo $summary_title; ?></a>
                                                <br/><small class="grey"><strong>Created:</strong> <?php echo $_created; ?></small><br/>
                                                <small class="grey"><strong>Modified:</strong> <?php echo $_modified; ?></small> 
                                            </td>
                                            <td class="center" width="10%"><a href="<?php echo ADMIN_URL.'users/profile/'.$author_id; ?>"><?php echo $author; ?></a></td>
                                            <td class="center" width="10%"><a href="<?php echo ADMIN_URL.'blog/edit_category/'.$category_id; ?>"><?php echo $summary_category_name; ?></a></td>
                                            <td class="center">
                                                <div class="action-buttons">
                                                    <a href="<?php echo URL.'ar/blog/'.$_alias; ?>" target="_blank" data-rel="tooltip" data-placement="top" title="Show Article" >
                                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                                    </a>
                                                    <a href="#" value="<?php echo $item['id']; ?>" data-rel="tooltip" data-placement="top" title="<?php echo ($item['status'] == 0) ? 'UnPublished' : 'Published'; ?>" onclick="action(this)" status="<?php echo ($item['status'] == 0) ? 'publish' : 'unpublish'; ?>" >
                                                        <i class="ace-icon fa fa- <?php echo ($item['status'] == 0) ? 'fa-minus-circle red' : 'fa-check green'; ?> bigger-130"></i>
                                                    </a>
                                                    <a href="<?php echo ADMIN_URL . 'blog/edit_article/' . $item['id']; ?>" data-rel="tooltip" data-placement="top" title="Edit">
                                                        <i class="ace-icon fa fa-pencil green bigger-130"></i>
                                                    </a>
                                                    <a href="#" onclick="action(this)" status="delete" value="<?php echo $item['id']; ?>" data-rel="tooltip" data-placement="top" title="Delete">
                                                        <i class="ace-icon fa fa-trash-o red bigger-130"></i>
                                                    </a>
                                                </div>
                                            </td>
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
                                                        $(document).ready(function() {
                                                            //        table ......
                                                            //         //initiate dataTables plugin
                                                            var oTable1 =
                                                                    $('#dynamic-table')
                                                                    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                                                                    .dataTable({
                                                                        bAutoWidth: false,
                                                                        "aoColumns": [
                                                                            {"bSortable": false}, null, null, null, {"bSortable": false}
                                                                        ],
                                                                        "aaSorting": []
                                                                    });
                                                            //initiate TableTools extension
                                                            var tableTools_obj = new $.fn.dataTable.TableTools(oTable1, {
                                                                "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
                                                                "sRowSelector": "td:not(:last-child)",
                                                                "sRowSelect": "multi",
                                                                "fnRowSelected": function(row) {
                                                                    //check checkbox when row is selected
                                                                    try {
                                                                        $(row).find('input[type=checkbox]').get(0).checked = true
                                                                    }
                                                                    catch (e) {
                                                                    }
                                                                },
                                                                "fnRowDeselected": function(row) {
                                                                    //uncheck checkbox
                                                                    try {
                                                                        $(row).find('input[type=checkbox]').get(0).checked = false
                                                                    }
                                                                    catch (e) {
                                                                    }
                                                                },
                                                                "sSelectedClass": "success"
                                                            });

                                                            $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function() {
                                                                var th_checked = this.checked;//checkbox inside "TH" table header

                                                                $(this).closest('table').find('tbody > tr').each(function() {
                                                                    var row = this;
                                                                    if (th_checked)
                                                                        tableTools_obj.fnSelect(row);
                                                                    else
                                                                        tableTools_obj.fnDeselect(row);
                                                                });
                                                            });
                                                            //select/deselect a row when the checkbox is checked/unchecked
                                                            $('#dynamic-table').on('click', 'td input[type=checkbox]', function() {
                                                                var row = $(this).closest('tr').get(0);
                                                                if (!this.checked)
                                                                    tableTools_obj.fnSelect(row);
                                                                else
                                                                    tableTools_obj.fnDeselect($(this).closest('tr').get(0));
                                                            });

                                                            //    actions ........
                                                            $('#dynamic-table_wrapper > div:first-child').append('<div class="col-xs-12 col-sm-6 actions"></div>');
                                                            $('#dynamic-table_wrapper .actions').append('<strong>Actions: </strong>');
                                                            $('#dynamic-table_wrapper .actions').append('<a href="#" action="publish" class="action" data-rel="tooltip" data-placement="top" title="Publish"><i class="ace-icon fa fa- fa-check green bigger-130"></i></a>');
                                                            $('#dynamic-table_wrapper .actions').append('<a href="#" action="unpublish" class="action" data-rel="tooltip" data-placement="top" title="UnPublish"><i class="ace-icon fa fa- fa-minus-circle red bigger-130"></i></a>');
                                                            $('#dynamic-table_wrapper .actions').append('<a href="#" action="delete" class="action" data-rel="tooltip" data-placement="top" title="Delete"><i class="ace-icon fa fa- fa-trash-o red bigger-130"></i></a>');

                                                            //        tooltip .........
                                                            $('[data-rel=tooltip]').tooltip();
                                                        });
                                                        function action(anchor) {
                                                            var id = anchor.getAttribute('value');
                                                            var action = anchor.getAttribute('status');
                                                            if (action == 'delete')
                                                            {
                                                                var x = confirm(' Do you want to delete ? ');
                                                                if (x == true)
                                                                {
                                                                    $.get("<?php echo ADMIN_URL ?>views/blog/articles_action.php?status=1&action=" + action + "&id=" + id, function(dd) {
                                                                        location.reload();
                                                                    });
                                                                }
                                                            } else
                                                            {
                                                                $.get("<?php echo ADMIN_URL ?>views/blog/articles_action.php?status=1&action=" + action + "&id=" + id, function(dd) {
                                                                    location.reload();
                                                                });
                                                            }
                                                        }
                                                        $(function() {
                                                            $('.action').click(function() {
                                                                var action = $(this).attr('action');
                                                                var val = [];
                                                                $(':checkbox:checked').each(function(i) {
                                                                    val[i] = $(this).val();
                                                                });
                                                                var id = val;
                                                                if (id.length == 0)
                                                                {
                                                                    alert('Please choose at least one element of the command is executed');
                                                                } else
                                                                {
                                                                    if (action == 'delete')
                                                                    {
                                                                        var x = confirm(' Do you want to delete ? ');
                                                                        if (x == true)
                                                                        {
                                                                            $.get("<?php echo ADMIN_URL ?>views/blog/articles_action.php?action=" + action + "&id=" + id, function(dd) {
                                                                                location.reload();
                                                                            });
                                                                        }
                                                                    } else
                                                                    {
                                                                        $.get("<?php echo ADMIN_URL ?>views/blog/articles_action.php?action=" + action + "&id=" + id, function(dd) {
                                                                            location.reload();
                                                                        });
                                                                    }
                                                                }
                                                            });
                                                        });

</script>
