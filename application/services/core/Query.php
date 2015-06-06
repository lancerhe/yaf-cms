<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-06-06
 */

namespace Service\Core;

use Core\Exception\ResourceHasTrashException;

class Query {

    protected $_assoc;

    protected $_Entity;

    public function getAssoc() {
        return $this->_assoc;
    }

    public function getEntity() {
        return $this->_Entity;
    }

    /**
     * 过滤已删除
     * @return void|exception
     */
    public function filterTrash() {
        if ( $this->_Entity->isTrash() ) {
            throw new ResourceHasTrashException();
        }
    }
}