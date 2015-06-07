<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\ArticleCate;

class Merge {

    public function __construct() {
        $this->_Model = (new \Model_ArticleCate());
    }

    public function single($row) {
        $cate_list = $this->_Model->fetchListGroupById();
        $row['cate'] = $cate_list[$row[$key_cid]];
        return $row;
    }

    public function muti($rows, $key_cid='cid', $key_cate='cate') {
        $cate_list = $this->_Model->fetchListGroupById();
        foreach ($rows as &$row) {
            $row['cate'] = $cate_list[$row[$key_cid]];
        }
        return $rows;
    }
}