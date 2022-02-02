<?php

/*
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */
ob_start();
session_start();
require_once '../../../config.php';
require_once '../../core/controller.php';
require_once '../../core/view.php';
require_once '../../core/model.php';
require_once '../../core/session.php';
$model = new model();
$session = new Session();

if (isset($_GET['id'])) {
    $all_id = $_GET['id'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $msg = '';
        $msg2 = '';
        $result = FALSE;
        switch ($action) {
            case 'publish' :
                $result = $model->publish('menus', $all_id);
                break;

            case 'unpublish' :
                $result = $model->unpublish('menus', $all_id);
                break;

            case 'delete' :
                $ids_array = explode(',', $all_id);
                $bad_ids = array();
                $valid_ids = array();
                foreach ($ids_array as $link_id) {
                    if ($model->Is_There_Sons('menus',$link_id) == 0) {
//                        if ($model->Check_items_Under_category('articles',$link_id) == 0) {
//                            $valid_ids[] = $link_id;
//                        } else {
//                            $bad_ids[] = $link_id;
//                        }
                        $valid_ids[] = $link_id;
                    } else {
                        $bad_ids[] = $link_id;
                    }
                }
                unset($link_id);
                if (!empty($valid_ids)) {
                    echo $done_ids = implode(',', $valid_ids);
                    echo $result = $model->Wipe('menus',$done_ids);
                }
                if (!empty($bad_ids)) {
                    $result = ($result == true ) ? true : false;
                    $count_not_deleted = (count($bad_ids) > 1) ? count($bad_ids) . ' menus ' : count($bad_ids) . ' category ';
                    $count_items = (count($bad_ids) > 1) ? ' items ' : ' item ';
                    $msg2 .= '<br/>Notice  : ' . $count_not_deleted . ' have not been delete them for the existence of ' . $count_items . ' Related .  ';
                }
                unset($done_ids);
                unset($valid_ids);
                break;
        }
        if ($result) {
            $msg .= 'successful operation ';
            $msg .= (!empty($msg2)) ? $msg2 : null;
            $session->message($msg, 'alert alert-success');
        } else {
            $msg .= 'failed operation';
            $msg .= (!empty($msg2)) ? $msg2 : null;
            $session->message($msg, 'alert alert-danger');
        }
    }
} else {
    echo 'Please choose at least one element of the command is executed';
}

echo 'Please choose at least one element of the command is executed';
?>