<?php
/**
 * 管理员列表搜索类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-12-09
 */

namespace Service\Manager;

use Service\Manager\Entity;

class QueryList {

    /**
     * 模型对象
     */
    protected $_model = null;

    /**
     * 检索条件
     */
    protected $_condition = [
        'deleted' => 0,
    ];

    /**
     * 初始化
     */
    public function __construct() {
        $this->_model = new \Model_Manager();
    }

    /**
     * 检索返回变量
     */
    public function fetchAll() {
        $condition = $this->_condition;
        $condition['ORDER'] = [
            'mid ASC',
        ];
        return $this->_model->fetchRowsByCondition($condition);
    }

    /**
     * 检索返回对象
     */
    public function fetchEntities() {
        $rows = $this->fetchAll();
        $entities = array();
        foreach ($rows as $row) {
            $entities[] = new Entity($row);
        }
        return $entities;
    }
}