<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Article;

use Core\Exception\ResourceNotFoundException;

class Cate {

    protected $_tree;

    protected $_Model;

    public function __construct() {
        $this->_Model = (new \Model_ArticleCate());
    }

    public function queryTreeRecords() {
        return $this->_Model->fetchListRecursion();
    }

    public function queryTreeOptionsList() {
        $records = $this->queryTreeRecords();
        $list = [];
        foreach ($records as $record) {
            $list[$record['cid']] = str_repeat("&#160;&#160;&#160;&#160;", $record['depth']) . '┕' . $record['name'];
        }
        return $list;
    }

    public function trash($id) {
        if ( false === $cate = $this->_Model->fetchById($id) ) {
            throw new ResourceNotFoundException();
        }
        $trash_ids = [$id];
        $children  = $this->_Model->fetchListRecursionByFid($id);
        if ( ! empty($children) ) {
            $trash_ids = array_merge($trash_ids, \Util_Array::column($children, 'cid') );
        }

        $this->_Model->updateRowsByPk($trash_ids, ["deleted" => 1]);
    }
}