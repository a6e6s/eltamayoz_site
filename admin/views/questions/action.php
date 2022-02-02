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
                $result = $model->publish('questions', $all_id);
                break;

            case 'unpublish' :
                $result = $model->unpublish('questions', $all_id);
                break;

            case 'delete' :
                $result = $model->Wipe('questions', $all_id);
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