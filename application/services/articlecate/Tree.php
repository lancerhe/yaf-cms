<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\ArticleCate;

class Tree {

    protected $_tree;

    protected $_Model;

    public function __construct() {
        $this->_Model = (new \Model_ArticleCate());
    }

    public function queryAll() {
        return $this->_Model->fetchListRecursion();
    }

    public function queryTreeOptionsList() {
        $records = $this->queryAll();
        $list = [];
        foreach ($records as $record) {
            $list[$record['cid']] = str_repeat("&#160;&#160;&#160;&#160;", $record['depth']) . '┕' . $record['name'];
        }
        return $list;
    }

    public function queryTreeOptionsListWithoutId($id) {
        $ids     = $this->queryChildrenIdsAndSelfId($id);
        $records = $this->queryAll();
        $list = [];
        foreach ($records as $record) {
            if ( in_array( $record['cid'], $ids) ) continue;
            $list[$record['cid']] = str_repeat("&#160;&#160;&#160;&#160;", $record['depth']) . '┕' . $record['name'];
        }
        return $list;
    }

    public function queryChildrenIdsAndSelfId($id) {
        return array_merge([$id], $this->queryChildrenIds($id));
    }

    public function queryChildrenIds($id) {
        $ids = [];
        $children  = $this->_Model->fetchListRecursionByFid($id);
        if ( ! empty($children) ) {
            $ids = \Util_Array::column($children, 'cid');
        }
        return $ids;
    }
}