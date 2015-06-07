<?php
/**
 * 管理员列表查询
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-17
 */

namespace Service\Manager;

use Service\Manager\Entity;
use Core\Exception\ResourceNotFoundException;
use Service\Core\Query as Core_Query;

class Query extends Core_Query {

    public $Model;

    /**
     * 初始化查询类
     * @param mixed $manager  管理员ID/用户名
     * @param void
     */
    public function __construct($manager) {
        $this->Model = new \Model_Manager();
        is_numeric($manager) ? $this->fetchById($manager) : $this->fetchByUsername($manager);
    }

    protected function _init($row) {
        if ( empty($row) ) {
            throw new ResourceNotFoundException();
        }
        $this->_assoc  = $row;
        $this->_Entity = new Entity($row);
    }

    /**
     * 以用户ID进行检索
     * @param int $mid 管理员ID
     * @param void
     */
    public function fetchById($mid) {
        $this->_init($this->Model->fetchRowByPk($mid));
    }

    /**
     * 以用户名进行检索
     * @param string $username 管理员用户名
     * @param void
     */
    public function fetchByUsername($username) {
        $this->_init($this->Model->fetchRowsByCondition(["username" => $username])[0]);
    }
}