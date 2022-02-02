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
        switch ($action) {
            case 'publish' :
                $result = $model->publish('sites', $all_id);
                break;

            case 'unpublish' :
                $result = $model->unpublish('sites', $all_id);
                break;

            case 'delete' :
                $result = false;
                $ids_array = explode(',', $all_id);
                $bad_ids = array();
                $valid_ids = array();
                foreach ($ids_array as $site_id) {
                    if ($model->Count_Rows('works', " WHERE site_id = '" . $site_id . "' ") == 0) {
                        $valid_ids[] = $site_id;
                    } else {
                        $bad_ids[] = $site_id;
                    }
                }
                if (is_array($valid_ids)) {
                    $valid2_ids = array();
                    foreach ($valid_ids as $site_id) {
                        if ($model->Count_Rows('menus', " WHERE site_id = '" . $site_id . "' ") == 0) {
                            $valid2_ids[] = $site_id;
                        } else {
                            $bad_ids[] = $site_id;
                        }
                    }
                }
                if (is_array($valid2_ids)) {
                    $valid3_ids = array();
                    foreach ($valid2_ids as $site_id) {
                        if ($model->Count_Rows('pages', " WHERE site_id = '" . $site_id . "' ") == 0) {
                            $valid3_ids[] = $site_id;
                        } else {
                            $bad_ids[] = $site_id;
                        }
                    }
                }
                unset($site_id);
                if (!empty($valid3_ids)) {
                    $done_ids = implode(',', $valid3_ids);
                    $result = $model->Wipe('sites', $done_ids);
                }
                if (!empty($bad_ids)) {
                    if($bad_ids[0] == 0) { unset($bad_ids[0]);}
                    $result = ($result == true ) ? true : false;
                    $count_not_deleted = (count($bad_ids) > 1) ? count($bad_ids) . ' sites ' : count($bad_ids) . ' site ';
                    $count_items = (count($bad_ids) > 1) ? ' items ' : ' item ';
                    $msg2 .= '<br/>Notice  : ' . $count_not_deleted . ' have not been delete them for the existence of ' . $count_items . ' Related .  ';
                }
                unset($done_ids);
                unset($valid_ids);
                break;
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
?>