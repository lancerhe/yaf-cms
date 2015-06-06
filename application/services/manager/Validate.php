<?php
/**
 * 管理员验证类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-18
 */

namespace Service\Manager;

use Service\Manager\Entity as Manager;
use Service\Manager\Exception\UsernameExistException;
use Core\Exception\RequestParameterException;

class Validate {

    /**
     * 管理员对象
     * @var Entity
     */
    public $Manager;

    /**
     * 初始化需要验证的管理员对象
     * @return void
     */
    public function __construct(Manager $Manager) {
        $this->Manager = $Manager;
    }

    /**
     * 验证创建管理员
     */
    public function create() {
        $this->_fieldUsername();
        $this->_fieldPassword();
        $this->_hasUsernameExist();
    }

    /**
     * 验证编辑管理员
     */
    public function edit() {
        $this->_fieldUsername();
        $this->_fieldPassword();
        $this->_hasUsernameExist();
    }

    /**
     * 验证管理员用户名是否已经存在
     */
    protected function _hasUsernameExist() {
        $model = new \Model_Manager();
        $condition = ["AND" => [
            "deleted"  => 0,
            "username" => $this->Manager->username
        ] ];
        if ( $this->Manager->mid ) {
            $condition["AND"]["mid[!]"] = $this->Manager->mid;
        }

        $rows  = $model->fetchRowsByCondition($condition);

        if ( isset($rows[0]) ) {
            throw new UsernameExistException();
        }
    }

    /**
     * 验证管理员用户名是否填写
     */
    protected function _fieldUsername() {
        if ( ! $this->Manager->username ) {
            throw new RequestParameterException('用户名必须填写');
        }
    }

    /**
     * 验证管理员密码是否填写
     */
    protected function _fieldPassword() {
        if ( ! $this->Manager->password ) {
            throw new RequestParameterException('密码必须填写');
        }
    }
}