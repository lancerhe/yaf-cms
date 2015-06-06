<?php
/**
 * Admin CP 综述管理控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

class Controller_Index extends \Core\Controller\Admin {

    /**
     * 综述
     */
    public function IndexAction() {
        $this->getView()->display('index/index.html');
    }
}