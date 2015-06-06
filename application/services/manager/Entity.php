<?php
/**
 * 管理员实体类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-17
 */

namespace Service\Manager;

use Service\Manager\RoleList;
use Service\Manager\Session;
use Service\Manager\Exception\PasswordNotMatchException;
use Service\Core\Entity as Core_Entity;

class Entity extends Core_Entity {

    protected $_properties = [
        'mid'            => 0,
        'username'       => '',
        'password'       => '',
        'name'           => '',
        'lastloginip'    => '',
        'lastlogouttime' => 0,
        'createtime'     => 0,
        'updatetime'     => 0,
        'deleted'        => 0,
    ];

    /**
     * 验证管理员密码是否一致
     * @param  string  $password  非加密密码
     * @return void|exception 
     */
    public function validatePassword($password) {
        if ( md5($password) !== $this->_properties['password'] ) {
            throw new PasswordNotMatchException();
        }
    }

    /**
     * 记录管理员登陆信息
     * @return void
     */
    public function saveLogin() {
        (new Session())->save($this);
    }

    /**
     * 设置用户名
     * @param  string  $username  用户名
     * @return void
     */
    public function setUsername($username) {
        if ( trim($username) )
            $this->setProperty('username', trim($username) );
    }

    /**
     * 设置密码
     * @param  string  $password  非加密密码
     * @return void
     */
    public function setPassword($password) {
        if ( $password )
            $this->setProperty('password', md5($password));
    }

    /**
     * 删除
     * @return void
     */
    public function trash() {
        $this->setProperty('updatetime', time());
        $this->setProperty('deleted', 1);
        $model = new \Model_Manager();
        $model->updateRowByPk($this->_properties['mid'], $this->_changed);
    }

    /**
     * 更新
     * @return void
     */
    public function save() {
        $Validate = new Validate($this);
        $Validate->edit();
        $this->setProperty('updatetime', time());
        $model = new \Model_Manager();
        $model->updateRowByPk($this->_properties['mid'], $this->_changed);
    }

    /**
     * 创建
     * @return void
     */
    public function create() {
        $Validate = new Validate($this);
        $Validate->create();
        $this->_properties['createtime'] = time();
        $model = new \Model_Manager();
        $model->insertRow($this->_properties);
    }
}