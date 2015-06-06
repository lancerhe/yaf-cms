<?php
/**
 * Admin CP Ajax 设置控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

class Controller_Setting extends \Core\Controller\Ajax {

    public function SaveAction() {
        $Setting = new \Service\Setting\Entity();
        $Setting->site_name      = $this->getRequest()->getPost('site_name');
        $Setting->site_keywords  = $this->getRequest()->getPost('site_keywords');
        $Setting->site_descrip   = $this->getRequest()->getPost('site_descrip');
        $Setting->site_copyright = $this->getRequest()->getPost('site_copyright');
        $Setting->site_icp       = $this->getRequest()->getPost('site_icp');
        $Setting->site_phone     = $this->getRequest()->getPost('site_phone');
        $Setting->site_address   = $this->getRequest()->getPost('site_address');
        $Setting->site_qq        = $this->getRequest()->getPost('site_qq');
        $Setting->save();
        $this->getView()->display('保存成功');
    }
}