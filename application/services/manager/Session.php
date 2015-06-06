<?php
/**
 * 管理员会话
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-17
 */

namespace Service\Manager;

use Service\Manager\Entity;
use Service\Manager\Exception\NotLoginException;

class Session {

    /**
     * 会话是否存在
     * @return boolean
     */
    public function has() {
        return \Core\Session::getInstance()->has('Manager');
    }

    /**
     * 获取会话
     * @return mixed
     */
    public function get() {
        return \Core\Session::getInstance()->get('Manager');
    }

    /**
     * 删除会话
     * @return boolean
     */
    public function del() {
        return \Core\Session::getInstance()->del('Manager');
    }

    /**
     * 保存会话
     * @param  Entity  $Manager 管理员对象
     * @return void
     */
    public function save(Entity $Manager) {
        \Core\Session::getInstance()->set('Manager', $Manager);
    }

    /**
     * 强制是否登陆
     * @return void|exception
     */
    public function forceLogin() {
        if ( ! $this->has() ) {
            throw new NotLoginException();
        }
    }
}