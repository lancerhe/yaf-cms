<?php
/**
 * Admin CP 后台注销控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

class Controller_Logout extends \Core\Controller\Admin {

    public function IndexAction() {
        Service\Manager\Dispatcher::getInstance()->getSession()->del();
        $this->redirect('/admin/login/index');
    }
}