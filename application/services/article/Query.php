<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-07
 */

namespace Service\Article;

use Service\Article\Entity;
use Service\Core\Query as Core_Query;
use Core\Exception\ResourceNotFoundException;

class Query extends Core_Query {

    public $Model;

    /**
     * 初始化查询类
     * @param int  $id  
     * @param void
     */
    public function __construct($id) {
        $this->Model = new \Model_Article();
        $this->fetchById($id);
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
}