<?php
/**
 * 管理员列表查询
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-11-17
 */

namespace Service\Manager;

use Service\Manager\Entity;
use Service\Manager\Exception\NotFoundException;
use Service\Manager\Exception\HasTrashException;
use Service\Core\Query as Core_Query;

class Query extends Core_Query {

    /**
     * 初始化查询类
     * @param mixed $manager  管理员ID/用户名
     * @param void
     */
    public function __construct($manager) {
        is_numeric($manager) ? $this->fetchById($manager) : $this->fetchByUsername($manager);
    }

    /**
     * 以用户ID进行检索
     * @param int $mid 管理员ID
     * @param void
     */
    public function fetchById($mid) {
        $model = new \Model_Manager();
        $row   = $model->fetchRowByPk($mid);
        if ( empty($row) ) {
            throw new NotFoundException();
        }
        $this->_assoc  = $row;
        $this->_entity = new Entity($row);
    }

    /**
     * 以用户名进行检索
     * @param string $username 管理员用户名
     * @param void
     */
    public function fetchByUsername($username) {
        $model = new \Model_Manager();
        $rows  = $model->fetchRowsByCondition(["username" => $username]);
        if ( ! isset($rows[0]) ) {
            throw new NotFoundException();
        }
        $this->_assoc  = $rows[0];
        $this->_entity = new Entity($rows[0]);
    }

    /**
     * 过滤已删除
     * @return void|exception
     */
    public function filterTrash() {
        if ( $this->_entity->isTrash() ) {
            throw new HasTrashException();
        }
    }
}