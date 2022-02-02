<?php
/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
ob_start();
session_start();
$session = new Session();
$model = new model();
if(isset($_POST['login']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        $email = $model->filtrate($_POST['email'], false);
        $pass  = sha1($model->filtrate($_POST['password'], false));
        $authenticate = $model->Authenticate($email, $pass);
        if(is_array($authenticate))
        {
            $id = $authenticate[0]['id'] ;
            $username = $authenticate[0]['username'];
            $alias = $authenticate[0]['alias'];
            $avatar = $authenticate[0]['avatar'];
            
            $session->login($id,$username,$alias,$avatar);
            $model->redirect_to(ADMIN_URL.'sites');
        }else
        {
            $session->message('ERROR ... Your Email and  Password is Not Match .','alert alert-danger');
            $model->redirect_to(ADMIN_URL.'login');
        }
    }else
    {
        $session->message('ERROR ... Your Email and  Password is Not Match .','alert alert-danger');
        $model->redirect_to(ADMIN_URL.'login');
    }
}else
{
    $session->message('ERROR ... Your Email and  Password is Not Match .','alert alert-danger');
    $model->redirect_to(ADMIN_URL.'login');
}
?>