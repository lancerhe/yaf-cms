<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Article;

use Service\Article\Entity;

class QueryList {

    protected $_model = null;

    protected $_condition = [
        'AND' => [
            'deleted' => 0
        ]
    ];

    public function __construct() {
        $this->_model = new \Model_Page();
    }

    public function setLimit($start, $limit) {
        $start = intval($start);
        $limit = intval($limit);
        $this->_condition['LIMIT'] = [$start, $limit];
    }

    public function setOrderForManager() {
        $this->_condition['ORDER'] = [
            'createtime ASC', 
        ];
    }

    public function fetchCount() {
        $condition = $this->_condition;
        unset($condition['LIMIT']);
        $count = $this->_model->fetchCountByCondition($condition);
        return $count;
    }

    public function fetchAll() {
        $condition = $this->_condition;
        return $rows = $this->_model->fetchRowsByCondition($condition);
    }

    public function fetchEntities() {
        $rows = $this->fetchAll();
        $entities = array();
        foreach ($rows as $row) {
            $entities[] = new Entity($row);
        }
        return $entities;
    }
}