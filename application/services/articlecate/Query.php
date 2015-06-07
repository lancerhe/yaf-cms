<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\ArticleCate;

use Service\ArticleCate\Entity;
use Service\Core\Query as Core_Query;
use Core\Exception\ResourceNotFoundException;

class Query extends Core_Query {

    /**
     * 初始化查询类
     * @param mixed $page  CATE ID/CATE CNAME
     * @param void
     */
    public function __construct($page) {
        is_numeric($page) ? $this->fetchById($page) : $this->fetchByCname($page);
    }

    /**
     * 以ID进行检索
     * @param int $id
     * @param void
     */
    public function fetchById($id) {
        $model = new \Model_ArticleCate();
        $row   = $model->fetchRowByPk($id);
        if ( empty($row) ) {
            throw new ResourceNotFoundException();
        }
        $this->_assoc  = $row;
        $this->_Entity = new Entity($row);
    }

    /**
     * 以CNAME进行检索
     * @param string $cname
     * @param void
     */
    public function fetchByCname($cname) {
        $model = new \Model_ArticleCate();
        $rows  = $model->fetchRowsByCondition(["cname" => $cname]);
        if ( ! isset($rows[0]) ) {
            throw new ResourceNotFoundException();
        }
        $this->_assoc  = $rows[0];
        $this->_Entity = new Entity($rows[0]);
    }
}