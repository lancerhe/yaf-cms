<?php
/**
 * Admin CP 后台登录控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

class Controller_Login extends \Core\Controller\Admin {

    public function IndexAction() {
        $Session = new Service\Manager\Session();
        if ( $Session->has() ) {
            $this->redirect('/admin/index/index');
            exit();
        }
        $this->getView()->display('login/index.html');
    }
}