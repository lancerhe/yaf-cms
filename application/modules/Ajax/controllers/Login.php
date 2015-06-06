<?php
/**
 * Admin CP Ajax 登录控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

class Controller_Login extends \Core\Controller\Ajax {

    public function IndexAction() {
        $username = $this->getRequest()->getPost('username');
        $password = $this->getRequest()->getPost('password');

        $Query = new Service\Manager\Query($username);
        $Entity = $Query->getEntity();
        $Entity->validatePassword($password);
        $Entity->saveLogin();
        $this->getView()->display('登陆成功');
    }

    public static function defaultExceptionHandler( $exception, $view ) {
        $view->display("登录失败，请输入正确的账户密码", array(), $exception->getCode());
    }
}