<?php
/**
 * 请求调度器 
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-18
 */

namespace Service\Manager;

use Service\Manager\Entity as Manager;
use Service\Manager\Session;

class Dispatcher {

    /**
     * Service\Manager\Session
     * @var object
     */
    protected $_Session = null;

    /**
     * Service\Manager\Entity
     * @var object
     */
    protected $_Manager = null;

    private function __construct() {}

    private function __clone() {}

    /**
     * 单例模式
     * @return Dispatcher
     */
    public static function getInstance() {
        $registry_class = get_called_class();
        if ( $instance = \Yaf\Registry::get( $registry_class ) ) {
            return $instance;
        }
        $instance = new self();
        $instance->initSession(new Session());
        \Yaf\Registry::set( $registry_class, $instance );
        return $instance;
    }

    /**
     * 初始化会话Session
     * @param  Session $Session  会话对象
     * @return void
     */
    public function initSession(Session $Session) {
        $this->_Session = $Session;
        $this->_Session->forceLogin();
        $this->initManager($this->_Session->get());
    }

    /**
     * 初始化会话Session
     * @param  Manager $Manager  管理员实体对象
     * @return void
     */
    public function initManager(Manager $Manager) {
        $this->_Manager = $Manager;
    }

    /**
     * 获取管理员实体对象
     * @return Manager
     */
    public function getManager() {
        return $this->_Manager;
    }

    /**
     * 获取管理员会话对象
     * @return Session
     */
    public function getSession() {
        return $this->_Session;
    }
}