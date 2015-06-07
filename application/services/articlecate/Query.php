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

    public $Model;

    /**
     * 初始化查询类
     * @param mixed $page  CATE ID/CATE CNAME
     * @param void
     */
    public function __construct($page) {
        $this->Model = new \Model_ArticleCate();
        is_numeric($page) ? $this->fetchById($page) : $this->fetchByCname($page);
    }

    protected function _init($row) {
        if ( empty($row) ) {
            throw new ResourceNotFoundException();
        }
        $this->_assoc  = $row;
        $this->_Entity = new Entity($row);
    }

    /**
     * 以ID进行检索
     * @param int $id
     * @param void
     */
    public function fetchById($id) {
        $this->_init($this->Model->fetchRowByPk($id));
    }

    /**
     * 以CNAME进行检索
     * @param string $cname
     * @param void
     */
    public function fetchByCname($cname) {
        $this->_init($this->Model->fetchRowsByCondition(["cname" => $cname])[0]);
    }
}