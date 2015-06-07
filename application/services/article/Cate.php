<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Article;

class Cate {

    protected $_tree;

    public function __construct() {
        $this->_treelist = (new \Model_ArticleCate())->fetchListRecursion();
    }

    public function queryTreeList() {
        return $this->_treelist;
    }
}