<?php
/**
 * Admin CP 设置控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

class Controller_Setting extends \Core\Controller\Admin {

    public function IndexAction() {
        $Query   = new \Service\Setting\Query();
        $Setting = $Query->getEntity();

        $this->getView()->assign("setting", $Query->getAssoc());
        $this->getView()->display("setting/index.html");
    }
}
