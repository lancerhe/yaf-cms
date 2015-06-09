<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Article;

use Service\Article\Entity;
use Service\ArticleCate\Tree as CateTree;

class QueryList {

    protected $_model = null;

    protected $_condition = [
        'AND' => [
            'deleted' => 0
        ]
    ];

    public function __construct() {
        $this->_model = new \Model_Article();
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

    public function setOrderByVisitor() {
        $this->_condition['ORDER'] = [
            'publishdate DESC',
        ];
    }

    public function setCName($cname, $children=false) {
        $ModelCate = new \Model_ArticleCate();
        if ( false === $cate = $ModelCate->fetchByCName($cname) ) {
            $this->_condition['AND']['cid'] = 0;
            return;
        }
        if ( $children ) 
            $this->_condition['AND']['cid'] = (new CateTree())->queryChildrenIdsAndSelfId($cate['cid']);
        else 
            $this->_condition['AND']['cid'] = (new CateTree())->queryChildrenIds($cate['cid']);
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