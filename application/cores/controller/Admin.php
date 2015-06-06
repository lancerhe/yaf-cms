<?php
/**
 * 应用核心控制器类  \Core\Controller\Admin
 * Admin 请求控制器基类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-06-02
 */
namespace Core\Controller;

class Admin extends \Core\Controller {

    public function init() {
        $this->getView()->assign("view_path", APPLICATION_MODULES_PATH . "/" . $this->getRequest()->getModuleName() . "/views");
        if ( "Login" === $this->getRequest()->getControllerName() )
            return;

        $this->initSession();
        $this->initAssign();
    }

    /**
     * 初始化会话
     * @return void
     */
    public function initSession() {
        try {
            \Service\Manager\Dispatcher::getInstance();
        } catch(\Service\Manager\Exception\NotLoginException $e) {
            $this->redirect('/admin/login/index');
            exit();
        }
    }

    /**
     * 初始化赋值
     * @return void
     */
    public function initAssign() {
        $this->getView()->assign("manager", \Service\Manager\Dispatcher::getInstance()->getManager()->getProperties());
    }

    /**
     * 获取当前Page
     * @return int
     */
    public function getCurrentPage() {
        $page  = intval($this->getRequest()->getQuery('page'));
        return (1 > $page) ? 1 : $page;
    }

    /**
     * 获取分页pagesize
     * @return int
     */
    public function getPageLimit() {
        return 10;
    }

    /**
     * 获取分页开始Start值
     * @return int
     */
    public function getPageStart() {
        return ($this->getCurrentPage() - 1) * $this->getPageLimit();
    }
}