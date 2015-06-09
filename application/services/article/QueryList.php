<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Article;

use Service\Article\Entity;
use Service\ArticleCate\Tree as CateTree;

class QueryList {

    protected $_Model;

    protected $_Model_Cate;

    protected $_condition = [
        'AND' => [
            'deleted' => 0
        ]
    ];

    public function __construct() {
        $this->_Model      = new \Model_Article();
        $this->_Model_Cate = new \Model_ArticleCate();
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

    public function setTitle($title) {
        $title = trim($title);
        if ( ! $title ) return;
        $this->_condition['AND']['title[~]'] = $title;
    }

    public function setCid($cid, $children=false) {
        if ( ! $cid ) return;
        if ( false === $cate = $this->_Model_Cate->fetchById($cid) ) {
            $this->_condition['AND']['cid'] = 0;
            return;
        }
        $this->_condition['AND']['cid'] = $children ? (new CateTree())->queryChildrenIdsAndSelfId($cid) : $cid;
    }

    public function setCName($cname, $children=false) {
        $cname = trim($cname);
        if ( ! $cname ) return;
        if ( false === $cate = $this->_Model_Cate->fetchByCName($cname) ) {
            $this->_condition['AND']['cid'] = 0;
            return;
        }
        $this->_condition['AND']['cid'] = $children ? (new CateTree())->queryChildrenIdsAndSelfId($cid) : $cid;
    }

    public function fetchCount() {
        $condition = $this->_condition;
        unset($condition['LIMIT']);
        $count = $this->_Model->fetchCountByCondition($condition);
        return $count;
    }

    public function fetchAll() {
        $condition = $this->_condition;
        return $rows = $this->_Model->fetchRowsByCondition($condition);
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